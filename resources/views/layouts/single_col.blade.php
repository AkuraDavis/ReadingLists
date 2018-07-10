@extends ('layouts.master')

@section ('main-container')
    <div class="container-fluid ml-sm-auto pt-3 px-4">
        @include ('layouts.flash')
        @yield('content')
    </div>
@endsection