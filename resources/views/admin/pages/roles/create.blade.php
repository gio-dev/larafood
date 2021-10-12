@extends('adminlte::page')

@section('title', 'Cadastrar função')

@section('content_header')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('roles.index') }}">Funções</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="active" href="javascript:void(0)">Cadastrar função</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Cadastrar função</h1>
        <a href="{{ route('roles.index') }}" class="btn btn-outline-info">
          <i class="fas fa-arrow-circle-left"></i>
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            #filtros
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('roles.store') }}" method="post">
                @csrf
                @include('admin.pages.roles.components.formrole')
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
