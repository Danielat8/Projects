@extends('layouts.user.user')

@section('content')
<div class="container" style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="mb-4">Available Tickets</h2>

    @if($tickets->isEmpty())
    <p class="text-muted">No tickets available at the moment.</p>
    @else
    <div class="row">
        @foreach($tickets as $ticket)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card h-100 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">{{ $ticket->ticket_name }}</h5>
                    <p class="card-text">
                        <strong>Type:</strong> {{ $ticket->ticket_type }} <br>
                        <strong>Date:</strong> {{ $ticket->ticket_date }} <br>
                        <strong>Place:</strong> {{ $ticket->place }} <br>
                        <strong>Price:</strong> ${{ $ticket->price }}
                    </p>

                    @if(in_array($ticket->id, $boughtTicketIds))
                    <button class="btn btn-secondary mb-3" disabled>You bought this ticket</button>

                    @endif
                    <a href="{{ route('user.tickets.show', $ticket->id) }}" class="btn btn-primary">View Details and Buy Ticket</a>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection