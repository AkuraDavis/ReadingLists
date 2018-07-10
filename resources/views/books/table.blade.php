<table class="table table-striped table-sm">
    <thead>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>ISBN</th>
        <th>Publication Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($books as $book)
        <tr>
            <td>
                <div class="row">
                    <div class="col-4" style="min-width: 150px">
                        <img class="card-img-right flex-auto d-none d-md-block"
                             src="{{ $book->thumbnail ? 'img/'.$book->thumbnail : 'http://via.placeholder.com/150?text=' }}"
                             alt="Book Image">
                    </div>
                    <div class="col-8 text-center"><h3>{{ $book->title }}</h3></div>
                </div>
            </td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->isbn ? : 'N/A' }}</td>
            <td>{{ $book->publication_date }}</td>
        </tr>
    @endforeach
    </tbody>
</table>