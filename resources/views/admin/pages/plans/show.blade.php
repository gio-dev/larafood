@extends('adminlte::page')

@section('title', "Detalhes do Plano {$plan->name}")

@section('content_header')
    <div>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Detalhes do Plano {{$plan->name}}</h1>
        <a href="{{ route('plans.index') }}" class="btn btn-outline-info">
          <i class="fas fa-arrow-circle-left"></i>
        </a>
    </div>
@stop

@section('content')
    @include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <b>Nome: </b>{{ $plan->name }}
                </li>
                <li>
                    <b>Url: </b>{{ $plan->url }}
                </li>
                <li>
                    <b>Preço: </b>R$ {{ number_format($plan->price,'2',',','.') }}
                </li>
                <li>
                    <b>Descrição: </b>{{ $plan->description }}
                </li>
            </ul>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <form action="{{ route('plans.destroy', $plan->url) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><span class="fas fa-eraser mr-2"></span>Deletar</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
