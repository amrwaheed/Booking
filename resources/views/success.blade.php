@extends('layouts.app')

@section('content')

<div class="container">
{{--    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">--}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking Your Ticket</div>
                <div class="card-body">
                   @include('layouts._message')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
