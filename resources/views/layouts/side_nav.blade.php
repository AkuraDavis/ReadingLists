<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : null }}" href="{{ url('/') }}">
                    <span data-feather="home"></span>
                    Home <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('books') ? 'active' : null }}" href="{{ url('/books') }}">
                    <span data-feather="book"></span>
                    Book Directory
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('lists') ? 'active' : null }}" href="{{ url('/lists') }}">
                    <span data-feather="list"></span>
                    Reading Lists
                </a>
            </li>
        </ul>

        @auth
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>My Stuff</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('my_lists') ? 'active' : null }}" href="{{ url('/my_lists') }}">
                    <span data-feather="book-open"></span>
                    My Lists
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('my_books') ? 'active' : null }}" href="{{ url('/my_books') }}">
                    <span data-feather="file-text"></span>
                    Books
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account') ? 'active' : null }}" href="{{ url('/account') }}">
                    <span data-feather="settings"></span>
                    Account Settings
                </a>
            </li>
        </ul>
        @endauth

    </div>
</nav>