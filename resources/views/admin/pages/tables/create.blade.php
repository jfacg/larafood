@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <h1>Nova Mesa</h1>
@stop

@section('content')
    <div class="card">
      <div class="card-body">
        <form action="{{ route('tables.store') }}" class="form" method="POST">
          @csrf

          @include('admin.pages.tables._partials.form')
        </form>
      </div>
    </div>
@endsection