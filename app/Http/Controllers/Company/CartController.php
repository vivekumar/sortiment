<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomizeProduct;
use App\Models\MultiPriceQty;
use App\Models\CustomizeProductAttribute;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        //Cart::destroy();
    	$product = CustomizeProduct::findOrFail($id);
        $product_priceqty = MultiPriceQty::where('product_id',$id)->get();

        //dd($product_priceqty);
        //echo $product_priceqty[0]['product_id'];
        //die();
        //dd($request->quantity);
        foreach($product_priceqty as $key=>$value)
        {
            //print_r($key);
            if($request->quantity<$value->qty){
                //$product_price=$value->price;
                $key=$key-1;
                $key = ($key<=0)?0:$key;

                break;
            }

        }
       // echo $request->quantity.'____'.$key;die;
        $product_price= $product_priceqty[$key]->price;
       /* die();
        if($request->quantity<10){
            $product_price=$product->price1;
        }elseif($request->quantity<25){
            $product_price=$product->price2;
        }elseif($request->quantity<50){
            $product_price=$product->price3;
        }elseif($request->quantity<100){
            $product_price=$product->price4;
        }else{
            $product_price=$product->price5;
        }*/

    	//if ($product->discount_price == NULL) {
    		Cart::add([
    			'id' => $id,
    			'name' => $product->product_name,
    			'qty' => $request->quantity,
    			'price' => $product_price,
    			'weight' => 1,
    			'options' => [
    				'image' => $product->product_thambnail,
    				//'color' => $request->color,
    				//'size' => $request->size,
                    'name_on_product'=>$product->name_on_product,
    			],
    		]);

    		//return response()->back()->json(['success' => 'Successfully Added on Your Cart']);
            $notification = array(
                'message' => 'Successfully Added on Your Cart',
                'alert-type' => 'success'
            );

            return redirect()->route('view.cart')->with($notification);

        /*
    	}else{

    		Cart::add([
    			'id' => $id,
    			'name' => $request->product_name,
    			'qty' => $request->quantity,
    			'price' => $product->discount_price,
    			'weight' => 1,
    			'options' => [
    				'image' => $product->product_thambnail,
    				'color' => $request->color,
    				'size' => $request->size,
    			],
    		]);
    		return response()->json(['success' => 'Successfully Added on Your Cart']);
    	}*/

    } // end mehtod
    public function deleteToCart($rowId){
        //Cart::destroy();
        //dd($rowId);
        Cart::remove($rowId);
        $notification = array(
            'message' => __('Successfully deleted on Your Cart'),
            'alert-type' => 'success'
        );

        return redirect()->route('myproduct')->with($notification);
        //return response()->json(['success' => 'Successfully deleted on Your Cart']);
    }
    public function updateCart($rowId,$perm){
        $catinfo=Cart::get($rowId);
        //dd($catinfo);
        if($perm=='plus'){
            $item_qty=$catinfo->qty+1;
        }else{
            $item_qty=$catinfo->qty-1;
        }
        $product = CustomizeProduct::findOrFail($catinfo->id);
        $product_priceqty = MultiPriceQty::where('product_id',$catinfo->id)->get();

        foreach($product_priceqty as $key=>$value)
        {
            if($item_qty<$value->qty){
                //$product_price=$value->price;
                $key=$key-1;
                $key = ($key<=0)?0:$key;
                break;
            }
        }
        $product_price= $product_priceqty[$key]->price;


        /*$item_qry=Cart::count();
        if($perm=='plus'){
            $item_qry=$item_qry+1;
        }else{
            $item_qry=$item_qry-1;
        }*/
        //echo $item_qry;die;
        Cart::update($rowId, ['qty' => $item_qty,'price'=>$product_price]);
        $cartmsg=__('Cart updated');
        $notification = array(
            'message' => $cartmsg,
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function updateCartbulk($rowId,$item_qty){
        $catinfo=Cart::get($rowId);

        $product = CustomizeProduct::findOrFail($catinfo->id);
        $product_priceqty = MultiPriceQty::where('product_id',$catinfo->id)->get();

        foreach($product_priceqty as $key=>$value)
        {
            if($item_qty<$value->qty){
                //$product_price=$value->price;
                $key=$key-1;
                $key = ($key<=0)?0:$key;
                break;
            }
        }
        $product_price= $product_priceqty[$key]->price;
        //echo $item_qry;die;
        Cart::update($rowId, ['qty' => $item_qty,'price'=>$product_price]);
        $cartmsg=__('Cart updated');
        $notification = array(
            'message' => $cartmsg,
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function viewCart() {
        $products = [];

        if (count(Cart::content())) {
            $cart = Cart::content();
            foreach ($cart as $product) {
               // print_r($product);
                $productAttributes = CustomizeProductAttribute::getProductAttributes($product->id);
                if ($product->options->image && is_file(public_path() . $product->options->image)) {
                    $image = asset($product->options->image);
                } else {
                    // set a default image
                    $image = asset('backend/images/logo-dark.png');
                }
                //dd($productAttributes);
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
            }
        }
        //dd($products);
        return view('company.cart', compact('products'));
    }
    public function viewCart1() {
        $products = [];
        $employees=Employee::where('user_id',Auth::user()->id)->get();

        //dd($employees->count());
        if (count(Cart::content())) {
            $cart = Cart::content();
            foreach ($cart as $product) {
                //print_r($product);
               // CartController::updateCartbulk($product->rowId,$employees->count());
                $productAttributes = CustomizeProductAttribute::getProductAttributes($product->id);
                if ($product->options->image && is_file(public_path() . $product->options->image)) {
                    $image = asset($product->options->image);
                } else {
                    // set a default image
                    $image = asset('backend/images/logo-dark.png');
                }
                //dd($productAttributes);
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
            }
        }
        //dd($products);
        return view('company.cart1', compact('products','employees'));
    }
}
