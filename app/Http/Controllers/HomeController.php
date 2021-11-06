<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function type()
    {
        return view('type');
    }


    public function adherent()
    {
        return view('adherent');
    }


    public function product()
    {
        return view('product');
    }

    public function entraineur()
    {
        return view('entraineur');
    }
}
