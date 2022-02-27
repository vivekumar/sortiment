<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\PriceRequest;

use App\Models\Product;
use App\Models\CustomizeProduct;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\User;
use App\Models\AttributeValue;
use App\Models\Attribute;
use App\Models\Chat;
use App\Models\Employee;
use App\Models\ProductAttribute;
use App\Models\MultiImg;
use App\Models\ProductDeny;
use App\Models\Order;
use App\Models\OrderProcess;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Intervention\Image\Facades\Image;
use DB;use PDF;use Mail;

use App\Models\MultiPriceQty;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        //print_r($attr[0]);
        $subcategory=$seo=[];
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $attributes=Attribute::with('values')->latest()->get();
        //dd($attributes);
        $products = Product::where('status',1)->orderBy('products.created_at','asc');
        //$products->leftJoin('product_attributes','product_attributes.product_id','=','products.id');
        if (count($request->all())>0) {

            if(!empty($request->category))
            {
                //$products->where('products.category_id',$request->category);
                $subcategory=SubCategory::where('category_id',$request->category)->orderBy('subcategory_name','ASC')->get();
            }
            /*if(!empty($request->subcategory))
            {
                $products->where('products.subcategory_id',$request->subcategory);
            }*/
            if(!empty($request->brand))
            {
                $products->where('products.brand_id',$request->brand);
            }
            if(isset($request->s) && !empty($request->s))
            {
                $search=$request->s;
                $products->Where(function ($query) use($search) {
                    $query->where('products.product_name', 'LIKE', "%$search%")
                            ->orwhere('products.product_sku', 'LIKE', "%$search%");
                });

                //$products->where('products.product_name', 'LIKE', "%$request->s%");
                //$products->where('products.product_sku', 'LIKE', "%$request->s%");
            }
            $atrrr=$request->attribute;
            //foreach($request->attribute as $key=>$attr){

            if(isset($atrrr[1][0]) && !empty($request->attribute)){

                    $products->whereHas('product_attributes', function ($query) use($atrrr){
                        foreach($atrrr as $keyaa=>$atrr){
                        $query->where(function ($query) use($keyaa,$atrr) {
                            $query->where('attribute_id', $keyaa)->whereIn('attrvalue_id', [$atrr[0]]);
                        });

                        }
                    });

                    //$products->where([['product_attributes.attrvalue_id',$attr[0]],['product_attributes.attribute_id',$key]]);
                //}
            }


            if(!empty($request->category)){
                $category=$request->category;
                $products->whereHas('product_categories', function ($query) use($category){
                    $query->where('cat_id', $category);                                      
                });                    
            }

            if(!empty($request->subcategory))
            {
                $category=$request->category;
                $subcategory1=$request->subcategory;
                $products->whereHas('product_sub_categories', function ($query1) use($category,$subcategory1){
                    //$query->where('subcat_id',$subcategory1);
                    //$query->where('cat_id',$category);
                }); 
            }


        }


          $products = $products->get();
         // dd($products);
          $seo['metaTitle']="Vores produkter";
          $seo['metaDescription']="";
          $seo['metaTag']="";
        return view('company.index',compact('products','categories','brands','attributes','subcategory','seo'));
    }
    public function productDetail($id)
    {
        $seo=[];
        $product = Product::with('mutimage')->where('id',$id)->first();
        $allimages = DB::table('company_uploads')->where('user_id',Auth::user()->id)->get();
        $distincts = DB::table('product_attributes')->distinct()->select('attribute_id')->where('product_id', '=',$product->id)->get();

        if(!empty($product->meta_title)){
            $meta_title=$product->meta_title;
        }else{
            $meta_title='Sortiment - '.$product->product_name;
        }
        $seo['metaTitle']=$meta_title;
        $seo['metaDescription']=$product->meta_desc;
        $seo['metaTag']=$product->meta_tag;

        return view('company.single-product',compact('product','distincts','allimages','seo'));
    }
    public function customizeProductDetail($slug){
        $cproduct = CustomizeProduct::with('mutimage')->where('id',$slug)->first();

        if(!empty($cproduct->meta_title)){
            $meta_title=$cproduct->meta_title;
        }else{
            $meta_title='Sortiment - '.$cproduct->product_name;
        }
        $seo['metaTitle']=$meta_title;

        ///$seo['metaTitle']=$cproduct->meta_title;
        $seo['metaDescription']=$cproduct->meta_desc;
        $seo['metaTag']=$cproduct->meta_tag;

        return view('company.single-product',compact('cproduct','seo'));
    }
    public function customizeProductStatus($id){
        $product = CustomizeProduct::with('mutimage')->where('id',$id)->first();
        $mqtyprice=MultiPriceQty::where('product_id',$id)->get();
        $distincts = DB::table('customize_product_attributes')->distinct()->select('attribute_id')->where('product_id', '=',$product->id)->get();
        
        if(!empty($product->meta_title)){
            $meta_title=$product->meta_title;
        }else{
            $meta_title='Sortiment - '.$product->product_name;
        }
        $seo['metaTitle']=$meta_title;
        $seo['metaDescription']=$product->meta_desc;
        $seo['metaTag']=$product->meta_tag;
        return view('company.single-product-status-change',compact('product','mqtyprice','distincts','seo'));
    }
    public function myProduct(Request $request)
    {

        $uerid = Auth::user()->id;
        //$products = CustomizeProduct::where('user_id',$uerid)->latest()->get();
        $products = CustomizeProduct::where('user_id',$uerid)->latest();
        //$products->leftJoin('product_attributes','product_attributes.product_id','=','products.id');
        if (count($request->all())>0) {

            if(!empty($request->status))
            {
                $products->where('status',$request->status);
            }
        }
        //$products = $products->paginate(2);
        $products = $products->get();

        $seo['metaTitle']='Mine produkter';
        $seo['metaDescription']="";
        $seo['metaTag']="";

        return view('company.my-product',compact('products','seo'));
    }

    public function orderHostory()
    {
        $orders=Order::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        //dd(Auth::user()->id);
        $seo['metaTitle']='Ordre historik';
        $seo['metaDescription']="";
        $seo['metaTag']="";
        return view('company.order-history', compact('orders','seo'));
    }
    public function orderDetails($id){
        $order=Order::where([['id',$id],['user_id',Auth::user()->id]])->first();
        $order_process=OrderProcess::where('order_id',$id)->orderBy('date', 'desc')->get();
        return view('company.view-order', compact('order','order_process'));
    }
    public function downloadInvoicePDF($id){
        $data=[];
        $data['order'] = Order::where([['id',$id],['user_id',Auth::user()->id]])->first();

        $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->download('invoice.pdf');

        //$pdf = PDF::loadView('pdf.invoice', $data);
        //return $pdf->stream('invoice.pdf');
    }

    public function askAquestion()
    {
        $admins = Admin::all();
        $seo['metaTitle']='Hjælp';
        $seo['metaDescription']="";
        $seo['metaTag']="";
        return view('company.ask-question', compact('admins','seo'));
    }

    public function askAquestionChat($admin_id)
    {
        $admin_id = (int)$admin_id;
        $user = Auth::user();
        $admin = Admin::find($admin_id);
        //return public_path($user->profile_photo_path);
        if (!is_file(public_path($admin->profile_photo_path) )) {
            $admin->profile_photo_path = 'frontend/assets/img/user.png';
        }

        if (!is_file(public_path($user->profile_photo_path) )) {
            $user->profile_photo_path = 'frontend/assets/img/user.png';
        }

        $chats = Chat::where('user_id', '=', $user->id)->where('admin_id', '=', $admin_id)->orderBy('id', 'ASC')->get();

        return view('company.ask-question-form', compact('user', 'admin', 'chats'));
    }

    public function companyInfo()
    {
        $uerid = Auth::user()->id;
        $uerDetails = User::find($uerid);
        $allimages = DB::table('company_uploads')->where('user_id',$uerid)->get();

        $seo['metaTitle']='Min konto';
        $seo['metaDescription']="";
        $seo['metaTag']="";
        return view('company.company-information',compact('uerDetails','allimages','seo'));
    }
    public function companyInfoSave(Request $request)
    {
        $uerid = Auth::user()->id;
        $request->validate([
            'name' => 'required|max:255',
            'company' => 'required',
            'crv_no' => 'required|digits_between:8,8|numeric',
            'email' => 'required|string|email|max:255|unique:users,email,'.$uerid,
            'phone' => 'required',
            'address' => 'required',
            //'ean_number' => 'required|digits_between:13,13|numeric',
        ], [
            'name.required' => __('This field is required'),
            'company.required' => __('This field is required'),
            //'crv_number.required' => __('This field is required'),
            'email.unique' =>  __('Please enter unique email'),
            'phone.required' => __('This field is required'),
            'crv_no.digits_between'=>"CVR nummer skal indeholde 8 cifre"
        ]);
        if(!empty($request->ean_number)){
            $request->validate([                
                'ean_number' => 'digits_between:13,13|numeric',
            ],[
                'ean_number.digits_between'=>"Ean nummer skal indeholde 13 cifre"
            ]);
        }
        if($request->hasFile('profile_photo_path')) {
            $file=$request->file('profile_photo_path');
            @unlink(public_path('uploads/admin_images/'.$request->profile_photo_path));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'),$filename);
            $profile_photo_path='uploads/admin_images/'.$filename;

            $uerDetails = User::where('id',$uerid)->update([
                'name'=>$request->name,
                'company'=>$request->company,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'zip'=>$request->zip,
                'address'=>$request->address,
                'address2'=>$request->address2,
                'crv_number'=>$request->crv_no,
                'ean_number'=>$request->ean_number,
                'profile_photo_path'=>$profile_photo_path,
            ]);
        }else{
            $uerDetails = User::where('id',$uerid)->update([
                'name'=>$request->name,
                'company'=>$request->company,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'zip'=>$request->zip,
                'address'=>$request->address,
                'address2'=>$request->address2,
                'crv_number'=>$request->crv_no,
                'ean_number'=>$request->ean_number,
            ]);
        }
        $notification = array(
            'message' => __('Successfully update company info.'),
            'alert-type' => 'success'
        );

        return redirect()->route('companyInfo')->with($notification);
    }
    public function priceRequest(Request $request){
        //dd($request);
        $text_value=$logo_value='';
        $user = auth()->user();
        $logo_url='';
        $this->validate($request,[
            'message' => 'required',
            'logo' => 'mimes:eps,ai,jpg,jpeg,png,svg,pdf|max:10048',
        ],[
            'message.required' => __('Beskrivelse mangler..'),
        ]);

        if($request->hasFile('logo')){
            $image = $request->file('logo');
           // dd($image);
            $logo_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //Image::make($image)->save('public/uploads/products/logo/'.$logo_gen);//->resize(917,1000)
            move_uploaded_file($_FILES['logo']['tmp_name'], 'public/uploads/products/logo/'.$logo_gen);
            $logo_url = 'uploads/products/logo/'.$logo_gen;
        }
        if($request->logo_value){
            $logo_value=implode('|',$request->logo_value);
        }
        if($request->text_value){
            $text_value=implode('|',$request->text_value);
        }
        $product_id = PriceRequest::insertGetId([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'text_on_product' =>  $request->text_on_product?$request->text_on_product:0,
            'logo_on_product' => $request->logo_on_product?$request->logo_on_product:0,
            'logo_value' => $logo_value,
            'text_value' => $text_value,
            'logo' => $logo_url,
            'profile_logo'=>$request->profile_logo,
            'message'=>$request->message,
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);

        $product=Product::where('id',$request->product_id)->select('product_name', 'product_thambnail')->first();

        $details = [
            'product_name'=>$product->product_name,
            'product_thambnail'=>$product->product_thambnail,
            'text_on_product' =>  $request->text_on_product?$request->text_on_product:0,
            'logo_on_product' => $request->logo_on_product?$request->logo_on_product:0,
            'logo_value' => $logo_value,
            'text_value' => $text_value,
            'message'=>$request->message,
        ];
        //dd($details);

        \Mail::to('dev12@infoiconsoftware.com')->cc(Auth::user()->email)->send(new \App\Mail\ProductRequestConfirmationMail($details));
        // if it's correctly validated then do the stuff here
        $html='<h2 style="color:#0a58ca">SUCCES!</h2>
                <h4>'.__('We have now received your product information').'.</h4>
                <h4>'.__('You will be notified by email when your product is ready').'.</h4>
                <p>'.__('If you have any questions please contact Sortiment using the livechat or contact us at info@sortiment.dk or +45 30 30 30 30').'</p>';
                //dd($request);
        $data=['message'=>$html];
        return response()->json(['data'=>$data],200);
    }
    public function changeProductStatus($id){
        CustomizeProduct::findOrFail($id)->update(['status' => 'approved']);
            $notification = array(
               'message' => __('Product Approved'),
               'alert-type' => 'success'
           );

           return redirect()->back()->with($notification);
    }
    public function productDeny(Request $request){
        //dd($request->all());
        CustomizeProduct::findOrFail($request->product_id)->update(['status' => 'denied']);
        ProductDeny::insert([
            'deny_text' => $request->deny_text,
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            ]);

        $details = [
                    'deny_text'=>$request->deny_text,                    
                    'product' => CustomizeProduct::where('id',$request->product_id)->value('product_name'),
                    'user' => User::where('id',$request->user_id)->value('name'),
                ];            
                $email='dev12@infoiconsoftware.com';
                Mail::send('mail.cproduct-deny', $details, function($message) use($email) {
                     $message->to($email, 'Sortiment')->subject('produkter Afvist ');
                     $message->from('dev12@infoiconsoftware.com','Sortiment');
                });

        return response()->json(['data'=>''],200);

    }
    public function getEmployee(){
        $employees=Employee::where('user_id',Auth::user()->id)->get();
        $html='';
        foreach($employees as $employee){
            $html.='<li>
                <lable><input type="checkbox" name="employee[{{$row->id}}][]" value="'.$employee->id.'" checked>'.$employee->name.'</lable>
            </li>';
        }
        return response()->json(['data'=>$html],200);
    }
    public function downloadMultiImagePDF($id){
        $data=[];
        //$data['product'] = Product::where([['id',$id],['user_id',Auth::user()->id]])->first();
        $data['product'] = CustomizeProduct::with('mutimage')->where('id',$id)->first();
        //$pdf = PDF::loadView('pdf.imagepdf', $data);
        //return $pdf->download('imagepdf.pdf');
        //echo $id;
        //dd($data['product']->product_thambnail);
        $pdf = PDF::loadView('pdf.imagepdf', $data);
        return $pdf->stream('imagepdf.pdf');
    }
    public function companyImgUploads(Request $request){
        //dd($request->file('images'));
        $this->validate($request,[
            'images' => 'required|mimes:ai,jpg,jpeg,png,svg,pdf|max:10048',
        ]);
        $uerid = Auth::user()->id;
        if($request->hasFile('images')) {
            $file=$request->file('images');
            //@unlink(public_path('uploads/admin_images/'.$request->image));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'),$filename);
            $photo_path='uploads/admin_images/'.$filename;

            DB::table('company_uploads')->insert([
                'user_id'=>$uerid,
                'image'=>$photo_path,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => __('Image upload successfully!'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function companyImgDelete($id){
        //dd($request->file('images'));
        $data=DB::table('company_uploads')->find($id);

        $uerid = Auth::user()->id;
        @unlink(public_path($data->image));
        DB::table('company_uploads')->where('id',$id)->delete();
        $notification = array(
            'message' => __('Image upload successfully!'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
