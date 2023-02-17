<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function Change_Password() {
        return view('admin.body.change_password');
    }

    public function Update_Password(Request $request) {
        
        $validate_data = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashed_password = Auth::user()->password;

        if(Hash::check($request->old_password, $hashed_password)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            
            return redirect()->route('login')->with('success', 'Password is changed Successfuly');

        } else {
            return redirect()->route('login')->with('error', 'Current password is Invalid');
        }
    }
}
