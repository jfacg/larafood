@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('categories.index')}}">Categoria</a></li>
    </ol>
    <a href="{{ route('categories.products.available', $category->id) }}" class="btn btn-dark">Novo Produto</a>
    <h1>  Produtos da Categoria <strong>{{$category->name}}</strong> </h1>

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
                        <th style="width: 200px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product )
                        <tr>
                            <td>
                                {{ $product->title}}
                            </td>
                            <td>
                                {{$product->description}}
                            </td>
                            <td style="width: 200px;">
                                <a href="{{ route('categories.products.detach', [$category->id, $product->id])}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!!$products->appends($filters)->links()!!}

            @else
                {!!$products->links()!!}
            @endif
        </div>
    </div>
@stop