@extends('layouts.user.user')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Edit Your Information</h2>
    <form id="edit-user-info-form" method="POST" action="{{ route('user.usersabout.update', $aboutUser->id) }}" class="bg-light p-4 shadow rounded" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname', $aboutUser->surname) }}" placeholder="Your Surname">
        </div>

        <div class="form-group mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $aboutUser->title) }}" placeholder="Your Title">
        </div>

        <div class="form-group mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $aboutUser->city) }}" placeholder="Your City">
        </div>


        <div class="form-group mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $aboutUser->country) }}" placeholder="Your Country">
        </div>

        <div class="form-group mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea name="bio" id="bio" class="form-control" rows="3" placeholder="Tell us about yourself">{{ old('bio', $aboutUser->bio) }}</textarea>
        </div>


        <div class="form-group mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $aboutUser->phone) }}" placeholder="Your Phone Number">
        </div>


        <div class="form-group mb-3">
            <label for="photo_upload" class="form-label">Profile Image (JPEG/PNG only)</label>
            <input type="file" name="photo_upload" id="photo_upload" class="form-control" accept="image/jpeg, image/png">
        </div>

        <div class="form-group mb-3">
            <label for="cv_upload" class="form-label">Upload CV (PDF only)</label>
            <input type="file" name="cv_upload" id="cv_upload" class="form-control" accept=".pdf">
            @if($aboutUser->cv_upload)
            <p class="mt-2">Current CV: <a href="{{ asset('storage/' . $aboutUser->cv_upload) }}" target="_blank">View CV</a></p>
            @endif
        </div>

        <div class="text-center mb-5">
            <button type="submit" class="btn btn-success btn-lg">Update Your Information</button>
        </div>
    </form>
</div>

<script>
    $('#edit-user-info-form').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Your information has been updated successfully');
                window.location.href = "{{ route('user.usersabout.index') }}";
            },
            error: function(xhr) {
                alert('Error updating your information: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection