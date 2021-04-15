<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Comment;
use App\Models\Subscribe;
use App\Models\View;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videos = Video::paginate(config('constants.paginate'));
        return $videos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $video = new Video();
        $video->user_id = $request->user()->id;
        $video->title = request('title');
        $video->description = request('description');
        $video->thumbnail = $request->file('thumbnail')->store('thumbnail');
        $video->videoURL = $request->file('video')->store('video');
        $video->save();
        
        return [
            'status' => 'Success',
            'message' => 'Uploaded Successfully',
            'video' => $video,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Video $video)
    {
        //
        // if($request->cookie($video->id) === null) {
        //     $videoView = new View();
        //     $videoView->video_id = $video->id;
        //     $videoView->ip = request()->ip();
        //     $videoView->agent = request()->header('User-Agent');
        //     $videoView->session_id = null;
        //     if ($request->user() !== null) {
        //         $videoView->user_id = $request->user()->id;
        //     }
        //     $videoView->save();
        //     Cookie::queue($video->id, 'kUfkflsfdTjsfsllEjldajjkaalRfk', 720);
        // }
        $channel = $video->user;
        $subscriber_count = Subscribe::where([ ['status', '=', true], ['subscribed_user_id', '=', $channel->id] ])->count();
        $like_count = $video->likes()->where('status', true)->count();
        $unlike_count = $video->likes()->where('status', false)->count();
        $recommended = Video::whereNotIn('id', [$video->id])->limit(10)->get();
        $comments = $video->comments;

        if($request->user() === null) {

            $content = [
                'video' => $video,
                'comments' => $comments, 
                'like_count' => $like_count,
                'unlike_count' => $unlike_count,
                'subscriber_count' => $subscriber_count,
                'recommended' => $recommended,
            ];
            return $content;
        }

        // else
        $user = $request->user();
        $subscribe = Subscribe::where([ ['subscriber_user_id', '=', $user->id], ['subscribed_user_id', '=', $channel->id] ]);
        $subscribe = $subscribe->first();
        if($subscribe == null) 
        {
            $subscribe_status =null;
        }
        else {
            $subscribe_status = $subscribe->status;
        }

        $like = $video->likes()->where([['user_id', '=', $user->id], ['video_id', '=', $video->id]])->first();
        if ($like) {
            $like = $like->status;
        } else {
            $like = null;
        }
        
        $content = [
            'video' => $video,
            'comments' => $comments, 
            'like' => $like,
            'like_count' => $like_count,
            'unlike_count' => $unlike_count,
            'subscribe_status' => $subscribe_status, 
            'subscriber_count' => $subscriber_count,
            'recommended' => $recommended
        ];
        return $content;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
        if ($request->user()->cannot('update', $video)) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $video->title = request('title');
        $video->description = request('description');
        $video->save();

        return [
            'status' => 'Success',
            'message' => 'Updated Successfully',
            'video' => $video,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
        if ($request->user()->cannot('delete', $video)) {
            abort(403);
        }
        $video->delete();
        return [
            'status' => 'Success',
            'message' => 'Deleated Successfully'
        ];
    }
}
