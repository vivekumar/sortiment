<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductLogoPostion;
class ProductLogoPostionController extends Controller
{
    public function view(){
        $positions=ProductLogoPostion::latest()->get();
        return view('backend.product_logo_position.view',compact('positions'));
    }
    public function store(Request $request){

        $request->validate([
            'positions'=>'required',
        ],[
            'positions.required' =>__('This field is required'),
        ]);
        ProductLogoPostion::insert([
            'positions'=>$request->positions,
        ]);
        $notification=array(
            'message'=>__('Logo postion save successfully'),
            'alert-type'=>'success'
        );
        return redirect()->route('all.position')->with($notification);
    }
    public function edit($id){
        $position=ProductLogoPostion::find($id);
        return view('backend.product_logo_position.edit',compact('position'));
    }
    public function update(Request $request){
        //dd($request);
        $positions_id=$request->id;

        ProductLogoPostion::where('id',$positions_id)->update([
            'positions'=>$request->positions,
        ]);
        $notification=array(
            'message'=>__('Logo postion update successfully'),
            'alert-type'=>'success'
        );
        return redirect()->route('all.position')->with($notification);
    }
    public function delete($id){
        ProductLogoPostion::findOrFail($id)->delete();
        $notification=array(
            'message'=>__('Logo postion Delete Successfully'),
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

}
