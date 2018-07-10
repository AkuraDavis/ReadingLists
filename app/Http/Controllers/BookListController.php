<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookList;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (request('sort')) {
            default:
            case 'name':
                $sort['field'] = "name";
                break;
            case 'books':
                $sort['field'] = "books";
                // Dark magic
                break;
        }

        switch (request('order')) {
            default:
            case 'asc':
                $sort['order'] = "asc";
                break;
            case 'desc':
                $sort['order'] = "desc";
                break;
        }


        if ($sort['field'] != 'books') {
            $lists = BookList::where('public', true)->orderBy($sort['field'], $sort['order'])->get();
        }else{
            $lists = BookList::where('public', true)->withCount('books')->orderBy('books_count', $sort['order'])->get();
        }

        return view('lists.index', compact('lists', 'sort'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myLists()
    {
        switch (request('sort')){
            default:
            case 'name':
                $sort['field'] = "name";
                break;
            case 'books':
                $sort['field'] = "books";
                // Dark magic
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

        if ($sort['field'] != 'books') {
            $lists = Auth::user()->lists()->orderBy($sort['field'], $sort['order'])->get();
        }else{
            $lists = Auth::user()->lists()->withCount('books')->orderBy('books_count', $sort['order'])->get();
        }

        return view('lists.index', compact('lists', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        BookList::create([
            'name' => $request['name'],
            'desc' => $request['desc'],
            'public' => ($request['public'] ? true : false),
            'user_id' => Auth::id(),
        ]);

        return redirect('/my_lists');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookList  $list
     * @return \Illuminate\Http\Response
     */
    public function show(BookList $list)
    {
        //Check if the user can do this
        try{
            $this->authorize('show', $list);
        }catch (AuthorizationException $e){
            return redirect('/lists');
        }


        $books = $list->books()->orderBy('display_order')->get();

        return view('lists.show', compact('list', 'books', 'sort'));
    }

    /**
     * Display the page to add books to the list
     *
     * @param  \App\BookList  $List
     * @return \Illuminate\Http\Response
     */
    public function showAddBook(BookList $list)
    {
        //Check if the user can do this
        try{
            $this->authorize('showAddBook', $list);
        }catch (AuthorizationException $e){
            return redirect('/lists');
        }

        return view('lists.add_book', compact('list'));
    }

    public function addBook(BookList $list, Request $request)
    {
        //Check if the user can do this
        try{
            $this->authorize('addBook', $list);
        }catch (AuthorizationException $e){
            return redirect('/lists');
        }

        //Did the add an existing book or make a new one?
        if($request['existing']) {

            $book = Book::where('id', $request['existing'])->first();

        } else {

            $this->validate($request, [
                'title' => 'required',
                'author' => 'required',
                'image' => 'image|mimes:jpg,jpeg,png|max:2048'
            ]);

            //Create book first
            $book = Book::create([
                'title' => $request['title'],
                'author' => $request['author'],
                'isbn' => $request['isbn'],
                'publication_date' => $request['date'],
                'contributed_by' => Auth::id(),
            ]);

            //Check for image
            if ($request->hasFile('image')) {
                $book->addThumbnail($request->file('image'));
            }
        }

        $list->books()->save($book, ['display_order' => count($list->books) + 1]);

        return redirect('/lists/'.$list->id);
    }

    public function updateBooks(BookList $list, Request $request)
    {
        //Check if the user can do this
        try{
            $this->authorize('updateBooks', $list);
        }catch (AuthorizationException $e){
            return redirect('/lists');
        }

        $this->validate($request, [
            'books' => 'required|array',
            "books.*" => "required|exists:books,id",
        ]);

        $i = 0;
        foreach($request['books'] as $book_id){
            $list->books()->updateExistingPivot($book_id, ['display_order' => $i]);
            $i++;
        }

        return http_response_code('200');
    }

    public function removeBook(BookList $list, Request $request)
    {
        //Check if the user can do this
        try{
            $this->authorize('removeBook', $list);
        }catch (AuthorizationException $e){
            return redirect('/lists');
        }

        $this->validate($request, [
            'book' => 'required'
        ]);

        $book = Book::where('id', $request['book'])->first();

        $list->books()->detach($book);

        return redirect('/lists/'.$list->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookList  $list
     * @return \Illuminate\Http\Response
     */
    public function edit(BookList $list)
    {
        //Check if the user can do this
        try{
            $this->authorize('edit', $list);
        }catch (AuthorizationException $e){
            return redirect('/lists');
        }

        return view('lists.edit', compact('list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookList  $list
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookList $list)
    {
        //Check if the user can do this
        try{
            $this->authorize('update', $list);
        }catch (AuthorizationException $e){
            return redirect('/lists');
        }

        $this->validate($request, [
            'name' => 'required',
        ]);

        $list->name = $request['name'];
        $list->desc = $request['desc'];
        $list->public = $request['public'] ? 1 : 0;


        $list->save();

        session()->flash('message', 'The list has been updated!');;

        return redirect('/lists/'.$list->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws
     * @param  \App\BookList  $list
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookList $list)
    {
        //Check if the user can do this
        try{
            $this->authorize('destroy', $list);
        }catch (AuthorizationException $e){
            return redirect('/lists');
        }

        $list->delete();

        return redirect('/my_lists');
    }
}
