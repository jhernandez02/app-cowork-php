@extends('layouts.app')

@section('content')
<div class="mb-3">
    <h1>Editar Sala</h1>
</div>

<form action="{{ route('salas.update', $sala->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $sala->nombre }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control">{{ $sala->descripcion }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button> 
    <a class="btn btn-secondary" href="/salas">Cancelar</a>
</form>
@endsection
