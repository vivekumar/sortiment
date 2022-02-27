<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function view(){
        $category=Category::latest()->get();
        return view('backend.category.view',compact('category'));
    }
    public function store(Request $request){

        $request->validate([
            'category_name'=>'required',
        ],[
            'category_name.required' =>__('This field is required'),
        ]);
        Category::insert([
            'category_name'=>$request->category_name,
            'cagegory_slug'=>strtolower(str_replace('','-',$request->category_name)),
        ]);

        $notification=array(
            'message'=>__('Category save successfully'),
            'alert-type'=>'success'
        );

        return redirect()->route('all.category')->with($notification);
    }
    public function edit($id){
        $category=Category::find($id);
        return view('backend.category.edit',compact('category'));
    }
    public function update(Request $request){
        //dd($request);
        $cat_id=$request->id;
        /*$request->validate([
            'category_name_en'=>'required',
            'cagegory_icon' =>'required'
        ],[
            'category_name_en.required' =>'Input Category EN Name',
            'cagegory_icon.required' =>'Input Icon Name',
        ]);*/
        Category::where('id',$cat_id)->update([
            'category_name'=>$request->category_name,
            'cagegory_slug'=>strtolower(str_replace('','-',$request->category_name)),
        ]);
        $msg=__('Category update successfully');
        $notification=array(
            'message'=>$msg,
            'alert-type'=>'success'
        );

        return redirect()->route('all.category')->with($notification);
    }
    public function delete($id){
        Category::findOrFail($id)->delete();

        $msg=__('Category Delete Successfully');
        $notification=array(
            'message'=>$msg,
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }










}
