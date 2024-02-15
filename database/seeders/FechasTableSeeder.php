<?php

use App\Models\Fecha;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FechasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define las fechas y horas para febrero y marzo
        $fechas = [];

        // Añade todas las fechas de martes a sábado para febrero y marzo
        for ($month = 2; $month <= 3; $month++) {
            $year = 2024; // Cambia el año según sea necesario
            $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $currentDate = Carbon::create($year, $month, $day);

                // Agrega solo las fechas de martes a sábado
                if ($currentDate->isTuesday() || $currentDate->isWednesday() || $currentDate->isThursday() || $currentDate->isFriday() || $currentDate->isSaturday()) {
                    $fechas[] = $currentDate->format('Y-m-d');
                }
            }
        }

        $horas = [
            '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00',
        ];

        foreach ($fechas as $fecha) {
            foreach ($horas as $hora) {
                Fecha::create([
                    'fecha' => $fecha,
                    'hora' => $hora,
                    'disponible' => true,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
