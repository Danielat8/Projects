@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Create New Event</h2>
    <form id="create-event-form" method="POST" action="{{ route('admin.events.store') }}" class="bg-light p-4 shadow rounded">
        @csrf

        <div class="form-group mb-3">
            <label for="title" class="form-label">Event Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Event Title">
        </div>

        <div class="form-group mb-3">
            <label for="theme" class="form-label">Theme</label>
            <input type="text" name="theme" id="theme" class="form-control" placeholder="Event Theme">
        </div>

        <div class="form-group mb-3">
            <label for="objective" class="form-label">Objective</label>
            <textarea name="objective" id="objective" class="form-control" rows="3" placeholder="Event Objective"></textarea>
        </div>


        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Event Description"></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="date" class="form-label">Event Date</label>
            <input type="date" name="date" id="date" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control" placeholder="Event Location">
        </div>


        <div class="form-group mb-3">
            <label for="picture_path" class="form-label">Event Image URL or Path</label>
            <input type="text" name="picture_path" id="picture_path" class="form-control" placeholder="Enter image URL or local path">
        </div>


        <div class="text-center mb-5">
            <button type="submit" class="btn btn-primary">Create Event</button>
        </div>
    </form>
</div>

<script>
    $('#create-event-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.events.store") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                alert('Event created successfully');
                window.location.href = "{{ route('admin.events.index') }}";
            },
            error: function(xhr) {
                alert('Error creating event: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection