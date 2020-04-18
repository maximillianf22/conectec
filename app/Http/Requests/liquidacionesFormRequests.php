<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class liquidacionesFormRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            case 'POST':
                return ['MI_BILLETERA' => 'required','RETIRAR' => 'required'];
            case 'PUT':
            case 'PATCH':
                return [
                    'SOPORTE' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
                ];
            default:
                break;
        }
    }
}
