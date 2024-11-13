<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UsuarioRepositoryInterface;

class RegisterController extends Controller
{
    private $usuarioRepository;

    public function __construct(UsuarioRepositoryInterface $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function index()
    {
        return view('auth.register');
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ]);
        
        $data['password'] = Hash::make($request->password);

        $this->usuarioRepository->createUsuario($data);
        return redirect()->route('login')
                        ->with('success', 'Usuario creado correctamente.');
    }
}
