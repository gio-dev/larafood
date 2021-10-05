    @extends('adminlte::page')

@section('title', "Detalhes da categoria {$category->name}")

@section('content_header')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('categories.index') }}">Categorias</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="active" href="javascript:void(0)">Detalhes da categoria {{ $category->name }}</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Detalhes da categoria {{ $category->name }}</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-info">
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
                    <b>Nome: </b>{{ $category->name }}
                </li>
                <li>
                    <b>Descrição: </b>{{ $category->description }}
                </li>
            </ul>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
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
