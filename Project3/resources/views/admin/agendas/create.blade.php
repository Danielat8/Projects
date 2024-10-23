@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Create New Agenda Item</h2>
    <form id="create-agenda-form" method="POST" action="{{ route('admin.agendas.store') }}" class="bg-light p-4 shadow rounded">
        @csrf
        <div class="form-group mb-3">
            <label for="title" class="form-label">Agenda Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Agenda Title">
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Brief description"></textarea>
        </div>
        <div id="additional-descriptions">
            <div class="form-group mb-3">
                <label for="descriptions" class="form-label">Additional Description</label>
                <textarea name="descriptions[]" class="form-control" rows="2" placeholder="Additional description"></textarea>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" id="add-description">Add More Descriptions</button>

        <div class="form-group mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="time" name="time" id="time" class="form-control">
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
            <button type="submit" class="btn btn-primary">Create Agenda Item</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/EventConference.js') }}"></script>

<script>
    document.getElementById('add-description').addEventListener('click', function() {
        const descriptionsDiv = document.getElementById('additional-descriptions');
        const newDescription = document.createElement('div');
        newDescription.className = 'form-group mb-3';
        newDescription.innerHTML = `
            <label for="descriptions" class="form-label">Additional Description</label>
            <textarea name="descriptions[]" class="form-control" rows="2" placeholder="Additional description"></textarea>
        `;
        descriptionsDiv.appendChild(newDescription);
    });

    $('#create-agenda-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.agendas.store") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                alert('Agenda item created successfully');
                window.location.href = "{{ route('admin.agendas.index') }}";
            },
            error: function(xhr) {
                alert('Error creating agenda item: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection