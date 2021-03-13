<?php

namespace App\Http\Controllers;
use App\Models\Video;

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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // dd($request);
        $search = $request->search;
        $videos = Video::when($search, function ($query, $search) {
            return $query
                ->where('title', 'LIKE', "%{$search}%")->limit(config('constants.paginate'))->get(); 
                // ->orWhere('description', 'LIKE', "%{$search}%") 
        })
        ->when(!$search, function ($query, $search) {
            return $query
                ->paginate(config('constants.paginate')); 
                // ->orWhere('description', 'LIKE', "%{$search}%") 
        });
        // dd($videos);
        return view('home', ['videos' => $videos]);
    }
}
