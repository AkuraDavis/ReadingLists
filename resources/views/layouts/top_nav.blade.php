    <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <div class="navbar-brand col-sm-3 col-md-2 mr-0 justify-content-between">
            <button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="{{ url('/') }}" class="text-white">Simple Reading Lists</a>
        </div>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="row w-100 ml-0">
            <div class="search-icon h-100 col-auto"><span data-feather="search"></span></div>
            <form method="get" action="/search" class="col pl-0">
                <input class="form-control form-control-dark" type="text"
                       placeholder="Search Books" id="header-search" name="q" aria-label="Search Books"
                {{ request('q') ? 'value='.request('q') : null }}>
            </form>
            </div>
        <ul class="navbar-nav px-3 col m-1 align-items-center">
            <li class="nav-item hidden">
                <a class="nav-link {{ Request::is('/') ? 'active' : null }}" href="{{ url('/') }}">
                    <span data-feather="home"></span>
                    Home <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item hidden">
                <a class="nav-link {{ Request::is('books') ? 'active' : null }}" href="{{ url('/books') }}">
                    <span data-feather="book"></span>
                    Book Directory
                </a>
            </li>
            <li class="nav-item hidden">
                <a class="nav-link {{ Request::is('lists') ? 'active' : null }}" href="{{ url('/lists') }}">
                    <span data-feather="list"></span>
                    Reading Lists
                </a>
            </li>
            @auth
                <li class="nav-item text-nowrap">
                    <hr class="border-white hidden">
                    <span class="text-white p-2">Hello, {{ Auth::user()->name }}!</span>
                </li>
                <li class="nav-item hidden">
                    <a class="nav-link {{ Request::is('my_lists') ? 'active' : null }}" href="{{ url('/my_lists') }}">
                        <span data-feather="book-open"></span>
                        My Lists
                    </a>
                </li>
                <li class="nav-item hidden">
                    <a class="nav-link {{ Request::is('my_books') ? 'active' : null }}" href="{{ url('/my_books') }}">
                        <span data-feather="file-text"></span>
                        Books
                    </a>
                </li>
                <li class="nav-item hidden">
                    <a class="nav-link {{ Request::is('account') ? 'active' : null }}" href="{{ url('/account') }}">
                        <span data-feather="settings"></span>
                        Account Settings
                    </a>
                </li>
                <li class="nav-item text-nowrap">
                    <a class="btn btn-outline-danger" href="{{ url('/logout') }}">Sign out</a>
                </li>
            @else
                <li class="btn-group">
                    <a class="btn btn-outline-success" href="{{ url('/login') }}">Login</a>
                    <a class="btn btn-outline-secondary" href="{{ url('/register') }}">Register</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>
