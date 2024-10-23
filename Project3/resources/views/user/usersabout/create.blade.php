@extends('layouts.user.user')

@section('content')
<div class="container" style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Create Your About Information</h2>
    <form id="create-aboutuser-form" method="POST" action="{{ route('user.usersabout.store') }}" class="bg-light p-4 shadow rounded" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" name="surname" id="surname" class="form-control" placeholder="Your Surname">
        </div>

        <div class="form-group mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Your Title">
        </div>

        <div class="form-group mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" id="city" class="form-control" placeholder="Your City">
        </div>

        <div class="form-group mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" name="country" id="country" class="form-control" placeholder="Your Country">
        </div>

        <div class="form-group mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea name="bio" id="bio" class="form-control" rows="3" placeholder="Your Bio"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone">
        </div>

        <div class="form-group mb-3">
            <label for="photo_upload" class="form-label">Profile Image (JPEG/PNG only)</label>
            <input type="file" name="photo_upload" id="photo_upload" class="form-control" accept="image/jpeg, image/png">
        </div>

        <div class="form-group mb-3">
            <label for="cv_upload" class="form-label">Upload CV (PDF only)</label>
            <input type="file" name="cv_upload" id="cv_upload" class="form-control" accept=".pdf">
        </div>

        <div class="text-center mb-5">
            <button type="submit" class="btn btn-primary">Create About Information</button>
        </div>
    </form>
</div>
<script>
    $('#create-aboutuser-form').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '{{ route("user.usersabout.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('About User information created successfully');
                window.location.href = "{{ route('user.usersabout.index') }}";
            },
            error: function(xhr) {
                alert('Error creating About User information: ');
            }
        });
    });
</script>
@endsection