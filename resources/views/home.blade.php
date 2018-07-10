@extends ('layouts.double_col')

@section ('content')

    <div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-light main-photo"style="background-image: url('{{ url('splash.jpg') }}'); background-position: center;">
        <div class="col-md-4 p-lg-5 mx-auto my-5 pb-3 box">
            <h1 class="display-4 font-weight-normal">Reading Lists</h1>
            <p class="lead font-weight-normal">A small Laravel App to create and manage reading lists for books.</p>
            @guest
            <a class="btn btn-sm btn-danger" href="{{ url('/register') }}">Sign Up</a>
            @endguest
        </div>
        <div class="credit-button align-self-end">
        @include ('photo_credit')
        </div>
    </div>

    <div class="px-3 py-3 pb-md-4 mx-auto">
        <h1 class="display-4 text-center">Recent Books</h1>
        @include ('books.cards')
    </div>

    <div class="px-3 py-3 pb-md-4 mx-auto">
        <h1 class="display-4 text-center">Recent Lists</h1>
        @include ('lists.group')
    </div>

@endsection