@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Create General Information</h2>
    <form id="create-general-info-form" method="POST" action="{{ route('admin.generalinfo.store') }}" class="bg-light p-4 shadow rounded">
        @csrf

        <div class="form-group mb-3">
            <label for="general" class="form-label">General Information</label>
            <textarea name="general" id="general" class="form-control" rows="3" placeholder="Enter general information"></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="picture_path" class="form-label">Profile Image URL or Path</label>
            <input type="text" name="picture_path" id="picture_path" class="form-control" placeholder="Enter image URL or local path">
        </div>

        <div class="form-group mb-3">
            <label for="facebook" class="form-label">Facebook</label>
            <input type="url" name="facebook" id="facebook" class="form-control" placeholder="Facebook URL">
        </div>

        <div class="form-group mb-3">
            <label for="twitter" class="form-label">Twitter</label>
            <input type="url" name="twitter" id="twitter" class="form-control" placeholder="Twitter URL">
        </div>

        <div class="form-group mb-3">
            <label for="instagram" class="form-label">Instagram</label>
            <input type="url" name="instagram" id="instagram" class="form-control" placeholder="Instagram URL">
        </div>

        <div class="form-group mb-3">
            <label for="linkedin" class="form-label">LinkedIn</label>
            <input type="url" name="linkedin" id="linkedin" class="form-control" placeholder="LinkedIn URL">
        </div>

        <div class="text-center mb-5">
            <button type="submit" class="btn btn-primary">Create General Information</button>
        </div>
    </form>
</div>

<script>
    $('#create-general-info-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.generalinfo.store") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                alert('General information created successfully');
                window.location.href = "{{ route('admin.generalinfo.index') }}";
            },
            error: function(xhr) {
                alert('Error creating general information: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection