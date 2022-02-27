<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\OrderEmployee;
use App\Models\Order;
use App\Models\Admin;
use App\Models\Chat;
use App\Models\ChatEmployeeAdmin;
class EmpDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:employee,employee', 'verified']);
    }

    public function employeeShop(Request $request){

         $products=OrderEmployee::where('employee_id',Auth::user()->id)
                                ->join('order_items', 'order_items.id', '=', 'order_employees.order_item_id')
                                ->join('customize_products', 'customize_products.id', '=', 'order_items.product_id')
                                ->select('customize_products.id as product_id','customize_products.product_name','customize_products.product_thambnail','customize_products.product_slug','order_employees.*');
        if (isset($request->status) && !empty($request->status)) {
            $products->where('order_employees.status',$request->status);            
        }
        if(isset($request->s) && !empty($request->s))
        {
            $search=$request->s;
            $products->Where(function ($query) use($search) {
                $query->where('customize_products.product_name', 'LIKE', "%$search%")
                        ->orwhere('customize_products.product_sku', 'LIKE', "%$search%");
            });

            //$products->where('products.product_name', 'LIKE', "%$request->s%");
            //$products->where('products.product_sku', 'LIKE', "%$request->s%");
        }
        $allemp_orders = $products->get();
        //dd($allemp_orders);
        return view('employee/employees-shop',compact('allemp_orders'));
    }
    public function edit(){

        return view('employee/employee-information');
    }
    public function update(Request $request){


        $uerid = Auth::user()->id;
        if($request->hasFile('profile_photo_path')) {
            $file=$request->file('profile_photo_path');
            if(!empty(Auth::user()->profile_photo_path)){
                @unlink(public_path('uploads/admin_images/'.$request->profile_photo_path));
            }
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'),$filename);
            $profile_photo_path='public/uploads/admin_images/'.$filename;

            $uerDetails = \App\Models\Employee::where('id',$uerid)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'profile_photo_path'=>$profile_photo_path,
                //'password'=>Hash::make($request->password),
            ]);
        }else{
            $uerDetails = \App\Models\Employee::where('id',$uerid)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                //'password'=>Hash::make($request->password),
            ]);
        }
        $notification = array(
            'message' => __('Successfully update info.'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
    public function updatePassword(Request $request){

        $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ],[
            'password.required' =>'Password is required!',
            'password_confirmation.required' =>'Password is required!',
        ]);

        $uerid = Auth::user()->id;


        $uerDetails = \App\Models\Employee::where('id',$uerid)->update([
            'password'=>Hash::make($request->password),
        ]);

    $notification = array(
        'message' => __('Successfully update password.'),
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
    }
    public function viewdetail($id){
        $product=OrderEmployee::where('order_employees.id',$id)
                                ->join('order_items', 'order_items.id', '=', 'order_employees.order_item_id')
                                ->join('customize_products', 'customize_products.id', '=', 'order_items.product_id')
                                ->select('customize_products.id as product_id','customize_products.product_name','customize_products.product_thambnail','customize_products.product_slug','customize_products.name_on_product','order_employees.*')
                            ->first();
        //dd(Auth::user()->user_id);

        return view('employee/employees-single-product',compact('product'));
    }
    public function postdetail(Request $request){

        //DB::enableQueryLog();
        $product=OrderEmployee::where('id',$request->order_emp_id)->update([
                                    'color'=>$request->Color?$request->Color:'',
                                    'size'=>$request->Size?$request->Size:'',
                                    'label'=>$request->label?$request->label:'',
                                    'status'=>'approved',
                                ]);

        $company_details=\App\Models\User::where('id',Auth::user()->user_id)->first();
        $details = [
            'name' => $request->product_name,
            'color'=>$request->Color?$request->Color:'',
            'size'=>$request->Size?$request->Size:'',
            'label'=>$request->label,
            'product_thambnail'=>$request->product_thambnail,
            'company_user_name'=>$company_details->name,
        ];
        //$email=\App\Models\Employee::where('id',$request->employee_id)->value('email');
        //dd(Auth::user()->email);
        \Mail::to(Auth::user()->email)->send(new \App\Mail\EmployeeProductInformationConfirmedMail($details));
        //$quries = DB::getQueryLog();
        //dd($quries);


        return redirect()->back()->with('message', __('Thanks for update details!'));
    }

    public function askAquestion()
    {
        $admins = Admin::all();

        return view('employee.ask-question', compact('admins'));
    }

    public function askAquestionChat($admin_id)
    {
        $admin_id = (int)$admin_id;
        $employee = Auth::user();
        $admin = Admin::find($admin_id);

        if (!is_file(public_path() . $admin->profile_photo_path)) {
            $admin->profile_photo_path = 'uploads/admin_images/202106040505avatar-1.png';
        }

        if (!is_file(public_path() . $employee->profile_photo_path)) {
            $employee->profile_photo_path = 'uploads/admin_images/202108070638user-img.png';
        }

        $chats = ChatEmployeeAdmin::where('employee_id', '=', $employee->id)->where('admin_id', '=', $admin_id)->orderBy('id', 'ASC')->get();

        return view('employee.ask-question-form', compact('employee', 'admin', 'chats'));
    }
    public function askAquestionChatCompany($com_id)
    {
        $user_id = (int)$com_id;
        $user = Auth::user();
        $admin = Admin::find($user_id);

        if (!is_file(public_path() . $admin->profile_photo_path)) {
            $admin->profile_photo_path = 'uploads/admin_images/202106040505avatar-1.png';
        }

        if (!is_file(public_path() . $user->profile_photo_path)) {
            $user->profile_photo_path = 'uploads/admin_images/202108070638user-img.png';
        }

        $chats = Chat::where('user_id', '=', $user->id)->where('user_id', '=', $user_id)->orderBy('id', 'ASC')->get();

        return view('employee.ask-question-form', compact('user', 'admin', 'chats'));
    }


}
