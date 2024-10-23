@extends('layouts.user.user')
@section('content')
<div class="container" style="margin-bottom: 200px; margin-top:100px;">
    <h1 class="text-center mb-4">User Comments</h1>



    <div class="text-end mb-3">
        <a href="{{ route('user.comments.create') }}" class="btn btn-success btn-lg">
            <i class=" ps-2 fa-solid fa-plus fa-flip fa-lg" style="color: #ffcccc;"></i> <span class="ps-2" style="color: #ffcccc;">Create Comment</span>
        </a>
    </div>

    <ul class="list-group mt-4 shadow-sm bg-info">
        @foreach($comments as $comment)
        @if(!$comment->reply_id)

        <p class="p-3">Comment by <strong>{{ $comment->user->name }}:</strong></p>
        <li class="list-group-item border rounded mb-3 bg-warning-subtle">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="mb-1"><strong>{{ $comment->user->name }}:</strong> {{ $comment->body }}</p>
                    <p class="fw-bolder">Check the blog: <a href="{{ route('user.blogs.show', $comment->blog->id) }}" class="link-success link-offset-5 link-underline-opacity-25 link-underline-opacity-100-hover"><i class="fa-solid fa-person-booth fa-fade fa-2xl" style="color: #99d3ff;"></i></a></p>

                    <small class="text-muted">Posted on: {{ $comment->created_at->format('d M, Y') }}</small>
                </div>


                @if($comment->user_id === Auth::id())
                <div class="btn-group">
                    <a href="{{ route('user.comments.edit', $comment->id) }}" class="btn btn-warning btn-sm rounded-2  me-2">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('user.comments.destroy', $comment->id) }}" method="POST" class="delete-form d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
                @endif

            </div>
            <div class="mb-2">
                <form action="{{ route('user.comments.like', $comment->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary me-1">
                        <i class="fa-solid fa-beat fa-thumbs-up"></i> Like
                    </button>
                </form>
                <form action="{{ route('user.comments.unlike', $comment->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger me-1">
                        <i class="fa-solid fa-bounce fa-thumbs-down"></i> Unlike
                    </button>
                </form>
                @php
                $likedUsers = $comment->likes->map(function($like) {
                return $like->user->name;
                })->implode(', ');
                @endphp
                <span
                    class="text-muted"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="{{ $likedUsers ?: 'No one has liked this yet.' }}">
                    {{ $comment->likes->count() }} Likes
                </span>
            </div>

            @if($comment->replies->count() > 0)
            <ul class="list-group mt-3 ">
                @foreach($comment->replies as $reply)
                <p class="mb-1 p-1">Reply by <strong>{{ $reply->user->name }}:</strong></p>
                <li class="list-group-item border rounded mt-2 mb-2 bg-info-subtle">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-1"><strong>{{ $reply->user->name }}:</strong> {{ $reply->body }}</p>
                            <small class="text-muted">Posted on: {{ $reply->created_at->format('d M, Y') }}</small>
                        </div>
                        @if($reply->user_id === Auth::id())
                        <div class="btn-group">
                            <a href="{{ route('user.comments.edit', $reply->id) }}" class="btn btn-warning btn-sm rounded-2  me-2">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('user.comments.destroy', $reply->id) }}" method="POST" class="delete-form d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
            @endif

            <form action="{{ route('user.comments.store') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="reply_id" value="{{ $comment->id }}">
                <input type="hidden" name="blog_id" value="{{ $comment->blog->id }}">
                <div class="form-floating mb-2">
                    <textarea name="body" class="form-control" placeholder="Leave a reply here" id="replyTextarea" style="height: 100px;"></textarea>
                    <label for="replyTextarea">Reply...</label>
                </div>
                <button type="submit" class="btn btn-secondary btn-sm">
                    <i class="fa fa-reply"></i> Reply
                </button>
            </form>
        </li>
        @endif
        @endforeach
    </ul>
</div>

<script>
    document.addEventListener('click', function(event) {
        if (event.target && event.target.closest('.delete-form')) {
            event.preventDefault();
            const form = event.target.closest('form');

            if (confirm('Are you sure you want to delete this comment?')) {
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams(new FormData(form))
                }).then(response => {
                    if (response.status === 204) {
                        alert('Comment deleted successfully!');
                        location.reload();
                    } else {
                        alert('Error deleting comment.');
                    }
                }).catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the comment: ' + error.message);
                });
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)

        })
    });
</script>
@endsection