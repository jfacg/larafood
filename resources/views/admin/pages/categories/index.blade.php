@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('categories.index')}}">Categorias</a></li>
    </ol>
    <h1>Categorias <a href="{{ route('categories.create') }}" class="btn btn-dark">Novo</a> </h1>

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('categories.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th style="width: 200px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category )
                        <tr>
                            <td>
                                {{ $category->name}}
                            </td>
                            <td>
                                {{ $category->description}}
                            </td>
                            <td style="width: 200px;">
                                <a href="{{ route('categories.products.index', $category->id)}}" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                <a href="{{ route('categories.edit', $category->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('categories.show', $category->id)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                            </td>
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