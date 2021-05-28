@extends('adminlte::page')

@section('title', 'Detalhes')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{route('plans.show', $plan->url)}}">{{$plan->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{route('details.plans.index', $plan->url)}}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{route('details.plan.show', [$plan->url, $detail->id])}}" class="active">Detalhes</a></li>
      </ol>
    <h1>Detalhe do Plano </h1>

@stop

@section('content')
    <div class="card">
        <div class="card-body">
          <ul>
            <li>
              <strong>Nome: </strong> {{$detail->name}}
            </li>
          </ul>
        </div>
        <div class="card-footer">
          <form action="{{ route('details.plan.destroy', [$plan->url, $detail->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Excluir</button>
          </form>
        </div>
    </div>
@stop