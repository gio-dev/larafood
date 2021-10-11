@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="active" href="javascript:void(0)">Empresas</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Empresas</h1>
{{--        <a href="{{ route('tenants.create') }}" class="btn btn-outline-info">--}}
{{--          <i class="fas fa-plus-circle"></i>--}}
{{--        </a>--}}
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
            <form method="post" action="{{ route('tenants.search') }}" class="form form-inline" name="form-filtes">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" class="form-control" placeholder="Pesquise qualquer informação da Empresas"
                           value="{{ $filters['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-outline-success"><span class="fas fa-search"></span> Filtrar</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nome</th>
                        <th style="width: 20%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tenants as $tenant)
                        <tr>
                            <td>
                                <img style="max-height: 80px" class="img-fluid" src="{{ asset("storage/{$tenant->logo}") }}" alt="{{ $tenant->name }}">
                            </td>
                            <td>
                                {{ $tenant->name }}
                            </td>
                            <td style="width: 25%">
                                <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-outline-warning">
                                    <span class="fas fa-eye mr-2"></span> Ver
                                </a>
                                <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-outline-primary">
                                    <span class="fas fa-edit mr-2"></span> Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            @if (isset($filters))
                {!! $tenants->appends($filters)->links() !!}
            @else
                {!! $tenants->links() !!}
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
