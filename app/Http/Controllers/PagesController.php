<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Website's index page.
     *
     * @return void
     */
    public function root()
    {
        return view('pages.root');
    }
}
