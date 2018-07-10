@extends ('layouts.double_col')

@section ('content')

    @can('destroy', $list)
    <form id="delete" action="{{ url('lists/'.$list->id) }}" method="POST">
        @csrf
        @method ('DELETE')
    </form>
    @endcan

    <div class="px-3 py-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4">{{ $list->name }}
            @can('edit', $list)
            <a href="{{ url('/lists/'.$list->id.'/edit') }}" class="text-center"><span data-feather="edit" class="feather-big"></span></a>
            @endcan
            @can('destroy', $list)
                <a href="#" onclick="if(confirm('Are you sure you want to delete this list?')){$('#delete').submit();} return false;" class="text-center"><span data-feather="trash-2" class="feather-big text-danger"></span></a>
            @endcan
        </h1>
        <p class="lead">{{ $list->desc }}</p>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2">
        <h3>Books in List</h3>
        @if ($list->user_id == Auth::id())
            <span class="small">Drag to Sort</span>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ url('/lists/'.$list->id.'/add_book') }}" class="btn btn-sm btn-outline-primary">Add Book to List</a>
            </div>
        </div>
        @endif

    </div>

    <div class="table-responsive">

        @include ('books.list_cards')

    </div>

@endsection