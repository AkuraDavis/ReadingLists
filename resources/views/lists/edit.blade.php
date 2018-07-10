@extends ('layouts.double_col')

@section ('content')

    <h1>Edit a List</h1>

    @include ('layouts.errors')

    <form method="POST" action="/lists/{{ $list->id }}">
        @csrf
        @method ('PATCH')

        <div class="form-group">
            <label for="name">List Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="List Name" value="{{ $list->name }}">
        </div>

        <div class="form-group">
            <label for="desc">Description</label>
            <textarea type="text" class="form-control" id="desc" name="desc"  placeholder="Describe your list! Summer reading goals, a reading challenge, etc...">{{ $list->desc }}</textarea>
        </div>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="public" name="public" {{ $list->public ? 'checked' : null }}>
            <label class="custom-control-label" for="public">Make List Public</label>
        </div>

        <hr>

        <button type="submit" class="btn btn-primary">Update List</button>
    </form>

@endsection