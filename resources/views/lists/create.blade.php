@extends ('layouts.double_col')

@section ('content')

    <h1>Create a List</h1>

    @include ('layouts.errors')

    <form method="POST" action="/lists">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">List Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="List Name">
        </div>

        <div class="form-group">
            <label for="desc">Description</label>
            <textarea type="text" class="form-control" id="desc" name="desc"  placeholder="Describe your list! Summer reading goals, a reading challenge, etc..."></textarea>
        </div>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="public" name="public">
            <label class="custom-control-label" for="public">Make List Public</label>
        </div>

        <hr>

        <button type="submit" class="btn btn-primary">Create List</button>
    </form>

@endsection