<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

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
}
