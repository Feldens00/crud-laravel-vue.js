<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use Illuminate\Support\Carbon;
use App\Models\Multipicture;
use Auth;

class AboutController extends Controller
{
    public function Home_About(){
        $abouts = HomeAbout::latest()->paginate(5);
        return view('admin.home.index', compact('abouts'));
    }

    public function Add_About(){
        return view('admin.home.create');
    }

    public function Store_About(Request $request){
        // var_dump($request->title_about);
        // die();
        $validetedData = $request->validate([
            'title_about' => 'required|min:5',
            'subtitle_about' => 'required|min:5',
            'description_about' => 'required|min:5',
        ],
        [
            'title_about.required' => 'Pleas insert a valid title!',
            'title_about.min' => 'Pleas insert more then 5 character!',

            
            'subtitle_about.required' => 'Pleas insert a valid subtitle!',
            'subtitle_about.min' => 'Pleas insert more then 5 character!',

            'description_about.required' => 'Pleas insert a valid description!',
            'description_about.min' => 'Pleas insert more then 5 character!',

        ]);

        HomeAbout::insert([
            'title' => $request->title_about,
            'subtitle' => $request->subtitle_about,
            'description' => $request->description_about,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.about')->with('success','About Insert Successfuly');
    }

    public function Edit_About($id){
        $about = HomeAbout::find($id);
        return view('admin.home.edit', compact('about'));
    }

    public function update_About(Request $request, $id){
        $validetedData = $request->validate([
            'title_about' => 'required|min:5',
            'subtitle_about' => 'required|min:5',
            'description_about' => 'required|min:5',
        ],
        [
            'title_about.required' => 'Pleas insert a valid title!',
            'title_about.min' => 'Pleas insert more then 5 character!',

            
            'subtitle_about.required' => 'Pleas insert a valid subtitle!',
            'subtitle_about.min' => 'Pleas insert more then 5 character!',

            'description_about.required' => 'Pleas insert a valid description!',
            'description_about.min' => 'Pleas insert more then 5 character!',

        ]);

        $update = HomeAbout::find($id)->update([
            'title' => $request->title_about,
            'subtitle' => $request->subtitle_about,
            'description' => $request->description_about,
        ]);

        return Redirect()->route('home.about')->with('success','About Updated Successfuly');
    }

    public function Delete_About($id){

        HomeAbout::find($id)->delete();
        return redirect()->back()->with('success','About Delete Successfuly');

    }

    public function Portfolio(){
        $images = Multipicture::all();
        return view('pages.portfolio', compact('images'));
    }
}
