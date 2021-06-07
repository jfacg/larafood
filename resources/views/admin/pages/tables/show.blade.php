@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <h1>Detalhes da Mesa  <b>{{$table->identify}}</b></h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <ul>
      <li>
        <strong>Nome: </strong> {{$table->identify}}
      </li>
      <li>
        <strong>Descrição: </strong> {{ $table->description}}
      </li>
    </ul>
    @include('admin.includes.alerts')
  </div>
  <div class="card-footer">
    <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Excluir</button>
    </form>
  </div>
</div>
@endsection