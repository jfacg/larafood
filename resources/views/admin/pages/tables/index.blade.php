@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('tables.index')}}">Planos</a></li>
    </ol>
    <h1>Mesas <a href="{{ route('tables.create') }}" class="btn btn-dark">Novo</a> </h1>

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('tables.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Mesa</th>
                        <th>Descrição</th>
                        <th style="width: 200px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tables as $table )
                        <tr>
                            <td>
                                {{ $table->identify}}
                            </td>
                            <td>
                                {{ $table->description}}
                            </td>
                            <td style="width: 200px;">
                                {{--  <a href="{{ route('details.tables.index', $table->id)}}" class="btn btn-primary"><i class="fas fa-search"></i></a>  --}}
                                <a href="{{ route('tables.edit', $table->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('tables.show', $table->id)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!!$tables->appends($filters)->links()!!}

            @else
                {!!$tables->links()!!}
            @endif
        </div>
    </div>
@stop