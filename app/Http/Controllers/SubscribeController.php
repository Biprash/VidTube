<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Subscribe;

class SubscribeController extends Controller
{
    //

    public function store(Request $request, $subscribed_id) 
    {

        try {
            $user = $request->user();
            $subscribe = Subscribe::where([ 
                ['subscriber_user_id', '=', $user->id], 
                ['subscribed_user_id', '=', $subscribed_id] 
            ])->firstOrFail();
            // dd($subscribe);
            if($subscribe->status == true) 
            {
                $subscribe->status = false;
            } else {
                $subscribe->status = true;
            }
            $subscribe->save();
            return redirect()->back()->with('message', 'subscribed to the channel');
            
        } catch (ModelNotFoundException $e) {
            $subscribe = new Subscribe();
            $subscribe->subscriber_user_id = $request->user()->id;
            $subscribe->subscribed_user_id = $subscribed_id;
            $subscribe->status = true;
            $subscribe->save();
            return redirect()->back()->with('message', 'subscribed to the channel');
        }
    }
}
