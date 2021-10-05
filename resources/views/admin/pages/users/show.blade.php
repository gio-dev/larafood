    @extends('adminlte::page')

@section('title', "Detalhes do usuário {$user->name}")

@section('content_header')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('users.index') }}">Usuários</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="active" href="javascript:void(0)">Detalhes do usuário {{ $user->name }}</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Detalhes do usuário {{ $user->name }}</h1>
        <a href="{{ route('users.index') }}" class="btn btn-outline-info">
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
                    <b>Nome: </b>{{ $user->name }}
                </li>
                <li>
                    <b>E-mail: </b>{{ $user->email }}
                </li>
                <li>
                    <b>Empresa: </b>{{ $user->tenant->name }}
                </li>
            </ul>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <form action="{{ route('users.destroy', $user->id) }}" method="post">
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
