<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Models\AttributeValue;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\MultiImg;
use Carbon\Carbon;
use DB;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToModel, WithValidation, WithHeadingRow
{
    public function rules(): array
    {
        return [
            'product_name' => 'required',//|max:255|unique:products
            'product_price' => 'required',
            'product_thambnail' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',

            // 'Name' => 'required|unique:products',//|max:255
            // 'price' => 'required',
            // 'Main Images' => 'required',
            // 'category' => 'required',
            // 'Brand' => 'required',
        ];

    }

    public function customValidationMessages()
    {
        return [

            #All Validation for Product
            'product_name.required'    => 'Product name not be empty!',
            //'product_name.unique' => 'Please enter unique name',
            'category_id.required'       => 'This Field is required',
            //'product_sku.required'      => 'This Field is required',
            'brand_id.required'               => 'This Field is required',
            'product_price.required'                    => 'This Field is required',
            'product_thambnail.required'               => 'This Field is required',


       ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $thumb_image_path=$pdf_path='';
        $multi_img=explode(',',$row['multiple_images']);
        $attributes=json_decode($row['attribute']);//json_encode($row['attribute'])

        $cate=\App\Models\Category::where('category_name', "like","%".$row['category_id']."%")->first();
        $subcate=\App\Models\SubCategory::where('subcategory_name', "like","%".$row['subcategory_id']."%")->first();
        $brand= \App\Models\Brand::where('brand_name',"like","%".$row['brand_id']."%")->first();

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
        $product_slug=strtolower(str_replace(' ', '-', $row['product_name']));
        $product_find=Product::where('product_slug',$product_slug)->first();
        if(!empty($product_find)){
            $product_slug=$product_slug.time();
        } 
        //return $errors;
        $product_id = Product::insertGetId([
        //return new Product([
            'product_name' => trim($row['product_name']),
            'category_id' => $cate->id,
            'subcategory_id' => @$subcate->id?$subcate->id:NULL,
            'product_slug' =>  $product_slug,
            'product_sku' => $row['sku'],
            'brand_id' => @$brand->id?$brand->id:NULL,
            'product_price' => $row['product_price'],
            'description' => $row['description'],
            'product_thambnail' =>  $thumb_image_path,
            'product_pdf' => $pdf_path,
            'status' => 1,
            'created_at' => Carbon::now(),
            'text_on_product'   => $row['text_on_product']?$row['text_on_product']:NULL,
            'logo_on_product'   => $row['logo_on_product']?$row['logo_on_product']:NULL,
            'text_value'        => $row['text_on_product'] == 1?$row['text_value']:NULL,
            'logo_value'        => $row['logo_on_product']==1?$row['logo_value']:NULL,
        ]);
        if(!empty($attributes)){
            foreach ($attributes as $key=>$attribute) {
                $attribute_data=\App\Models\Attribute::where('attr_name', "like","%".$key."%")->first();
                foreach ($attribute as $attr) {
                    //$attrvalue= \App\Models\AttributeValue::where('attr_value',"like","%".$attr."%")->first();
                    $attrvalue= \App\Models\AttributeValue::where('attr_value',$attr)->where('attribute_id',$attribute_data->id)->first();
                    DB::table('product_attributes')->insert([
                        'product_id' => $product_id,
                        'attribute_id' => $attribute_data->id,
                        'attrvalue_id' => $attrvalue?$attrvalue->id:0,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }
        }
        if(!empty($multi_img)){
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

                MultiImg::insert([
                    'product_id' => $product_id,
                    //'photo_name' => $uploadPath,
                    'photo_name' => $image_path,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        //return true;
        //dd($product_id);
    }
}







