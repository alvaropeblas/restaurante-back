<?php

namespace App\Http\Controllers;

use App\Models\Tarjeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ApiTarjetaController extends Controller
{
    public function crearTarjeta(Request $request)
    {
        $user_id = $request->user()->id;

        try {
            $validateTarjeta = Validator::make(
                $request->all(),
                [
                    'n_tarjeta' => 'required',
                    'f_vencimiento' => 'required',
                    'cvv' => 'required',
                ]
            );

            if ($validateTarjeta->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateTarjeta->errors()
                ], 422);
            }

            Tarjeta::create([
                'n_tarjeta' => $request->n_tarjeta,
                'f_vencimiento' => $request->f_vencimiento,
                'cvv' => $request->cvv,
                'user_id' => $user_id,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Tarjeta created successfully',
            ], 201);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function obtenerTarjetas(Request $request)
    {
        $user = $request->user();

        try {
            $tarjetas =  $user->tarjetas()->get();
            return response()->json($tarjetas);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function eliminarTarjeta($id, Request $request)
    {
        $userId = $request->user()->id;

        try {
            $tarjeta = Tarjeta::findOrFail($id);

            if ($tarjeta->user_id !== $userId) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $tarjeta->delete();

            return response()->json([
                'status' => true,
                'message' => 'Tarjeta deleted successfully'
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
