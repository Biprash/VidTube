<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Video;

class AuthorizedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $request->route()->parameters();
        $id = $request->route('id');
        $video = Video::findOrFail($id);
        if($video->user_id !== $request->user()->id) 
        {
            return redirect()->route('home')->with('message', 'You are not authorized');
        }
        return $next($request);
    }
}
