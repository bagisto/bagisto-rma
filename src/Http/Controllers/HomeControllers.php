<?php

namespace Webkul\RMA\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Loads the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('rma::home.index');
    }
}