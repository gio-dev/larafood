@include('admin.includes.alerts')
{{--//'name', 'cnpj', 'email', 'url', 'active','logo','active',--}}
{{--//'subscription', 'expires_at', 'subscription_id','subscription_active', 'subscription_suspended'--}}
<div class="form-row">
    <div class="form-group col">
        <label for="name">
            Nome
        </label>
        <input type="text" required name="name" class="form-control" value="{{ $tenant->name ?? old('name') }}" placeholder="Nome: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="name">
            CNPJ
        </label>
        <input type="text" required name="cnpj" class="form-control" value="{{ $tenant->cnpj ?? old('cnpj') }}" placeholder="CNPJ: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="name">
            E-mail
        </label>
        <input type="email" required name="email" class="form-control" value="{{ $tenant->email ?? old('cnpj') }}" placeholder="CNPJ: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="name">
            Logo
        </label>
        <input type="file" name="logo" class="form-control" >
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="name">
            Ativo
        </label>
        <select name="active" class="form-control">
            <option {{ $tenant->active == 'Y' ? 'selected': '' }} value="Y">Sim</option>
            <option {{ $tenant->active == 'N' ? 'selected': '' }} value="N">Não</option>
        </select>
    </div>
</div>

<hr>
<h3>Assinatura</h3>


<div class="form-row">
    <div class="form-group col">
        <label for="subscription">
            Data assinatura:
        </label>
        <input type="date"  name="subscription" class="form-control" value="{{ $tenant->subscription ?? old('subscription') }}" placeholder="Assinatura: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="expires_at">
            Data expira
        </label>
        <input type="date" name="expires_at" class="form-control" value="{{ $tenant->expires_at ?? old('expires_at') }}" placeholder="Data expira: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="subscription_id">
            Identificador
        </label>
        <input type="text" name="subscription_id" class="form-control" value="{{ $tenant->subscription_id ?? old('subscription_id') }}" placeholder="Identificadpr: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="subscription_active">
            Ativo
        </label>
        <select name="subscription_active" class="form-control">
            <option {{ $tenant->subscription_active == '1' ? 'selected': '' }} value="1">Sim</option>
            <option {{ $tenant->subscription_active == '0' ? 'selected': '' }} value="0">Não</option>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col">
        <label for="name">
            Cancelado
        </label>
        <select name="subscription_suspended" class="form-control">
            <option {{ $tenant->subscription_suspended == '1' ? 'selected': '' }} value="1">Sim</option>
            <option {{ $tenant->subscription_suspended == '0' ? 'selected': '' }} value="0">Não</option>
        </select>
    </div>
</div>
