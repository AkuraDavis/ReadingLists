@if (count($books) > 0 )
    <div class="books m-2">
    @foreach ($books as $book)
        <div class="card flex-md-row mb-3 card-shadow sort-handle">
            @csrf
            <input type="hidden" name="books[]" class="book_values" value="{{ $book->id }}" />
            <img class="card-img-left flex-auto d-none d-md-block"
                 src="{{ $book->thumbnail ? url('img').'/'.$book->thumbnail : 'http://via.placeholder.com/150?text='.$book->title }}"
                 alt="Book Image">
            <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                <div class="flex-column col-10 align-items-center">
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
                        <a href="{{ url('books/' . $book->id) }}" class="btn btn-sm btn-outline-primary">View Book</a>
                        @if(Auth::id() == $list->user_id)
                        <form action="{{ url('lists/'.$list->id).'/remove_book' }}" class="del-form" method="POST">
                            @csrf
                            @method('DELETE')
                            <button name="book" type="submit" class="ml-2 btn btn-sm btn-outline-danger del-btn" value="{{ $book->id }}">Remove <span data-feather="trash-2"></span></button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@else
    <span class="lead">No Books Found</span>
@endif

@push ("scripts")
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $( function() {
            $('.del-form').submit(function () {
                return confirm('Are you sure you want to delete this book?');
            });
            $( ".books" ).sortable({
                axis: 'y',
                containment: "window",
                placeholder: "card-placeholder",
                update: function(event, ui){
                    var data = $('.book_values').serialize();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: data,
                        type: 'PATCH',
                        url:  '{{ url('lists').'/'.$list->id.'/books' }}'
                    });
                },
            });
        } );
    </script>
@endpush