@include('admin.includes.alerts')

<div class="form-row">
    <div class="form-group col">
        <label for="name">
            Nome
        </label>
        <input type="text" required name="name" class="form-control" value="{{ $category->name ?? old('name') }}" placeholder="Nome: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="email">
            Descrição
        </label>
        <textarea required name="description" class="form-control" rows="5">{{ $category->description ?? old('description') }}</textarea>
    </div>
</div>
