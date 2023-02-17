<?php

namespace App\Http\Controllers;

use App\Models\Multipicture;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class MultipictureController extends Controller
{
    public function All_Multi(){
        $images = Multipicture::all();
        return view('admin.multipicture.index',compact('images'));
    }

    public function Add_Multi(Request $request){
        $images = $request->file('image');

        foreach($images as $image):

            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300,200)->save('image/multipicture/'.$name_gen);

            $last_img = 'image/multipicture/'.$name_gen;

            Multipicture::insert([
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);

        endforeach;

        return redirect()->back()->with('success','Multi Images Insert Successfuly');
    }
}
