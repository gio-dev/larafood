@include('admin.includes.alerts')

<div class="form-row">
    <div class="form-group col">
        <label for="name">
            Identificação
        </label>
        <input type="text" required name="identify" class="form-control" value="{{ $table->identify ?? old('identify') }}" placeholder="Identificação: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="email">
            Descrição
        </label>
        <textarea required name="description" class="form-control" rows="5">{{ $table->description ?? old('description') }}</textarea>
    </div>
</div>
