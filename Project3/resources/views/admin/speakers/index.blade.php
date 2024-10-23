@extends('layouts.admin.admin')

@section('content')

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Speakers</h2>
    <div class="text-end mb-3">
        <a href="{{ route('admin.speakers.create') }}" class="btn btn-outline-success">Create New Speaker</a>
    </div>
    <div class="row">
        @foreach ($speakers as $speaker)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">

            <div class="card shadow-sm h-80">
                <img src="{{ (filter_var($speaker->image, FILTER_VALIDATE_URL) ? $speaker->image : asset($speaker->image)) ?? asset('images/default-image.jpg') }}" class="card-img-top rounded-bottom" alt="{{ $speaker->title }}" style="height: 280px; object-fit: cover; width: 100%;">
                <div class="card-body text-center">
                    <h5 class="card-title"><span class="fw-bolder">Name:</span> {{ $speaker->name }}</h5>
                    <p class="card-text"><span class="fw-bolder">Speaker Title:</span> {{ $speaker->title }}</p>
                    <p class="badge bg-primary"><span class="fw-bolder">Type:</span> {{ ucfirst($speaker->type) }}</p>


                    @if($speaker->event)
                    <p class="text-muted"><span class="fw-bolder">Event Title:</span> {{ $speaker->event->title }}</p>
                    @endif

                    @if($speaker->conference)
                    <p class="text-muted"><span class="fw-bolder">Conference Title:</span> {{ $speaker->conference->title }}</p>
                    @endif


                </div>
                <div class="d-flex justify-content-center gap-2 mb-3">
                    @if($speaker->linkedin)
                    <a href="{{ $speaker->linkedin }}" target="_blank" class="btn btn-outline-info btn-sm">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <div class="d-flex justify-content-center gap-2">

                        <a href="{{ route('admin.speakers.edit', $speaker->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>


                        <form method="POST" action="{{ route('admin.speakers.destroy', $speaker->id) }}" class="delete-form" data-id="{{ $speaker->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
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
            const formId = form.dataset.id;

            if (confirm('Are you sure you want to delete this speaker?')) {
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
                            alert('Speaker deleted successfully!');
                            location.reload();

                        } else {
                            return response.text().then(text => {
                                throw new Error(text || 'Unknown error.');
                            });
                        }
                    })
                    .catch(error => {
                        alert('An error occurred while deleting the speaker: ' + error.message);
                        console.error('Error:', error);
                    });
            }
        }
    });
</script>
@endsection