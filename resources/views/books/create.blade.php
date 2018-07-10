@extends ('layouts.double_col')

@section ('content')

    <h1>Add a Book</h1>

    @include ('layouts.errors')

    <form method="POST" action="/books" enctype="multipart/form-data">
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