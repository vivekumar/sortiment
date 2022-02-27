<?php

namespace App\Imports;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Models\AttributeValue;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\CustomizeMultimg;
use App\Models\MultiPriceQty;

use Carbon\Carbon;
use DB;

use App\Models\CustomizeProduct;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CustomizeProductImport implements ToModel, WithValidation, WithHeadingRow
{
    public function rules(): array
    {
        return [
            'product_name' => 'required|unique:customize_products|max:255',
            'product_price' => 'required',
            'product_thambnail' => 'required',
            'name_on_product' => 'required',
            //'category_id' => 'required',
            'brand_id' => 'required',
            'user_id' => 'required',
            //'product_sku' =>'required',
            //'product_pdf' => 'required|pdf|max:9048',
            'request_id'=>'required',
        ];

    }

    public function customValidationMessages()
    {
        return [

            #All Validation for Product
            'product_name.required'    => 'Product name not be empty!',
            'product_name.unique' => 'Please enter unique name',
            //'category_id.required'       => 'This Field is required',
            //'product_sku.required'      => 'This Field is required',
            'brand_id.required'               => 'This Field is required',
            'product_price.required'                    => 'This Field is required',
            'product_thambnail.required'               => 'This Field is required',
            'name_on_product.required'      => 'This Field is required',
            'request_id.required'        => 'This Field is required',
            'user_id.required' => 'This Field is required',
       ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // echo "<pre>"; print_r($row); echo "</pre>"; die;
        $thumb_image_path=$pdf_path='';

        $multiPrice=json_decode($row['multi_price']);
        $multi_img=explode(',',$row['multiple_images']);
        $attributes=json_decode($row['attribute']);//json_encode($row['attribute'])

        //$cate=\App\Models\Category::where('category_name', "like","%".$row['category_id']."%")->first();
        $brand= \App\Models\Brand::where('brand_name',"like","%".$row['brand_id']."%")->first();
        $product= \App\Models\Product::where('product_name',"like","%".$row['request_id']."%")->first();
        $company= \App\Models\User::where('company',"like","%".$row['user_id']."%")->first();
        //return $errors;

        if(!empty($row['product_thambnail'])){
            $url=$row['product_thambnail'];
            $file_arr=explode('/',$url);
            $file_name=end($file_arr);
            $file_name_arr=explode('.',$file_name);
            $file_ext=end($file_name_arr);
            $file_name=time().$file_name_arr[0].'.'.$file_ext;
            $firstarr=current($file_arr);

            $thumb_image_path='uploads/products/images/'.$file_name;
            $thumb_image_spath = public_path($thumb_image_path);

             if($file_arr[0]=="https:"||$file_arr[0]=="http:"){

                file_put_contents($thumb_image_spath, file_get_contents($url));
             }
        }
        if(!empty($row['pdf'])){
            $pdf_url=$row['pdf'];
            $pdf_arr=explode('/',$pdf_url);
            $pdf_name=end($pdf_arr);
            $pdf_name_arr=explode('.',$pdf_name);
            $pdf_ext=end($pdf_name_arr);
            $pdf_name=time().$pdf_name_arr[0].'.'.$pdf_ext;
            
            $firstarr=current($pdf_arr);
            $pdf_path='uploads/products/pdf/'.$pdf_name;
            $pdf_spath = public_path($pdf_path);

            if($pdf_arr[0]=="https:"||$pdf_arr[0]=="http:"){

                file_put_contents($pdf_spath, file_get_contents($pdf_url));
            }
        }


        $product_id = CustomizeProduct::insertGetId([
        //return new Product([
            'product_name' => trim($row['product_name']),
            //'category_id' => $cate->id,
            'product_slug' =>  strtolower(str_replace(' ', '-', $row['product_name'])),
            'product_sku' => $row['sku'],
            'brand_id' => $brand->id,
            'product_price' => $row['product_price'],
            'description' => $row['description'],
            'product_thambnail' =>  $thumb_image_path,
            'product_pdf' => $pdf_path,
            'name_on_product' => $row['name_on_product'],
            'request_id' => $product->id,
            'user_id' => $company->id,
            'status' =>$row['status'],
            'created_at' => Carbon::now(),
            'delevery_days'=> $row['delevery_days'],
            'express_delivery_status'=> $row['express_delivery_status']?$row['express_delivery_status']:NULL,
            'express_delivery_days'=> $row['express_delivery_status'] == 1 ?$row['express_delivery_days']:NULL,
        ]);

        foreach ($attributes as $key=>$attribute) {
            $attribute_data=\App\Models\Attribute::where('attr_name', "like","%".$key."%")->first();
            foreach ($attribute as $attr) {
                $attrvalue= \App\Models\AttributeValue::where('attr_value',"like","%".$attr."%")->first();
                DB::table('customize_product_attributes')->insert([
                    'product_id' => $product_id,
                    'attribute_id' => $attribute_data->id,
                    'attrvalue_id' => $attrvalue->id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        foreach($multi_img as $uploadPath){
            $url=$uploadPath;

            $file_arr=explode('/',$url);
            $file_name=end($file_arr);
            $file_name_arr=explode('.',$file_name);
            $file_ext=end($file_name_arr);
            $file_name=time().$file_name_arr[0].'.'.$file_ext;
            $firstarr=current($file_arr);

            $image_path='uploads/products/images/'.$file_name;
            $image_spath = public_path($image_path);

            if($file_arr[0]=="https:"||$file_arr[0]=="http:"){
                file_put_contents($image_spath, file_get_contents($url));
            }

            CustomizeMultimg::insert([
                'customize_product_id' => $product_id,
                //'photo_name' => $uploadPath,
                'photo_name' => $image_path,
                'created_at' => Carbon::now(),
            ]);
        }

        if(!empty($multiPrice)){

            foreach ($multiPrice as $key=>$pqty) {
                MultiPriceQty::insert([
                    'product_id' => $product_id,
                    'qty' => $pqty->qty,
                    'price' => $pqty->price,
                    'created_at' => Carbon::now(),
                ]);

            }
        }


    }
}
