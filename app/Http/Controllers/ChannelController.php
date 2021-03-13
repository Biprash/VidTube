<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class ChannelController extends Controller
{
    //
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $user = $request->user();
        $videos = Video::where('user_id', $user->id)->paginate(config('constants.paginate'));
        $content = [
            'videos' => $videos
        ];
        return view('channel.index', $content);
    }
}
