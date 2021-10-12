@extends('adminlte::page')

@section('title', "Usuários do cargo {$role->name}")

@section('content_header')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('roles.index') }}">Cargos</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('roles.show', $role->id) }}">Cargo {{ $role->name }}</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="active" href="javascript:void(0)">Usuários do cargo {{ $role->name }}</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Usuários do cargo {{ $role->name }}</h1>
        <a href="{{ route('roles.users.avaliable', $role->id) }}" class="btn btn-outline-info">
          <i class="fas fa-plus-circle"></i>
        </a>
    </div>
@stop

@section('content')
    @include('admin.includes.alerts')
    <div class="card">
{{--        <div class="card-header">--}}
{{--            <div class="row mb-3">--}}
{{--                <div class="col">--}}
{{--                    <h4 class="card-title">Filtros</h4>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <form method="post" action="{{ route('roles.search') }}" class="form form-inline" name="form-filtes">--}}
{{--                @csrf--}}
{{--                <div class="form-group">--}}
{{--                    <input type="text" name="filter" class="form-control" placeholder="Pesquise qualquer informação dos useros"--}}
{{--                           value="{{ $filters['filter'] ?? '' }}">--}}
{{--                    <button type="submit" class="btn btn-outline-success"><span class="fas fa-search"></span> Filtrar</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th style="width: 20%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td style="width: 20%">
                                <a href="{{ route('roles.users.detach', [$role->id, $user->id]) }}" class="btn btn-outline-secondary">
                                    <span class="fas fa-lock-open "></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            @if (isset($filters))
                {!! $users->appends($filters)->links() !!}
            @else
                {!! $users->links() !!}
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
