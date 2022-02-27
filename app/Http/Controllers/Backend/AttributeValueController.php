<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
class AttributeValueController extends Controller
{
    public function view($attr_id){
        $attributevalues=AttributeValue::where('attribute_id',$attr_id)->latest()->get();
        return view('backend.attribute_value.view',compact('attributevalues','attr_id'));
    }
    public function store(Request $request){
        $attr_id = $_GET['attr_id'];
        $request->validate([
            'attr_value'=>'required',
            'attr_code'=>'required',
        ],[
            'attr_value.required' =>'This field is required',
            'attr_code.required' =>'This field is required',
        ]);
        AttributeValue::insert([
            'attribute_id' =>$attr_id,
            'attr_value'=>$request->attr_value,
            'attr_code'=>$request->attr_code,
            'attr_order'=>$request->attr_order,
        ]);
        $msg=__('AttributeValue save successfully');
        $notification=array(
            'message'=>$msg,
            'alert-type'=>'success'
        );
        return redirect()->route('all.attributeval',$attr_id)->with($notification);
    }
    public function edit($id){
        $attr_id=$_GET['attr_id'];
        if(empty($attr_id)){
            $notification=array(
                'message'=>'Attribute id not empty',
                'alert-type'=>'dengar'
            );
            return redirect()->back()->with($notification);
        }
        $attributevalue=AttributeValue::find($id);
        return view('backend.attribute_value.edit',compact('attributevalue','attr_id'));
    }
    public function update(Request $request){
        $cat_id=$request->id;
        $attr_id=$request->attr_id;
        AttributeValue::where('id',$cat_id)->update([
            'attr_value'=>$request->attr_value,
            'attr_code'=>$request->attr_code,
            'attr_order'=>$request->attr_order,
        ]);
        $msg=__('AttributeValue update successfully');
        $notification=array(
            'message'=>$msg,
            'alert-type'=>'success'
        );

        return redirect()->route('all.attributeval',$attr_id)->with($notification);
    }
    public function delete($id){
        AttributeValue::findOrFail($id)->delete();
        $msg=__('AttributeValue Delete Successfully');
        $notification=array(
            'message'=>$msg,
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }
}
