<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;

class SearchController extends Controller
{

    /**
     * Search and return a list of books.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $this->validate(request(), [
            'q' => 'string|required'
        ]);

        switch (request('sort')){
            default:
            case 'title':
                $sort['field'] = "title";
                break;
            case 'author':
                $sort['field'] = "author";
                break;
            case 'date':
                $sort['field'] = "publication_date";
                break;
        }

        switch (request('order')){
            default:
            case 'asc':
                $sort['order'] = "asc";
                break;
            case 'desc':
                $sort['order'] = "desc";
                break;
        }

        $books = Book::where(function ($query) {
            $query->where('public', true)->orWhere('contributed_by', Auth::id());
        })->where(function ($query) {
            $query->where('title', 'like', '%'.request('q').'%')
                ->orWhere('author', 'like', '%'.request('q').'%');
        })->orderBy($sort['field'], $sort['order'])->get();

        return view('search', compact('books', 'sort'));

    }

}
