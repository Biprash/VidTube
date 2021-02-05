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
            if(is_null($like->status)) {
                $like->status = $this->status('new', request('like'));
            }else {
                if(request('like') === 'like' && $like->status === true){
                    $like->status = null;
                } elseif (request('like') === 'unlike' && $like->status === false) {
                    $like->status = null;
                } else {
                    $like->status = !$like->status;
                }
            }
            $like->save();
            return redirect()->back()->with('message', 'Video LIKE STATUS has been updated');
            
        } catch (ModelNotFoundException $e) {
            $like = new Like();
            $like->user_id = $request->user()->id;
            $like->video_id = $video_id;
            $like->status = $this->status('new', request('like'));
            $like->save();
            return redirect()->back()->with('message', 'Video has been liked');
        }
    }

    public function status($current_status, $form_value) 
    {
        if($current_status === 'new') {
            if ($form_value === 'like') {
                return true;
            } elseif ($form_value === 'unlike') {
                return false;
            } else {
                return null;
            }
        }
        return null;
    }
}
