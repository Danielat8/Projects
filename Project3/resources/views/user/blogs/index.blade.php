@extends('layouts.user.user')

@section('content')

<div class="container" style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">All Blogs</h2>

    <div class="text-end mb-3">
        <a href="{{ route('user.blogs.create') }}" class="btn btn-outline-success btn-lg">Create New Blog</a>
    </div>

    <div class="row">
        @foreach ($blogs as $blog)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card blog-card shadow-lg border-0 rounded-lg overflow-hidden h-100 bg-warning-subtle">
                <div class="card-header bg-info text-dark">
                    <h5 class="card-title text-center fw-bold">{{ $blog->title }}</h5>
                </div>
                <div class="card-body text-start">
                    <p class="card-text text-muted"><span class="fw-bolder">Body Description:</span> {{ ($blog->body) }}</p>
                    <p class="badge bg-info mb-2 text-wrap"><span class="fw-bolder">Section:</span> {{ $blog->sections }}</p>
                    <p class="text-muted"><span class="fw-bolder">Created By:</span> {{ $blog->user->name }}</p>
                </div>
                <div class=" py-4 text-center">
                    @if ($blog->created_by === Auth::id())
                    <div class="d-flex justify-content-center gap-2">

                        <a href="{{ route('user.blogs.edit', $blog->id) }}" class="btn btn-outline-info btn-sm">
                            <i class="fa-solid fa-pen"></i> Edit
                        </a>

                        <form method="POST" action="{{ route('user.blogs.destroy', $blog->id) }}" class="delete-form" data-id="{{ $blog->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                    @endif
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

            if (confirm('Are you sure you want to delete this blog?')) {
                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams(new FormData(form))
                    })
                    .then(response => {
                        if (response.status === 204) {
                            alert('Blog deleted successfully!');
                            location.reload();
                        } else {
                            alert('Error deleting blog post.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the blog: ' + error.message);
                    });
            }
        }
    });
</script>

@endsection