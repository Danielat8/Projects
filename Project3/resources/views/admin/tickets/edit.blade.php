@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Edit Ticket</h2>
    <form id="edit-ticket-form" method="POST" action="{{ route('admin.tickets.update', $ticket->id) }}" class="bg-light p-4 shadow rounded">
        @csrf
        @method('PUT')


        <div class="form-group mb-3">
            <label for="ticket_type" class="form-label">Ticket Type</label>
            <input type="text" name="ticket_type" id="ticket_type" class="form-control" value="{{ old('ticket_type', $ticket->ticket_type) }}" placeholder="Ticket Type">
        </div>


        <div class="form-group mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $ticket->price) }}" placeholder="Ticket Price" step="0.01">
        </div>


        <div class="form-group mb-3">
            <label for="available" class="form-label">Available</label>
            <input type="number" name="available" id="available" class="form-control" value="{{ old('available', $ticket->available) }}" placeholder="Tickets Available">
        </div>


        <div class="form-group mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $ticket->quantity) }}" placeholder="Ticket Quantity">
        </div>

        <div class="form-group mb-3">
            <label for="ticket_name" class="form-label">Ticket Name</label>
            <input type="text" name="ticket_name" id="ticket_name" class="form-control" value="{{ old('ticket_name', $ticket->ticket_name) }}">
        </div>


        <div class="form-group mb-3">
            <label for="ticket_date" class="form-label">Ticket Date</label>
            <input type="date" name="ticket_date" id="ticket_date" class="form-control" value="{{ old('ticket_date', $ticket->ticket_date) }}">
        </div>


        <div class="form-group mb-3">
            <label for="place" class="form-label">Place</label>
            <input type="text" name="place" id="place" class="form-control" value="{{ old('place', $ticket->place) }}">
        </div>


        <div class="form-group mb-3">
            <label for="event_or_conference" class="form-label">Select Type</label>
            <select name="event_or_conference" id="event_or_conference" class="form-control">
                <option value="">-- Select Event or Conference --</option>
                <option value="event" {{ old('event_or_conference', $ticket->event_id ? 'event' : 'conference') === 'event' ? 'selected' : '' }}>Event</option>
                <option value="conference" {{ old('event_or_conference', $ticket->conference_id ? 'conference' : 'event') === 'conference' ? 'selected' : '' }}>Conference</option>
            </select>
        </div>


        <div id="event_input" class="form-group mb-3" style="display: none;">
            <label for="event_id" class="form-label">Select Event</label>
            <select name="event_id" id="event_id" class="form-control">
                <option value="">-- Select Event --</option>
                @foreach($events as $event)
                <option value="{{ $event->id }}" {{ (old('event_id', $ticket->event_id) == $event->id) ? 'selected' : '' }}>
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
                <option value="{{ $conference->id }}" {{ (old('conference_id', $ticket->conference_id) == $conference->id) ? 'selected' : '' }}>
                    {{ $conference->title }}
                </option>
                @endforeach
            </select>
        </div>


        <div class="text-center mb-5">
            <button type="submit" class="btn btn-success btn-lg">Update Ticket</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/EditEventConference.js') }}"></script>
<script>
    $('#edit-ticket-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData + '&_method=PUT',
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Ticket updated successfully');
                window.location.href = "{{ route('admin.tickets.index') }}";
            },
            error: function(xhr) {
                alert('Error updating ticket: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection