<?php

namespace App\Http\Controllers;

use App\Models\Fecha;
use Illuminate\Http\Request;
use Throwable;

class ApiFechaController extends Controller
{
    public function obtenerfechas()
    {
        try {
            $fechas = Fecha::where('disponible', true)->get();
            return response()->json($fechas);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
