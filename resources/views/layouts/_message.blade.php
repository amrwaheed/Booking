@if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
@endif
@if (session('booked'))
    <div class="alert alert-danger" role="alert">
        {{ session('booked') }}
    </div>
@endif
