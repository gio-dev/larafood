@include('admin.includes.alerts')
<?php


$require = isset($user) && !is_null($user) ? '' : 'required';
?>

<div class="form-row">
    <div class="form-group col">
        <label for="name">
            Nome
        </label>
        <input type="text" required name="name" class="form-control" value="{{ $user->name ?? old('name') }}" placeholder="Nome: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="email">
            E-mail
        </label>
        <input type="email" required name="email" class="form-control" value="{{ $user->email ?? old('email') }}" placeholder="Email: ">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="password">
            Password
        </label>
        <input type="password" {{ $require }} name="password" class="form-control" value="" placeholder="Password: ">
    </div>
</div>
