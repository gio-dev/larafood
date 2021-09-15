@if ($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>
                {{ $error }}
            </p>
        @endforeach
    </div>
@endif

@if (session('message-success'))
    <div class="alert alert-info">
        {{ session('message-success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
