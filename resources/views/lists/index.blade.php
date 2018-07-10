@extends ('layouts.double_col')

@section ('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">{{ Request::is('my_lists') ? 'My' : 'Public' }} Book Lists</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ url('/lists/create') }}" class="btn btn-sm btn-outline-success">New List</a>
            </div>
        </div>
    </div>

    @include ('lists.group')

@endsection