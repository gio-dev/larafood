@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="active" href="javascript:void(0)">Perfis</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Perfis</h1>
        <a href="{{ route('profiles.create') }}" class="btn btn-outline-info">
          <i class="fas fa-plus-circle"></i>
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
            <form method="post" action="{{ route('profiles.search') }}" class="form form-inline" name="form-filtes">
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
                        <th>Nome</th>
                        <th style="width: 20%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $profile)
                        <tr>
                            <td>
                                {{ $profile->name }}
                            </td>
                            <td style="width: 25%">
                                <a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-outline-warning">
                                    <span class="fas fa-eye mr-2"></span> Ver
                                </a>
                                <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-outline-primary">
                                    <span class="fas fa-edit mr-2"></span> Editar
                                </a>
                                <a href="{{ route('profiles.permissions.index', $profile->id) }}" class="btn btn-outline-secondary">
                                    <span class="fas fa-lock-open mr-2"></span>
                                </a>
                                <a href="{{ route('profiles.plans.index', $profile->id) }}" class="btn btn-outline-secondary">
                                    <span class="fas fa-user-lock mr-2"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            @if (isset($filters))
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
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
