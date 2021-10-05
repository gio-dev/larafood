@extends('adminlte::page')

@section('title', "Editar usuário {$user->name}")

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
                <a class="active" href="javascript:void(0)">Editar usuário {{$user->name}}</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Editar usuário {{$user->name}}</h1>
        <a href="{{ route('users.index') }}" class="btn btn-outline-info">
          <i class="fas fa-arrow-circle-left"></i>
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form" action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('admin.pages.users.components.formuser')
                <div class="form-row">
                    <div class="form-group col d-flex justify-content-center">
                        <button class="btn btn-success"><span class="fas fa-save mr-1"></span> Salvar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex justify-content-center">
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
