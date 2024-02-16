<?php

namespace App\Http\Controllers;

use App\Mail\ReservaView;
use App\Mail\ReservaViewOut;
use App\Models\Fecha;
use App\Models\Reservasoout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ApiReservaOutController extends Controller
{
    public function crearReserva(Request $request)
    {

        try {
            $validateReserva = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'apellidos' => 'required',
                    'email' => 'required',
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

            $reserva = Reservasoout::create([
                'name' => $request->name,
                'apellidos' => $request->apellidos,
                'email' => $request->email,
                'n_personas' => $request->n_personas,
                'menu' => $request->menu,
                'alergias' => $request->alergias,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
            ]);
            Fecha::where('fecha', $request->fecha)
                ->where('hora', $request->hora)
                ->update(['disponible' => false]);

/*             Mail::to($request->email)->send(new ReservaViewOut($reserva));
 */
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
}
