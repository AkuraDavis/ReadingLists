@if (count($books) > 0 )
    @if(isset($sort))
        @php
        $sort_string = $sort['order'] == "desc" ? 'asc' : 'desc';
        $sort_arrow = $sort['order'] == "desc" ? "&nbsp;<span data-feather=\"chevron-down\"></span>" : "&nbsp;<span data-feather=\"chevron-up\"></span>";
        @endphp
        <div class="btn-group align-middle pb-2">
            <span class="sort-by">Sort By</span>
            <a href="?sort=title&order={{ $sort_string }}" class="btn btn-sm btn{{ ($sort['field'] == 'title') ? null : '-outline'  }}-info">Title{!! ($sort['field'] == 'title') ? $sort_arrow : null !!}</a>
            <a href="?sort=author&order={{ $sort_string }}" class="btn btn-sm btn{{ ($sort['field'] == 'author') ? null : '-outline'  }}-info">Author{!! ($sort['field'] == 'author') ? $sort_arrow : null !!}</a>
            <a href="?sort=date&order={{ $sort_string }}" class="btn btn-sm btn{{ ($sort['field'] == 'publication_date') ? null : '-outline'  }}-info">Publication Date{!! ($sort['field'] == 'publication_date') ? $sort_arrow : null !!}</a>
        </div>
    @endif
    <div class="card-deck justify-content-center">
    @foreach ($books as $book)
        <div class="card flex-md-row mb-3 card-shadow">
            <img class="card-img-left flex-auto d-none d-md-block"
                 src="{{ $book->thumbnail ? url('img').'/'.$book->thumbnail : 'http://via.placeholder.com/150?text=' }}"
                 alt="Book Image">
            <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                <div class="flex-column col-12 align-items-center">
                    <div class="align-items-start card-title">
                        <h5 class="d-inline-flex mr-2">{{ $book->title }}</h5>
                        <span class="d-inline-flex">by {{ $book->author }}</span>
                    </div>
                    <p class="card-text">
                        Published on {{ $book->publication_date->toFormattedDateString() }}
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
                        <a href="{{ url('books/' . $book->id) }}" class="btn btn-sm btn-outline-primary">View Book</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@else
<span class="lead">No Books Found</span>
@endif