<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var string current route
     */
    private $active_page;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $r)
    {
        $this->active_page = $r->route()->uri();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $videos = \App\Video::all();

        return view('home', [
            'active_page' => $this->active_page,
            'videos' => $videos,
        ]);
    }

    public function mine()
    {
        $user_id = \Auth::id();
        $videos = \App\Video::where('user_id', $user_id)->get();

        return view('mine', [
            'active_page' => $this->active_page,
            'videos' => $videos,
        ]);
    }

    public function upload()
    {
        return view('upload', [
            'active_page' => $this->active_page,
        ]);
    }

}
