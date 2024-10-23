@php
$layout = auth()->check() && auth()->user()->role_id == 1 ? 'layouts.admin.admin' : 'layouts.user.user';
@endphp

@extends($layout)

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('content')
<div class="container" style="margin-bottom: 200px; margin-top:100px;">
    <h2>All Users</h2>
    <div class="row">
        @foreach($users as $user)
        @php
        $isBlockedByMe = in_array($user->id, auth()->user()->blockedUsers->pluck('blocked_user_id')->toArray());
        $hasBlockedMe = auth()->user()->usersThatBlockedMe->contains('user_id', $user->id);
        $isRequestSent = in_array($user->id, $pendingRequestIdsSent);
        $isRequestReceived = in_array($user->id, $pendingRequestIdsReceived);
        $isAlreadyConnected = in_array($user->id, $connectionIds);
        $isAlreadyConnectedByOneSide = in_array($user->id, $friendUserIds);
        @endphp

        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card h-100 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p>{{ $user->email }}</p>
                    @if (!$isBlockedByMe && !$hasBlockedMe)
                    <a href="{{ route('user.show', $user->id) }}" class="text-white btn btn-info">
                        <i class="fa-solid fa-eye fa-sm pe-2" style="color: #FFD43B;"></i> Show Profile
                    </a>
                    @elseif (!$isBlockedByMe)
                    <p class="text-danger p-1">They have blocked you</p>
                    @endif
                    @if(auth()->user()->role_id == 1)
                    @if($user->is_banned)
                    <button class="btn btn-secondary unban-user m-1" data-id="{{ $user->id }}">Unban User</button>
                    <p class="text-danger p-1">You banned them.</p>
                    @else
                    @if(!$isRequestSent && !$isRequestReceived && !$isAlreadyConnected && !$isAlreadyConnectedByOneSide)
                    <button class="btn btn-danger ban-user m-1" data-id="{{ $user->id }}">Ban User</button>
                    @else
                    <button class="btn btn-sm btn-danger m-1" disabled>Can't ban - already in contact</button>
                    @endif
                    @endif
                    @elseif(auth()->check())
                    @php
                    $isBlockedByMe = in_array($user->id, auth()->user()->blockedUsers->pluck('blocked_user_id')->toArray());
                    @endphp
                    @if(!$isRequestSent && !$isRequestReceived && !$isRequestSent && !$isAlreadyConnected && !$isAlreadyConnectedByOneSide)
                    @if($isBlockedByMe )
                    <button class="btn btn-secondary unblock-user m-1" data-id="{{ $user->id }}">Unblock User</button>
                    <p>You have blocked this user</p>
                    @else
                    <button class="btn btn-danger block-user m-1" data-id="{{ $user->id }}">Block User</button>
                    @endif
                    @else
                    <button class="btn btn-sm btn-danger m-1" disabled>You can block if you are not friends </button>
                    @endif
                    @endif
                    @if(!$isBlockedByMe && !$hasBlockedMe)
                    @if($isAlreadyConnected)
                    <button class="btn btn-info m-1" disabled>We are now friends!</button>
                    <button class="btn btn-danger unfriend my-2 m-1" data-id="{{ $user->id }}">Unfriend</button>
                    @elseif($isAlreadyConnectedByOneSide)
                    <button class="btn btn-info" disabled>We are friends !</button>
                    <button class="btn btn-danger unfriend my-2 m-1" data-id="{{ $user->id }}">Unfriend</button>
                    @elseif($isRequestReceived && !$isAlreadyConnected)
                    <button class="btn btn-sm btn-success disabled accept-friend-request my-2 m-1">Accept Request if you want to be friends</button>
                    @elseif($isRequestSent)
                    <button class="btn btn-warning m-1" disabled>Request Sent</button>
                    @elseif (!$isRequestSent && !$user->is_banned)
                    <button class="btn btn-success send-friend-request my-2 m-1" data-id="{{ $user->id }}">
                        Add Friend <i class="fa-solid fa-user-plus fa-beat fa-xs" style="color: #e8ffcc;"></i>
                    </button>
                    @endif
                    @endif

                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($pendingRequestsReceived->isEmpty())
    <h3 class="fw-bolder pt-3 pb-3">No pending requests.</h3>
    @else
    @foreach($pendingRequestsReceived as $request)
    @php
    $requestUserId = $request->user->id;
    $isRequestUserBlocked = in_array($requestUserId, auth()->user()->blockedUsers->pluck('blocked_user_id')->toArray());

    $isBlockedByMe = in_array($requestUserId, auth()->user()->blockedUsers->pluck('blocked_user_id')->toArray());
    @endphp
    @if (!$isRequestUserBlocked && !$isBlockedByMe)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-lg">
            <div class="card-body">
                <h5 class="card-title">{{ $request->user->name }}</h5>
                <p>{{ $request->user->email }}</p>
                <button class="btn btn-success accept-friend-request" data-id="{{ $request->id }}">Accept</button>
                <button class="btn btn-danger reject-friend-request" data-id="{{ $request->id }}">Reject</button>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    @endif
</div>
@include('layouts.script')

<script>
    $(document).on('click', '.send-friend-request', function() {
        let button = $(this);
        let friend_user_id = button.data('id');
        $.ajax({
            url: "{{ route('user.friends.sendRequest') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                friend_user_id: friend_user_id
            },
            success: function(response) {
                alert(response.message);
                button.removeClass('btn-success').addClass('btn-warning').prop('disabled', true);
                button.text('Request Sent');
                location.reload();

            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
                console.log(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.accept-friend-request', function() {
        let request_id = $(this).data('id');
        $.ajax({
            url: "{{ route('user.friends.accept', ':id') }}".replace(':id', request_id),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                request_id: request_id
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
                console.log(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.reject-friend-request', function() {
        let request_id = $(this).data('id');
        $.ajax({
            url: "{{ route('user.friends.reject', ':id') }}".replace(':id', request_id),
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',
                request_id: request_id
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
                console.log(xhr.responseText);
            }
        });
    });
    $(document).on('click', '.unfriend', function() {
        let button = $(this);
        let friend_user_id = button.data('id');
        $.ajax({
            url: "{{ route('user.friends.unfriend') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                friend_user_id: friend_user_id
            },
            success: function(response) {
                alert(response.message);
                button.removeClass('btn-danger').addClass('btn-success').text('Add Friend');
                location.reload();

            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
                console.log(xhr.responseText);
            }
        });
    });
    $(document).on('click', '.ban-user', function() {
        let userId = $(this).data('id');
        $.ajax({
            url: '{{ route("user.ban", ":id") }}'.replace(':id', userId),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                days: 3
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error banning user: ' + (xhr.responseJSON.message || error));
            }
        });
    });

    $(document).on('click', '.unban-user', function() {
        let userId = $(this).data('id');
        $.ajax({
            url: '{{ route("user.unban", ":id") }}'.replace(':id', userId),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error unbanning user: ' + (xhr.responseJSON.message || error));
            }
        });
    });

    $(document).on('click', '.block-user', function() {
        var userId = $(this).data('id');

        $.ajax({
            url: '{{ route("user.friends.block", ":id") }}'.replace(':id', userId),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error blocking user: ' + (xhr.responseJSON.message || error));
            }
        });
    });



    $(document).on('click', '.unblock-user', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: '{{ route("user.friends.unblock", ":id") }}'.replace(':id', userId),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(error) {
                alert('Error unblocking user');
            }
        });
    });
</script>
@endsection