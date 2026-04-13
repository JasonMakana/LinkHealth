<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class NfcController extends Controller
{
    public function verificacion(Request $request)
    {
        //return response()->json(['mensaje' => 'La ruta funciona, el problema es el modelo'], 200);
    
        $paciente = Paciente::where('nfc_id', $request->nfc_id)->first();

        if ($paciente) {
            return response()->json([
                'status' => 'success',
                'paciente' => $paciente->nombre.' '.$paciente->apellido_P,
                'mensaje' => 'Identificacion exitosa'
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'mensaje' => 'Identificacion fallida'.$request->ndf_id
        ], 404);
    
    }
}
