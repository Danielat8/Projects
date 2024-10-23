<header>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="{{ route('admin.adminpanel') }}">Admin</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav mx-auto " style="font-size: 14px;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.conferences.index') }}">Conferences</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.blogs.index') }}">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.comments.index') }}">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.events.index') }}">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.tickets.index') }}">Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.speakers.index') }}">Event Speakers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.agendas.index') }}">Agendas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.employees.index') }}">Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.aboutuser.index') }}">Abouts User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.generalinfo.index') }}">General Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.friends.index') }}">Friends</a>
                    </li>
                </ul>
                @auth
                <ul class="navbar-nav ms-auto " style="margin-right: 80px;">
                    <li class="nav-item dropdown">
                        <a class=" nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>
</header>