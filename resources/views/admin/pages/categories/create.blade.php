@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Nova Categoria</h1>
@stop

@section('content')
    <div class="card">
      <div class="card-body">
        <form action="{{ route('categories.store') }}" class="form" method="POST">
            @include('admin.pages.categories._partials.form')
        </form>
      </div>
    </div>
@endsection