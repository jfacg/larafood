@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('profiles.index')}}">Perfil</a></li>
    </ol>
    <a href="{{ route('profiles.plans.available', $profile->id) }}" class="btn btn-dark">Novo Plano</a>
    <h1>  Planos do Perfil <strong>{{$profile->name}}</strong> </h1>

@stop

@section('content')
    <div class="card">
        {{-- <div class="card-header">
            <form action="{{route('profiles.search')}}" method="POST" class="form form-inline">
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
                    @foreach ($plans as $plan )
                        <tr>
                            <td>
                                {{ $plan->name}}
                            </td>
                            <td>
                                {{$plan->description}}
                            </td>
                            <td style="width: 200px;">
                                <a href="{{ route('profiles.plans.detach', [$profile->id, $plan->id])}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!!$plans->appends($filters)->links()!!}

            @else
                {!!$plans->links()!!}
            @endif
        </div>
    </div>
@stop