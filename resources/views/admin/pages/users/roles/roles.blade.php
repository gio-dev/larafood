@extends('adminlte::page')

@section('title', "Cargos do usuário {$user->name}")

@section('content_header')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="active" href="{{ route('users.index') }}">Usuários</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('users.show', $user->id) }}">Usuário {{ $user->name }}</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="active" href="javascript:void(0)">Cargos do usuário {{ $user->name }}</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Cargos do usuário {{ $user->name }}</h1>
{{--        <a href="{{ route('profiles.permissions.avaliable', $profile->id) }}" class="btn btn-outline-info">--}}
{{--          <i class="fas fa-plus-circle"></i>--}}
{{--        </a>--}}
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
{{--            <form method="post" action="{{ route('profiles.search') }}" class="form form-inline" name="form-filtes">--}}
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>
                                {{ $role->name }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
{{--            @if (isset($filters))--}}
{{--                {!! $permissions->appends($filters)->links() !!}--}}
{{--            @else--}}
                {!! $roles->links() !!}
{{--            @endif--}}

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
