@extends('adminlte::page')

@section('title', "Categorias do produto {$product->title}")

@section('content_header')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('products.index') }}">Perfis</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('products.show', $product->id) }}">Perfil {{ $product->title }}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="active" href="{{ route('products.categories.index', $product->id) }}">Categorias do produto {{ $product->title }}</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="active" href="javascript:void(0)">Vincular permissão ao perfil {{ $product->title }}</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Vincular permissão ao perfil {{ $product->title }}</h1>
        <a href="{{ route('products.categories.index', $product->id) }}" class="btn btn-outline-info">
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
            <form method="post" action="{{ route('products.categories.avaliable', $product->id) }}" class="form form-inline" name="form-filtes">
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
                    <form action="{{ route('products.categories.attach', $product->id) }}" method="post">
                        @csrf
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <input type="checkbox" class="custom-checkbox" name="categories[]" value="{{ $category->id }}">
                                </td>
                                <td>
                                    {{ $category->name }}
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
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
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
