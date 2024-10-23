@extends('layouts.admin.admin')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">General Info</h2>
    <div class="text-end mb-3">
        <a href="{{ route('admin.generalinfo.create') }}" class="btn btn-outline-success">Create New General Info</a>
    </div>

    <div class="row">
        @foreach ($generalInfo as $generalInfos)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card text-center">
                <img src="{{ (filter_var($generalInfos->picture_path, FILTER_VALIDATE_URL) ? $generalInfos->picture_path : asset($generalInfos->picture_path)) ?? asset('images/default-image.jpg') }}" class="card-img-top" alt="{{ $generalInfos->title }}" style="height: 280px; object-fit: cover; width: 100%;">
                <div class="card-body">
                    <h5 class="card-title text-start pb-3">{{ $generalInfos->general }}</h5>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        @if($generalInfos->linkedin)
                        <a href="{{ $generalInfos->linkedin }}" target="_blank" class="btn btn-outline-info btn-sm">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                        @endif
                        @if($generalInfos->instagram)
                        <a href="{{ $generalInfos->instagram }}" target="_blank" class="btn btn-outline-danger btn-sm">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        @endif
                        @if($generalInfos->facebook)
                        <a href="{{ $generalInfos->facebook }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        @endif
                        @if($generalInfos->twitter)
                        <a href="{{ $generalInfos->twitter }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="fa-brands fa-square-twitter"></i>
                        </a>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center gap-2">

                        <a href="{{ route('admin.generalinfo.edit', $generalInfos->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>


                        <form method="POST" action="{{ route('admin.generalinfo.destroy', $generalInfos->id) }}" class="delete-form" data-id="{{ $generalInfos->id }}">
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

            if (confirm('Are you sure you want to delete this item?')) {
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
                            alert('Item deleted successfully!');
                            form.closest('.col-lg-4').remove();
                        } else {
                            return response.text().then(text => {
                                throw new Error(text || 'Unknown error.');
                            });
                        }
                    })
                    .catch(error => {
                        alert('An error occurred while deleting the item: ' + error.message);
                        console.error('Error:', error);
                    });
            }
        }
    });
</script>
@endsection