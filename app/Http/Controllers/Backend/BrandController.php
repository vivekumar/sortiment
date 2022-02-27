<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
class BrandController extends Controller
{
    public function view(){
        $brands=Brand::latest()->get();
        return view('backend.brand.view',compact('brands'));
    }
    public function store(Request $request){

        $request->validate([
            'brand_name'=>'required',
        ],[
            'brand_name.required' =>'This field is required',
        ]);
        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_slug'=>strtolower(str_replace('','-',$request->brand_name)),
        ]);

        $msg=__('Brand save successfully');
        $notification=array(
            'message'=>$msg,
            'alert-type'=>'success'
        );
        return redirect()->route('all.brand')->with($notification);
    }
    public function edit($id){
        $brand=Brand::find($id);
        return view('backend.brand.edit',compact('brand'));
    }
    public function update(Request $request){
        //dd($request);
        $brand_id=$request->id;
        /*$request->validate([
            'brand_name_en'=>'required',
            'cagegory_icon' =>'required'
        ],[
            'brand_name_en.required' =>'Input Brand EN Name',
            'cagegory_icon.required' =>'Input Icon Name',
        ]);*/
        Brand::where('id',$brand_id)->update([
            'brand_name'=>$request->brand_name,
            'brand_slug'=>strtolower(str_replace('','-',$request->brand_name)),
        ]);
        $msg=__('Brand update successfully');
        $notification=array(
            'message'=>$msg,
            'alert-type'=>'success'
        );
        return redirect()->route('all.brand')->with($notification);
    }
    public function delete($id){
        Brand::findOrFail($id)->delete();
        $msg=__('Brand Delete Successfully');
        $notification=array(
            'message'=>$msg,
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}
