@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="active" href="javascript:void(0)">Produtos</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Produtos</h1>
        <a href="{{ route('products.create') }}" class="btn btn-outline-info">
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
            <form method="post" action="{{ route('products.search') }}" class="form form-inline" name="form-filtes">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" class="form-control" placeholder="Pesquise qualquer informação dos Produtos"
                           value="{{ $filters['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-outline-success"><span class="fas fa-search"></span> Filtrar</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th style="width: 20%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <img style="max-height: 80px" class="img-fluid" src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->title }}">
                            </td>
                            <td>
                                {{ $product->title }}
                            </td>
                            <td style="width: 25%">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-warning">
                                    <span class="fas fa-eye mr-2"></span> Ver
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary">
                                    <span class="fas fa-edit mr-2"></span> Editar
                                </a>
                                <a href="{{ route('products.categories.index', $product->id) }}" class="btn btn-outline-secondary">
                                    <span class="fas fa-lock-open mr-2"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            @if (isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
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
