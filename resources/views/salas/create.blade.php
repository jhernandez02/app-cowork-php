@extends('layouts.app')

@section('content')
<div class="mb-3">
    <h1>Crear Sala</h1>
</div>

<form action="{{ route('salas.store') }}" method="POST">
    @csrf
    <div class="form-group mb-3">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>
    <div class="form-group mb-3">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button> 
    <a class="btn btn-secondary" href="/salas">Cancelar</a>
</form>
@endsection
