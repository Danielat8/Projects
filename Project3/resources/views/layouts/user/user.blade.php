<!DOCTYPE html>
<html lang="en">
@include('layouts.user.head')

<body style="background-color:#F0FFF0;">
    @include('layouts.user.navbar')
    <div class="container mt-5">
        @include('layouts.session')
        @include('layouts.errors')
        @yield('content')

    </div>
    @include('layouts.user.footer')
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</html>