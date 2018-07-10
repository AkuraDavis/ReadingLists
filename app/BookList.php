<?php

namespace App;

use App\Traits\Uuid_Trait;
use Illuminate\Database\Eloquent\Model;

class BookList extends Model
{
    //Use UUIDs instead of incrementing IDs.
    use Uuid_Trait;

    // Prevent auto incrementing, since we are using UUIDs.
    public $incrementing = false;

    protected $fillable = ['id', 'name', 'desc', 'user_id', 'public'];

    /**
     * A BookList is owned by one person.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }


    /**
     * A BookList has many books inside of it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books() {
        return $this->belongsToMany(Book::class, 'book_list_books')->withPivot('display_order');
    }
}
