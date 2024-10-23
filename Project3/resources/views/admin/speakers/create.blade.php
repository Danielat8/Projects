@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Create New Speaker </h2>
    <form id="create-speaker-form" method="POST" action="{{ route('admin.speakers.store') }}" class="bg-light p-4 shadow rounded" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="form-label">Speaker Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Speaker Name">
        </div>


        <div class="form-group mb-3">
            <label for="linkedin" class="form-label">LinkedIn Profile</label>
            <input type="url" name="linkedin" id="linkedin" class="form-control" placeholder="LinkedIn Profile URL">
        </div>

        <div class="form-group mb-3">
            <label for="title" class="form-label">Speaker Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Speaker Title">
        </div>
        <div class="form-group mb-3">
            <label for="type" class="form-label">Select Speaker Type</label>
            <select name="type" id="type" class="form-control">
                <option value="">-- Select Speaker Type --</option>
                <option value="speaker">Speaker</option>
                <option value="special_guest">Special Guest</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="event_or_conference" class="form-label">Select Type</label>
            <select name="event_or_conference" id="event_or_conference" class="form-control">
                <option value="">-- Select Event or Conference --</option>
                <option value="event">Event</option>
                <option value="conference">Conference</option>
            </select>
        </div>
        <div id="event_input" class="form-group mb-3" style="display: none;">
            <label for="event_id" class="form-label">Select Event</label>
            <select name="event_id" id="event_id" class="form-control">
                <option value="">-- Select Event --</option>
                @foreach($events as $event)
                <option value="{{ $event->id }}">{{ $event->title }}</option>
                @endforeach
            </select>
        </div>

        <div id="conference_input" class="form-group mb-3" style="display: none;">
            <label for="conference_id" class="form-label">Select Conference</label>
            <select name="conference_id" id="conference_id" class="form-control">
                <option value="">-- Select Conference --</option>
                @foreach($conferences as $conference)
                <option value="{{ $conference->id }}">{{ $conference->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="image" class="form-label">Profile Image URL or Path</label>
            <input type="text" name="image" id="image" class="form-control" placeholder="Enter image URL or local path">
        </div>

        <div class="text-center mb-5">
            <button type="submit" class="btn btn-primary">Create Speaker</button>
        </div>
</div>
</form>

<script src="{{ asset('js/EventConference.js') }}"></script>

<script>
    $('#create-speaker-form').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '{{ route("admin.speakers.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Speaker created successfully');
                window.location.href = "{{ route('admin.speakers.index') }}";
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    alert('Error creating speaker: ' + xhr.responseJSON.message);
                } else {
                    alert('Error creating speaker: ' + xhr.statusText);
                }
            }
        });
    });
</script>
@endsection