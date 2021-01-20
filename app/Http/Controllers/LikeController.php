<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    //
    public function store(Request $request, $video_id) 
    {
        try {
            $like = Like::where([
                ['user_id', '=', $request->user()->id],
                ['video_id', '=', $video_id]
            ])->firstOrFail();
            // $like = Like::findOrFail([
            //     'user_id' => $request->user()->id,
            //     'video_id' => $video_id,
            // ])->first();
            if($like->status) 
            {
                $like->status = false;
            } else {
                $like->status = true;
            }
            $like->save();
            return redirect()->back()->with('message', 'Video LIKE STATUS has been updated');
            
        } catch (ModelNotFoundException $e) {
            $like = new Like();
            $like->user_id = $request->user()->id;
            $like->video_id = $video_id;
            $like->status = true;
            $like->save();
            return redirect()->back()->with('message', 'Video has been liked');
        }
    }
}
