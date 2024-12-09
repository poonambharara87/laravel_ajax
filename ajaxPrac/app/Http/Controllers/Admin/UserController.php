<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function addUser(Request $request)
    {
        $image_path = "";
        if($request->file('image'))
        {
            $file = $request->file('image');
            $filename = time()." ". $file->getClientOriginalName();
            $image_path = $file->storeAs('public', $filename);
        }
      
        $user = new User;
        $user->name = $request->input('name') ? $request->input('name') : '';
        $user->image  = $image_path ? $image_path : '';
        $user->email  = $request->input('email') ? $request->input('email') : '';
        $user->password  = $request->password ? $request->password : '';
        $user->save();
        return response()->json(['res' => 'User created Successfully!']);
    }


    
}
