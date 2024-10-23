@extends('layouts.user.user')

@section('content')
<div class="container" style="margin-bottom: 200px; margin-top:100px;">
    <h1 class="text-center">Edit Form</h1>

    <form action="{{ route('user.comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="body p-2 ">Edit Comment</label>
            <textarea name="body" id="body" class="form-control">{{ $comment->body }}</textarea>
        </div>
        <button type="submit" class="btn btn-success mt-2 mb-3">Update</button>
    </form>
</div>
<script>
    function editComment(commentId, commentBody) {
        $('#body').val(commentBody);
        $('#create-comment-form').off('submit').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize() + '&reply_id=' + commentId;

            $.ajax({
                url: "{{ url('comments ') }}/" + commentId,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Error updating comment: ' + xhr.responseText);
                }
            });
        });
    }
</script>
@endsection