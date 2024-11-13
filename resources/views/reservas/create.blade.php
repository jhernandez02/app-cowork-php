@extends('layouts.app')

@section('content')
<h1>Crear Reserva</h1>

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<form action="{{ route('reservas.store') }}" method="POST">
    @csrf
    <div class="form-group mb-3">
        <label for="sala_id">Sala</label>
        <select name="sala_id" id="sala_id" class="form-control" required>
            <option value="">Seleccione una opción</option>
            @foreach ($salas as $sala)
                <option value="{{ $sala->id }}">{{ $sala->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group mb-3">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group mb-3">
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora" class="form-control" required>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Reservar</button> 
    <a class="btn btn-secondary" href="/reservas">Cancelar</a>
</form>
@endsection
