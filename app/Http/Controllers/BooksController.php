<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;

class BooksController extends Controller
{
    public function index() {

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


        $books = Book::where('public', true)->orderBy($sort['field'], $sort['order'])->get();

        return view('books.index', compact('books', 'sort'));

    }

    /**
     * Display a listing of the books contributed by the auth'ed user
     *
     * @return \Illuminate\Http\Response
     */
    public function myBooks()
    {
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

        $books = Book::where('contributed_by', Auth::id())->orderBy($sort['field'], $sort['order'])->get();

        return view('books.contributed', compact('books', 'sort'));
    }

    public function create() {

        return view('books.create');
    }

    /**
     * Display the book
     */
    public function show(Book $book)
    {
        $lists = $book->lists;

        $api_data = null;
        $guz = new Client();
        $url_title = htmlspecialchars($book->title);
        try {
            $resp = $guz->get('https://www.googleapis.com/books/v1/volumes?q=' . $url_title . '+inauthor:'.htmlspecialchars($book->author));
            if($resp->getStatusCode() == 200){
                $api_data = json_decode($resp->getBody(), true);
            }

        }catch (RequestException $e){
            //General catch
        }

        return view('books.show', compact('book', 'lists', 'api_data'));
    }

    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'date' => 'date|nullable'
        ]);

        //dd($request['date']);

        //Create book first
        $book = Book::create([
            'title' => $request['title'],
            'author' => $request['author'],
            'isbn' => $request['isbn'],
            'publication_date' => $request['date'] != "" ? $request['date'] : '1901-01-01',
            'contributed_by' => Auth::id(),
        ]);

        //Check for image
        if($request->hasFile('image')) {
            $book->addThumbnail($request->file('image'));
        }

        return redirect('/books/' . $book->id);
    }

    /**
     * Edit the book
     */
    public function edit(Book $book)
    {
        //TODO: Auth who owns what books, or can only admin edit?

        return view('books.edit', compact('book', 'book'));
    }

    public function update(Request $request, Book $book)
    {
        //dd($request['date']);

        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'date' => 'date|nullable'
        ]);

        $book->title = $request['title'];
        $book->author = $request['author'];
        $book->isbn = $request['isbn'];
        $book->publication_date = $request['date'] != null ? $request['date'] : '1901-01-01';


        $book->save();

        session()->flash('message', 'The book has been updated!');;

        return redirect('/books/'.$book->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @throws
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //Check if the user can do this
        try{
            $this->authorize('destroy', $book);
        }catch (AuthorizationException $e){
            return redirect('/lists');
        }

        $book->delete();

        return redirect('/my_books');
    }

}
