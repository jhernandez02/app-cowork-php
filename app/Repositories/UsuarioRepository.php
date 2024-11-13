<?php

namespace App\Repositories;

use App\Models\User;

class UsuarioRepository implements UsuarioRepositoryInterface
{
    public function createUsuario(array $data): User
    {
        return User::create($data);
    }
}
