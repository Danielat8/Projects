@extends('layouts.admin.admin')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4 display-4 fw-bold text-primary">Upcoming Events</h2>
    <div class="text-end mb-4">
        <a href="{{ route('admin.events.create') }}" class="btn btn-lg btn-success shadow-sm">Create New Event</a>
    </div>

    <div class="row">
        @foreach ($events as $event)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card border-0 shadow-lg rounded">
                <div class="card-header bg-info text-center text-white py-3">
                    <h5 class="card-title mb-0"><strong>{{ $event->title }}</strong></h5>
                </div>
                <img src="{{ (filter_var($event->picture_path, FILTER_VALIDATE_URL) ? $event->picture_path : asset($event->picture_path)) ?? asset('images/default-image.jpg') }}" class=" card-img-top rounded-bottom" alt="{{ $event->title }}" style=" height: 280px;
        object-fit: cover;
        width: 100%;">
                <div class="card-body p-4">
                    <p class="card-text bg-light p-2 rounded mb-2 text-center"><strong>Theme:</strong> {{ $event->theme }}</p>
                    <p class="card-text bg-light p-2 rounded mb-3 text-center"><strong>Objective:</strong> {{ $event->objective }}</p>
                    <p class="card-text">{{ ($event->description) }}</p>
                    <div class="d-flex justify-content-between">
                        <p class="card-text text-muted"><strong>Date:</strong> {{ $event->date }}</p>
                        <p class="card-text text-muted"><strong>Location:</strong> {{ $event->location }}</p>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-primary btn-sm shadow-sm"><i class="fa-solid fa-pencil"></i> Edit</a>
                        <form method="POST" action="{{ route('admin.events.destroy', $event->id) }}" class="delete-form" data-id="{{ $event->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('click', function(event) {
        if (event.target && event.target.closest('.delete-form')) {
            event.preventDefault();
            const form = event.target.closest('form');

            if (confirm('Are you sure you want to delete this event?')) {
                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams(new FormData(form))
                    })
                    .then(response => {
                        if (response.status === 204) {
                            alert('Event deleted successfully!');
                            location.reload();

                        } else {
                            return response.text().then(text => {
                                throw new Error(text || 'Unknown error.');
                            });
                        }
                    })
                    .catch(error => {
                        alert('An error occurred while deleting the event: ' + error.message);
                        console.error('Error:', error);
                    });
            }
        }
    });
</script>
@endsection