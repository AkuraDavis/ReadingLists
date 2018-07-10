@extends ('layouts.master')

@section ('main-container')
    @include('layouts.side_nav')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        @include ('layouts.flash')
        @yield('content')
    </main>
@endsection