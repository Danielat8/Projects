<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>About User</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class=" bg-info-subtle">
    <div id="success-message" class="alert alert-success" style="display:none;"></div>
    <div id="error-message" class="alert alert-danger" style="display:none;"></div>
    <h1 class="text-center pb-2 fs-2 pt-2">About You</h1>
    <div class="container  d-flex justify-content-center ">

        <form id="about-form" action="{{ route('user.aboutuser') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-1">
                <label for="surname" class="form-label">Surname</label>
                <input type="text" class="form-control" id="surname" name="surname">
            </div>

            <div class="mb-1">
                <label for="bio" class="form-label">Bio</label>
                <textarea class="form-control" id="bio" name="bio"></textarea>
            </div>

            <div class="mb-1">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="mb-1">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>

            <div class="mb-1">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city">
            </div>

            <div class="mb-1">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" id="country" name="country">
            </div>

            <div class="mb-1">
                <label for="cv_upload" class="form-label">Upload CV</label>
                <input type="file" class="form-control" id="cv_upload" name="cv_upload">
            </div>

            <div class="mb-2">
                <label for="photo_upload" class="form-label">Upload Photo</label>
                <input type="file" class="form-control" id="photo_upload" name="photo_upload">
            </div>

            <button type="submit" class="btn btn-primary ">Submit</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#about-form').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: '{{ route("user.aboutuser") }}',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#success-message').text('Information saved successfully! Redirecting...').show();
                        $('#error-message').hide();
                        $('#about-form')[0].reset();
                        setTimeout(function() {
                            window.location.href = '{{ route("user.userpanel") }}';
                        }, 4000);
                    },
                    error: function(xhr) {
                        $('#error-message').text(xhr.responseJSON.message || 'An error occurred.').show();
                        $('#success-message').hide();
                    }
                });
            });
        });
    </script>
</body>

</html>