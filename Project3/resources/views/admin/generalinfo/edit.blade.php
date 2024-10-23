@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Edit General Information</h2>
    <form id="edit-general-info-form" method="POST" action="{{ route('admin.generalinfo.update', $generalInfo->id) }}" class="bg-light p-4 shadow rounded">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="general" class="form-label">General Info</label>
            <textarea name="general" id="general" class="form-control" rows="3" placeholder="General Info">{{ old('general', $generalInfo->general) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="picture_path" class="form-label">Profile Image URL or Path</label>
            <input type="text" name="picture_path" id="picture_path" class="form-control" value="{{ old('picture_path', $generalInfo->picture_path) }}" placeholder="Enter image URL or local path">
        </div>

        <div class="form-group mb-3">
            <label for="facebook" class="form-label">Facebook</label>
            <input type="url" name="facebook" id="facebook" class="form-control" value="{{ old('facebook', $generalInfo->facebook) }}" placeholder="Facebook URL">
        </div>

        <div class="form-group mb-3">
            <label for="twitter" class="form-label">Twitter</label>
            <input type="url" name="twitter" id="twitter" class="form-control" value="{{ old('twitter', $generalInfo->twitter) }}" placeholder="Twitter URL">
        </div>

        <div class="form-group mb-3">
            <label for="instagram" class="form-label">Instagram</label>
            <input type="url" name="instagram" id="instagram" class="form-control" value="{{ old('instagram', $generalInfo->instagram) }}" placeholder="Instagram URL">
        </div>

        <div class="form-group mb-3">
            <label for="linkedin" class="form-label">LinkedIn</label>
            <input type="url" name="linkedin" id="linkedin" class="form-control" value="{{ old('linkedin', $generalInfo->linkedin) }}" placeholder="LinkedIn URL">
        </div>

        <div class="text-center mb-5">
            <button type="submit" class="btn btn-success btn-lg">Update General Info</button>
        </div>
    </form>
</div>

<script>
    $('#edit-general-info-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData + '&_method=PUT',
            success: function(response) {
                alert('General information updated successfully');
                window.location.href = "{{ route('admin.generalinfo.index') }}";
            },
            error: function(xhr) {
                alert('Error updating general information: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection