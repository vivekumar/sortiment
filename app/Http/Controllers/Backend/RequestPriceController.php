<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceRequest;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use DB;use PDF;
class RequestPriceController extends Controller
{
    public function index(Request $request){
        $users=User::latest()->get();
        if(isset($_GET['company'])){
            $user_id=$_GET['company'];
        }
        //$products->where('status','Pending');
        if(!empty($user_id)){
            $products= PriceRequest::with('product')->where('status','Pending')->where('user_id',$user_id)->orderBy('id', 'desc')->get();
        }else{
            $products= PriceRequest::with('product')->where('status','Pending')->orderBy('id', 'desc')->get();
        }
        //dd($products);
        return view('backend.price_request.list',compact('products','users'));
    }
    public function add(Request $request){
        $users=User::latest()->get();

        $products = Product::with('mutimage')->where('status',1)->orderBy('id', 'desc')->get();
        return view('backend.price_request.add',compact('products','users'));
    }
    public function get_upload_images($id){
        //dd($id);
        $allimages = DB::table('company_uploads')->where('user_id',$id)->get();
        $html='';
        foreach($allimages as $allimage){
        $html.='<div class="custom_logo" style="display:inline-block">
                <input type="radio" name="profile_logo" id="cb'.$allimage->id.'" value="'.$allimage->image.'" />
                <label for="cb'.$allimage->id.'" style="display: inline;">
                    <img src="'.asset($allimage->image).'" style="height:100px;width:auto"/>
                </label>
            </div>';
        }

        return response()->json($html,200);
    }
    public function store(Request $request){


        $logo_url='';
        $this->validate($request,[
            'message' => 'required',
            'logo' => 'mimes:eps,ai|max:10048',
        ]);
        if($request->hasFile('logo')){
            $image = $request->file('logo');
           // dd($image);
            $logo_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //Image::make($image)->save('public/uploads/products/logo/'.$logo_gen);//->resize(917,1000)
            move_uploaded_file($_FILES['logo']['tmp_name'], 'public/uploads/products/logo/'.$logo_gen);
            $logo_url = 'public/uploads/products/logo/'.$logo_gen;
        }
        if($request->logo_value){
            $logo_value=implode('|',$request->logo_value);
        }
        if($request->text_value){
            $text_value=implode('|',$request->text_value);
        }
        $product_id = PriceRequest::insertGetId([
            'user_id' => $request->user_id,
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
        if(!empty($product)){
            $product_name=$product->product_name;
        }else{
            $product_name='';
        }

        $details = [
            'product_name'=>$product_name,
            'product_thambnail'=>$product->product_thambnail,
            'text_on_product' =>  $request->text_on_product?$request->text_on_product:0,
            'logo_on_product' => $request->logo_on_product?$request->logo_on_product:0,
            'logo_value' => $logo_value,
            'text_value' => $text_value,
            'message'=>$request->message,
        ];
        //dd($details);
        $email = User::where('id',$request->user_id)->value('email');
        \Mail::to('info@sortiment.dk')->cc($email)->send(new \App\Mail\ProductRequestConfirmationMail($details));
        // if it's correctly validated then do the stuff here

       $notification = array(
			'message' => __('Product Request Inserted Successfully'),
			'alert-type' => 'success'
		);
		return redirect()->back()->with($notification);

    }
    public function view($id){
        $product = PriceRequest::with('product')->where('id',$id)->latest()->first();
        $distincts=[];
        if($product->product_id){
            $distincts = DB::table('product_attributes')->distinct()->select('attribute_id')->where('product_id', '=',$product->product->id)->get();
        }
        return view('backend.price_request.view',compact('product','distincts'));
    }
    public function downloadPDF($id){
        $data=[];
        $data['product'] = PriceRequest::with('product')->where('id',$id)->latest()->first();

        if($data['product']->product_id){
            $data['distincts'] = DB::table('product_attributes')->distinct()->select('attribute_id')->where('product_id', '=',$data['product']->product->id)->get();
        }

        //$pdf = PDF::loadView('pdf.priceRequest', $data);
        //return $pdf->download('priceRequest.pdf');

        $pdf = PDF::loadView('pdf.priceRequest', $data);
        return $pdf->stream('priceRequest.pdf');
    }

}
