@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Edit Speaker</h2>
    <form id="edit-speaker-form" method="POST" action="{{ route('admin.speakers.update', $speaker->id) }}" class="bg-light p-4 shadow rounded" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name" class="form-label">Speaker Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $speaker->name) }}" placeholder="Speaker Name">
        </div>

        <div class="form-group mb-3">
            <label for="title" class="form-label">Speaker Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $speaker->title) }}" placeholder="Speaker Title">
        </div>


        <div class="form-group mb-3">
            <label for="linkedin" class="form-label">LinkedIn Profile</label>
            <input type="url" name="linkedin" id="linkedin" class="form-control" value="{{ old('linkedin', $speaker->linkedin) }}" placeholder="LinkedIn Profile URL">
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
                <option value="event" {{ old('event_or_conference', $speaker->event_id ? 'event' : 'conference') === 'event' ? 'selected' : '' }}>Event</option>
                <option value="conference" {{ old('event_or_conference', $speaker->conference_id ? 'conference' : 'event') === 'conference' ? 'selected' : '' }}>Conference</option>
            </select>
        </div>

        <div id="event_input" class="form-group mb-3" style="display: none;">
            <label for="event_id" class="form-label">Select Event</label>
            <select name="event_id" id="event_id" class="form-control">
                <option value="">-- Select Event --</option>
                @foreach($events as $event)
                <option value="{{ $event->id }}" {{ (old('event_id', $speaker->event_id) == $event->id) ? 'selected' : '' }}>
                    {{ $event->title }}
                </option>
                @endforeach
            </select>
        </div>

        <div id="conference_input" class="form-group mb-3" style="display: none;">
            <label for="conference_id" class="form-label">Select Conference</label>
            <select name="conference_id" id="conference_id" class="form-control">
                <option value="">-- Select Conference --</option>
                @foreach($conferences as $conference)
                <option value="{{ $conference->id }}" {{ (old('conference_id', $speaker->conference_id) == $conference->id) ? 'selected' : '' }}>
                    {{ $conference->title }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="image" class="form-label">Profile Image URL or Path</label>
            <input type="text" name="image" id="image" class="form-control" value="{{ old('image', $speaker->image) }}" placeholder="Enter image URL or local path">
        </div>

        <div class="text-center mb-5">
            <button type="submit" class="btn btn-success btn-lg">Update Speaker</button>
        </div>
    </form>
</div>

<script src="{{ asset('js/EditEventConference.js') }}"></script>



<script>
    $('#edit-speaker-form').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Speaker updated successfully');
                window.location.href = "{{ route('admin.speakers.index') }}";
            },
            error: function(xhr) {
                alert('Error updating speaker: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection