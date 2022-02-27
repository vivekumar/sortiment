<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatSetting;
class ChatSettingController extends Controller
{
    public function view(){
        $data=ChatSetting::where('id',1)->first();

        return view('backend.chat_setting.edit',compact('data'));
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
        ChatSetting::where('id',$cat_id)->update([
            'video'=>$request->video,
            'pdf1'=>$request->pdf1,
            'pdf2'=>$request->pdf2,
            'pdf3'=>$request->pdf3,
            'pdf4'=>$request->pdf4,
        ]);

        $msg=__('Update successfully');
        $notification=array(
            'message'=>$msg,
            'alert-type'=>'success'
        );
        return redirect()->route('view.chat.setting')->with($notification);
    }
}




