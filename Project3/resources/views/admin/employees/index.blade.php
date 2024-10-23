@extends('layouts.admin.admin')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Employees</h2>
    <div class="text-end mb-3">
        <a href="{{ route('admin.employees.create') }}" class="btn btn-outline-success">Create New Employee</a>
    </div>

    <div class="row">
        @foreach ($employees as $employee)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card text-center">
                <img src="{{ (filter_var($employee->picture_path, FILTER_VALIDATE_URL) ? $employee->picture_path : asset($employee->picture_path)) ?? asset('images/default-image.jpg') }}" class="card-img-top" alt="{{ $employee->name }}" style=" height: 280px;
        object-fit: cover;
        width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ $employee->name }} {{ $employee->surname }}</h5>
                    <p class="card-text">{{($employee->bio) }}</p>
                    <p class="card-text"><strong>Job:</strong> {{ $employee->job }}</p>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        @if($employee->linkedin)
                        <a href="{{ $employee->linkedin }}" target="_blank" class="btn btn-outline-info btn-sm">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                        @endif
                        @if($employee->instagram)
                        <a href="{{ $employee->instagram }}" target="_blank" class="btn btn-outline-danger btn-sm">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        @endif
                        @if($employee->facebook)
                        <a href="{{ $employee->facebook }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        @endif
                        @if($employee->twitter)
                        <a href="{{ $employee->twitter }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="fa-brands fa-square-twitter"></i>
                        </a>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center gap-2">

                        <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>



                        <form method="POST" action="{{ route('admin.employees.destroy', $employee->id) }}" class="delete-form" data-id=" $employee->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('click', function(event) {
        if (event.target && event.target.closest('.delete-form')) {
            event.preventDefault();
            const form = event.target.closest('form');
            const formId = form.dataset.id;

            if (confirm('Are you sure you want to delete this employee?')) {
                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams(new FormData(form))
                    })
                    .then(response => {
                        if (response.status === 204) {
                            alert('Employees deleted successfully!');
                            location.reload();

                        } else {
                            return response.text().then(text => {
                                throw new Error(text || 'Unknown error.');
                            });
                        }
                    })
                    .catch(error => {
                        alert('An error occurred while deleting the Employees: ' + error.message);
                        console.error('Error:', error);
                    });
            }
        }
    });
</script>
@endsection