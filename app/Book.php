<?php

namespace App;

use App\Traits\Uuid_Trait;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //Use UUIDs instead of incrementing IDs.
    use Uuid_Trait;

    // Prevent auto incrementing, since we are using UUIDs.
    public $incrementing = false;

    protected $fillable = ['title', 'author', 'publication_date', 'isbn', 'contributed_by'];

    protected $dates = ['publication_date'];

    /**
     * Books can be in a bunch of different lists.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lists() {
        return $this->belongsToMany(BookList::class, 'book_list_books');
    }

    /**
     * Add the Thumbnail to this book
     *
     * @return void
     */
    public function addThumbnail($image){
        $filename = $this->id . '_full.' . $image->getClientOriginalExtension();

        $file = $image->move(public_path('img'), $filename);

        //Generate small thumbnail image
        $thumb = Image::make($file);
        $thumb->resize(150, 150);

        $thumb_filename = $this->id . '_thumb.' . $image->getClientOriginalExtension();

        $thumb->save('img/' . $thumb_filename);

        $this->thumbnail = $thumb_filename;
        $this->save();

        return;
    }
}
