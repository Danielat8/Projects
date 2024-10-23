@extends('layouts.user.user')

@section('content')
<div class="container mt-5" style="margin-bottom: 200px; margin-top:100px;">
    <h2 class="text-center mb-4 " style="margin-top: 100px;"> Edit Your Blog Post</h2>
    <form id="edit-blog-form" method="POST" action="{{ route('user.blogs.update', $blog->id) }}" class="bg-light p-4 shadow rounded">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="title" class="form-label">Blog Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blog->title) }}" placeholder="Blog Title">
        </div>

        <div class="form-group mb-3">
            <label for="sections" class="form-label">Section</label>
            <input type="text" name="sections" id="sections" class="form-control" value="{{ old('sections', $blog->sections) }}" placeholder="Blog Section">
        </div>

        <div class="form-group mb-3">
            <label for="body" class="form-label">Body Description</label>
            <textarea name="body" id="body" class="form-control" rows="4" placeholder="Blog Body">{{ old('body', $blog->body) }}</textarea>
        </div>

        <div class="text-center mb-5">
            <button type="submit" class="btn btn-primary">Update Blog Post</button>
        </div>
    </form>
</div>

<script>
    $('#edit-blog-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData + '&_method=PUT',
            success: function(response) {
                alert('Blog information updated successfully');
                window.location.href = "{{ route('user.blogs.index') }}";
            },
            error: function(xhr) {
                alert('Error updating blog information: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection