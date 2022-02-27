<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
class SubCategoryController extends Controller
{
    public function view(){
        $subcategory=SubCategory::latest()->get();
        $categories=Category::latest()->get();

        return view('backend.subcategory.view',compact('subcategory','categories'));
    }
    public function store(Request $request){
        //dd($request);
        $request->validate([
            'category_id'=>'required',
            'subcategory_name'=>'required',
        ]/*,[
            'category_name_en.required' =>'Input Category EN Name',
            'category_icon.required' =>'Input Icon Name',
        ]*/);
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_slug'=>strtolower(str_replace(' ','-',$request->subcategory_name)),

        ]);
        $notification=array(
            'message'=>__('Category save successfully'),
            'alert-type'=>'success'
        );
        return redirect()->route('all.subcategory')->with($notification);
    }
    public function edit($id){
        $categories=Category::latest()->get();
        $subcategory=SubCategory::find($id);
        return view('backend.subcategory.edit',compact('subcategory','categories'));
    }
    public function update(Request $request){
        $cat_id=$request->id;
        /*$request->validate([
            'category_name_en'=>'required',
            'cagegory_icon' =>'required'
        ],[
            'category_name_en.required' =>'Input Category EN Name',
            'cagegory_icon.required' =>'Input Icon Name',
        ]);*/
        SubCategory::where('id',$cat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_slug'=>strtolower(str_replace(' ','-',$request->subcategory_name)),
        ]);
        $notification=array(
            'message'=>__('Category update successfully'),
            'alert-type'=>'success'
        );
        return redirect()->route('all.subcategory')->with($notification);
    }
    public function delete($id){
        SubCategory::findOrFail($id)->delete();
        $notification=array(
            'message'=>__('Category Delete Successfully'),
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }


    public function GetSubCategory(Request $request){
        //dd($request->category_ids);
        $subcat = SubCategory::whereIn('category_id',$request->category_ids)->orderBy('subcategory_name','ASC')->get();
        /*$html='<select class="custom-select form-control required " name="subcategory_id" id="subcategory_id">
                    <option value="" selected="" disabled="">----------Select SubCategory--------</option>';
                    foreach($subcat as $subdata){
                        $html.='<option value="'.$subdata->id.'">'.$subdata->subcategory_name_de.'</option>';
                    }
        $html.='</select>';
        return $html;*/

        return response()->json($subcat);
    }



}
