@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking Your Ticket</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
{{--                            @foreach($tickets as $ticket)--}}
{{--                                @foreach($ticket->category as $cat)--}}
{{--                                <h3>{{$$cat->category_name}}</h3>--}}
{{--                                @endforeach--}}
{{--                            @endforeach--}}
                        </div>
                    @endif
                    @if (session('booked'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('booked') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
