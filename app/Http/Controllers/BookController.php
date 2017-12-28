<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Topic;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * A book's preface page.
     *
     * @param  App\Models\Book  $book
     * @return View
     */
    public function show(Book $book)
    {
        return view('book.show', compact('book'));
    }

    /**
     * Creating a book.
     *
     * @param  App\Models\Book  $book
     * @return View
     */
    public function create(Book $book)
	{
		return view('book.create_and_edit', compact('book'));
	}

    /**
     * Editing a book.
     *
     * @param  App\Models\Book  $book
     * @return View
     */
    public function edit(Book $book)
    {
        $this->authorize('update', $user);
        
        return view('book.edit', compact('book'));
    }

}
