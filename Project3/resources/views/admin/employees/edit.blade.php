@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Edit Employee Information</h2>
    <form id="edit-employee-form" method="POST" action="{{ route('admin.employees.update', $employee->id) }}" class="bg-light p-4 shadow rounded">
        @csrf
        @method('PUT')


        <div class="form-group mb-3">
            <label for="name" class="form-label">First Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $employee->name) }}" placeholder="First Name">
        </div>


        <div class="form-group mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname', $employee->surname) }}" placeholder="Surname">
        </div>


        <div class="form-group mb-3">
            <label for="bio" class="form-label">Biography</label>
            <textarea name="bio" id="bio" class="form-control" rows="3" placeholder="Biography">{{ old('bio', $employee->bio) }}</textarea>
        </div>


        <div class="form-group mb-3">
            <label for="job" class="form-label">Job Title</label>
            <input type="text" name="job" id="job" class="form-control" value="{{ old('job', $employee->job) }}" placeholder="Job Title">
        </div>


        <div class="form-group mb-3">
            <label for="picture_path" class="form-label">Profile Image URL or Path</label>
            <input type="text" name="picture_path" id="picture_path" class="form-control" value="{{ old('picture_path', $employee->picture_path) }}" placeholder="Enter image URL or local path">
        </div>

        <div class="form-group mb-3">
            <label for="facebook" class="form-label">Facebook</label>
            <input type="url" name="facebook" id="facebook" class="form-control" value="{{ old('facebook', $employee->facebook) }}" placeholder="Facebook URL">
        </div>

        <div class="form-group mb-3">
            <label for="twitter" class="form-label">Twitter</label>
            <input type="url" name="twitter" id="twitter" class="form-control" value="{{ old('twitter', $employee->twitter) }}" placeholder="Twitter URL">
        </div>

        <div class="form-group mb-3">
            <label for="instagram" class="form-label">Instagram</label>
            <input type="url" name="instagram" id="instagram" class="form-control" value="{{ old('instagram', $employee->instagram) }}" placeholder="Instagram URL">
        </div>

        <div class="form-group mb-3">
            <label for="linkedin" class="form-label">LinkedIn</label>
            <input type="url" name="linkedin" id="linkedin" class="form-control" value="{{ old('linkedin', $employee->linkedin) }}" placeholder="LinkedIn URL">
        </div>

        <div class="text-center mb-5">
            <button type="submit" class="btn btn-success btn-lg">Update Employee</button>
        </div>
    </form>
</div>

<script>
    $('#edit-employee-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData + '&_method=PUT',
            success: function(response) {
                alert('Employee information updated successfully');
                window.location.href = "{{ route('admin.employees.index') }}";
            },
            error: function(xhr) {
                alert('Error updating employee information: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection