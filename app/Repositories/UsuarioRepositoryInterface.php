<?php

namespace App\Repositories;

use App\Models\User;

interface UsuarioRepositoryInterface
{
    public function createUsuario(array $data): User;
}