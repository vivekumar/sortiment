<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomizeProductAttribute;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemAttr;
use App\Models\OrderLabelQty;
use App\Models\OrderEmployee;
use App\Models\OrderProcess;
use App\Models\User;
use Carbon\Carbon;
use App\Exports\NameListExport;
use Auth;use PDF;use Cart;use DB;use Excel;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders=Order::orderBy('id', 'desc');
        if (count($request->all())>0) {

            if(!empty($request->company))
            {
                $orders->where('user_id',$request->company);
            }
        }
        $orders=$orders->get();
        //dd($orders);
        $users=User::get();
        return view('backend.order.list',compact('orders','users'));
    }
    public function view($id){
        $order=Order::where('id',$id)->first();
        $order_process=OrderProcess::where('order_id',$id)->orderBy('date', 'desc')->get();
        return view('backend.order.view',compact('order','order_process'));
    }
    public function updateStatus(Request $request){

        if($request->status=='Payment confirmed'){
            Order::findOrFail($request->order_id)->update(['status'=>$request->status,'payment_confirmed_date'=>Carbon::now()]);
            $desc='Awaiting confirmation...';
            $orderItems=\App\Models\OrderItem::where('order_id',$request->order_id)->get();
            $order = [
                'amount'=>$request->amount,
                'order_number'=>$request->order_number,
                'delivery_costs'=>$request->delivery_costs,
                'id'=>$request->order_id,
                'estimated_delivery_date'=>$request->estimated_delivery_date,
                'order_recieved_date'=>$request->order_recieved_date,
                'address'=>$request->address,
                'pdf'=>$request->pdf,
                'items'=>$orderItems,
            ];

            \Mail::to('dev12@infoiconsoftware.com')->cc($request->email)->send(new \App\Mail\PaymentReceivedMail($order));

        }else if($request->status=='Order being processed'){
            Order::findOrFail($request->order_id)->update(['status'=>$request->status,'order_being_processed_date'=>Carbon::now()]);
            $desc='We are preparing your order.';

            $orderItems=\App\Models\OrderItem::where('order_id',$request->order_id)->get();
            $order = [
                'amount'=>$request->amount,
                'order_number'=>$request->order_number,
                'delivery_costs'=>$request->delivery_costs,
                'id'=>$request->order_id,
                'estimated_delivery_date'=>$request->estimated_delivery_date,
                'order_recieved_date'=>$request->order_recieved_date,
                'address'=>$request->address,
                'pdf'=>$request->pdf,
                'items'=>$orderItems,
            ];
            //dd($order);
            //dd(Auth::user()->email);
            \Mail::to('dev12@infoiconsoftware.com')->cc($request->email)->send(new \App\Mail\OrderProcessingMail($order));

        }else if($request->status=='Shipping order'){
            Order::findOrFail($request->order_id)->update(['status'=>$request->status,'shipping_order_date'=>Carbon::now()]);
            $desc='Your order is being shipped.';
            $orderItems=\App\Models\OrderItem::where('order_id',$request->order_id)->get();
            $order = [
                'amount'=>$request->amount,
                'order_number'=>$request->order_number,
                'delivery_costs'=>$request->delivery_costs,
                'id'=>$request->order_id,
                'order_recieved_date'=>$request->order_recieved_date,
                'address'=>$request->address,
                'tracking_url'=>$request->tracking_url,
                'pdf'=>$request->pdf,
                'items'=>$orderItems,
            ];
            //dd(Auth::user()->email);
            \Mail::to('dev12@infoiconsoftware.com')->cc($request->email)->send(new \App\Mail\ShippingOrderMail($order));

        }else if($request->status=='Order delivered'){
            Order::findOrFail($request->order_id)->update(['status'=>$request->status,'order_delivered_date'=>Carbon::now()]);
            $desc='Your order has been delivered.';
            $orderItems=\App\Models\OrderItem::where('order_id',$request->order_id)->get();
            $order = [
                'amount'=>$request->amount,
                'order_number'=>$request->order_number,
                'delivery_costs'=>$request->delivery_costs,
                'id'=>$request->order_id,
                'order_recieved_date'=>$request->order_recieved_date,
                'address'=>$request->address,
                'pdf'=>$request->pdf,
                'items'=>$orderItems,
            ];
            //dd(Auth::user()->email);
            \Mail::to('dev12@infoiconsoftware.com')->cc($request->email)->send(new \App\Mail\OrderCompletedMail($order));

        }else{
            Order::findOrFail($request->order_id)->update(['status'=>$request->status,'order_recieved_date'=>Carbon::now()]);
            $desc='We have received your order.';

            $orderItems=\App\Models\OrderItem::where('order_id',$request->order_id)->get();
            $order = [
                'amount'=>$request->amount,
                'order_number'=>$request->order_number,
                'delivery_costs'=>$request->delivery_costs,
                'id'=>$request->order_id,
                'estimated_delivery_date'=>\App\Models\Order::where('id',$request->order_id)->value('order_delivered_date'),
                'order_recieved_date'=>\App\Models\Order::where('id',$request->order_id)->value('order_recieved_date'),
                'address'=>$request->address,
                'pdf'=>$request->pdf,
                'items'=>$orderItems,
            ];
            \Mail::to('dev12@infoiconsoftware.com')->cc($request->email)->send(new \App\Mail\OrderConfirmedMail($order));
        }

        OrderProcess::insert([
            'order_id'=>$request->order_id,
            'status'=>$request->status,
            'desc'=>$desc,
            'date' => Carbon::now(),
        ]);
        $notification = array(
            'message' => __('Order Status Updated!'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function updateTracking(Request $request){
        //dd($request);
        Order::where('id',$request->order_id)->update(['tracking_url'=>$request->tracking_url]);
        $notification = array(
            'message' => __('Order Tracking url Updated!'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function updatePDF(Request $request){
        //dd($request);
        $request->validate([
            'order_pdf' => 'required',
        ], [
            'product_name.required' => 'This field is required',
        ]);

        $oldPDF = $request->old_pdf;

        if ($oldPDF && is_file(public_path() . $oldPDF)) {
            unlink($oldPDF);
        }


        if($request->hasFile('order_pdf')){
            $fileName = time().'.'.$request->order_pdf->extension();
            $request->file('order_pdf')->move(public_path('uploads/orders/pdf/'), $fileName);
            $save_url_pdf = 'uploads/orders/pdf/'.$fileName;
            Order::where('id',$request->order_id)->update(['pdf'=>$save_url_pdf,'updated_at' => Carbon::now(),]);
            $notification = array(
                'message' => 'Order PDF Updated!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => __('Something Error!'),
                'alert-type' => 'info'
            );
        }

        return redirect()->back()->with($notification);
    }
    public function pdfRemove($id){
        $prder=Order::find($id);

        $oldpdf = 'public/'.$prder->pdf;
        unlink($oldpdf);

        Order::findOrFail($id)->update([
            'pdf' => '',
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
			'message' => __('Order PDF Remove Successfully'),
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);
    }
    public function downloadPDF($id){
        $data['order'] = Order::where([['id',$id],['user_id',Auth::user()->id]])->first();

        $pdf = PDF::loadView('pdf.invoice', $data);
        //return $pdf->download('invoice.pdf');

        //$pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->stream('invoice.pdf');
    }
    public function orderNameList($orderId,$orderItemid){

        $data=[];


        $orderItems=\App\Models\OrderItem::where('order_id',$orderId)->get();
        $orderItemssubs=\App\Models\OrderLabelQty::where(['order_id'=>$orderId,'order_item_id'=>$orderItemid])->get();


        $orderItemsAttr=DB::table('order_item_attrs')->where(['order_item_id'=>$orderItemid])->get();

        $aatttrr2=[];

        if($orderItemsAttr->count()>0){

            /*$data['label']='Name label';
            foreach($orderItemsAttr as $orderAttr){
                $data[__(\App\Models\Attribute::where('id',$orderAttr->attribute_id)->value('attr_name'))]=\App\Models\Attribute::where('id',$orderAttr->attribute_id)->value('attr_name');
            }
            $data['Quantity']='Quantity';*/
            //dd($orderItemsAttr);
            foreach($orderItemsAttr as $key3=>$orderItemsAttr_1s){
                //dd($data);
                $aatttrr=$orderItemsAttr_1s->attribute_value;
                $aatttrr2[\App\Models\Attribute::where('id',$orderItemsAttr_1s->attribute_id)->value('attr_name')]=explode(',',$aatttrr);
            }

            $j=1;
            foreach($orderItemssubs as $key2=>$orderItemssub){
                //dd($orderItemssub);
                // $data[]=array(
                //     'label'=>$orderItemssub->label,

                // );

                $data[__('Label')][$key2]=$orderItemssub->label;
                foreach($aatttrr2 as $key4=>$aatttr){
                    //print_r($aatttr[$key2]);
                    $data[__($key4)][$key2]=$aatttr[$key2];
                }
                $data[__('Qty')][$key2]=$orderItemssub->aqty;



                $j=$j+1;
            }

            $result     = array();
            $count      = sizeof($data[__('Qty')]);
            foreach($data as $key => $value){
                $result[0][] = $key;
            }


            $counter    = 1;
            for ($i=0; $i < $count; $i++) {
                foreach($data as $key => $value){
                    if (isset($data[$key][$i]))
                    {
                        $result[$counter][] = $data[$key][$i];

                    }else{
                        $result[$counter][] = "";
                    }
                }
                $counter++;

            }


        }


        return Excel::download(new \App\Exports\NameListExport($result), 'NameList.xlsx');


    }
    public function delete($id){
        //dd($id);
        OrderItem::where('order_id',$id)->delete();
        OrderItemAttr::where('order_id',$id)->delete();
        OrderLabelQty::where('order_id',$id)->delete();
        OrderEmployee::where('order_id',$id)->delete();        
        OrderProcess::where('order_id',$id)->delete();
        Order::where('id',$id)->delete();
        $notification = array(
           'message' => __('Order Deleted Successfully'),
           'alert-type' => 'success'
       );
       return redirect()->back()->with($notification);
    }

}
