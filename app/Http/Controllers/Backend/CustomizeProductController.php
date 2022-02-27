<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomizeProduct;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Models\AttributeValue;
use App\Models\Attribute;
use App\Models\CustomizeProductAttribute;
use App\Models\CustomizeMultimg;
use App\Models\MultiPriceQty;
use App\Models\PriceRequest;
use App\Imports\CustomizeProductImport;
use Carbon\Carbon;use Mail;
use Image;use DB;use Validator; use Excel;
class CustomizeProductController extends Controller
{
    public function view(Request $request){
        //$attributes=Attribute::latest()->get();
        $users=User::latest()->get();
        //$products = CustomizeProduct::latest()->get();
        $brands = Brand::latest()->get();
        $products = CustomizeProduct::latest();
        //$products->leftJoin('product_attributes','product_attributes.product_id','=','products.id');

        if (count($request->all())>0) {

            if(!empty($request->user_id))
            {
                $products->where('user_id',$request->user_id);
            }
            if(!empty($request->status))
            {
                $products->where('status',$request->status);
            }
        }

          $products = $products->get();

		return view('backend.customize_product.list',compact('products','brands','users'));
    }
    public function add(){
        $attributes=Attribute::with('values')->latest()->get();
        $users=User::latest()->get();
        $brands = Brand::latest()->get();
        $categories=Category::latest()->get();
        $PriceRequest=PriceRequest::orderBy('id', 'DESC')->get();
        return view('backend.customize_product.add',compact('categories','brands','users','attributes','PriceRequest'));
    }
    public function store(Request $request){
        //dd($request);
        $save_url_pdf=$save_url='';
        $request->validate([
            'product_name' => 'required|unique:customize_products|max:255',
            'product_price' => 'required',
            'product_thambnail' => 'required',
            'name_on_product' => 'required',
            //'category_id' => 'required',
            'brand_id' => 'required',
            'user_id' => 'required',
            'product_sku' =>'required',
            //'product_pdf' => 'required|pdf|max:9048',
            //'request_id'=>'required',
            'express_delivery_status'=>'required',
        ], [
            'product_name.required' => __('This field is required'),
            'product_name.unique' => __('Please enter unique name'),
            'product_price.required' => __('This field is required'),
            'product_thambnail.required' => __('This field is required'),
            'name_on_product.required' => __('This field is required'),
            //'category_id.required' => 'This field is required',
            'user_id.required' => __('This field is required'),
            'brand_id.required' => __('This field is required'),
            //'request_id.required' => 'This Field is required',
            'product_sku.required' => __('This field is required'),
            'express_delivery_status.required' => __('This field is required'),
        ]);
        if($request->hasFile('product_thambnail')){
            $image = $request->file('product_thambnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('public/uploads/products/images/'.$name_gen);
            $save_url = 'uploads/products/images/'.$name_gen;

        }

        //$fileModel = new File;
        if($request->hasFile('product_pdf')){
            $fileName = time().'.'.$request->product_pdf->extension();
            $request->file('product_pdf')->move(public_path('uploads/products/pdf/'), $fileName);
            $save_url_pdf = 'uploads/products/pdf/'.$fileName;
        }

        /*
        $qty5 = (float) strtr($request->qty5, [
            '+' => '',
        ]);*/

        $product_id = CustomizeProduct::insertGetId([
            //'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' =>  strtolower(str_replace(' ', '-', $request->product_name)),
            'product_sku' => $request->product_sku,
            'user_id' => $request->user_id,
            'brand_id' => $request->brand_id,
            'name_on_product' => $request->name_on_product,
            'request_id' =>$request->request_id,

            'product_price' => $request->product_price,
            'description' => $request->description,
            'product_thambnail' => $save_url,
            'product_pdf' => $save_url_pdf,
            'status' => 1,
            'delevery_days'=>$request->delevery_days,
            'express_delivery_days'=>$request->express_delivery_days,
            'express_delivery_status'=>$request->express_delivery_status,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
            'meta_tag' => $request->meta_tag,
            'created_at' => Carbon::now(),

        ]);

        ////////// Multiple Image Upload Start ///////////
        if($request->hasFile('multi_img')){
            $images = $request->file('multi_img');
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->save('public/uploads/products/images/'.$make_name);
                $uploadPath = 'uploads/products/images/'.$make_name;

                CustomizeMultimg::insert([
                    'customize_product_id' => $product_id,
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
                    DB::table('customize_product_attributes')->insert([
                        'product_id' => $product_id,
                        'attribute_id' => $key,
                        'attrvalue_id' => $attr,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }
        }
        ////////// Attribute Start ///////////
        ////////// price qty Start ///////////

        $pqty = $request->qty;
        $pprice = $request->price;
        if(!empty($pqty)){
            $priceArr=[];
            foreach ($pqty as $key=>$pqty) {
                MultiPriceQty::insert([
                    'product_id' => $product_id,
                    'qty' => $pqty,
                    'price' => $pprice[$key],
                    'created_at' => Carbon::now(),
                ]);
                $priceArr[]=[
                    'qty' => $pqty,
                    'price' => $pprice[$key],
                ];
            }
        }
        ////////// price qty Start ///////////

        if($request->request_id){

            $product_request=\App\Models\PriceRequest::where('id',$request->request_id)->first();

            $details = [
                'amount'=>$request->product_price,
                'product_thambnail'=>$save_url,
                'product_title'=>$request->product_name,
                'priceArr'=>$priceArr,
                'request'=>$product_request,
                'page_url' => route('cproduct.cstatus',$product_id),
            ];
            //dd(Auth::user()->email);->cc($request->email) dev12@infoiconsoftware.com

            $email=\App\Models\User::where('id',$request->user_id)->value('email');

            \Mail::to('dev12@infoiconsoftware.com')->cc($email)->send(new \App\Mail\ProductConfirmationMail($details));
        }
        ///// end Send mail //////////////////////////////////

       $notification = array(
			'message' => __('Product Inserted Successfully'),
			'alert-type' => 'success'
		);
		return redirect()->back()->with($notification);




    }
    public function edit($id){

        $multiImgs = CustomizeMultimg::where('customize_product_id',$id)->get();
		$attributes=Attribute::with('values')->latest()->get();
        $users=User::latest()->get();
        $brands = Brand::latest()->get();
        $categories=Category::latest()->get();
        //$product_attributes = ProductAttribute::where('product_id',$id)->get();
		$product = CustomizeProduct::findOrFail($id);
        $mqtyprice=MultiPriceQty::where('product_id',$id)->get();
        $PriceRequest=PriceRequest::orderBy('id', 'DESC')->get();
		return view('backend.customize_product.edit',compact('categories','product','multiImgs','brands','users','attributes','mqtyprice','PriceRequest'));

    }
    public function update(Request $request){
        //dd($request);
        $product_id = $request->id;
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            //'product_thambnail' => 'required',
            'name_on_product' => 'required',
            //'category_id' => 'required',
            'brand_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'product_sku'=>'required',
            //'product_pdf' => 'required|pdf|max:9048',
            //'request_id'=>'required',
            'express_delivery_status'=>'required',
        ], [
            'product_name.required' => __('This field is required'),
            'product_price.required' => __('This field is required'),
            //'product_thambnail.required' => 'This Field is required'),
            'name_on_product.required' => __('This field is required'),
            //'category_id.required' => 'This field is required',
            'user_id.required' => __('This field is required'),
            'brand_id.required' => __('This field is required'),
            'status.required' => __('This field is required'),
            //'request_id.required' => 'This Field is required',
            'product_sku.required' => __('This field is required'),
            'express_delivery_status.required' => __('This field is required'),
        ]);
        /*$qty5 = (float) strtr($request->qty5, [
            '+' => '',
        ]);*/
        CustomizeProduct::findOrFail($product_id)->update([
            //'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' =>  strtolower(str_replace(' ', '-', $request->product_name)),
            'product_sku' => $request->product_sku,
            'user_id' => $request->user_id,
            'brand_id' => $request->brand_id,
            'name_on_product' => $request->name_on_product,
            'request_id' =>$request->request_id,

            'product_price' => $request->product_price,
            'description' => $request->description,
            //'product_thambnail' => $save_url,
            'status' => $request->status,
            'delevery_days'=>$request->delevery_days,
            'express_delivery_days'=>$request->express_delivery_days,
            'express_delivery_status'=>$request->express_delivery_status,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
            'meta_tag' => $request->meta_tag,
            'updated_at' => Carbon::now(),

        ]);
         ////////// Attribute Start ///////////
         DB::table('customize_product_attributes')->where('product_id',$product_id)->delete();
         $attributes = $request->attrval_id;
         if(!empty($attributes)){
            //DB::table('customize_product_attributes')->where('product_id',$product_id)->delete();
             foreach ($attributes as $key=>$attribute) {
                 foreach ($attribute as $attr) {
                     DB::table('customize_product_attributes')->insert([
                         'product_id' => $product_id,
                         'attribute_id' => $key,
                         'attrvalue_id' => $attr,
                         'created_at' => Carbon::now(),
                     ]);
                 }
             }
         }
         ////////// Attribute Start ///////////
          ////////// price qty Start ///////////

        $pqty = $request->qty;
        $pprice = $request->price;
        MultiPriceQty::where('product_id',$product_id)->delete();
        if(!empty($pqty)){
            foreach ($pqty as $key=>$pqty) {
                MultiPriceQty::insert([
                    'product_id' => $product_id,
                    'qty' => $pqty,
                    'price' => $pprice[$key],
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        ////////// price qty Start ///////////

        if($request->request_id){
            //dd($request->status);//pending //approved

            $product_request=\App\Models\PriceRequest::where('id',$request->request_id)->first();
            $email=\App\Models\User::where('id',$request->user_id)->value('email');
            //dd($email);
            if($request->status=='pending'){
                $details = [
                    'status'=>$request->status,                    
                    'content' => 'Dit produkt er nu online på din profil og klar til at blive godkendt.',
                ];            
                Mail::send('mail.cproduct-notification', $details, function($message) use($email) {
                     $message->to($email, 'Sortiment')->subject('Reminder: Din produkt er nu klar til godkendelse på din profil.');
                     $message->from('dev12@infoiconsoftware.com','Sortiment');
                });
            }else if($request->status=='approved'){
                $details = [
                    'status'=>$request->status,                    
                    'content' => 'Du har godkendt dit produkt og det vil nu altid ligge klar på dit profil.',
                ];            
                Mail::send('mail.cproduct-notification', $details, function($message) use($email) {
                     $message->to($email, 'Sortiment')->subject('Tak for din godkendelse');
                     $message->from('dev12@infoiconsoftware.com','Sortiment');
                });
            }
            
        }

          $notification = array(
			'message' => __('Product Updated Without Image Successfully'),
			'alert-type' => 'success'
		);

		return redirect()->route('all.cproduct')->with($notification);


    }
    public function ProductInactive($id){
        CustomizeProduct::findOrFail($id)->update(['status' => 0]);
        $notification = array(
           'message' => __('Product Inactive'),
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);
    }


    public function ProductActive($id){
        CustomizeProduct::findOrFail($id)->update(['status' => 1]);
        $notification = array(
           'message' => __('Product Active'),
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);

    }
    public function delete($id){
        $product = CustomizeProduct::findOrFail($id);

        if(!empty($product->product_thambnail) && file_exists(public_path($product->product_thambnail)) ){
            unlink(public_path($product->product_thambnail));
        }
        if(!empty($product->product_pdf) && file_exists(public_path($product->product_pdf)) ){
            unlink(public_path($product->product_pdf));
        }
        $images = CustomizeMultimg::where('customize_product_id',$id)->get();
        foreach ($images as $img) {
            if(!empty($img->photo_name) && file_exists(public_path($img->photo_name)) ){
                unlink(public_path($img->photo_name));
            }
            CustomizeMultimg::where('id',$img->id)->delete();
        }
        CustomizeProductAttribute::where('product_id',$id)->delete();
        CustomizeProduct::findOrFail($id)->delete();



        $notification = array(
           'message' => __('Product Deleted Successfully'),
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);
    }

    public function MultiImageUpdate(Request $request){
		$imgs = $request->multi_img;

		foreach ($imgs as $id => $img) {
            $imgDel = CustomizeMultimg::findOrFail($id);
            if(!empty($imgDel->photo_name) && file_exists(public_path($imgDel->photo_name)) ){
                unlink(public_path($imgDel->photo_name));
            }
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->save('public/uploads/products/images/'.$make_name);
            $uploadPath = 'uploads/products/images/'.$make_name;

            CustomizeMultimg::where('id',$id)->update([
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

        if($request->hasFile('product_thambnail')){
            if(!empty($oldImage) && file_exists(public_path($oldImage)) ){
                unlink(public_path($oldImage));
            }

            $image = $request->file('product_thambnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('public/uploads/products/images/'.$name_gen);
            $save_url = 'uploads/products/images/'.$name_gen;

            CustomizeProduct::findOrFail($pro_id)->update([
                'product_thambnail' => $save_url,
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
            $oldpdf = $request->old_pdf;

            if(!empty($request->old_pdf) && file_exists(public_path($request->old_pdf)) ){
                unlink(public_path($oldpdf));
            }


            
            $fileName = time().'.'.$request->product_pdf->extension();
            $request->file('product_pdf')->move(public_path('uploads/products/pdf/'), $fileName);
            $save_url_pdf = 'uploads/products/pdf/'.$fileName;
            

            CustomizeProduct::findOrFail($pro_id)->update([
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
    public function pdfRemove($id){
        $product=CustomizeProduct::find($id);

        $oldpdf = $product->product_pdf;
        if(!empty($oldpdf) && file_exists(public_path($oldpdf)) ){
            unlink(public_path($oldpdf));
        }
        CustomizeProduct::findOrFail($id)->update([
            'product_pdf' => '',
            'updated_at' => Carbon::now(),

        ]);
        $notification = array(
			'message' => __('Product PDF Remove Successfully'),
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);
    }
    public function MultiImageDelete($id){
        $oldimg = CustomizeMultimg::findOrFail($id);
        if(!empty($oldimg->photo_name) && file_exists(public_path($oldimg->photo_name)) ){
            unlink(public_path($oldimg->photo_name));
        }
        CustomizeMultimg::findOrFail($id)->delete();

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

                CustomizeMultimg::insert([
                    'customize_product_id' => $request->id,
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
               Excel::import(new CustomizeProductImport,$request->file('file'));
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
