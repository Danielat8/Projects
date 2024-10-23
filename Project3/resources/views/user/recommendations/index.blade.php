@extends('layouts.user.user')

@section('content')

<h2 style="margin-bottom:100px; margin-top:100px; " class="fw-bolder">My Recommendations</h2>
<div class="list-group">
    @foreach($myRecommendations as $recommendation)

    <div class="list-group-item" id="recommendation-{{ $recommendation->id }}">
        <h5 class="recommendation-description">{{ $recommendation->description }}</h5>
        <p>For User: {{ $recommendation->forUser->name }}</p>
        <p>From User: {{ $recommendation->fromUser->name }}</p>


        @if($recommendation->from_user_id == Auth::id())

        <button class="edit-recommendation btn btn-warning mb-3" data-id="{{ $recommendation->id }}">Edit</button>

        <form class="edit-recommendation-form " id="edit-recommendation-form-{{ $recommendation->id }}" action="{{ route('user.recommendations.update', $recommendation->id) }}" method="POST" style="display: none;">
            @csrf
            @method('PUT')
            <textarea name="description">{{ $recommendation->description }}</textarea>
            <button type="submit" class="btn btn-primary mb-5">Update</button>
        </form>


        <form action="{{ route('user.recommendations.destroy', $recommendation->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mb-3">Delete</button>
        </form>
        @endif
    </div>
    @endforeach
</div>
<h2 class="pt-4 pb-2 fw-bolder">Received Recommendations</h2>
<div class="list-group" id="received-recommendations-list">
    @foreach($receivedRecommendations as $recommendation)
    <div class="list-group-item">
        <h5>{{ $recommendation->description }}</h5>

        @if($recommendation->fromUser)
        <p>From User: {{ $recommendation->fromUser->name }}</p>
        <a href="{{ route('user.show', $recommendation->fromUser->id) }}" class="btn btn-info">Show Profile</a>
        @endif

        @if($recommendation->from_user_id == Auth::id() || $recommendation->for_user_id == Auth::id())

        <form action="{{ route('user.recommendations.destroy', $recommendation->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        @endif
    </div>
    @endforeach
</div>


<h2 class="pt-4 pb-2 fw-bolder">Add Recommendation</h2>
<form action="{{ route('user.recommendations.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <textarea name="description" class="form-control" id="description" placeholder="Your recommendation..."></textarea>
    </div>
    <div class="form-group mb-3 mt-3">
        <label for="for_user_id">For User:</label>
        <select name="for_user_id" id="for_user_id" class="form-control">
            <option value="" disabled selected>Select a user</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-bottom:200px; margin-top:30px;">Submit</button>
</form>

@include('layouts.script')


<script>
    $(document).ready(function() {
        function loadMyRecommendations() {
            $.ajax({
                url: '{{ route("user.recommendations.my") }}',
                method: 'GET',
                success: function(data) {
                    let recommendationsHTML = '';
                    data.myRecommendations.forEach(function(recommendation) {
                        recommendationsHTML += `<div class="list-group-item" id="recommendation-${recommendation.id}">
                            <h5 class="mb-1">${recommendation.description}</h5>
                            <button class="edit-recommendation btn btn-warning" data-id="${recommendation.id}">Edit</button>
                            <button class="delete-recommendation btn btn-danger" data-id="${recommendation.id}">Delete</button>
                        </div>`;
                    });
                    $('#my-recommendations-list').html(recommendationsHTML);
                }
            });
        }


        function loadReceivedRecommendations() {
            $.ajax({
                url: '{{ route("user.recommendations.received") }}',
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    let recommendationsHTML = '';
                    data.receivedRecommendations.forEach(function(recommendation) {
                        const fromUserName = recommendation.from_user && recommendation.from_user.name ? recommendation.from_user.name : 'Unknown User';
                        const fromUserId = recommendation.from_user ? recommendation.from_user.id : null;

                        recommendationsHTML += `<div class="list-group-item">
                    <h5 class="mb-1">${recommendation.description}</h5>
                    <p>From User: ${fromUserName}</p>
                    ${fromUserId ? `<a href="{{ route('user.show', '') }}/${fromUserId}" class="btn btn-info">Show Profile</a>` : ''}
                    
                    <form action="{{ route('user.recommendations.destroy', '') }}/${recommendation.id}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>`;
                    });

                    $('#received-recommendations-list').html(recommendationsHTML);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading recommendations:', error);
                }
            });
        }





        loadMyRecommendations();
        loadReceivedRecommendations();

        $('#add-recommendation-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/recommendations',
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    loadMyRecommendations();
                    loadReceivedRecommendations();
                    $('#description').val('');
                    $('#for_user_id').val('');
                }
            });
        });


        $(document).on('click', '.delete-recommendation', function() {
            let recommendationId = $(this).data('id');
            $.ajax({
                url: `/recommendations/${recommendationId}`,
                method: 'DELETE',
                success: function() {
                    loadRecommendations();
                }
            });
        });
    });
    $(document).ready(function() {
        $('.edit-recommendation').on('click', function() {
            let recommendationId = $(this).data('id');
            let form = $('#edit-recommendation-form-' + recommendationId);

            form.toggle();
        });

        $('form.edit-recommendation-form').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData + '&_method=PUT',
                success: function(response) {
                    alert('Recommendation updated successfully');

                    form.closest('.list-group-item').find('.recommendation-description').text(form.find('textarea[name="description"]').val());

                    form.hide();
                },
                error: function(xhr) {
                    alert('Error updating recommendation: ' + xhr.responseText);
                }
            });
        });
    });
</script>
@endsection