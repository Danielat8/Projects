@extends('layouts.user.user')

@section('content')
<link href="{{ asset('css/setting.css') }}" rel="stylesheet">


<div class="container" style="margin-bottom: 200px; margin-top: 100px;">
    <div class="card  shadow mb-5 bg-body-tertiary rounded" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header text-center bg-primary text-white">
            <h2>User Settings</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('user.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>

                <div class="mb-3">
                    <label for="surname" class="form-label">Surname:</label>
                    <input type="text" class="form-control" id="surname" name="surname" value="{{ $userAbout->surname }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">New Password (optional):</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password if you want to change">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password:</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter new password">
                </div>

                <div class="mb-3">
                    <label for="job" class="form-label">Job:</label>
                    <select name="job" id="job" class="form-select">
                        <option value="">Select Job</option>
                        @foreach($jobs as $job)
                        <option value="{{ $job->job }}" {{ optional($settings)->job == $job->job ? 'selected' : '' }}>
                            {{ $job->job }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Notification Target Preference:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="notification_target_preference" id="platform" value="платформа">
                        <label class="form-check-label" for="platform">
                            Платформа
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="notification_target_preference" id="social_media" value="социјални медиуми">
                        <label class="form-check-label" for="social_media">
                            Социјални медиуми
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="notification_target_preference" id="email" value="Е-маил">
                        <label class="form-check-label" for="email">
                            Е-маил
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Notification Topic Preference:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="notification_topic_preference" id="new_content" value="нови содржини">
                        <label class="form-check-label" for="new_content">
                            Нови содржини
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="notification_topic_preference" id="new_events" value="нови настани">
                        <label class="form-check-label" for="new_events">
                            Нови настани
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="notification_topic_preference" id="event_reminder" value="приближување на датум за настан">
                        <label class="form-check-label" for="event_reminder">
                            Приближување на датум за настан
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Settings</button>
            </form>
        </div>
    </div>
</div>
@endsection