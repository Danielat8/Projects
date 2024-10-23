@extends('layouts.admin.admin')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Tickets</h2>
    <div class="text-end mb-3">
        <a href="{{ route('admin.tickets.create') }}" class="btn btn-outline-success">Create New Ticket</a>
    </div>

    <div class="row">
        @foreach ($tickets as $ticket)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">

            <div class="card text-bg-warning shadow h-100">
                <div class="card-header text-dark fw-bold">{{ $ticket->ticket_type }}</div>
                <div class="card-body">
                    <h5 class="card-title text-center">Price: ${{ $ticket->price }}</h5>
                    <p class="text-muted"><span class="fw-bolder">Ticket name: </span> {{ $ticket->ticket_name }}</p>
                    <p class="text-muted"><span class="fw-bolder">Ticket Date: </span>{{ $ticket->ticket_date }}</p>
                    <p class="text-muted"><span class="fw-bolder">Ticket Place:</span> {{ $ticket->place }}</p>
                    @if($ticket->event)
                    <p class="text-muted"><span class="fw-bolder">Event Title:</span> {{ $ticket->event->title }}</p>
                    @endif

                    @if($ticket->conference)
                    <p class="text-muted"><span class="fw-bolder">Conference Title:</span> {{ $ticket->conference->title }}</p>
                    @endif

                    <div class="card-footer bg-transparent d-flex justify-content-between">
                        <strong>Quantity:</strong> {{ $ticket->quantity }}<br>
                        <strong>Available:</strong> {{ $ticket->available }}<br>
                    </div>
                </div>
                <div class="card-footer bg-transparent d-flex justify-content-between">
                    <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                    <form method="POST" action="{{ route('admin.tickets.destroy', $ticket->id) }}" id="delete-form-{{ $ticket->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('click', function(event) {
        if (event.target && event.target.matches('button[type="submit"]')) {
            event.preventDefault();
            const form = event.target.closest('form');

            if (confirm('Are you sure you want to delete this ticket?')) {
                fetch(form.action, {
                        method: 'POST',
                        body: new URLSearchParams(new FormData(form)),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    })
                    .then(response => {
                        if (response.status === 204) {
                            alert('Ticket deleted successfully!');
                            setTimeout(() => {
                                form.closest('.col-lg-4, .col-md-6, .col-sm-12').remove();
                            }, 100);
                        } else {
                            return response.text().then(text => {
                                throw new Error(text || 'Unknown error.');
                            });
                        }
                    })
                    .catch(error => {
                        alert('An error occurred while deleting the ticket: ' + error.message);
                        console.error('Error:', error);
                    });
            }
        }
    });
</script>
@endsection