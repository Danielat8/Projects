@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Edit Event Information</h2>
    <form id="edit-event-form" method="POST" action="{{ route('admin.events.update', $event->id) }}" class="bg-light p-4 shadow rounded">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="title" class="form-label">Event Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $event->title) }}" placeholder="Event Title">
        </div>

        <div class="form-group mb-3">
            <label for="theme" class="form-label">Theme</label>
            <input type="text" name="theme" id="theme" class="form-control" value="{{ old('theme', $event->theme) }}" placeholder="Event Theme">
        </div>

        <div class="form-group mb-3">
            <label for="objective" class="form-label">Objective</label>
            <textarea name="objective" id="objective" class="form-control" rows="3" placeholder="Event Objective">{{ old('objective', $event->objective) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Event Description">{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="date" class="form-label">Event Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $event->date) }}">
        </div>

        <div class="form-group mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $event->location) }}" placeholder="Event Location">
        </div>

        <div class="form-group mb-3">
            <label for="picture_path" class="form-label">Event Image URL or Path</label>
            <input type="text" name="picture_path" id="picture_path" class="form-control" value="{{ old('picture_path', $event->picture_path) }}" placeholder="Enter image URL or local path">
        </div>

        <div class="text-center mb-5">
            <button type="submit" class="btn btn-success btn-lg">Update Event</button>
        </div>
    </form>
</div>

<script>
    $('#edit-event-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData + '&_method=PUT',
            success: function(response) {
                alert('Event information updated successfully');
                window.location.href = "{{ route('admin.events.index') }}";
            },
            error: function(xhr) {
                alert('Error updating event information: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection