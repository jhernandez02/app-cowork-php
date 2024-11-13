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
        
        $horaInicio = Carbon::createFromFormat('H:i', $hora);

        return !Reserva::where('sala_id', $salaId)
        ->where('fecha', $fecha)
        ->whereBetween('hora', [
            $horaInicio->copy()->subHour(), 
            $horaInicio->copy()->addMinutes(59)
         ])->exists();
    }
}
