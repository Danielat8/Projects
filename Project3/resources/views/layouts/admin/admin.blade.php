<!DOCTYPE html>
<html lang="en">

<!-- head -->
@include('layouts.admin.head')

<body class="bg-dark-subtle">

    <!-- navbar -->
    @include('layouts.admin.navbar')
    <main class="py-4">
        @include('layouts.session')
        @include('layouts.errors')
        @yield('content')
    </main>
    <!-- footer -->
    @include('layouts.admin.footer')


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>