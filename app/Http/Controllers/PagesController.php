<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Welcome page.
     *
     * @return View
     */
    public function welcome()
    {
        return view('pages.welcome');
    }

    /**
     * Main page.
     *
     * @return View
     */
    public function root()
    {
        return view('pages.root');
    }
}
