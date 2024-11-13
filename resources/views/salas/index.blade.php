@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1>Lista de Salas</h1>
    <div>
        <a href="{{ route('salas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nueva Sala
        </a>
    </div>
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
                <th>Nombre</th>
                <th>Descripción</th>
                <th class="text-center">Reservas</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salas as $sala)
                <tr>
                    <td>{{ $sala->nombre }}</td>
                    <td>{{ $sala->descripcion }}</td>
                    <td class="text-center">
                        <a href="{{ route('sala.reservas', $sala->id) }}" class="btn btn-secondary btn-sm" title="Reservas" >
                            <i class="bi bi-list-check"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('salas.edit', $sala->id) }}" class="btn btn-primary btn-sm" title="Editar" >
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form class="deleteForm" action="{{ route('salas.destroy', $sala->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm btnDelete" title="Eliminar" >
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $('.btnDelete').click(function(){
        Swal.fire({
            title: '¿Estás seguro de elimnina este registro?',
            text: "¡No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).parent().submit();
            }
        });
    });
</script>
@endsection
