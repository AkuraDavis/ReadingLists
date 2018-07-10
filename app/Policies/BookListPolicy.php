<?php

namespace App\Policies;

use App\User;
use App\BookList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookListPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function owned(User $user, BookList $list) {
        //Check the list is either public or owned by the user
        if($list->user_id == $user->id){

            return true;
        }

        return false;
    }

    private function ownedOrPublic(User $user, BookList $list) {
        //Check the list is either public or owned by the user
        if($list->user_id == $user->id || $list->public){
            return true;
        }

        return false;
    }

    /**
     * Can the user view this?
     *
     * Owned or Public
     */
    public function show(User $user, BookList $list)
    {
        return $this->ownedOrPublic($user, $list);
    }

    /**
     * Can the user add a book?
     *
     * Only if they own it
     *
     */
    public function showAddBook(User $user, BookList $list)
    {
        return $this->owned($user, $list);
    }

    public function addBook(User $user, BookList $list)
    {
        return $this->owned($user, $list);
    }

    public function updateBooks(User $user, BookList $list)
    {
        return $this->owned($user, $list);
    }

    public function removeBook(User $user, BookList $list)
    {
        return $this->owned($user, $list);
    }

    /**
     * Can the user edit, update, or destroy this list?
     *
     * Owned only
     */
    public function edit(User $user, BookList $list)
    {
        return $this->owned($user, $list);
    }

    public function update(User $user, BookList $list)
    {
        return $this->owned($user, $list);
    }

    public function destroy(User $user, BookList $list)
    {
        return $this->owned($user, $list);
    }

}
