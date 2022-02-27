<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Employee;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Excel;use DB;
use App\Imports\EmployeeImport;
use App\Imports\NameListImport;
use App\Models\CustomizeProduct;

use App\Models\OrderEmployee;
//use App\Models\Order;

class EmployeeController extends Controller
{
    public function yourEmployees()
    {
        $user = Auth::user();
        $employees = Employee::where('user_id',$user->id)->get();
        $seo['metaTitle']='Mine medarbejdere';
        $seo['metaDescription']="";
        $seo['metaTag']="";
        return view('company.your-employee', compact('employees','seo'));
    }
    public function view($id){
        $user = Auth::user();
        $employee = Employee::find($id);
        $employees = Employee::where('user_id',$user->id)->get();
        $products_approve=OrderEmployee::where(['employee_id'=>$id,'order_employees.status'=>'approved'])
                                ->join('order_items', 'order_items.id', '=', 'order_employees.order_item_id')
                                ->join('customize_products', 'customize_products.id', '=', 'order_items.product_id')
                                ->select('customize_products.id as product_id','customize_products.product_name','customize_products.product_thambnail','customize_products.product_slug','order_employees.*')->get();
        $products_pending=OrderEmployee::where(['employee_id'=>$id,'order_employees.status'=>'pending'])
                                ->join('order_items', 'order_items.id', '=', 'order_employees.order_item_id')
                                ->join('customize_products', 'customize_products.id', '=', 'order_items.product_id')
                                ->select('customize_products.id as product_id','customize_products.product_name','customize_products.product_thambnail','customize_products.product_slug','order_employees.*')->get();
        //dd($products_pending);
        return view('company.employee-order', compact('employee', 'employees','products_approve','products_pending'));
    }
    public function create(Request $request)
    {
        $employees = $request->get('employee');
        $errors = [];

        $success = false;

        foreach ($employees as $key => $employee) {
            if (trim($employee['name']) == '') {
                $errors[$key]['name'] = __('Name is required!');
            }

            if (!filter_var($employee['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[$key]['email'] = __('Enter a valid email!');
            }

            $existing = Employee::where('email', $employee['email'])->where('user_id', Auth::user()->id);

            if ($existing->count()) {
                $errors[$key]['email'] = __('This email is already added!');
            }
        }

        if (!$errors) {
            $success = true;
            foreach ($employees as $key => $employee) {
                $name = explode(' ', $employee['name']);
                $password_string = ucfirst($name[0]) . '@1234';

                $empObj = new Employee();
                $empObj->name = $employee['name'];
                $empObj->email = $employee['email'];
                $empObj->user_id = Auth::user()->id;
                $empObj->status = 1;
                $empObj->password = Hash::make($password_string);
                $empObj->save();

                $details = [
                    'email'=>$employee['email'],
                    'password'=>$password_string,
                    'company'=>Auth::user()->company
                ];
                //$email=\App\Models\Employee::where('id',$emp_id)->value('email');
                \Mail::to($employee['email'])->cc(Auth::user()->email)->send(new \App\Mail\EmployeeLoginMail($details));
            }
        }

        return response()->json(['errors' => $errors, 'success' => $success]);
    }

    public function edit(Request $request, $id)
    {   $user = Auth::user();
        $employee = Employee::find($id);

        $error = [];

        if ($employee && $employee->user_id != $user->id) {
            return redirect('yourEmployees');
        }

        if ($request->isMethod('POST')) {
            $file = $request->file('profile_photo_path');

            $post = $request->input();

            $post['password'] = trim($post['password']);
            $post['confirm_password'] = trim($post['confirm_password']);

            if (strlen(trim($post['name'])) < 5) {
                $error['name'] = __('Name should have at least 5 characters!');
            }

            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                $error['email'] = __('Invalid email!');
            }

            $existing_employee_email  = Employee::where('user_id', $user->id)->where('email', $post['email'])->where('id', '<>', $id)->get();

            if ($existing_employee_email->count()) {
                $error['email'] = __('This email is already used for another employee, please choose different!');
            }

            if ($post['password'] && strlen($post['password']) < 4) {
                $error['password'] = __('Password should have at least 4 characters!');
            }

            if ($post['password'] && ($post['password'] != $post['confirm_password'])) {
                $error['confirm_password'] = __('Confirm Password must be same as password!');
            }

            if (!$error) {
                $employee->name = trim($post['name']);
                $employee->email = $post['email'];
                if(isset($post['status']) && !empty($post['status'])){
                    $employee->status = $post['status'];
                }else{
                    $employee->status = 0;
                }
                if ($post['password']) {
                    $employee->password = Hash::make($post['password']);
                }

                // Upload profile photo
                if ($file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('frontend/img/'), $fileName);
                    $employee->profile_photo_path = 'frontend/img/' . $fileName;
                }

                $employee->save();
                Session::flash('message', __('You have updated employee successfully!'));


                return redirect('/company/your-employees');
            }
        }

        return view('company.edit-employee', compact('employee', 'error'));
    }

    public function delete($id)
    {
        $employee = Employee::find($id);

        if ($employee->user_id == Auth::user()->id) {
            $employee->delete();

            Session::flash('message', 'Medarbejderen er blevet slettet.');
        }

        return redirect('/company/your-employees');
    }
    public function uploadFile(Request $request){

        $data = array();

        $validator = Validator::make($request->all(), [
           'file' => 'required|mimes:xlsx|max:2048'
        ]);

        if ($validator->fails()) {

           $data['success'] = 0;
           $data['error'] = $validator->errors()->first('file');// Error response

        }else{
           if($request->file('file')) {

               $file = $request->file('file');

               Excel::import(new EmployeeImport,$request->file('file'));
               // Response
               $data['success'] = 1;
               $data['message'] = 'Upload Successfully!';
           }else{
               // Response
               $data['success'] = 2;
               $data['message'] = __('File not uploaded.');
           }
        }

        return response()->json($data);
    }
    public function uploadList(Request $request){

        $data = array();

        $validator = Validator::make($request->all(), [
           'file' => 'required|mimes:xlsx|max:2048'
        ]);

        if ($validator->fails()) {

           $data['success'] = 0;
           $data['error'] = $validator->errors()->first('file');// Error response

        }else{
           if($request->file('file')) {

               $file = $request->file('file');
                //dd($file);
               //$data=Excel::import(new NameListImport,$request->file('file'));
               $data=Excel::toArray(new NameListImport,$request->file('file'));

               //$data = Excel::load($file, function($reader) {})->get();
                $product_data=CustomizeProduct::where('id',$request->pid)->value('name_on_product');
                $attrs=DB::table('customize_product_attributes')->select('attribute_id')->where('product_id',$request->pid)->groupby('attribute_id')->distinct()->get();
                foreach($attrs as $attr ){

                    $data[\App\Models\Attribute::where('id',$attr->attribute_id)->value('attr_name')] = $attr->attribute_id;
                }
                //SELECT distinct attribute_id FROM `customize_product_attributes` where product_id in (2)

               // Response
               $data['label'] = $product_data;
               $data['data'] = $data[0];
               $data['pid'] = $request->pid;

                Session::put('uploadExcel', 1);

               $data['success'] = 1;
               $data['message'] = __('Upload Successfully!');
           }else{
               // Response
               $data['success'] = 2;
               $data['message'] = __('File not uploaded.');
           }
        }

        return response()->json($data);
    }
    public function showpopEmpHtml($id){
        $product=OrderEmployee::where('order_employees.id',$id)
                                ->join('order_items', 'order_items.id', '=', 'order_employees.order_item_id')
                                ->join('customize_products', 'customize_products.id', '=', 'order_items.product_id')
                                ->select('customize_products.id as product_id','customize_products.product_name','customize_products.product_thambnail','customize_products.product_slug','customize_products.name_on_product','order_employees.*')
                            ->first();
        //dd($product);
        $html='<div class="select-product-type"><h3>'.$product->product_name.'</h3><form action="'.route('emp.order.approve').'" method="post">
        <input type="hidden" name="_token" value="'.csrf_token().'" />
        <input type="hidden" name="order_emp_id" value="'.$product->id.'">
        <input type="hidden" name="employee_id" value="'.$product->employee_id.'">
        <input type="hidden" name="product_name" value="'.$product->product_name.'">


        <input type="hidden" name="product_thambnail" value="'.$product->product_thambnail.'">';
        if($product->name_on_product=='yes'){
        $html.='<div class="form-group">
            <input type="text" class="form-control" name="label" placeholder="Indtast navn" value="'.$product->label.'" required>
        </div>';
        }
        $distincts = DB::table('customize_product_attributes')->distinct()->select('attribute_id')->where('product_id', '=',$product->product_id)->get();
        //$product_attribute=array('Color'=>$product->color,'Size'=>$product->size);
        //echo $product_attribute['Color'];
        foreach($distincts as $distinct){
            //$attributs=DB::table('customize_product_attributes')->where('product_id',$product->product_id)->where('attribute_id',$distinct->attribute_id)->get();

            $attributs=DB::table('customize_product_attributes')
            ->select('customize_product_attributes.id','customize_product_attributes.product_id','customize_product_attributes.attribute_id','customize_product_attributes.attrvalue_id','attribute_values.attr_order')
            ->join('attribute_values','attribute_values.id','=','customize_product_attributes.attrvalue_id')
            ->where(['customize_product_attributes.product_id' => $product->product_id, 'customize_product_attributes.attribute_id' => $distinct->attribute_id])
            ->orderBy('attribute_values.attr_order')
            ->get();


            $html.= '<div class="form-group"><select name="'.\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name').'" class="form-control" required><option value="">Select '.__(\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name')).'</option>';
            $attrselected = $product->{lcfirst(\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name'))};

            foreach($attributs as $attribut){
                //echo "<pre>";
                //print_r($attribut->attrvalue_id);
                //die();
                $attr_value=\App\Models\AttributeValue::where('id',$attribut->attrvalue_id)->value('attr_value');
                $html.= '<option value="'.$attr_value.'"';
                if($attr_value==$attrselected){
                    $html.='selected';
                }
                $html.= ' >'.$attr_value.'</option>';
            }
            $html.= "</select></div>";
        }


        $html.='<div class="form-group">
            <button class="btn btn-blue">Godkend</button>
        </div>
    </form></div>';

    return response()->json($html);
    }

    public function empOrderApprove(Request $request){
        //dd($request);
        //DB::enableQueryLog();
        $product=OrderEmployee::where('id',$request->order_emp_id)->update([
                                    'color'=>$request->Color?$request->Color:'',
                                    'size'=>$request->Size?$request->Size:'',
                                    'label'=>$request->label,
                                    'status'=>'approved',
                                ]);

        //$company_details=\App\Models\User::where('id',Auth::user()->id)->first();
        $details = [
            'name' => $request->product_name,
            'color'=>$request->Color?$request->Color:'',
            'size'=>$request->Size?$request->Size:'',
            'label'=>$request->label,
            'product_thambnail'=>$request->product_thambnail,
            'company_user_name'=>Auth::user()->name,
        ];
        //$email=\App\Models\Employee::where('id',$request->employee_id)->value('email');
        //dd(Auth::user()->email);
        \Mail::to(Auth::user()->email)->send(new \App\Mail\EmployeeProductInformationConfirmedMail($details));
        //$quries = DB::getQueryLog();
        //dd($quries);
        return redirect()->back()->with('message', __('Thanks for update details!'));
        //$data='Update successfully!';
        //return response()->json($data);
    }
}
