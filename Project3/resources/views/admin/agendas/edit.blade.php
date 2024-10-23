@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Edit Agenda Item</h2>
    <form id="edit-agenda-form" method="POST" action="{{ route('admin.agendas.update', $agenda->id) }}" class="bg-light p-4 shadow rounded">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="title" class="form-label">Agenda Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $agenda->title) }}" placeholder="Agenda Title">
        </div>

        <div class="form-group mb-3">
            <label for="agenda_description" class="form-label">Main Description</label>
            <textarea name="description" id="agenda_description" class="form-control" rows="4" placeholder="Brief description">{{ old('description', $agenda->description) }}</textarea>
        </div>

        <div id="description-container">
            <h4>Descriptions</h4>
            @foreach($agenda->descriptions as $description)
            <div class="description-item mb-2">
                <textarea name="descriptions[]" class="form-control" rows="2">{{ $description->description }}</textarea>
                <button type="button" class="btn btn-danger btn-sm remove-description">Remove</button>
            </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-secondary mb-3" id="add-description">Add Description</button>

        <div class="form-group mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="time" name="time" id="time" class="form-control" value="{{ old('time', $agenda->time) }}">
        </div>

        <div class="form-group mb-3">
            <label for="event_or_conference" class="form-label">Select Event or Conference</label>
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


        <div class="text-center mb-5">
            <button type="submit" class="btn btn-success btn-lg">Update Agenda</button>
        </div>
    </form>
</div>

<script src="{{ asset('js/EditEventConference.js') }}"></script>


<script>
    document.getElementById('add-description').addEventListener('click', function() {
        const container = document.getElementById('description-container');
        const newDescription = document.createElement('div');
        newDescription.className = 'description-item mb-2';
        newDescription.innerHTML = `<textarea name="descriptions[]" class="form-control" rows="2" ></textarea>
                                    <button type="button" class="btn btn-danger btn-sm remove-description">Remove</button>`;
        container.appendChild(newDescription);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-description')) {
            e.target.parentElement.remove();
        }
    });

    $('#edit-agenda-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData + '&_method=PUT',
            success: function(response) {
                alert('Agenda item updated successfully');
                window.location.href = "{{ route('admin.agendas.index') }}";
            },
            error: function(xhr) {
                alert('Error updating agenda item: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection