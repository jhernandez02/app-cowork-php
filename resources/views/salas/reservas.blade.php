@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Reservas para la Sala: {{ $sala->nombre }}</h3>
    <div>
        <a href="{{ route('salas.index') }}" class="btn btn-secondary">
            Volver a las salas
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Hora</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($reservas as $reserva)
            <tr>
                <td>{{ $reserva->user->name }}</td>    
                <td class="text-center">{{ App\Helpers\Util::formatDate($reserva->fecha) }}</td>
                <td class="text-center">{{ $reserva->hora }}</td>
                <td class="text-center">{!! App\Helpers\Util::badgeStatus($reserva->estado) !!}</td>
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