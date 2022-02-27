<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;
class AttributeController extends Controller
{
    public function view(){
        $attributes=Attribute::latest()->get();
        return view('backend.attribute.view',compact('attributes'));
    }
    public function store(Request $request){

        $request->validate([
            'attr_name'=>'required',
        ],[
            'category_name.required' =>'This field is required',
        ]);
        Attribute::insert([
            'attr_name'=>$request->attr_name,
        ]);
        $msg=__('Attribute save successfully');
        $notification=array(
            'message'=>$msg,
            'alert-type'=>'success'
        );
        return redirect()->route('all.attribute')->with($notification);
    }
    public function edit($id){
        $attribute=Attribute::find($id);
        return view('backend.attribute.edit',compact('attribute'));
    }
    public function update(Request $request){
        //dd($request);
        $cat_id=$request->id;
        Attribute::where('id',$cat_id)->update([
            'attr_name'=>$request->attr_name,
        ]);

        $msg=__('Attribute update successfully');
        $notification=array(
            'message'=>$msg,
            'alert-type'=>'success'
        );
        return redirect()->route('all.attribute')->with($notification);
    }
    public function delete($id){
        AttributeValue::where('attribute_id',$id)->delete();
        Attribute::findOrFail($id)->delete();
        $msg=__('Attribute Delete Successfully');
        $notification=array(
            'message'=>$msg,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }

}
