@extends('layouts.user.user')

@section('content')
<div class="container" style="margin-bottom: 200px; margin-top:100px;">
    <h1 class="mb-4">{{ $blog->title }}</h1>
    <div class="card mb-4 shadow">
        <div class="card-body">
            <p class="card-text"><span class="fw-bold">Blog :</span>{{ $blog->body }}</p>
            <p class="card-text"><span class="fw-bold">Section :</span>{{ $blog->sections }}</p>
            <p class="card-text"><span class="fw-bold">Title :</span>{{ $blog->title }}</p>
            <hr>
            <p class="text-muted"><span class="fw-bold">Created By:</span> {{ $blog->user->name }}</p>
            <p class="text-muted"><span class="fw-bold">Created On:</span> {{ $blog->created_at->format('F j, Y') }}</p>
        </div>
    </div>
    <div class="mb-2">
        <form action="{{ route('user.blogs.like', $blog->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-primary me-1">
                <i class="fa-solid fa-thumbs-up"></i> Like
            </button>
        </form>
        <form action="{{ route('user.blogs.unlike', $blog->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger me-1">
                <i class="fa-solid fa-thumbs-down"></i> Unlike
            </button>
        </form>
        @php
        $likedUsers = $blog->likes->map(function($like) {
        return $like->user->name;
        })->implode(', ');
        @endphp

        <span
            class="text-muted"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="{{ $likedUsers ?: 'No one has liked this yet.' }}">
            {{ $blog->likes->count() }} Likes
        </span>
    </div>

    <div class="mt-3 mb-4">
        <a href="{{ route('user.comments.index') }}" class="btn btn-secondary">Back to Comments</a>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection