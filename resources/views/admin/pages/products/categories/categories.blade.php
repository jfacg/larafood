@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('products.index')}}">Categoria</a></li>
    </ol>
    {{--  <a href="{{ route('products.categories.available', $product->id) }}" class="btn btn-dark">Novo Produto</a>
    <h1>  Categorias do produto <strong>{{$product->title}}</strong> </h1>  --}}

@stop

@section('content')
    <div class="card">
        {{-- <div class="card-header">
            <form action="{{route('categorys.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
            </form>
        </div> --}}
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Description</th>
                        {{--  <th style="width: 200px;">Ações</th>  --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category )
                        <tr>
                            <td>
                                {{ $category->name}}
                            </td>
                            <td>
                                {{$category->description}}
                            </td>
                            {{--  <td style="width: 200px;">
                                <a href="{{ route('products.categories.detach', [$category->id, $product->id])}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>  --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!!$categories->appends($filters)->links()!!}

            @else
                {!!$categories->links()!!}
            @endif
        </div>
    </div>
@stop