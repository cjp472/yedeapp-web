<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
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

    /**
     * Permission denied page.
     *
     * @return View/Redirect
     */
    public function permissionDenied()
    {
        // If Auth::check() && Auth::user()->can('manage_contents'), redirect to admin panel (xa)
        if (config('administrator.permission')()) {
            return redirect(url(config('administrator.uri')), 302);
        }

        // Else
        return view('pages.permission_denied');
    }
}
