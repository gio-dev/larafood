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
            <li class="breadcrumb-item active">
                <a class="active" href="javascript:void(0)">Categorias do produto {{ $product->title }}</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Categorias do produto {{ $product->title }}</h1>
        <a href="{{ route('products.categories.avaliable', $product->id) }}" class="btn btn-outline-info">
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
{{--            <form method="post" action="{{ route('products.search') }}" class="form form-inline" name="form-filtes">--}}
{{--                @csrf--}}
{{--                <div class="form-group">--}}
{{--                    <input type="text" name="filter" class="form-control" placeholder="Pesquise qualquer informação dos planos"--}}
{{--                           value="{{ $filters['filter'] ?? '' }}">--}}
{{--                    <button type="submit" class="btn btn-outline-success"><span class="fas fa-search"></span> Filtrar</button>--}}
{{--                </div>--}}
{{--            </form>--}}
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
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td style="width: 20%">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-warning">
                                    <span class="fas fa-eye "></span>
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary">
                                    <span class="fas fa-edit"></span>
                                </a>
                                <a href="{{ route('products.categories.detach', [$product->id, $category->id]) }}" class="btn btn-outline-secondary">
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
