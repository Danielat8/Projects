@extends('layouts.user.user')

@section('content')
<div class="container" style="margin-bottom: 200px; margin-top:100px;">
    <input type="hidden" name="_token" value="...">

    <h2 class="mb-4">{{ $ticket->ticket_name }} Details</h2>

    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title">{{ $ticket->ticket_name }}</h5>
            <p class="card-text">
                <strong>Type:</strong> {{ $ticket->ticket_type }} <br>
                <strong>Date:</strong> {{ $ticket->ticket_date }} <br>
                <strong>Place:</strong> {{ $ticket->place }} <br>
                <strong>Price:</strong> ${{ $ticket->price }} <br>
                <strong>Quantity:</strong> ${{ $ticket->quantity }} <br>
                <strong>Available:</strong> {{ $ticket->available }}<br>
                @if($ticket->event)
            <p class="text-muted"><span class="fw-bolder">Event Title:</span> {{ $ticket->event->title }}</p>
            @endif

            @if($ticket->conference)
            <p class="text-muted"><span class="fw-bolder">Conference Title:</span> {{ $ticket->conference->title }}</p>
            @endif

            </p>
            @if(in_array($ticket->id, $boughtTicketIds))
            <button class="btn btn-secondary" disabled>You bought this ticket</button>
            @else
            <form action="{{ route('user.tickets.buy', $ticket->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-lg"> <i class="fa-solid fa-cart-shopping fa-bounce fa-lg" style="color:azure"></i> <span class="ps-2">Buy Ticket</span></button>
            </form>
            @endif
            <a href="{{ route('user.tickets.index') }}" class="btn btn-primary mt-2">Back in Ticket</a>
        </div>
    </div>
</div>
@endsection