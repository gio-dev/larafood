    @extends('adminlte::page')

@section('title', "Detalhes da empresa {$tenant->name}")

@section('content_header')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a class="" href="{{ route('tenants.index') }}">Empresas</a>
            </li>
            <li class="breadcrumb-item active">
                <a class="active" href="javascript:void(0)">Detalhes da empresa {{ $tenant->name }}</a>
            </li>
        </ol>
        <h1 class="d-inline-flex mr-3" style="vertical-align: middle">Detalhes da empresa {{ $tenant->name }}</h1>
        <a href="{{ route('tenants.index') }}" class="btn btn-outline-info">
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
                    <img style="max-height: 80px" class="img-fluid" src="{{ asset("storage/{$tenant->image}") }}" alt="{{ $tenant->name }}">
                </li>
                <li>
                    <b>Plano: </b>{{ $tenant->plan->name }}
                </li>
                <li>
                    <b>Nome: </b>{{ $tenant->name }}
                </li>
                <li>
                    <b>URL: </b>{{ $tenant->url }}
                </li>
                <li>
                    <b>CNPJ: </b>{{ $tenant->cnpj }}
                </li>
                <li>
                    <b>E-mail: </b>{{ $tenant->email }}
                </li>
                <li>
                    <b>Ativo: </b>{{ $tenant->active == 'Y' ? 'Sim' : 'Não' }}
                </li>
            </ul>
            <hr>
            <h3>Assinatura</h3>
            <ul>
                <li>
                    <b>Data assinatura: </b>{{ $tenant->subscription }}
                </li>
                <li>
                    <b>Data expira: </b>{{ $tenant->expires_at }}
                </li>
                <li>
                    <b>Identificador: </b>{{ $tenant->subscription_id }}
                </li>
                <li>
                    <b>Ativo: </b>{{ $tenant->subscription_active == 'Y' ? 'Sim' : 'Não' }}
                </li>
                <li>
                    <b>Cancelado: </b>{{ $tenant->subscription_suspended == 'Y' ? 'Sim' : 'Não' }}
                </li>
            </ul>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
