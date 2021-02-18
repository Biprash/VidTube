<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Video;
use App\Models\Comment;
use App\Models\Subscribe;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id)
    {
        //
        $user = $request->user();
        $channel = User::findOrFail($user_id);
        $videos = Video::where('user_id', $user_id)->get();
        $subscribe = Subscribe::where([ ['subscriber_user_id', '=', $user->id], ['subscribed_user_id', '=', $channel->id] ]);
        $subscriber_count = Subscribe::where([ ['status', '=', true], ['subscribed_user_id', '=', $channel->id] ])->count();
        $subscribe = $subscribe->first();
        // dd(Subscribe::where([ ['subscriber_user_id', '=', $user->id], ['subscribed_user_id', '=', $channel->id] ])->where('status', true)->count());
        if($subscribe == null) 
        {
            $subscribe_status =null;
        }
        else {
            // dd( $subscribe->status);
            $subscribe_status = $subscribe->status;
        }
        $content = [
            'videos' => $videos, 
            'channel' => $channel, 
            'subscribe_status' => $subscribe_status, 
            'subscriber_count' => $subscriber_count,
        ];
        return view('videos.index', $content);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('videos.create');
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
        // dd($request);
        $video = new Video();
        $video->user_id = $request->user()->id;
        $video->title = request('title');
        $video->description = request('description');
        $video->thumbnail = $request->file('thumbnail')->store('thumbnail');
        $video->videoURL = $request->file('video')->store('video');
        $video->save();
        
        return redirect()->route('home')->with('message', 'Video has been uploded');
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
        $channel = $video->user;
        $subscriber_count = Subscribe::where([ ['status', '=', true], ['subscribed_user_id', '=', $channel->id] ])->count();
        $like_count = $video->likes()->where('status', true)->count();
        $unlike_count = $video->likes()->where('status', false)->count();
        $recommended = Video::whereNotIn('id', [$video->id])->limit(5)->get();
        $comments = $video->comments;

        if($request->user() === null) {

            $content = [
                'video' => $video,
                'comments' => $comments, 
                'like_count' => $like_count,
                'unlike_count' => $unlike_count,
                'subscriber_count' => $subscriber_count,
                'recommended' => $recommended
            ];
            return view('videos.show', $content);
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
        return view('videos.show', $content);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $video = Video::findOrFail($id);
        return view('videos.edit', ['video' => $video]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $video = Video::findOrFail($id);
        $video->title = request('title');
        $video->description = request('description');
        $video->save();
        return redirect()->route('home')->with('message', 'Video has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $video = Video::findOrFail($id);
        $video->destroy();
        return redirect()->route('home')->with('message', 'Video has been deleated');
    }
}
