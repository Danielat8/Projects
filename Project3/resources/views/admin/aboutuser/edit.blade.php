@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Edit User Information</h2>
    <form id="edit-user-info-form" method="POST" action="{{ route('admin.aboutuser.update', $aboutUser->id) }}" class="bg-light p-4 shadow rounded" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="form-group mb-3">
            <label for="user_id" class="form-label">Select User</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == old('user_id', $aboutUser->user_id) ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>


        <div class="form-group mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname', $aboutUser->surname) }}" placeholder="User Surname">
        </div>


        <div class="form-group mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $aboutUser->title) }}" placeholder="User Title">
        </div>


        <div class="form-group mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $aboutUser->city) }}" placeholder="User City">
        </div>


        <div class="form-group mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $aboutUser->country) }}" placeholder="User Country">
        </div>


        <div class="form-group mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea name="bio" id="bio" class="form-control" rows="3" placeholder="User Bio">{{ old('bio', $aboutUser->bio) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
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
            <button type="submit" class="btn btn-success btn-lg">Update User Information</button>
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
                alert('User information updated successfully');
                window.location.href = "{{ route('admin.aboutuser.index') }}";
            },
            error: function(xhr) {
                alert('Error updating user information: ' + xhr.responseText);
            }
        });
    });
</script>

@endsection