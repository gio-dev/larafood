@extends('adminlte::page')

@section('title', "Planos do perfil {$profile->name}")

@section('content_header')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('profiles.index') }}">Perfis</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('profiles.show', $profile->id) }}">Perfil {{ $profile->name }}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="active" href="{{ route('profiles.plans.index', $profile->id) }}">Permissões do perfil {{ $profile->name }}</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="active" href="javascript:void(0)">Vincular plano ao perfil {{ $profile->name }}</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Vincular plano ao perfil {{ $profile->name }}</h1>
        <a href="{{ route('profiles.plans.index', $profile->id) }}" class="btn btn-outline-info">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
    </div>
@stop

@section('content')
    @include('admin.includes.alerts')
    <div class="card">
        <div class="card-header">
            <div class="row mb-3">
                <div class="col">
                    <h4 class="card-title">Filtros</h4>
                </div>
            </div>
            <form method="post" action="{{ route('profiles.plans.avaliable', $profile->id) }}" class="form form-inline" name="form-filtes">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" class="form-control" placeholder="Pesquise qualquer informação dos planos"
                           value="{{ $filters['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-outline-success"><span class="fas fa-search"></span> Filtrar</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('profiles.plans.attach', $profile->id) }}" method="post">
                        @csrf
                        @foreach($plans as $plan)
                            <tr>
                                <td>
                                    <input type="checkbox" class="custom-checkbox" name="plans[]" value="{{ $plan->id }}">
                                </td>
                                <td>
                                    {{ $plan->name }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="text-center">
                                <button class="btn btn-success"><i class="fas fa-save"></i> Salvar</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            @if (isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
