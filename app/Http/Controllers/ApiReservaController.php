<?php

namespace App\Http\Controllers;

use App\Mail\ReservaView;
use App\Models\Fecha;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ApiReservaController extends Controller
{
    public function crearReserva(Request $request)
    {
        $user_id = $request->user()->id;

        try {
            $validateReserva = Validator::make(
                $request->all(),
                [
                    'n_personas' => 'required',
                    'menu' => 'required',
                    'alergias' => 'required',
                    'fecha' => 'required',
                    'hora' => 'required',
                ]
            );

            if ($validateReserva->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateReserva->errors()
                ], 422);
            }

            $reserva = Reserva::create([
                'n_personas' => $request->n_personas,
                'menu' => $request->menu,
                'alergias' => $request->alergias,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'user_id' => $user_id
            ]);
            Fecha::where('fecha', $request->fecha)
                ->where('hora', $request->hora)
                ->update(['disponible' => false]);

            Mail::to($request->user()->email)->send(new ReservaView($reserva));

            return response()->json([
                'status' => true,
                'message' => 'Reserva created successfully',
            ], 201);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function obtenerReservas(Request $request)
    {
        $user = $request->user();

        try {
            $reservas =  $user->reservas()->get();
            return response()->json($reservas);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function eliminarReserva($id, Request $request)
    {
        $userId = $request->user()->id;

        try {
            $reserva = Reserva::findOrFail($id);

            if ($reserva->user_id !== $userId) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }
            Fecha::where('fecha', $reserva->fecha)
                ->where('hora', $reserva->hora)
                ->update(['disponible' => true]);
            $reserva->delete();

            return response()->json([
                'status' => true,
                'message' => 'Reserva deleted successfully'
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
