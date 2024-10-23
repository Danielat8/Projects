@extends('layouts.admin.admin')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">About Users</h2>
    <div class="text-end mb-3">
        <a href="{{ route('admin.aboutuser.create') }}" class="btn btn-outline-success">Add New User Info</a>
    </div>
    <div class="row">
        @foreach ($aboutUsers as $aboutUser)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card h-100">
                <img src="{{ asset('storage/' . $aboutUser->photo_upload) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title text-primary fw-bold">{{ $aboutUser->user->name }}</h5>
                    <p class="card-text"><strong>Surname:</strong> {{ $aboutUser->surname }}</p>
                    <p class="card-text"><strong>Title:</strong> {{ $aboutUser->title }}</p>
                    <p class="card-text"><strong>City:</strong> {{ $aboutUser->city }}</p>
                    <p class="card-text"><strong>Country:</strong> {{ $aboutUser->country }}</p>
                    <p class="card-text"><strong>Bio:</strong> {{ Str::limit($aboutUser->bio, 100) }}</p>
                    <p class="card-text"><strong>Phone:</strong> {{ $aboutUser->phone }}</p>
                    @if($aboutUser->cv_upload)
                    <div class="mt-3">
                        <a href="{{ asset('storage/' . $aboutUser->cv_upload) }}" class="btn btn-outline-info btn-sm" target="_blank">
                            Show CV
                        </a>
                        <a href="{{ asset('storage/' . $aboutUser->cv_upload) }}" download class="btn btn-outline-secondary btn-sm">
                            Download CV
                        </a>
                    </div>
                    @else
                    <p class="text-danger">No CV uploaded</p>
                    @endif
                </div>

                <div class="card-footer d-flex justify-content-center gap-2">

                    <a href="{{ route('admin.aboutuser.edit', $aboutUser->id) }}" class="btn btn-outline-primary btn-sm">
                        Edit
                    </a>

                    <form method="POST" action="{{ route('admin.aboutuser.destroy', $aboutUser->id) }}" id="delete-form-{{ $aboutUser->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            Delete
                        </button>
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

            if (confirm('Are you sure you want to delete this user information?')) {
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
                            alert('User information deleted successfully!');
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
                        alert('An error occurred while deleting the user information: ' + error.message);
                        console.error('Error:', error);
                    });
            }
        }
    });
</script>
@endsection