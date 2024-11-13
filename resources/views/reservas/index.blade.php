@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1>Lista de Reservas</h1>
    @if(Auth::user()->role=='C')
    <div>
        <a href="{{ route('reservas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nueva Reserva
        </a>
    </div>
    @endif
</div>

@if(session('status'))
<div class="alert alert-{{session('status')}} alert-dismissible fade show" role="alert">
    {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Sala</th>
                <th>Cliente</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Hora</th>
                <th class="text-center">Estado</th>
                @if(Auth::user()->role=='A')
                <th class="text-center">Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @forelse($reservas as $reserva)
            <tr>
                <td>{{ $reserva->sala->nombre }}</td>
                <td>{{ $reserva->user->name }}</td>
                <td class="text-center">{{ App\Helpers\Util::formatDate($reserva->fecha) }}</td>
                <td class="text-center">{{ $reserva->hora }}</td>
                <td class="text-center">{!! App\Helpers\Util::badgeStatus($reserva->estado) !!}</td>
                @if(Auth::user()->role=='A')
                <td class="text-center">
                    <form class="acceptForm" action="{{ route('reservas.update', $reserva->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="estado" value="A" />
                        <button type="button" class="btn btn-success btn-sm btnStatus btn-sm" title="Aceptar" >
                            <i class="bi bi-check-circle"></i>
                        </button>
                    </form>
                    <form class="acceptForm" action="{{ route('reservas.update', $reserva->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="estado" value="R" />
                        <button type="button" class="btn btn-danger btn-sm btnStatus btn-sm" title="Aceptar" >
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </form>
                </td>
                @endif
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="5">No hay registros</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<script>
    $('.btnStatus').click(function(){
        Swal.fire({
            title: '¿Estás seguro de cambiar el estado de la reserva?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, actualizarlo',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).parent().submit();
            }
        });
    });
</script>
@endsection
