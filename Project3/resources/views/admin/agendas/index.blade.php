@extends('layouts.admin.admin')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Agendas</h2>
    <div class="text-end mb-3">
        <a href="{{ route('admin.agendas.create') }}" class="btn btn-outline-success">Create New Agenda</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-dark table-bordered align-middle text-center" id="Table">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Description-DESC</th>
                    <th>Time</th>
                    <th>Event Title</th>
                    <th>Conference Title</th>
                    <th>Agenda Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agendas as $agenda)
                <tr id="agenda-{{ $agenda->id }}">
                    <td class="text-primary fw-bold">{{ $agenda->title }}</td>
                    <td>{{($agenda->description) }}</td>
                    <td>
                        @foreach ($agenda->descriptions as $desc)
                        <li class="text-start">{{($desc->description) }}<br>
                            @endforeach
                    </td>
                    <td>{{ $agenda->time }}</td>
                    <td>
                        @if($agenda->event)
                        <p><span class="fw-bolder">Event Title:</span> {{ $agenda->event->title }}</p>
                        @else
                        <p>You have selected conference </p>
                        @endif
                    </td>
                    <td>
                        @if($agenda->conference)
                        <p<span class="fw-bolder">Conference Title:</span> {{ $agenda->conference->title }}</p>
                            @else
                            <p>You have selected event</p>
                            @endif
                    </td>
                    <td>{{ $agenda->title }}</td>

                    <td>
                        <div class="d-flex justify-content-center gap-2">

                            <a href="{{ route('admin.agendas.edit', $agenda->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                            <form method="POST" action="{{ route('admin.agendas.destroy', $agenda->id) }}" id="delete-form-{{ $agenda->id }}" onsubmit="return confirm('Are you sure you want to delete this agenda?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    document.addEventListener('click', function(event) {
        if (event.target && event.target.matches('button[type="submit"]')) {
            event.preventDefault();
            const form = event.target.closest('form');
            const formId = form.id;

            if (confirm('Are you sure you want to delete this agenda?')) {
                fetch(form.action, {
                        method: 'POST',
                        body: new URLSearchParams(new FormData(form)),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    })
                    .then(response => {
                        if (response.status === 204) {
                            document.querySelector(`#${formId}`).closest('tr').remove();
                            alert('Agenda deleted successfully!');
                        } else {
                            return response.text().then(text => {
                                throw new Error(text || 'Unknown error.');
                            });
                        }
                    })
                    .catch(error => {
                        alert('An error occurred while deleting the agenda: ' + error.message);
                        console.error('Error:', error);
                    });
            }
        }
    });
</script>
@endsection