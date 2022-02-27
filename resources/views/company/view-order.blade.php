@extends('company.main_master')
@section('content')
<style type="text/css">
    .order-track .btn {
    margin-left: 10px;
    font-size: 1rem;
    padding: 10px 20px;
}
</style>
@php
    $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
    @endphp
<div class="view-order-wrap shadow-box">
    <div class="order-head d-flex align-items-center justify-content-between">
        <h3><i class="fas fa-receipt"></i> {{__('Order status')}}</h3>
        <p>{{__('Viewing order')}} #{{$order->order_number}}</p>
    </div><!-- Order head -->
    <div class="status-content">
        <div class="row">
            <div class="col-md-8">
                <div class="order-status">
                    @foreach($order_process as $key=>$orderp)
                    <div class="process-row d-flex align-items-center @if($key==0) active @endif">
                        <span class="dot"></span>
                        @if($orderp->status=='Order recieved')
                        <img src="{{asset('frontend/assets/img/clipboard-regular.png') }}" class="icon" alt="">
                        @elseif($orderp->status=='Payment confirmed')
                        <img src="{{asset('frontend/assets/img/money-check-solid.png') }}" class="icon" alt="">
                        @elseif($orderp->status=='Order being processed')
                        <img src="{{asset('frontend/assets/img/people-carry-solid.png') }}" class="icon" alt="">
                        @elseif($orderp->status=='Shipping order')
                        <img src="{{asset('frontend/assets/img/shipping-fast-solid.png') }}" class="icon" alt="">
                        @else
                        <img src="{{asset('frontend/assets/img/shipping-fast-solid.png') }}" class="icon" alt="">
                        @endif


                        <h4>{{__($orderp->status)}} <small>{{__($orderp->desc)}}</small></h4>
                        <p class="date-time">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orderp->date)
                    ->format('d. F H:i');}}</p>
                    </div><!-- Process row-->
                    <hr>
                    @endforeach

                </div><!-- Order status -->
            </div>
            <div class="col-md-4">
                <div class="order-track d-flex justify-content-end align-items-center">
                    @if(!empty($order->tracking_url))
                    <a href="{{$order->tracking_url}}" class="btn btn-blue">{{__('Track delivery')}}</a>
                    @endif
                    @if(!empty($order->pdf))
                    {{--<a href="{{ route('download.invoice',$order->id)}}" class="btn btn-blue"><i class="fas fa-file-pdf"></i></a>--}}
                    <a href="{{ asset($order->pdf)}}" class="btn btn-blue" download>Hent din faktura <i class="fas fa-file-pdf"></i></a>
                    @endif

                </div>
                <div class="order-decs">

                    @php
                        $orderItems=DB::table('order_items')->where('order_id',$order->id)->get();
                    @endphp
                    @foreach($orderItems as $orderItem)
                        <figure class="product-pic">
                            <img src="{{asset(\App\Models\CustomizeProduct::where('id',$orderItem->product_id)->value('product_thambnail')) }}" width="250" alt="">
                        </figure>

                        <h5>{{$orderItem->product_name}} </h5>
                        <p><strong>{{$orderItem->qty}} stk.</strong></p>
                        @php
                            $orderItemsAttr=DB::table('order_item_attrs')->where('order_item_id',$orderItem->id)->get();
                            
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
                        <div class="order-block">
                            <h6>{{__('Estimated delivery date')}}:</h6>
                            <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orderItem->estimated_delivery_date)
                        ->format('d. F');}}</p>
                        </div>
                        <hr>
                    @endforeach

                    <p class="total-cost"><span>{{__('Delivery costs')}}: </span> {{$formatter->formatCurrency($order->delivery_costs, 'DKK'), PHP_EOL;}}</p>
                    <div class="order-block">
                        <h6 style="display:inline;">{{__('Total costs')}}:</h6> <p style="display:inline;">@php $totalAmt=$order->amount+$order->delivery_costs; @endphp {{$formatter->formatCurrency($totalAmt, 'DKK'), PHP_EOL;}}</p>
                    </div>
                    <div class="order-block">
                        <h6 style="display:inline;">{{__('Delivery address')}}:</h6>
                        <p style="display:inline;">{{$order->address}}</p>
                    </div>

                </div><!-- order descriptions -->
            </div>
        </div><!-- Row -->
    </div><!-- Status content -->
</div><!-- Order status -->
@endsection
