@extends('layouts.admin.admin')

@section('content')
<div class="container mt-5 " style="margin-bottom: 100px;">
    <h2 class="text-center mb-4">Conferences</h2>

    <div class="text-end mb-3">
        <a href="{{ route('admin.conferences.create') }}" class="btn btn-outline-success">Create New Conference</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-dark table-bordered align-middle text-center" id="Table">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Theme</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Objective</th>
                    <th>Agenda</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($conferences as $conference)
                <tr id="conference-{{ $conference->id }}">

                    <td class="text-primary fw-bold">{{ $conference->title }}</td>
                    <td>{{ $conference->theme }}</td>
                    <td>{{ $conference->date }}</td>
                    <td>{{ $conference->location }}</td>
                    <td class="text-start">{{ ($conference->description) }}</td>
                    <td>{{ Str::limit($conference->objective) }}</td>
                    <td class="text-start">{{ ($conference->agenda) }}</td>
                    <td>{{ $conference->status }}</td>

                    <td>

                        <a href="{{ route('admin.conferences.edit', $conference->id) }}" class=" mb-3 btn btn-outline-primary btn-sm ">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('admin.conferences.destroy', $conference->id) }}" id="delete-form-{{ $conference->id }}" onsubmit="return confirm('Are you sure you want to delete this conference?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm ">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </div>
</div>




<script>
    document.addEventListener('click', function(event) {
        if (event.target && event.target.matches('button[type="submit"]')) {
            event.preventDefault();
            const form = event.target.closest('form');
            const formId = form.id;

            if (confirm('Are you sure you want to delete this conference?')) {
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
                            alert('Conference deleted successfully!');
                        } else {
                            return response.text().then(text => {
                                throw new Error(text || 'Unknown error.');
                            });
                        }
                    })
                    .catch(error => {
                        alert('An error occurred while deleting the conference: ' + error.message);
                        console.error('Error:', error);
                    });
            }
        }
    });
</script>
@endsection