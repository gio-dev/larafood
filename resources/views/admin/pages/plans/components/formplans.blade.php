@include('admin.includes.alerts')
<div class="form-row">
    <div class="form-group col">
        <label for="name">
            Nome
        </label>
        <input type="text" required name="name" class="form-control" value="{{ $plan->name ?? old('name') }}" placeholder="Nome: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="price">
            Preço
        </label>
        <input type="text" required name="price" class="form-control" value="{{ $plan->price ?? old('price') }}" placeholder="Preço: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="description">
            Descrição
        </label>
        <input type="text" required name="description" class="form-control" value="{{ $plan->description ?? old('description') }}" placeholder="Descrição: ">
    </div>
</div>
