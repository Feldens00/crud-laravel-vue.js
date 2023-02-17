<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function All_Category(){
        // Exemplo de join com query builder
        // $categories = DB::table('categories')
        //     ->join('users','categories.user_id','users.id')
        //     ->select('categories.*','users.name')
        //     ->latest()->paginate(5);

        $trash_categories = Category::onlyTrashed()->latest()->paginate(3);
        $categories = Category::latest()->paginate(5);
        //$categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories','trash_categories'));
    }

    public function Add_Category(Request $request){
        $validetedData = $request->validate([
            'category_name' => 'required|unique:categories|min:5',
        ],
        [
            'category_name.required' => 'Pleas insert a valid name!',
            'category_name.min' => 'Pleas insert more then 5 character!',
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        // outro jeito para adicionar
        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return redirect()->back()->with('success','Category inserted Successfull');

    }

    public function Edit_Category($id){
        // $categories = Category::find($id);
        $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit', compact('categories'));
    }

    public function Update_Category(Request $request, $id){
        // $update = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id
        // ]);
        
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);

        return redirect()->route('all.category')->with('success','Category updated Successfull');
    }

    public function Soft_Delete_Category($id){
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success','Category Soft Delete Successfuly');
    }

    public function Restore_Category($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Category Restore Successfuly');
    }

    public function Permanent_Delete_Category($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Category Permanently Deleted');
    }
}
