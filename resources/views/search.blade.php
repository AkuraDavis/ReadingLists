@extends ('layouts.double_col')

@section ('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">Search Results</h1>
    </div>

    <div class="table-responsive">
        @include('books.cards')
    </div>

@endsection