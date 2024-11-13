<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ReservaRepositoryInterface;
use App\Repositories\SalaRepositoryInterface;

class ReservaController extends Controller
{
    private $reservaRepository;
    private $salaRepository;

    public function __construct(ReservaRepositoryInterface $reservaRepository, SalaRepositoryInterface $salaRepository)
    {
        $this->reservaRepository = $reservaRepository;
        $this->salaRepository = $salaRepository;
    }

    public function index()
    {
        $reservas = [];
        if(Auth::user()->role=='A'){
            $reservas = $this->reservaRepository->getAllReservas();
        }else{
            $userId = Auth::user()->id;
            $reservas = $this->reservaRepository->getReservasByUser($userId);
        }
        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        $salas = $this->salaRepository->getAllSalas();
        return view('reservas.create', compact('salas'));
    }

    public function store(Request $request)
    {   
        $data = $request->validate([
            'sala_id' => 'required|exists:salas,id',
            'fecha' => 'required|date',
            'hora' => 'required|string',
        ]);

        // Validar disponibilidad
        if (!$this->reservaRepository->isAvailable($data['sala_id'], $data['fecha'], $data['hora'])) {
            return redirect()->back()
                ->with('error', 'La sala ya está reservada en ese horario. Por favor, elige otra hora.')
                ->withInput();
        }

        $data['user_id'] = Auth::user()->id;
        $data['estado'] = 'P';
        $this->reservaRepository->createReserva($data);

        return redirect()->route('reservas.index')
                            ->with('status', 'success')
                            ->with('message', '¡Reserva creada exitosamente! Está pendiente de aprobación.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'estado' => 'required|string',
        ]);

        $backUrl = url()->previous();

        $success = $this->reservaRepository->updateReserva($id, $data);

        if (!$success) {
            return redirect->back()
                            ->with('status', 'error')
                            ->with('message', 'Reserva no encontrada.');
        }

        return redirect->back()
                            ->with('status', 'success')
                            ->with('message', 'Reserva actualizada correctamente.');
    }
}
