<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{
    public function Home_Slide(){
        $sliders = Slide::latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    public function Add_Slide(){
        return view('admin.slider.create');
    }

    public function Store_Slide(Request $request){
        
        $validetedData = $request->validate([
            'title_slide' => 'required|min:5',
            'description_slide' => 'required|min:5',
            'image_slide' => 'required|image|mimes:jpeg,png,jpg,'
        ],
        [
            'title_slide.required' => 'Pleas insert a valid title!',
            'title_slide.min' => 'Pleas insert more then 5 character!',

            'description_slide.required' => 'Pleas insert a valid description!',
            'description_slide.min' => 'Pleas insert more then 5 character!',

            'image_slide.min' => 'Pleas upload a image!'
        ]);

        $image = $request->file('image_slide');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(1920,1088)->save('image/slider/'.$name_gen);

        $last_img = 'image/slider/'.$name_gen;

        Slide::insert([
            'title' => $request->title_slide,
            'description' => $request->description_slide,
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('home.slider')->with('success','Slide Insert Successfuly');
    }
}
