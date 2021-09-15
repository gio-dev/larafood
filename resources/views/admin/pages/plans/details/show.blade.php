@extends('adminlte::page')

@section('title', "Mostrar detalhe do plano {$plan->name}")

@section('content_header')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('plans.index') }}">Planos</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('plans.show', $plan->url) }}">Plano {{ $plan->name }}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('details.plan.index', $plan->url) }}">Detalhes do plano {{ $plan->name }}</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="" href="javascript:void(0)">Mostrar detalhe do plano {{$plan->name}}</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Mostrar detalhe do plano {{$plan->name}}</h1>
        <a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-outline-info">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <b>Nome: </b>{{ $detail->name }}
                </li>
                <li>
                    <b>Nome do plano: </b>{{ $detail->plan()->first()->name }}
                </li>
            </ul>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <form action="{{ route('detail.plan.destroy', [$plan->url, $detail->id]) }}" method="post">
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
