<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\User;
use App\Models\AttributeValue;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\MultiImg;
use Carbon\Carbon;
use App\Imports\ProductImport;
use App\Models\ProductLogoPostion;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Image;use DB;use Validator; use Excel;
class ProductController extends Controller
{
    public function view(){
        //$attributes=Attribute::latest()->get();
        //$users=User::latest()->get();
        $products = Product::latest()->get();
        $brands = Brand::latest()->get();
		return view('backend.product.list',compact('products','brands'));
    }
    public function view_ajax(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Product::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Product::select('count(*) as allcount')->where('product_name', 'like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = Product::orderBy($columnName, $columnSortOrder)
            ->where('products.product_name', 'like', '%' . $searchValue . '%')
            ->orWhere('products.product_sku', 'like', '%' . $searchValue . '%')
            //->orWhere('products.branch', 'like', '%' . $searchValue . '%')
            ->select('products.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $data_arr[] = array(
                "id" => $record->id,
                "product_name" => $record->product_name,
                "product_price" => $record->product_price,
                "product_sku" => $record->product_sku,
                "status" => $record->status,
                'product_thambnail' => $record->product_thambnail,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        echo json_encode($response);
    }
    public function add(){
        $attributes=Attribute::with('values')->latest()->get();
        $users=User::latest()->get();
        $brands = Brand::latest()->get();
        $categories=Category::latest()->get();
        $ProductLogoPostion=ProductLogoPostion::latest()->get();
        return view('backend.product.add',compact('categories','brands','users','attributes','ProductLogoPostion'));
    }
    public function store(Request $request){

        //dd($request);
        $save_url_pdf=$save_url='';
        $request->validate([
            'product_name' => 'required|max:255', //unique:products|
            'product_price' => 'required',
            'product_thambnail' => 'required',

            'category_ids.*' => 'required',
            'brand_id' => 'required',
            //'product_pdf' => 'required|pdf|max:9048',
        ], [
            'product_name.required' => __('This field is required'),
            'product_price.required' => __('This field is required'),
            'product_thambnail.required' => __('This field is required'),
            'product_name.unique' =>  __('Please enter unique name'),
            'category_id.required' => __('This field is required'),
        ]);
        if($request->hasFile('product_thambnail')){
            $image = $request->file('product_thambnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('public/uploads/products/images/'.$name_gen);//->resize(917,1000)
            $uploadPath = 'uploads/products/images/'.$name_gen;

        }

        //$fileModel = new File;
        if($request->hasFile('product_pdf')){
            $fileName = time().'.'.$request->product_pdf->extension();
            $request->file('product_pdf')->move(public_path('uploads/products/pdf/'), $fileName);
            $save_url_pdf = 'uploads/products/pdf/'.$fileName;
        }
        if($request->logo_value){
            $logo_value=implode('|',$request->logo_value);
        }
        if($request->text_value){
            $text_value=implode('|',$request->text_value);
        }
        $product_slug=strtolower(str_replace(' ', '-', $request->product_name));
        $product_find=Product::where('product_slug',$product_slug)->first();
        if(!empty($product_find)){
            $product_slug=$product_slug.time();
        }
        $product_id = Product::insertGetId([
            //'category_id' => $request->category_id,
            //'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' =>  $product_slug,
            'product_sku' => $request->product_sku,
            //'user_id' => $request->user_id,
            'brand_id' => $request->brand_id,

            'product_price' => $request->product_price,
            'description' => $request->description,
            'product_thambnail' => $uploadPath,
            'product_pdf' => $save_url_pdf,

            'logo_value'=>$logo_value,
            'text_value'=>$text_value,
            'logo_on_product'=>$request->logo_on_product,
            'text_on_product'=>$request->text_on_product,

            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
            'meta_tag' => $request->meta_tag,


            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        ////////// Multiple Image Upload Start ///////////
        if($request->hasFile('multi_img')){
            $images = $request->file('multi_img');
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->save('public/uploads/products/images/'.$make_name);
                $uploadPath = 'uploads/products/images/'.$make_name;

                MultiImg::insert([
                    'product_id' => $product_id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        ////////// Een Multiple Image Upload Start ///////////

        ////////// Attribute Start ///////////

        $attributes = $request->attrval_id;
        if(!empty($attributes)){
            foreach ($attributes as $key=>$attribute) {
                foreach ($attribute as $attr) {
                    DB::table('product_attributes')->insert([
                        'product_id' => $product_id,
                        'attribute_id' => $key,
                        'attrvalue_id' => $attr,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }
        }
        $categories = $request->category_ids;
        if(!empty($categories)){
            foreach ($categories as $key=>$categorie) {
                ProductCategory::insert([
                    'product_id' => $product_id,
                    'cat_id' => $categorie,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $subcategories = $request->subcategory_ids;
        if(!empty($subcategories)){
            foreach ($subcategories as $key=>$subcategorie) {
                ProductSubCategory::insert([
                    'product_id' => $product_id,
                    'cat_id' => SubCategory::where('id',$subcategorie)->value('category_id'),
                    'subcat_id' => $subcategorie,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        ////////// Attribute Start ///////////

       $notification = array(
			'message' => __('Product Inserted Successfully'),
			'alert-type' => 'success'
		);
		return redirect()->back()->with($notification);




    }
    public function edit($id){
        $ProductCategory = ProductCategory::where('product_id',$id)->pluck('cat_id')->toArray();       
        $ProductSubCategory = ProductSubCategory::whereIn('cat_id',$ProductCategory)->pluck('subcat_id')->toArray();
        $multiImgs = MultiImg::where('product_id',$id)->get();
		$attributes=Attribute::with('values')->latest()->get();
        //$users=User::latest()->get();
        $brands = Brand::latest()->get();
        $categories=Category::latest()->get();
        $subCategories=SubCategory::whereIn('category_id',$ProductCategory)->get();        
        //$product_attributes = ProductAttribute::where('product_id',$id)->get();
        $ProductLogoPostion=ProductLogoPostion::latest()->get();
		$product = Product::findOrFail($id);
		return view('backend.product.edit',compact('categories','subCategories','product','multiImgs','brands','attributes','ProductLogoPostion','ProductCategory','ProductSubCategory'));

    }
    public function update(Request $request){
        $product_id = $request->id;
        /*$qty5 = (float) strtr($request->qty5, [
            '+' => '',
        ]);*/
        if($request->logo_value){
            $logo_value=implode('|',$request->logo_value);
        }
        if($request->text_value){
            $text_value=implode('|',$request->text_value);
        }
        Product::findOrFail($product_id)->update([
            //'category_id' => $request->category_id,
            //'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' =>  strtolower(str_replace(' ', '-', $request->product_name)),
            'product_sku' => $request->product_sku,
            //'user_id' => $request->user_id,
            'brand_id' => $request->brand_id,
            'product_price' => $request->product_price,
            'description' => $request->description,
            //'product_thambnail' => $save_url,
            //'status' => 1,
            'updated_at' => Carbon::now(),

            'logo_value'=>$logo_value,
            'text_value'=>$text_value,
            'logo_on_product'=>$request->logo_on_product,
            'text_on_product'=>$request->text_on_product,

            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
            'meta_tag' => $request->meta_tag,
        ]);
         ////////// Attribute Start ///////////

         $attributes = $request->attrval_id;
         if(!empty($attributes)){
            DB::table('product_attributes')->where('product_id',$product_id)->delete();
             foreach ($attributes as $key=>$attribute) {
                 foreach ($attribute as $attr) {
                     DB::table('product_attributes')->insert([
                         'product_id' => $product_id,
                         'attribute_id' => $key,
                         'attrvalue_id' => $attr,
                         'created_at' => Carbon::now(),
                     ]);
                 }
             }
         }
         ////////// Attribute Start ///////////
         $categories = $request->category_ids;
         ProductCategory::where('product_id',$product_id)->delete();
        if(!empty($categories)){
            foreach ($categories as $key=>$categorie) {
                ProductCategory::insert([
                    'product_id' => $product_id,
                    'cat_id' => $categorie,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $subcategories = $request->subcategory_ids;
        ProductSubCategory::where('product_id',$product_id)->delete();
        if(!empty($subcategories)){
            foreach ($subcategories as $key=>$subcategorie) {
                ProductSubCategory::insert([
                    'product_id' => $product_id,
                    'cat_id' => SubCategory::where('id',$subcategorie)->value('category_id'),
                    'subcat_id' => $subcategorie,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
          $notification = array(
			'message' => __('Product Updated Without Image Successfully'),
			'alert-type' => 'success'
		);

		return redirect()->route('all.product')->with($notification);


    }
    public function ProductInactive($id){
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
           'message' => __('Product Inactive'),
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);
    }


    public function ProductActive($id){
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
           'message' => __('Product Active'),
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);

    }
    public function delete($id){

        $product = Product::findOrFail($id);
        if(!empty($product->product_thambnail) && file_exists(public_path($product->product_thambnail)) ){
            unlink(public_path($product->product_thambnail));
        }
        if(!empty($product->product_pdf) && file_exists(public_path($product->product_pdf)) ){
            unlink(public_path($product->product_pdf));
        }
        $images = MultiImg::where('product_id',$id)->get();
        foreach ($images as $img) {
            if(!empty($img->photo_name) && file_exists(public_path($img->photo_name)) ){
                unlink(public_path($img->photo_name));
            }
            MultiImg::where('id',$img->id)->delete();
        }
        ProductAttribute::where('product_id',$id)->delete();
        Product::findOrFail($id)->delete();

        $notification = array(
           'message' => __('Product Deleted Successfully'),
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);
    }
    public function pdfRemove($id){
        $product=Product::find($id);
        $oldpdf = $product->product_pdf;
        if(!empty($product->product_pdf) && file_exists(public_path($product->product_pdf)) ){
            unlink(public_path($oldpdf));
            Product::findOrFail($id)->update([
                'product_pdf' => '',
                'updated_at' => Carbon::now(),

            ]);
        }
        $notification = array(
			'message' => __('Product PDF Remove Successfully'),
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);
    }
    public function MultiImageUpdate(Request $request){
		$imgs = $request->multi_img;

		foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            if(!empty($imgDel->photo_name) && file_exists(public_path($imgDel->photo_name)) ){
                unlink(public_path($imgDel->photo_name));
            }
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->save('public/uploads/products/images/'.$make_name);
            $uploadPath = 'uploads/products/images/'.$make_name;

            MultiImg::where('id',$id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);

        } // end foreach

       $notification = array(
			'message' => __('Product Image Updated Successfully'),
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

	} // end mehtod
    public function ThambnailImageUpdate(Request $request){
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        if(!empty($oldImage) && file_exists(public_path($oldImage)) ){
            unlink(public_path($oldImage));
        }
        if($request->hasFile('product_thambnail')){
            $image = $request->file('product_thambnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('public/uploads/products/images/'.$name_gen);
            $uploadPath = 'uploads/products/images/'.$name_gen;

            Product::findOrFail($pro_id)->update([
                'product_thambnail' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => __('Product Image Thambnail Updated Successfully'),
                'alert-type' => 'info'
            );
        }else{
           $notification = array(
                'message' => __('Product Image Thambnail Updated Successfully'),
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);

    } // end method
    public function pdfUpdate(Request $request){
        if($request->hasFile('product_pdf')){
            $pro_id = $request->id;
            $oldImage = $request->old_pdf;
            $product = Product::findOrFail($pro_id);
            if(!empty($product->product_pdf) && file_exists(public_path($product->product_pdf)) ){
            //if(!empty($product->product_pdf)){
                unlink(public_path($product->product_pdf));
            }


            $fileName = time().'.'.$request->product_pdf->extension();
            $request->file('product_pdf')->move(public_path('uploads/products/pdf/'), $fileName);
            $save_url_pdf = 'uploads/products/pdf/'.$fileName;


            Product::findOrFail($pro_id)->update([
                'product_pdf' => $save_url_pdf,
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => __('Product PDF Updated Successfully'),
                'alert-type' => 'info'
            );
        }else{
           $notification = array(
                'message' => __('Product PDF Updated Successfully'),
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);

    } // end method
    public function MultiImageDelete($id){
        $oldimg = MultiImg::findOrFail($id);
        if(!empty($oldimg->photo_name) && file_exists(public_path($oldimg->photo_name)) ){
            unlink(public_path($oldimg->photo_name));
        }
        MultiImg::findOrFail($id)->delete();

        $notification = array(
           'message' => __('Product Image Deleted Successfully'),
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);

    } // end method


    public function MultiImageInsert(Request $request){

        ////////// Multiple Image Upload Start ///////////
        if($request->hasFile('multi_img')){
            $images = $request->file('multi_img');
            //echo count($images);die;
            foreach ($images as $key=>$img) {
                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->save('public/uploads/products/images/'.$make_name);
                $uploadPath = 'uploads/products/images/'.$make_name;

                MultiImg::insert([
                    'product_id' => $request->id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);

            }
        }
        ////////// Een Multiple Image Upload Start ///////////
        $notification = array(
            'message' => __('Product Image Insert Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function UploadFile(Request $request){

        $data = array();
        $validator = Validator::make($request->all(), [
           'file' => 'required|mimes:xlsx,xls|max:2048'
        ]);

        if ($validator->fails()) {
           $data['success'] = 0;
           $data['error'] = $validator->errors()->first('file');// Error response
        }else{
           if($request->file('file')) {
               $file = $request->file('file');
               Excel::import(new ProductImport,$request->file('file'));
               $data['success'] = 1;
               $data['message'] = __('Upload Successfully!');
           }else{
               $data['success'] = 2;
               $data['message'] = __('File not uploaded.');
           }
        }

        return response()->json($data);
    }











}
