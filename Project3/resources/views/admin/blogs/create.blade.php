@extends('layouts.admin.admin')

@section('content')
<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4">Create New Blog Post</h2>
    <form id="create-blog-form" method="POST" action="{{ route('admin.blogs.store') }}" class="bg-light p-4 shadow rounded">
        @csrf

        <div class="form-group mb-3">
            <label for="title" class="form-label">Blog Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Blog Title">
        </div>

        <div class="form-group mb-3">
            <label for="sections" class="form-label">Section</label>
            <input type="text" name="sections" id="sections" class="form-control" placeholder="Blog Section">
        </div>

        <div class="form-group mb-3">
            <label for="body" class="form-label"> Body Description</label>
            <textarea name="body" id="body" class="form-control" rows="4" placeholder="Blog Description"></textarea>
        </div>

        <div class="text-center mb-5">
            <button type="submit" class="btn btn-primary">Create Blog Post</button>
        </div>
    </form>
</div>

<script>
    $('#create-blog-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.blogs.store") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                alert('Blog post created successfully');
                window.location.href = "{{ route('admin.blogs.index') }}";
            },
            error: function(xhr) {
                alert('Error creating blog post: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection