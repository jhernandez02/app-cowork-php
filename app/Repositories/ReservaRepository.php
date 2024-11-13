<?php

namespace App\Repositories;

use App\Models\Reserva;
use Carbon\Carbon;

class ReservaRepository implements ReservaRepositoryInterface
{
    public function getAllReservas()
    {
        return Reserva::all();
    }

    public function getReservasBySala($salaId)
    {
        return Reserva::where('sala_id', $salaId)->get();
    }

    public function getReservasByUser(int $userId)
    {
        return Reserva::where('user_id', $userId)->get();
    }

    public function findReservaById(int $id): ?Reserva
    {
        return Reserva::find($id);
    }

    public function createReserva(array $data): Reserva
    {
        return Reserva::create($data);
    }

    public function updateReserva(int $id, array $data): bool
    {
        $reserva = $this->findReservaById($id);
        return $reserva ? $reserva->update($data) : false;
    }

    public function deleteReserva(int $id): bool
    {
        $reserva = $this->findReservaById($id);
        return $reserva ? $reserva->delete() : false;
    }

    public function isAvailable(int $salaId, string $fecha, string $hora): bool
    {
        
        $horaInicio = Carbon::createFromFormat('H:i', $hora); // Hora solicitada
        $horaFin = $horaInicio->copy()->addHour(); // Hora de fin (1 hora después)

        return !Reserva::where('sala_id', $salaId)
            ->where('fecha', $fecha)
            ->where(function ($query) use ($horaInicio, $horaFin) {
                $query->where(function($query) use ($horaInicio, $horaFin) {
                    // Verifica que no haya una reserva que empiece dentro del rango solicitado
                    $query->whereBetween('hora', [
                        $horaInicio->format('H:i'),
                        $horaFin->format('H:i')
                    ]);
                })
                // Permite hacer la reserva si no hay solapamiento de más de 59 minutos
                ->orWhere(function($query) use ($horaInicio) {
                    $query->whereRaw("DATE_ADD(hora, INTERVAL 1 HOUR) <= ?", [$horaInicio->format('H:i')]);
                })
                ->orWhere(function($query) use ($horaFin) {
                    $query->whereRaw("hora >= DATE_SUB(?, INTERVAL 59 MINUTE)", [$horaFin->format('H:i')]);
                });
            })
            ->exists();
    }
}
