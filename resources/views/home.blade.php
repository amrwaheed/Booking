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
                        <div class="alert alert-danger" role="alert">
                            You can only book one ticket of each ticket type !!!!
                        </div>
                        <form action="{{route('createTicket')}}" method="post">
                            {{ csrf_field() }}
                            @foreach($tickets as $ticket)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           type="checkbox" id="inlineCheckbox{{++$i}}"
                                           value="{{$ticket->id}}"
                                           name="ticket[]"
                                        {{ (($order_count_normal < 200 && $ticket->id=="1") || ($ticket->id == "2" && $order_count_student < 200)) ? "" : "disabled"}}>
                                        <label class="form-check-label"  for="inlineCheckbox{{$i}}">{{$ticket->ticket_name }} -  {{ $ticket->price}}</label>
                                </div> <br>

                            @endforeach
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="text-center">
                                <input type="submit" class="btn btn-outline-primary">
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
