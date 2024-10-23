@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Edit Conference</h2>
    <form id="edit-conference-form" method="POST" action="{{ route('admin.conferences.update', $conference->id) }}" class="bg-light p-4 shadow rounded">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $conference->title) }}" placeholder="Conference Title">
        </div>


        <div class="form-group mb-3">
            <label for="theme" class="form-label">Theme</label>
            <input type="text" name="theme" id="theme" class="form-control" value="{{ old('theme', $conference->theme) }}" placeholder="Conference Theme">
        </div>
        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Brief description"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $conference->date) }}">
        </div>

        <div class="form-group mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $conference->location) }}" placeholder="Conference Location">
        </div>

        <div class="form-group mb-3">
            <label for="objective" class="form-label">Objective</label>
            <input type="text" name="objective" id="objective" class="form-control" value="{{ old('objective', $conference->objective) }}" placeholder="Conference Objective">
        </div>


        <div class="form-group mb-3">
            <label for="agenda" class="form-label">Agenda</label>
            <textarea name="agenda" id="agenda" class="form-control" rows="3" placeholder="Agenda">{{ old('agenda', $conference->agenda) }}</textarea>
        </div>


        <div class="form-group mb-3">
            <label for="status" class="form-label">Select Status</label>
            <select name="status" id="status" class="form-control">
                <option value="">-- Select Status --</option>
                <option value="upcoming">Upcoming</option>
                <option value="completed">Completed</option>
                <option value="canceled">Canceled</option>
            </select>
        </div>


        <div class="text-center mb-5">
            <button type="submit" class="btn btn-success btn-lg">Update Conference</button>
        </div>
    </form>
</div>

<script>
    $('#edit-conference-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData + '&_method=PUT',
            success: function(response) {
                alert('Conference updated successfully');
                window.location.href = "{{ route('admin.conferences.index') }}";
            },
            error: function(xhr) {
                alert('Error updating conference: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection