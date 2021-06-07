@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('categories.index')}}">Perfil</a></li>
    </ol>
    <h1>Produtos disponiveis para a Categoria</h1>

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('categories.products.available', $category->id)}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px"> # </th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{route('categories.products.attach', $category->id)}}" method="post">
                        @csrf

                        @foreach ($products as $product )
                        <tr>
                            <td>
                                <input type="checkbox" name="products[]" value="{{$product->id}}">
                            </td>
                            <td>
                                {{ $product->title}}
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="500">
                                @include('admin.includes.alerts')
                                <button type="submit" class="btn btn-dark">Vincular</button>
                            </td>
                        </tr>

                    </form>
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