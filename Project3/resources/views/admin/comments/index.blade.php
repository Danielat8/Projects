@extends('layouts.admin.admin')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Comments</h2>


    <div class="table-responsive">
        <table class="table table-hover table-dark table-bordered align-middle text-center" id="Table">
            <thead class="table-dark">
                <tr>
                    <th>Blog Title</th>
                    <th>User Name</th>
                    <th>Comment</th>
                    <th>Reply</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                <tr id="comment-{{ $comment->id }}">
                    <td>{{ $comment->blog->title }}</td>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ Str::limit($comment->body, 50) }}</td>
                    <td>
                        @if($comment->replies->count() > 0)
                        {{ $comment->replies->first()->body }}
                        @else
                        No reply yet
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.comments.destroy', $comment->id) }}" id="delete-form-{{ $comment->id }}" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                Delete
                            </button>
                        </form>
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

            if (confirm('Are you sure you want to delete this comment?')) {
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
                            alert('Comment deleted successfully!');
                            location.reload();

                        } else {
                            return response.text().then(text => {
                                throw new Error(text || 'Unknown error.');
                            });
                        }
                    })
                    .catch(error => {
                        alert('An error occurred while deleting the comment: ' + error.message);
                        console.error('Error:', error);
                    });
            }
        }
    });
</script>
@endsection