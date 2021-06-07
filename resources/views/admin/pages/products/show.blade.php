@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1>Detalhes do Produto  <b>{{$product->name}}</b></h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <ul>
      <li>
        <img src="{{ url("storage/{$product->image}") }}" alt="" style="max-width: 90px">
      </li>
      <li>
        <strong>Nome: </strong> {{$product->title}}
      </li>
      <li>
        <strong>Flag: </strong> {{$product->flag}}
      </li>
      <li>
        <strong>Preço: </strong> R$ {{ number_format( $product->price, 2, ',', '.' )}}
      </li>
      <li>
        <strong>Descrição: </strong> {{ $product->description}}
      </li>
    </ul>
    @include('admin.includes.alerts')
  </div>
  <div class="card-footer">
    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Excluir</button>
    </form>
  </div>
</div>
@endsection