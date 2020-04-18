<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\liquidacionesFormRequests;
use App\tbl_solicitudes_de_liquidacion;
use App\tbl_movimientos;
use Auth;
use Redirect;
use Session;
use Mail;
use App\User;
use App\tbl_parametros;
use DB;
use Illuminate\Support\Facades\Input;
use App\tbl_billeteras;

class LiquidacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->tipoUsuario;
        $user->billetera;


        $nombre = trim($request->get('NOMBRE'));
        $estado = trim($request->get('ESTADO'));

        if ($request) {
            $movimientos = 
                    DB::table('tbl_movimientos')   
                    ->select(['tbl_movimientos.*'])        
                    ->join('users', 'tbl_movimientos.ID_ARTISTA', '=', 'users.id')
                    ->where('users.name', 'like', '%' . $nombre . '%')
                    ->where('tbl_movimientos.ID_ESTADO', 'like', '%' . $estado . '%')
                    ->where('tbl_movimientos.ID_TIPO', '=', '39')
                    ->orderBy('tbl_movimientos.ID', 'DESC')
                    ->pluck('ID')
                    ->toArray();

            $movimientos = tbl_movimientos::whereIn('ID', $movimientos)    
                ->orderBy('ID', 'DESC')      
                ->paginate(15);

        }
        

        $estados = tbl_parametros::where('ID_VALOR','9')
            ->pluck('NOMBRE', 'ID');

            $precio = tbl_parametros::findOrFail(61);
        
		return view('administracion.liquidaciones.index')->with([
			"user"        => $user,
			"movimientos" => $movimientos,
			"estados" => $estados,
			"nombre" => $nombre,
            "estado" => $estado,
            "precio" => $precio,
			"liquidacionesPage" => "liquidaciones",
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(liquidacionesFormRequests $request)
    {
        try {

            $balance = 0;
            $retirosPendientes = tbl_movimientos::where('ID_ARTISTA', Auth::user()->id)
                ->where('ID_ESTADO', 42)
                ->where('ID_TIPO', 39)
                ->get();

            foreach ($retirosPendientes as $item) {
                $balance += $item->COSTO_TOTAL;
            }

            $billetera = tbl_billeteras::where('ID_USER', Auth::user()->id)->get();

            $totalDisponibles = $billetera->first()->SALDO;

            $balance = $totalDisponibles - $balance;

            if($balance < $request->get('RETIRAR')){
                Session::flash('message_error', 'Opps!. A ocurrido un error verifique e intentenuvamente');
                return Redirect::back();
            }


            //Registramos la movimiento 
            $movimiento = new tbl_movimientos();
            $movimiento->ID_ARTISTA = Auth::user()->id;
            $movimiento->ID_CLIENTE = Auth::user()->id;
            $movimiento->ID_TIPO = 39;
            $movimiento->ID_ESTADO = 42;
            $movimiento->COSTO_TOTAL = $request->get('RETIRAR');
            $movimiento->PORCENTAJE_PLATAFORMA = '0';
            $movimiento->COMICION_PLATAFORMA = '0';
            $movimiento->PORCENTAJE_ARTISTA = '0';
            $movimiento->COMICION_ARTISTA = '0';
            $movimiento->save();

            $liquidacion                                   = new tbl_solicitudes_de_liquidacion;
            $liquidacion->ID_ARTISTA                       = Auth::user()->id;
            $liquidacion->CANTIDAD                         = $request->get('RETIRAR');
            $liquidacion->ID_MOVIMIENTO                    = $movimiento->ID;
            $liquidacion->ID_ESTADO                        = 42;
            $liquidacion->save();



            Session::flash('message', 'Solicitud de liquidación envida exitosamente');
            return redirect::to('perfil');

        } catch (\PDOException $e) {
            return Redirect::back()
                ->withErrors([$e->errorInfo[2]])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(liquidacionesFormRequests $request, $id)
    {
        $movimiento = tbl_movimientos::findOrFail($id);
        
        if ($request->hasFile('SOPORTE')) {
            $file = Input::file('SOPORTE');
            $name = $id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/upload/soportes/liquidaciones/', $name);
            $movimiento->SOPORTE = $name;
        }
        $movimiento->ID_ESTADO = 40;
        $movimiento->update();

        $liquidacion = tbl_solicitudes_de_liquidacion::where('ID_MOVIMIENTO', $id)->get();
        $liquidacion = $liquidacion->first();
        $liquidacion->ID_ESTADO = 40;
        $liquidacion->update();

        $billetera = tbl_billeteras::where('ID_USER',$liquidacion->ID_ARTISTA)->get();
        $billetera = $billetera->first();
        $billetera->SALDO = $billetera->SALDO - $liquidacion->CANTIDAD;
        $billetera->update();

        $msg = tbl_parametros::where('ID', '59')->get();

        //Información del artista
        $artista = User::findOrfail($liquidacion->ID_ARTISTA);

        $data['nameArtista'] = $artista->name;
        $data['email'] = $artista->email;

        Mail::send('mail.liquidacion', ['data' => $data, 'msg' => $msg->first()], function ($mail) use ($data) {
            $mail->subject('Aprobación de solicitud retiro');
            $mail->to($data['email'], $data['nameArtista']);
        });

        Session::flash('message', 'Solicitud de liquidación aprobada satisfactoriamente');
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movimiento = tbl_movimientos::findOrFail($id);
        $movimiento->ID_ESTADO = 41;
        $movimiento->SOPORTE = '';
        $movimiento->update();

        $liquidacion = tbl_solicitudes_de_liquidacion::where('ID_MOVIMIENTO', $id)->get();
        $liquidacion = $liquidacion->first();
        $liquidacion->ID_ESTADO = 41;
        $liquidacion->update();

        

        Session::flash('message', 'Solicitud de liquidación rechazada satisfactoriamente');
        return Redirect::back();


    }
}
