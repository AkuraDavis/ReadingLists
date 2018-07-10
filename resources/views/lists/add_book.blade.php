@extends ('layouts.double_col')

@section ('content')

    <h1>Add a Book to {{ $list->name }}</h1>

    <h3>Choose an existing book...</h3>
    <a href="{{ url('/books') }}" class="btn btn-lg btn-secondary">Pick a Book</a>
    <hr>
    <h3>or add a new book!</h3>
    @include ('layouts.errors')

    <form method="POST" action="{{ url('/lists/'.$list->id.'/add_book') }}" enctype="multipart/form-data">
        @csrf

        @include('books.create_form')

        <p class="small">* Required Fields</p>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

@endsection

@push ('scripts')
    <script type="application/javascript">
        $('.custom-file-input').on('change',function(){
            var fileName = $(this).val().split('\\').pop();
            $('.custom-file-label').html(fileName);

        })
    </script>
@endpush