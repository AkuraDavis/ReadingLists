@extends ('layouts.double_col')

@section ('content')

@can('destroy', $book)
    <form id="delete" action="{{ url('books/'.$book->id) }}" method="POST">
        @csrf
        @method ('DELETE')
    </form>
@endcan

<div class="flex-md-row mb-3">
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <img class="card-img-left flex-column col-auto mb-2"
             src="{{ $book->thumbnail ? url('img').'/'.$book->id.'_full.'.substr(strrchr($book->thumbnail, "."), 1) : 'http://via.placeholder.com/150?text=' }}"
             alt="Book Image">
        <div class="flex-column col align-items-center">
            <h3 class="d-inline-flex mr-2">{{ $book->title }}
                @auth
                <a href="{{ url('/books/'.$book->id.'/edit') }}" class="ml-3 text-center"><span data-feather="edit"></span></a>
                @endauth
                @can('destroy', $book)
                    <a href="#" onclick="if(confirm('Are you sure you want to delete this book?')){$('#delete').submit();} return false;" class="ml-2 text-center"><span data-feather="trash-2" class="text-danger"></span></a>
                @endcan
            </h3>
            <p><span class="d-inline-flex">by {{ $book->author }}</span></p>
            <p class="card-text">
                Published on {{ $book->publication_date->toFormattedDateString() }}
                <br/>
                ISBN: {{ $book->isbn ? : 'N/A' }}
                <br/>
            </p>
        </div>
        <div class="flex-column btn-toolbar mb-2 mb-md-0 col-sm-auto justify-content-end">
            <div class="btn-group mr-2">
                @auth
                    <a class="btn btn-sm btn-outline-success dropdown-toggle-split" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span data-feather="plus"></span> My Lists
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        @if(count(Auth::user()->lists) > 0)
                            @foreach(Auth::user()->lists as $list)
                                <form action="{{ url('lists/'.$list->id).'/add_book' }}" method="POST">
                                    @csrf
                                    <button name="existing" type="submit" class="dropdown-item" value="{{ $book->id }}">{{ $list->name }}</button>
                                </form>
                            @endforeach
                        @else
                            You have no lists!
                        @endif
                    </div>
                @endauth
            </div>
        </div>
    </div>

    @if($api_data != null)
    <div class="pt-5">
        <h4>Matching Books from Google</h4>

        @include ('books.lookup')

    </div>
    @endif

    <div class="pt-5">
        <h4>Reading Lists Containing This Book</h4>

        @include ('lists.group')

    </div>
</div>
@endsection