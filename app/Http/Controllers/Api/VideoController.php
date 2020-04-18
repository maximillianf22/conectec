<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function crearVideo(Request $request)
    {
        $video = $request->file('video');
        if (!empty($video)) {
            $path_Video = public_path() . '/files/videosCantantes';
            $nameVideo = $video->getClientOriginalName();
            //Mover El Arhivo "RUT" a la Carpeta
            $video->move($path_Video, $nameVideo);
        }

        return $video;
    }
}
