<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$movie10 = Movies::where('id','!=','null')->limit(10)->get();
        return view('home');
    }

    public function getHome()
    {
        $username = session('username');
        if ($username != ""){
            return redirect()->action('HomeController@index');
        }
        else{        
            return view('login');
        }
    }
}
