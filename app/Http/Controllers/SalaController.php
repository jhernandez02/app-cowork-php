<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SalaRepositoryInterface;
use App\Repositories\ReservaRepositoryInterface;

class SalaController extends Controller
{
    private $salaRepository;
    private $reservaRepository;

    public function __construct(
        SalaRepositoryInterface $salaRepository, 
        ReservaRepositoryInterface $reservaRepository
    )
    {
        $this->salaRepository = $salaRepository;
        $this->reservaRepository = $reservaRepository;
    }

    public function index()
    {
        $salas = $this->salaRepository->getAllSalas();
        return view('salas.index', compact('salas'));
    }

    public function reservasPorSala($id)
    {
        $sala = $this->salaRepository->findSalaById($id);
        $reservas = $this->reservaRepository->getReservasBySala($id);
        return view('salas.reservas', compact('sala', 'reservas'));
    }

    public function create()
    {
        return view('salas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
        ]);

        $this->salaRepository->createSala($data);
        return redirect()->route('salas.index')
                        ->with('status', 'success')
                        ->with('message', 'Sala creada correctamente.');
    }

    public function edit($id)
    {
        $sala = $this->salaRepository->findSalaById($id);

        if (!$sala) {
            return redirect()->route('salas.index')
                            ->with('status', 'error')
                            ->with('message', 'Sala no encontrada.');
        }

        return view('salas.edit', compact('sala'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
        ]);

        $success = $this->salaRepository->updateSala($id, $data);

        if (!$success) {
            return redirect()->route('salas.index')
                            ->with('status', 'error')
                            ->with('message', 'Sala no encontrada.');
        }

        return redirect()->route('salas.index')
                            ->with('status', 'success')
                            ->with('message', 'Sala actualizada correctamente.');
    }

    public function destroy($id)
    {
        $success = $this->salaRepository->deleteSala($id);

        if (!$success) {
            return redirect()->route('salas.index')
                            ->with('status', 'error')
                            ->with('message', 'Sala no encontrada.');
        }

        return redirect()->route('salas.index')
                            ->with('status', 'success')
                            ->with('message', 'Sala eliminada correctamente.');
    }
}
