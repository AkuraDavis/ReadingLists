<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookList;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Most Recent Books
        $books = Book::where('public', true)->orderBy('created_at', 'desc')->limit('4')->get();

        //Most Recent Lists
        $lists = BookList::where('public', true)->orderBy('created_at', 'desc')->limit('4')->get();


        return view('home', compact('books', 'lists'));
    }
}
