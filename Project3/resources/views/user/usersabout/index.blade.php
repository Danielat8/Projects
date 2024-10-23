@extends('layouts.user.user')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">About Users</h2>

    <div class="text-end mb-3">
        @if(Auth::check())
        <a href="{{ route('user.usersabout.create') }}" class="btn btn-outline-success">Add Your New Information</a>
        <a href="{{ route('user.settings.setting') }}" class="ps-2"><i class="fa-solid fa-gear fa-spin-pulse fa-2xl" style="color: #FFD43B;"></i></a>
        @endif
    </div>

    <div class="row">
        @foreach ($aboutUsers as $aboutUser)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">

            <div class="card h-60 bg-success-subtle shadow-lg p-3 mb-5 bg-body-tertiary rounded-4">


                <img src="{{ asset('storage/' . $aboutUser->photo_upload) }}" class="card-img-top rounded-4" style="height: 250px; object-fit: cover;">

                <div class="card-body">
                    <h5 class="card-title text-primary fw-bold text-center">{{ $aboutUser->user->name }}</h5>
                    <p class="card-text"><strong>Surname:</strong> {{ $aboutUser->surname }}</p>
                    <p class="card-text"><strong>Title:</strong> {{ $aboutUser->title }}</p>
                    <p class="card-text"><strong>City:</strong> {{ $aboutUser->city }}</p>
                    <p class="card-text"><strong>Country:</strong> {{ $aboutUser->country }}</p>
                    <p class="card-text"><strong>Bio:</strong> {{ Str::limit($aboutUser->bio, 100) }}</p>
                    <p class="card-text"><strong>Phone:</strong> {{ $aboutUser->phone }}</p>

                    @if($aboutUser->cv_upload)
                    <div class="mt-3">
                        <a href="{{ asset('storage/' . $aboutUser->cv_upload) }}" class="btn btn-outline-info btn-sm" target="_blank">Show CV</a>
                        <a href="{{ asset('storage/' . $aboutUser->cv_upload) }}" download class="btn btn-outline-secondary btn-sm">Download CV</a>
                    </div>
                    @else
                    <p class="text-danger">No CV uploaded</p>
                    @endif
                </div>

                @if(Auth::check() && Auth::id() == $aboutUser->user_id)
                <div class="card-footer d-flex justify-content-center gap-2">

                    <a href="{{ route('user.usersabout.edit', $aboutUser->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>


                    <form method="POST" action="{{ route('user.usersabout.destroy', $aboutUser->id) }}" id="delete-form-{{ $aboutUser->id }}" onsubmit="return confirm('Are you sure you want to delete your information?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                    </form>
                </div>
                @endif
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
            const formId = form.id;

            if (confirm('Are you sure you want to delete this user information?')) {
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
                            const cardElement = document.querySelector(`#${formId}`).closest('.col-lg-4, .col-md-6, .col-sm-12');
                            if (cardElement) {
                                cardElement.remove();
                                alert('User information deleted successfully!');
                            } else {
                                console.error('Card element not found for form ID:', formId);
                            }
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