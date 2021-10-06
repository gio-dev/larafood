@include('admin.includes.alerts')

<div class="form-row">
    <div class="form-group col">
        <label for="name">
            Nome
        </label>
        <input type="text" required name="title" class="form-control" value="{{ $product->title ?? old('title') }}" placeholder="Nome: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="price">
            Preço
        </label>
        <input type="text" required name="price" class="form-control" value="{{ $product->price ?? old('price') }}" placeholder="Preço: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="name">
            Imagem
        </label>
        <input type="file" name="image" class="form-control" >
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="email">
            Descrição
        </label>
        <textarea required name="description" class="form-control" rows="5">{{ $product->description ?? old('description') }}</textarea>
    </div>
</div>
