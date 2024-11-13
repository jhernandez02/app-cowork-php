<?php

namespace App\Repositories;

use App\Models\Reserva;

interface ReservaRepositoryInterface
{
    public function getAllReservas();
    public function getReservasBySala(int $salaId);
    public function getReservasByUser(int $userId);
    public function findReservaById(int $id): ?Reserva;
    public function createReserva(array $data): Reserva;
    public function updateReserva(int $id, array $data): bool;
    public function deleteReserva(int $id): bool;
    public function isAvailable(int $salaId, string $fecha, string $hora): bool;
}
