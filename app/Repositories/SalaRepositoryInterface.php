<?php

namespace App\Repositories;

use App\Models\Sala;

interface SalaRepositoryInterface
{
    public function getAllSalas();
    public function findSalaById(int $id): ?Sala;
    public function createSala(array $data): Sala;
    public function updateSala(int $id, array $data): bool;
    public function deleteSala(int $id): bool;
}
