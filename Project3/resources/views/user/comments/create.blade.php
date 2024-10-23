@extends('layouts.user.user')

@section('content')
<div class="container" style="margin-bottom: 200px; margin-top:100px;">
    <h1>Create Comment</h1>
    <form id="create-comment-form" method="POST" action="{{ route('user.comments.store') }}">
        @csrf
        <div class="form-group">
            <label for="blog_id " class="p-2">Select Blog</label>
            <select name="blog_id" id="blog_id" class="form-control">
                <option value="">Select a blog</option>
                @foreach($blogs as $blog)
                <option value="{{ $blog->id }}">{{ $blog->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="body" class="p-2"> Create Comment </label>
            <textarea name="body" id="body" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-2 mb-3">Submit</button>
    </form>
</div>

<script>
    $('#create-comment-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('user.comments.store') }}",
            type: 'POST',
            data: formData,
            success: function(response) {
                alert('Comment created successfully');
                window.location.href = "{{ route('user.comments.index') }}";
            },
            error: function(xhr) {
                alert('Error creating comment: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection