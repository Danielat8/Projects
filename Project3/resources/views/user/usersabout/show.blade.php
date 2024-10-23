@php
$layout = auth()->check() && auth()->user()->role_id == 1 ? 'layouts.admin.admin' : 'layouts.user.user';
@endphp

@extends($layout)

@section('content')
<link href="{{ asset('css/usersabout.css') }}" rel="stylesheet">



<div class="container " style="margin-bottom: 200px; margin-top:100px;">
    <div class="d-flex justify-content-between mb-3">
        @if (auth()->check() && auth()->user()->role_id > 1)
        <a href="{{ route('user.recommendations.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-person-walking-arrow-right ps-2 fa-flip-horizontal" style="color: #74C0FC;"></i> Back to Recommendations
        </a>
        @endif
        <a href="{{ route('user.friends.index') }}" class="btn btn-info text-white float-end">
            Back to Friends <i class="fa-solid fa-person-walking-arrow-right fa-beat ps-2" style="color: #FFD43B;"></i>
        </a>
    </div>
    <div class="card mb-4 mt-5 shadow-lg p-4" style="background-color: #f0f8ff; border-radius: 15px;">
        <div class="row">
            <div class="col-md-4 mb-4 d-flex justify-content-center align-items-center">
                <img src="{{ asset('storage/' . $user->about->photo_upload) }}" class="img-fluid rounded-5 shadow" style="max-width: 100%; height: 250px; object-fit: cover; transition: transform 0.3s ease;">
            </div>

            <div class="col-md-8">
                <h2 class="text-primary">{{ $user->name }}'s Profile</h2>
                <p><strong>Surname:</strong> {{ $user->about->surname }}</p>
                <p><strong>Title:</strong> {{ $user->about->title }}</p>
                <p><strong>City:</strong> {{ $user->about->city }}</p>
                <p><strong>Country:</strong> {{ $user->about->country }}</p>
                <p><strong>Bio:</strong> {{ $user->about->bio }}</p>
                <p><strong>Phone:</strong> {{ $user->about->phone }}</p>

                <div class="mt-3">
                    <a href="{{ asset('storage/' . $user->about->cv_upload) }}" class="btn btn-outline-info btn-sm" target="_blank">Show CV</a>
                    <a href="{{ asset('storage/' . $user->about->cv_upload) }}" download class="btn btn-outline-secondary btn-sm">Download CV</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-lg p-4 mb-3" style="background-color: #e6f7ff; border-radius: 15px;">
        <h3 class="mb-4 text-info">Recommendations Received</h3>

        @if($user->receivedRecommendations->isEmpty())
        <p class="text-muted">No recommendations received yet.</p>
        @else
        <div class="row">
            @foreach($user->receivedRecommendations as $recommendation)
            <div class="col-md-12 mb-3">
                <div class="card recommendation-card shadow-sm h-100" style="transition: transform 0.3s ease; background-color: #fff; border-left: 5px solid #007bff;">
                    <div class="card-body">
                        <p class="card-text text-success"><small class="fw-bolder">Description:</small> {{ $recommendation->description }}</p>
                        <small><span class="fw-bolder fs-6 ">Created:</span> {{ $recommendation->fromUser->created_at }}</small>
                        <p class="pt-3"><strong>From:</strong> {{ $recommendation->fromUser->name }}</p>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>


@endsection