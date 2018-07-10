@extends ('layouts.double_col')

@section ('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">Books I've Added</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ url('/books/create') }}" class="btn btn-sm btn-outline-success">Add</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        @include('books.cards')
    </div>

@endsection