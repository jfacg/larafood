@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('users.index')}}">Usuários</a></li>
    </ol>
    <h1>Usuários <a href="{{ route('users.create') }}" class="btn btn-dark">Novo</a> </h1>

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('users.search')}}" method="POST" class="form form-inline">
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
                        <th>E-mail</th>
                        <th style="width: 200px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user )
                        <tr>
                            <td>
                                {{ $user->name}}
                            </td>
                            <td>
                                {{ $user->email}}
                            </td>
                            <td style="width: 200px;">
                                {{--  <a href="{{ route('details.users.index', $user->id)}}" class="btn btn-primary"><i class="fas fa-search"></i></a>  --}}
                                <a href="{{ route('users.edit', $user->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('users.show', $user->id)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!!$users->appends($filters)->links()!!}

            @else
                {!!$users->links()!!}
            @endif
        </div>
    </div>
@stop