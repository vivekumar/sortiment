<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomizeProductAttribute extends Model
{
    use HasFactory;

    public static function getProductAttributes(int $productId): array
    {
        $productAttributes = [];
        $query = DB::table('customize_product_attributes')->where('product_id', $productId)->get();

        if ($query->count()) {
            foreach ($query as $row) {
                $attribute = Attribute::find($row->attribute_id);
                
                if (!isset($productAttributes[$row->attribute_id])) {
                    $productAttributes[$row->attribute_id] = [
                        'attribute_id' => $row->attribute_id,
                        'name' => $attribute->attr_name
                    ];
                }

                if (!isset($productAttributes[$row->attribute_id]['values'])) {
                    $productAttributes[$row->attribute_id]['values'] = [];
                }

                $attribute_value = AttributeValue::find($row->attrvalue_id);

                $productAttributes[$row->attribute_id]['values'][] = [
                    'attribute_value_id' => $attribute_value->id,
                    'attribute_id' => $attribute_value->attribute_id,
                    'value' => $attribute_value->attr_value
                ];

            }
        }
        
        return $productAttributes;
    }
}
