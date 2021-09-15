@extends('adminlte::page')

@section('title', 'Cadastrar Plano')

@section('content_header')
    <div>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Cadastrar Plano</h1>
        <a href="{{ route('plans.index') }}" class="btn btn-outline-info">
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
            <form class="form" action="{{ route('plans.store') }}" method="post">
                @csrf
                @include('admin.pages.plans.components.formplans')
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
