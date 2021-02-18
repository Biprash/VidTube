<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    //
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        return view('profile.show');
    }

    public function update(Request $request, User $user)
    {
        if($request->user() == $user) {
            $user->image = $request->file('profile_pic')->store('profile_pic');
            $user->save();
            return redirect()->back()->with('message', 'Profile picture has been updated.');
        } else {
            return redirect()->back()->with('message', 'You are not Authorized.');
        }
    }
}
