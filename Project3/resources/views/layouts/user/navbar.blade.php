<header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-info">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="{{ route('user.userpanel') }}">User Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar" aria-controls="userNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="userNavbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.comments.index') }}">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.blogs.index') }}">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.recommendations.index') }}">Recommendations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.usersabout.index') }}">User About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.friends.index') }}">Friends</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.tickets.index') }}">Tickets</a>
                    </li>
                </ul>

                @auth
                <ul class="navbar-nav ms-auto" style="margin-right: 80px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Log Out
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