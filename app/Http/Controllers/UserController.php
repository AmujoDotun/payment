<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profilePicture(Request $request){
        //handle the user upload of profile/avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename =time() . '.' . $avatar->getClientOriginalExtention();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars' . $filename));

            $user->avatar = $filename;
            $user->save();
        }
    }
}
