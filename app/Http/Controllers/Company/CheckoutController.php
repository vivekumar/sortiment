<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Models\CustomizeProduct;
//use App\Models\MultiPriceQty;
use App\Models\CustomizeProductAttribute;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemAttr;
use App\Models\OrderLabelQty;
use App\Models\OrderEmployee;
use App\Models\OrderProcess;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Company\CartController;
use Carbon\Carbon;use Session;
class CheckoutController extends Controller
{
    public function checkout(Request $request){
        $input = $request->all();

        if(count(Cart::content()) <= 0){
            return redirect()->back();
        }
        $products = [];$userinfo=(object)[];
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'zip'=>'required',
            'address'=>'required',
        ],[
            'name.required' =>__('This field is required'),
            'email.required' =>__('This field is required'),
            'phone.required' =>__('This field is required'),
            'zip.required' =>__('This field is required'),
            'address.required' =>__('This field is required'),
        ]);
        //dd($request);
        if (count(Cart::content())) {
            $cart = Cart::content();
            foreach ($cart as $product) {
                //dd($product);
                $productAttributes = CustomizeProductAttribute::getProductAttributes($product->id);
                if ($product->options->image && is_file(public_path() . $product->options->image)) {
                    $image = asset($product->options->image);
                } else {
                    // set a default image
                    $image = asset('backend/images/logo-dark.png');
                }
                $totalqty= 0;$totleEmployee=0;



                if(array_key_exists('qty',$input)){
                    if(isset($request->qty[$product->id]) && !empty($request->qty[$product->id])){
                        //if(array_key_exists($request->qty[$product->id],$input['qty'])){

                            //$totalqty=count($request->qty[$product->id]);
                            foreach($request->qty[$product->id] as $key=>$product_qry){

                                if($product_qry==''){
                                        $totalqty = $totalqty + 0;
                                }
                                else{
                                    $totalqty = $totalqty + $product_qry ;
                                }

                            }
                        //}

                    }



                }
                if(array_key_exists('employee',$input)){
                    if(isset($request->employee[$product->id]) && !empty($request->employee[$product->id])){
                        $totleEmployee=count($request->employee[$product->id]);
                    }
                }
                $totalqty=$totalqty+$totleEmployee;

                $result = (new CartController)->updateCartbulk($product->rowId,$totalqty);
                if(array_key_exists('qty',$input)){
                $products[] = [
                    'product_id'    => $product->id,
                    'qty'           => $product->qty,
                    'name'          => $product->name,
                    'price'         => $product->price,
                    'weight'        => $product->weight,
                    'image'         => $image,
                    'attributes'    => $productAttributes,
                    'name_on_product'=>$product->options->name_on_product,

                ];
                }else{
                    $products[] = [
                        'product_id'    => $product->id,
                        'qty'           => $totalqty,//$product->qty,
                        'name'          => $product->name,
                        'price'         => $product->price,
                        'weight'        => $product->weight,
                        'image'         => $image,
                        'attributes'    => $productAttributes,
                        'name_on_product'=>$product->options->name_on_product,

                    ];
                }
            }
            //die;
            $userinfo->name=$request->name;
            $userinfo->email=$request->email;
            $userinfo->phone=$request->phone;
            $userinfo->company=$request->company;
            $userinfo->zip=$request->zip;
            $userinfo->address=$request->address;

        }
        return view('company.checkout', compact('products','userinfo','input','request'));
    }
    public function payments(Request $request){
            //$vals = array_count_values($request->product_attribute[12][2]);
            //$vals = array_unique($request->product_attribute[12][2]);
            //print($vals);
            //dd($request->product_attribute[12][2]);
        if(count(Cart::content())>0){
            $orderItemArr=[];$cvr_no=$ean_no='';
            $input = $request->all();
            $getMaxData = Order::orderBy('id', 'desc')->first();
            ///echo "<pre>";
            $year = Carbon::now()->year;
            $month = Carbon::now()->month;
            $day = Carbon::now()->day;
            if($getMaxData===null){
                $orderId = $year.$month.'1';
                $invoiceId = "inv".$year.$month.'1';
            }else{
                $orderId =  $year.$month.$getMaxData->id;
                $invoiceId = "inv".$year.$month.$getMaxData->id;
            }
            if($request->payment_method=="Invoice"){
                $cvr_no=$request->cvr_no;
            }else{
                $ean_no=$request->ean_no;
            }

            /*$weekMap = [
                0 => 'SU',
                1 => 'MO',
                2 => 'TU',
                3 => 'WE',
                4 => 'TH',
                5 => 'FR',
                6 => 'SA',
            ];
            $dayOfTheWeek = Carbon::now()->dayOfWeek;
            $weekday = $weekMap[$dayOfTheWeek];*/

            $today = Carbon::now();
            //dd($today->hour);
            $weekday=strtoupper(substr($today->format('l'), 0, 2));

            //return $estimated_delivery_date;
            $orderID=Order::insertGetId([
                'user_id'=>Auth::user()->id,
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'company'=>$request->company,
                'post_code'=>$request->zip,

                'payment_method'=>$request->payment_method,
                'cvr_no'=>$cvr_no,
                'ean_no'=>$ean_no,
                //'bank_account_no'=>$request->bank_account_no,
                'ref_no' =>$request->ref_no?$request->ref_no:'',
                'currency'=>'DKK',
                'amount'=>Cart::total(),
                'delivery_costs'=>$request->delivery_costs,
                'order_number'=>$orderId,
                'invoice_no'=>$invoiceId,
                'order_date'=>$day,
                'order_month'=>$month,
                'order_year'=>$year,
                
                'order_recieved_date'=>Carbon::now(),
                'status' =>'Order recieved',
            ]);
            foreach(Cart::content() as $key=>$row){
                //dd($request->estimated_delivery_date);
                $item_total_cost=$row->price*$row->qty;
                if($request->delivery_method[$row->id][0]=="Standard"){
                    $delivery_date= Carbon::createFromFormat('d-m-Y', $request->estimated_delivery_date[$row->id][0])
                    ->format('Y-m-d').' '.date('H:i:s');
                    $estimated_delivery_date=$delivery_date;
                    $delivery_costs=0;
                }/*elseif($request->delivery_method[$row->id][0]=="Express 72"){
                    if($weekday=='FR'){
                        $estimated_delivery_date=$today->addDays(5);
                    }elseif($weekday=='TH'){
                        $estimated_delivery_date=$today->addDays(5);
                    }elseif($weekday=='WE'){
                        $estimated_delivery_date=$today->addDays(5);
                    }else{
                        $estimated_delivery_date=$today->addDays(3);
                    }
                    $delivery_costs=($item_total_cost*25)/100;

                }elseif($request->delivery_method[$row->id][0]=="Express 48"){
                    if($weekday=='FR'){
                        $estimated_delivery_date=$today->addDays(4);
                    }elseif($weekday=='TH'){
                        $estimated_delivery_date=$today->addDays(4);
                    }else{
                        $estimated_delivery_date=$today->addDays(2);
                    }
                    $delivery_costs=($item_total_cost*50)/100;
                }
                else{
                    if($weekday=='FR'){
                        $estimated_delivery_date=$today->addDays(3);
                    }else{
                        $estimated_delivery_date=$today->addDays(1);
                    }
                    $delivery_costs=($item_total_cost*100)/100;
                }*/
                else{

                    $estimated_delivery_date=Carbon::createFromFormat('d-m-Y', $request->estimated_delivery_date2[$row->id][0])
                    ->format('Y-m-d').' '.date('H:i:s');

                    $delivery_costs=($item_total_cost*100)/100;
                }

                $orderItem=OrderItem::insertGetId([
                    'order_id'=>$orderID,
                    'product_id'=>$row->id,
                    'product_name'=>$row->name,
                    'price'=>$row->price,
                    'qty'=>$row->qty,
                    'estimated_delivery_date'=>$estimated_delivery_date,
                    'delivery_method'=>$request->delivery_method[$row->id][0],
                    'uploadExcel'=>@$request->uploadExcel[$row->id][0]?$request->uploadExcel[$row->id][0]:0,
                    'delivery_costs'=>$delivery_costs
                ]);
                $orderItemArr[]=[
                    'id'=>$orderItem,
                    'order_id'=>$orderID,
                    'product_id'=>$row->id,
                    'price'=>$row->price,
                    'qty'=>$row->qty,
                    'estimated_delivery_date'=>$estimated_delivery_date,
                ];
                //$attrArray=[];
                //print_r($request->product_attribute[$row->id]);

                if(array_key_exists('qty',$input)){
                    if(isset($request->qty[$row->id]) && !empty($request->qty[$row->id])){
                    for ($count = 0; $count < count($request->qty[$row->id]); $count ++)
                        {

                            OrderLabelQty::insertGetId([
                                'order_id'=>$orderID,
                                'order_item_id'=>$orderItem,
                                'label'=>@$request->lable[$row->id][$count]?$request->lable[$row->id][$count]:'',
                                'aqty'=>$request->qty[$row->id][$count],
                                'created_at' => Carbon::now(),
                            ]);


                        }
                        if (isset($request->product_attribute[$row->id])){


                        foreach ($request->product_attribute[$row->id] as $key1=>$attribute){
                            //echo $request->product_attribute[$row->id][$key1][$count]."<br>";
                            $attrValue = implode(',',$request->product_attribute[$row->id][$key1]);
                            OrderItemAttr::insertGetId([
                                'order_id'=>$orderID,
                                'order_item_id'=>$orderItem,
                                'attribute_id'=>$key1,
                                'attribute_value'=>$attrValue,
                                'created_at' => Carbon::now(),
                            ]);
                        }}
                    }
                }
                if(array_key_exists('employee',$input)){
                    if(isset($request->employee[$row->id]) && !empty($request->employee[$row->id])){
                        foreach($request->employee[$row->id] as $emp_id){
                            OrderEmployee::insertGetId([
                                'order_id'=>$orderID,
                                'order_item_id'=>$orderItem,
                                'employee_id'=>$emp_id,
                                'employee_name'=>\App\Models\Employee::where('id',$emp_id)->value('name'),
                                //'color'=>$attrValue,
                                //'size'=>$attrValue,
                                'status' =>'pending',
                                'created_at' => Carbon::now(),
                            ]);

                            $details = [
                                'name' => $row->name,
                                'company'=>Auth::user()->company,
                                'company_user_name'=>Auth::user()->name,
                                'product_thambnail'=>$row->options->image,
                            ];
                            $email=\App\Models\Employee::where('id',$emp_id)->value('email');
                            \Mail::to($email)->send(new \App\Mail\EmployeeProductInformationMail($details));
                        }
                    }
                }

            }
            //echo $key1;
            OrderProcess::insert([
                'order_id'=>$orderID,
                'status'=>'Order recieved',
                'desc'=>'We have received your order.',
                'date' => Carbon::now(),
            ]);




            $order = [
                'amount'=>Cart::total(),
                'order_number'=>$orderId,
                'invoice_no'=>$invoiceId,
                'estimated_delivery_date'=>$estimated_delivery_date,
                'order_recieved_date'=>Carbon::now(),
                'address'=>$request->address,
                'items'=>$orderItemArr,
                'delivery_costs'=>$request->delivery_costs,
            ];
            //$email=\App\Models\Employee::where('id',$emp_id)->value('email');
            \Mail::to('dev12@infoiconsoftware.com')->cc(Auth::user()->email)->send(new \App\Mail\OrderConfirmedMail($order));

            Cart::destroy();
            return redirect()->route('order.details',$orderID);
        }else{
            $notification = array(
                'message' => __('Empty cart!'),
                'alert-type' => 'success'
            );
            return redirect()->route('view.cart')->with($notification);
        }
    }

}
