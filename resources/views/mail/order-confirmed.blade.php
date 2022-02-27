<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
    <meta name="viewport" content="">
    <title>{{__('Order confirmation')}}</title>
    <style>
        @media (max-width:  768px){
            tfoot {
                padding: 0 15px;    
                width: 96%;            
            }
            tfoot, tfoot tr, tfoot tr td {
                display: block!important;
                text-align: center!important;
                width: 96%!important;
            }

            tfoot tr td img{
                margin: 0 auto!important;
            }
            tfoot tr td a, tfoot tr td h2, tfoot tr td p{
                text-align: center!important;
                display: block!important;
            }
            .fs-20 {
                font-size: 20px!important;
            }
            tfoot tr td p{
                padding-bottom: 15px;
            }
            tfoot tr td:last-child {
                display: inline-block!important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">
    @php
        $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
    @endphp
    <table cellspacing="0" cellpadding="0" style="max-width: 800px; width: 100%; margin: 0 auto 0 auto;">
        <thead>
            <tr>
                <th  colspan="3" style="padding: 10px 0;">
                    <a href="{{url('/')}}"><img src="{{ $message->embed('public/frontend/mail/img/sortiment-logo.png')}}" width="150" alt="logo"></a>
                </th>
            </tr>
        </thead>
        <tr>
            <td colspan="3">
                <table style="width: 100%; text-align: center; background-color: #001FD1; padding: 20px;">
                    <tr>
                        <td class="fs-20" style="font-size: 30px; font-weight: 600; color: #ffffff; padding-bottom: 15px;">
                            {{__('Order confirmation')}}
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #ffffff; font-size: 17px;">
                            {{__('We have now received your order')}}.  {{--__('you will receive an email every time your order goes to the next step in the process')--}}
                        </td>
                    </tr>
                </table><!-- banner -->
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table style="padding: 50px 15px; width: 100%;">
                    <tr>
                        <td style="padding-right:10px">
                            <table style="width: 100%;">
                                @foreach($order['items'] as $items)
                                <tr>
                                    <td valign="top">
                                        <img src="{{ $message->embed('public/'.\App\Models\CustomizeProduct::where('id',$items['product_id'])->value('product_thambnail') )}}" width="150px" alt="">
                                    </td>

                                    <td valign="top">
                                        <h3 style="margin: 0;">{{\App\Models\CustomizeProduct::where('id',$items['product_id'])->value('product_name')}}</h3>
                                        <p><strong>{{$items['qty']}} stk.</strong></p>
                                        @php
                                            $orderItemsAttr=DB::table('order_item_attrs')->where('order_item_id',$items['id'])->get();
                                        @endphp
                                        @foreach($orderItemsAttr as $orderAttr)
                                        
                                            @php     
                                                $newarrayattr=explode(',',$orderAttr->attribute_value); 
                                                $vals = array_count_values($newarrayattr);                      
                                                
                                                $arrattrubute=$attributs=[];
                                                $z=0;
                                                
                                            @endphp

                                            @foreach($vals as $keyyy=>$vvv)
                                                @php
                                                $attributs[]=DB::table('attribute_values')
                                                ->select('attr_value','attr_order')
                                                ->where('attr_value',$keyyy)
                                                ->orderBy('attr_order')
                                                ->first();                                                             
                                                @endphp
                                            @endforeach

                                            @foreach($vals as $keyyy=>$vvv)
                                                @php
                                                
                                                    //$arrattrubute[]=$vvv.' x '.$keyyy;
                                                    $arrattrubute[]=array(
                                                        'count'=>$vvv,
                                                        'value'=>$keyyy,
                                                        'order'=>$attributs[$z]->attr_order
                                                    );
                                                $z=$z+1;                                
                                                @endphp
                                            @endforeach
                                            @php   
                                             

                                            $columns = array_column($arrattrubute, 'order');
                                            array_multisort($columns, SORT_ASC, $arrattrubute);
                                            
                                            //print_r($arrattrubute);

                                               //$final=1;//implode(',',$arrattrubute);
                                            @endphp

                                            <p><strong>{{__(\App\Models\Attribute::where('id',$orderAttr->attribute_id)->value('attr_name'))}}:</strong> </p>
                                            <ul>
                                                @foreach($arrattrubute as $value111)
                                                <li>{{$value111['count']}} x {{$value111['value']}}</li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                        <!--<p><strong style="font-size: 18px;">Size:</strong> 1S · 2M · 2L · 5XL</p>-->
                                        <p><strong style="font-size: 18px;"><small style="color: #001FD1; font-size: 18px;">{{__('Item costs')}}:</small> {{$formatter->formatCurrency($items['price'], 'DKK'), PHP_EOL;}}</strong></p>
                                        <h3 style="margin: 15px 0 0; color: #001FD1;">{{__('Estimated delivery date')}}:</h3>
                                        <p style="margin-top: 5px;">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $items['estimated_delivery_date'])->format('d. F');}}</p>
                                    </td>

                                </tr>
                                @endforeach

                            </table>
                        </td>

                        <td valign="top">
                            <table style="width: 100%;">
                                <tr>
                                    <td valign="top">
                                        <h3 style="margin: 0; color: #001FD1;">{{__('Delivery address')}}:</h3>
                                        <p style="margin-top: 5px;">{{$order['address']}}</p>
                                        <h3 style="margin: 15px 0 0; color: #001FD1;">{{__('Delivery costs')}}:</h3>
                                        <p style="margin-top: 5px;">{{$formatter->formatCurrency($order['delivery_costs'], 'DKK'), PHP_EOL;}}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p><strong style="font-size: 18px;"><small style="color: #001FD1; font-size: 18px;">{{__('Total costs')}}:</small> @php $totalAmt=$order['amount']+$order['delivery_costs'];@endphp {{$formatter->formatCurrency($totalAmt, 'DKK'), PHP_EOL;}}</strong></p>
                                        <p><strong>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order['order_recieved_date'])->format('d. F H:i');}}</strong></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td><img src="{{ $message->embed('public/frontend/mail/img/check-icon.png')}}" width="20" alt=""></td>
                                                <td style="padding: 0 5px;"><img src="{{ $message->embed('public/frontend/mail/img/clipboard-regular.png')}}" width="20" alt=""></td>
                                                <td><p><strong>{{__('Order placed')}}</strong><br> <small>{{__('We have received your order')}}.</small></p></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tfoot style="background-color: #f3f3f3;">
            <tr>
                <td style="padding-left: 20px; width: 150px;">
                    <img src="{{ $message->embed('public/frontend/mail/img/Ellipse 45.png')}}" alt="" width="150">
                </td>
                <td style="padding-right: 15px; padding-left: 15px; width: 50%;">
                    <h2 class="fs-20" style="color: #001FD1; font-size: 30px; font-weight: bold; margin: 0 0 10px;">{{__('Do you have a question?')}}</h2>
                    <p style="margin: 0;">{{__('“Name” is ready to answer your questions')}}</p>
                </td>
                <td style="padding-right: 20px;">
                   <a href="#" style="background-color: #001FD1; color: #ffffff; display: block; padding: 12px 25px; border-radius: 5px;text-decoration: none; margin-bottom: 10px;"><img src="{{ $message->embed('public/frontend/mail/img/phone-solid.png')}}" alt="" width="20"> +45 41 88 80 80</a>
                   <a href="mailto:info@sortiment.dk" style="background-color: #001FD1; color: #ffffff; display: block; padding: 12px 25px; border-radius: 5px;text-decoration: none;"><img src="{{ $message->embed('public/frontend/mail/img/envelope-solid.png')}}" alt="" width="20"> info@sortiment.dk</a>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
