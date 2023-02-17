<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function All_Brand(){
        $brands = Brand::latest()->paginate(5);
        //return view('admin.brand.index', compact('brands'));
        return view('admin.brand.index', compact('brands'));
    }

    public function Add_Brand(Request $request){
        $validetedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:5',
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,'
        ],
        [
            'brand_name.required' => 'Pleas insert a valid name!',
            'brand_name.min' => 'Pleas insert more then 5 character!',
            'brand_image.min' => 'Pleas upload a image!'
        ]);

        $brand_image = $request->file('brand_image');

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen . '.' . $img_ext;
        // $upload_location = 'image/brand/';
        // $last_img = $upload_location . $img_name;
        // $brand_image->move($upload_location,$img_name);

        // tratamento e inserção da imagem usando package Interventention

        $name_gen = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = 'image/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success','Brand Insert Successfuly');
    }

    public function Edit_Brand($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function Update_Brand(Request $request, $id){
        $validetedData = $request->validate([
            'brand_name' => 'required|min:5',
        ],
        [
            'brand_name.required' => 'Pleas insert a valid name!',
            'brand_name.min' => 'Pleas insert more then 5 character!',
        ]);

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if($brand_image){

            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $upload_location = 'image/brand/';
            $last_img = $upload_location . $img_name;
            $brand_image->move($upload_location,$img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('success','Brand Updated Successfuly');

        } else {

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('success','Brand Updated Successfuly');


        }
        
    }

    public function Delete_Brand($id){
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return redirect()->back()->with('success','Brand Delete Successfuly');

    }

}
