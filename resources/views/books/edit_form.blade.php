<div class="form-group">
    <label for="title">Title *</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $book->title }}">
</div>

<div class="form-group">
    <label for="author">Author *</label>
    <input type="text" class="form-control" id="author" name="author"  placeholder="Author's Name" value="{{ $book->author }}">
</div>

<div class="form-group">
    <label for="isbn">ISBN</label>
    <input type="text" class="form-control" id="isbn" name="isbn"  placeholder="978-3-16-148410-0" value="{{ $book->isbn }}">
</div>

<div class="form-group">
    <label for="date">Publication Date</label>
    <input type="date" class="form-control" id="date" name="date" placeholder="0000-00-00" value="{{ $book->publication_date->toDateString() }}">
</div>

{{--<p class="label">Book Image</p>--}}
{{--<div class="custom-file mb-3">--}}
    {{--<input type="file" class="custom-file-input" id="image" name="image" accept="image/*" value="{{ $book->thumbnail }}">--}}
    {{--<label class="custom-file-label" for="image">Choose an image</label>--}}
{{--</div>--}}