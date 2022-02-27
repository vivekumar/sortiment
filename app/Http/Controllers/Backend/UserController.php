<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\CustomizeProduct;
use App\Models\CustomizeMultimg;
use App\Models\CustomizeProductAttribute;
use Carbon\Carbon;
use App\Models\Order;
class UserController extends Controller
{
    public function index(){
        $users=User::latest()->get();
        //dd($users);
        return view('backend.user.view',compact('users'));
    }
    public function view($id){
        $user=User::where('id',$id)->first();
        $employees=Employee::where('user_id',$id)->get();
        //dd($users);
        return view('backend.user.show',compact('employees','user'));
        //return response()->json($user,200);
    }
    public function employeelist(Request $request){
        $employees=Employee::orderBy('name', 'desc');
        $employees->join('users','users.id','=','employees.user_id');
        $employees->select('users.company as company','employees.*');
        //$users=User::orderBy('name', 'desc');
        if (count($request->all())>0) {

            if(!empty($request->company))
            {
                $employees->where('user_id',$request->company);
            }
        }
        $employees=$employees->get();
        $users=User::latest()->get();
        return view('backend.employee.view',compact('employees','users'));
    }
    public function employeeOrder($id){
        $orderemployeedata=\App\Models\OrderEmployee::where('employee_id',$id)
                                ->join('order_items', 'order_items.id', '=', 'order_employees.order_item_id')
                                ->join('orders', 'orders.id', '=', 'order_employees.order_id')
                                ->join('customize_products', 'customize_products.id', '=', 'order_items.product_id')
                                ->select('customize_products.id as product_id','customize_products.product_name','customize_products.product_thambnail','customize_products.product_slug','orders.order_number','order_employees.*')->get();


       //$orderemployeedata= \App\Models\OrderEmployee::where('employee_id',$id)->get();
        return response()->json($orderemployeedata,200);
    }
    public function employeeOrderStatusChange($id,$status){
        $status2=trim($status);

        $status1='';
        if($status2=="approved"){
            $status1="pending";
        }else{
            $status1="approved";
        }
        $product=\App\Models\OrderEmployee::where('id',$id)->update([
                                    'status'=>$status1,
                                ]);

        return response()->json($status1,200);
    }
    public function activeUser()
    {
        $users = User::whereNull('approved_at')->get();

        return view('users', compact('users'));
    }

    public function approve($user_id)
    {
        $user = User::findOrFail($user_id);
        //dd($user->email);
        //$user->update(['approved_at' => now()]);

        User::where('id',$user_id)->update([
            'approved_at' => Carbon::now()
        ]);//info@sortiment.dk
        $details=[
            'name'=>$user->name,
            'email'=>$user->email,
            'company'=>$user->company,
        ];
        \Mail::to($user->email)->send(new \App\Mail\CompanyApproval($user));
        $notification = array(
            'message' => __('User approved successfully'),
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
    public function unApprove($user_id)
    {
        User::where('id',$user_id)->update(['approved_at' => NULL]);
        $notification = array(
            'message' => __('User unapproved successfully'),
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);

    }
    public function delete($id){

        $employee = Employee::where('user_id',$id)->get();

        if (count($employee)>0) {
            Employee::where('user_id',$id)->delete();
        }
        User::where('id',$id)->delete();
        Order::where('user_id',$id)->delete();
        $products = CustomizeProduct::where('user_id',$id)->get();
        foreach($products as $product){

            unlink(public_path($product->product_thambnail));
            if(!empty($product->product_pdf)){
                unlink(public_path($product->product_pdf));
            }
            $images = CustomizeMultimg::where('customize_product_id',$product->id)->get();
            foreach ($images as $img) {
                unlink(public_path($img->photo_name));
                CustomizeMultimg::where('id',$img->id)->delete();
            }
            CustomizeProductAttribute::where('product_id',$product->id)->delete();
            CustomizeProduct::findOrFail($product->id)->delete();
        }


        $notification = array(
           'message' => __('Product Deleted Successfully'),
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);
    }
}
