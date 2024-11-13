<?php

namespace App\Repositories;

use App\Models\Sala;

class SalaRepository implements SalaRepositoryInterface
{
    public function getAllSalas()
    {
        return Sala::all();
    }

    public function findSalaById(int $id): ?Sala
    {
        return Sala::find($id);
    }

    public function createSala(array $data): Sala
    {
        return Sala::create($data);
    }

    public function updateSala(int $id, array $data): bool
    {
        $sala = $this->findSalaById($id);
        return $sala ? $sala->update($data) : false;
    }

    public function deleteSala(int $id): bool
    {
        $sala = $this->findSalaById($id);
        return $sala ? $sala->delete() : false;
    }
}
