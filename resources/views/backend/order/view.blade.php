@extends('admin.admin_master')
@section('css')
<style>
    .process-row{padding:15px;}
    .process-row .icon {
        margin-right: 20px;
    }
    .process-row .date-time {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        padding-left: 40px;
    }
</style>
@endsection
@section('admin')
<div class="container-full">

    <section class="content">

        <div class="row">
            <div class="col-md-8">
                <div class="order-decs">
                    {{--<div class="row">
                    @php
                        $orderItems=DB::table('order_items')->where('order_id',$order->id)->get();
                    @endphp
                    @foreach($orderItems as $orderItem)
                        <div class="col-md-4">
                            <figure class="product-pic">
                            <img src="{{asset(\App\Models\CustomizeProduct::where('id',$orderItem->product_id)->value('product_thambnail')) }}" width="250" alt="">
                            </figure>
                        </div>
                        <div class="col-md-8">
                            <h5>{{\App\Models\CustomizeProduct::where('id',$orderItem->product_id)->value('product_name')}} </h5>
                            <p><strong>{{$orderItem->qty}} stk.</strong></p>
                            @php
                                $orderItemsAttr=DB::table('order_item_attrs')->where('order_item_id',$orderItem->id)->get();

                            @endphp
                            @foreach($orderItemsAttr as $orderAttr)
                                <p><strong>{{\App\Models\Attribute::where('id',$orderAttr->attribute_id)->value('attr_name')}}:</strong> {{$orderAttr->attribute_value}}</p>
                            @endforeach
                        </div>
                        <hr>
                    @endforeach
                    </div>--}}







                <h3 class="heading head">{{__('Ordre nr')}} : #{{$order->order_number}}, {{__('Status')}} : "{{__($order->status)}}", År : {{$order->order_year}}

                </h3>

                    <hr>

                    @php
                    $orderItems=DB::table('order_items')->where('order_id',$order->id)->get();
                    $i=1;
                @endphp
               <div class="row">
                  <div class="col-md-12">
                  @foreach($orderItems as $key1=>$orderItem)

                     <h3 class="tt-tt">{{__('Product name')}} : <strong>{{\App\Models\CustomizeProduct::where('id',$orderItem->product_id)->value('product_name')}}</strong>

                    </h3>
                     @php
                    $orderItemssubs=DB::table('order_label_qties')->where(['order_id'=>$order->id,'order_item_id'=>$orderItem->id])->get();
                    $product_details=DB::table('customize_products')->where(['id'=>$orderItem->product_id])->first();

                    $distincts = DB::table('customize_product_attributes')->distinct()->select('attribute_id')->where('product_id', '=',$orderItem->product_id)->get();


                    @endphp


                    @php
                    $orderItemsAttr=DB::table('order_item_attrs')->where(['order_item_id'=>$orderItem->id,'order_item_id'=>$orderItem->id])->get();
                    //print_r($orderItemsAttr);die;
                    $aatttrr2=[];

                    @endphp


                    @if($orderItemsAttr->count()>0)
                     <h5><span></span> {{__('Product for yourself')}} @if($product_details->name_on_product=='yes')
                    @if($orderItem->uploadExcel==1)
                        <a class="btn btn-rounded btn-info pull-right" href="{{ url('order/order-namelist/'.$order->id.'/'.$orderItem->id)}}">Excel liste fra virksomhed</a>@endif
                        @endif

                    </h5>
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>{{__('NO')}}</th>
                                 @if($product_details->name_on_product=='yes')<th>{{__('Name label')}}</th>@endif
                                 @foreach($orderItemsAttr as $orderAttr)
                                 <th>{{__(\App\Models\Attribute::where('id',$orderAttr->attribute_id)->value('attr_name'))}}</th>
                                 @endforeach

                                 <th>{{__('Quantity')}}</th>
                              </tr>
                           </thead>

                           <tbody>
                           @foreach($orderItemsAttr as $key3=>$orderItemsAttr_1s)
                               @php
                               $aatttrr=$orderItemsAttr_1s->attribute_value;

                               $aatttrr2[]=explode(',',$aatttrr);

                               @endphp

                            @endforeach

                               @php

                               $j=1;@endphp
                               @foreach($orderItemssubs as $key2=>$orderItemssub)

                              <tr>
                                 <td>{{$j}}</td>
                                 @if($product_details->name_on_product=='yes')<td>{{$orderItemssub->label}}</td>@endif
                                 @foreach($aatttrr2 as $key4=>$aatttr)
                                 <td>@php print_r($aatttr[$key2]) @endphp</td>
                                  @endforeach
                                 <td>{{$orderItemssub->aqty}}</td>
                              </tr>
                                @php
                                $j=$j+1;
                                @endphp

                                @endforeach

                           </tbody>
                        </table>
                     </div>
                    @endif

                    @php
                    $orderemployees=DB::table('order_employees')->where(['order_item_id'=>$orderItem->id,'order_item_id'=>$orderItem->id])->get();
                    @endphp
                    @if($orderemployees->count()>0)
                     <h5><span></span> {{__('Product for employees')}}</h5>
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>NO</th>
                                 <th>{{__('Employee name')}}</th>
                                 @if($product_details->name_on_product=='yes')<th>{{__('Name label')}}</th>@endif
                                 @foreach($distincts as $distinct)
                                    @if($distinct->attribute_id==1)
                                        <th>{{__('Color')}}</th>
                                    @else
                                        <th>{{__('Size')}}</th>
                                    @endif

                                 @endforeach
                                 <th>{{__('Quantity')}}</th>
                              </tr>
                           </thead>

                           <tbody>
                           @php
                           $k=1;
                           @endphp
                           @foreach($orderemployees as $orderemployee)
                              <tr>
                                 <td>{{$k}}</td>
                                 <td>{{$orderemployee->employee_name}}</td>
                                 @if($product_details->name_on_product=='yes')<th>{{$orderemployee->label}}</th>@endif
                                 @foreach($distincts as $distinct)
                                    @if($distinct->attribute_id==1)
                                        <td>{{$orderemployee->color}}</td>
                                    @else
                                        <td>{{$orderemployee->size}}</td>
                                    @endif

                                 @endforeach



                                 <td>1</td>
                              </tr>
                              @php
                                $k=$k+1;
                                @endphp
                            @endforeach

                           </tbody>
                        </table>
                     </div>

                     <br>
                    @endif


                    @php
                    $i=$i+1;
                    @endphp
                    <div class="row">
                        <div class="col-md-6">
                            <div class="order-block">
                                <h6>{{__('Delivery date')}}:</h6>
                                <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orderItem->estimated_delivery_date)
                            ->format('d. F');}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="order-block">
                                <h6>{{__('Delivery method')}}:</h6>
                                <p>{{$orderItem->delivery_method}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                     <br>

                  </div>
               </div>




               <div class="row">
                  <div class="col-md-12">
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                              <tr class="th-bg">
                                 <th>{{__('NO')}}</th>
                                 <th>{{__('Product name')}}</th>
                                 <th>{{__('Quantity')}}</th>
                                 <th>{{__('Unit price')}}</th>
                                 <th>{{__('Total price')}}</th>
                              </tr>
                           </thead>

                           <tbody>

                              @foreach($orderItems as $orderItem)

                              <tr>
                                 <td>{{$i}}</td>
                                 <td>{{$orderItem->product_name}}</td>
                                 <td>{{$orderItem->qty}} stk.</td>
                                 <td>{{$orderItem->price}}</td>
                                 <td>{{$orderItem->price*$orderItem->qty}}</td>
                              </tr>

                              {{--
                              @php
                              $orderItemsAttr=DB::table('order_item_attrs')->where('order_item_id',$orderItem->id)->get();
                              @endphp
                              @foreach($orderItemsAttr as $orderAttr)
                              <p><strong>{{\App\Models\Attribute::where('id',$orderAttr->attribute_id)->value('attr_name')}}:</strong>
                                 {{$orderAttr->attribute_value}}</p>
                              @endforeach --}}

                              @php
                              $i=$i+1;
                              @endphp

                              @endforeach

                           </tbody>


                        </table>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <div class="price-dtails">
                        <h3 style="background: rgba(0, 0, 0, 0.3);text-align: right;
    padding: 10px 15px">{{__('Delivery costs')}} : <strong>{{$order->delivery_costs }}</strong></h3>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="price-dtails">
                        <h3 style="background: rgba(0, 0, 0, 0.3);text-align: right;
    padding: 10px 15px">{{__('Amount paid')}} : <strong>{{$order->amount+$order->delivery_costs }}</strong></h3>
                     </div>
                  </div>
               </div>




                    <div class="row">
                        <div class="col-md-6">
                        <table class="table table-bordered">
                              <tr class="th-bg">
                                 <th>{{__('Name')}}</th>
                                 <th>{{$order->name}}</th>
                              </tr>
                              <tr class="th-bg">
                                 <th>{{__('Email')}}</th>
                                 <th>{{$order->email}}</th>
                              </tr>
                              <tr class="th-bg">
                                 <th>{{__('Phone')}}</th>
                                 <th>{{$order->phone}}</th>
                              </tr>
                              <tr class="th-bg">
                                 <th>{{__('Address')}}</th>
                                 <th>{{$order->address}}</th>
                              </tr>
                              <tr class="th-bg">
                                 <th>{{__('Company')}}</th>
                                 <th>{{$order->company}}</th>
                              </tr>
                              <tr class="th-bg">
                                 <th>{{__('Post Code')}}</th>
                                 <th>{{$order->post_code}}</th>
                              </tr>
                        </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                              <tr class="th-bg">
                                 <th>{{__('Order date')}}:</th>
                                 <th>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_recieved_date)->format('d. F H:i');}}</th>
                              </tr>
                              <tr class="th-bg">
                                 <th>{{__('Payment method')}}</th>
                                 <th>{{__($order->payment_method)}}</th>
                              </tr>
                              <tr class="th-bg">
                                 <th>{{__('CVR number')}}</th>
                                 <th>{{$order->cvr_no}}</th>
                              </tr>
                              <tr class="th-bg">
                                 <th>{{__('EAN number')}}</th>
                                 <th>{{$order->ean_no}}</th>
                              </tr>
                              {{--<tr class="th-bg">
                                 <th>Bank account nr.</th>
                                 <th>{{$order->bank_account_no}}</th>
                              </tr>--}}
                              <tr class="th-bg">
                                 <th>{{__('Ref nr.')}}</th>
                                 <th>{{$order->ref_no}}</th>
                              </tr>
                              <tr class="th-bg">
                                 <th>{{__('Status')}}</th>
                                 <th>{{__($order->status)}}</th>
                              </tr>
                            </table>
                        </div>
                    </div>

               </div><!-- order descriptions -->






            </div>
            <div class="col-md-4">
                <div class="order-track d-flex justify-content-end align-items-center">
                    <a href="#" class="btn btn-blue">{{__('Track delivery')}}</a>
                    <a href="#" class="btn btn-blue"><i class="fas fa-file-pdf"></i></a>
                </div>
                <div class="order-status" style=" color: white;">
                    @foreach($order_process as $orderp)
                    <div class="process-row d-flex align-items-center active">
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
                        <h4>{{__($orderp->status)}} <br><small>{{__($orderp->desc)}}</small></h4>
                        <p class="date-time">{{$orderp->date}}</p>
                    </div><!-- Process row-->
                    <hr>
                    @endforeach
                    <br>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Update status')}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form method="post" action="{{route('order.status.update')}}">

                                @csrf
                                <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value="Order recieved" @if($order->status=='Order recieved'){{'selected'}} @endif>{{__('Order recieved')}}</option>
                                    <option value="Order being processed" @if($order->status=='Order being processed'){{'selected'}} @endif>{{__('Order being processed')}}</option>


                                    <option value="Shipping order" @if($order->status=='Shipping order'){{'selected'}} @endif>{{__('Shipping order')}}</option>
                                    <option value="Order delivered" @if($order->status=='Order delivered'){{'selected'}} @endif>{{__('Order delivered')}}</option>
                                    <option value="Payment confirmed" @if($order->status=='Payment confirmed'){{'selected'}} @endif>{{__('Payment confirmed')}}</option>
                                </select>
                                </div>
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <input type="hidden" name="order_number" value="{{$order->order_number}}">
                                <!--<input type="hidden" name="estimated_delivery_date" value="{{-- \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->estimated_delivery_date)
                            ->format('d. F');--}}">-->
                                <input type="hidden" name="delivery_costs" value="{{$order->delivery_costs }}">
                                <input type="hidden" name="order_recieved_date" value="{{$order->order_recieved_date}}{{-- \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_recieved_date)->format('d. F H:i');--}}">
                                <input type="hidden" name="address" value="{{$order->address}}">
                                <input type="hidden" name="amount" value="{{$order->amount}}">
                                <input type="hidden" name="email" value="{{$order->email}}">
                                <input type="hidden" name="tracking_url" value="{{$order->tracking_url}}">
                                <input type="hidden" name="pdf" value="{{$order->pdf}}">
                                <div class="text-xs-right">
                                    <button class="btn btn-rounded btn-info" id="delete2">{{__('Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Update tracking url')}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form method="post" action="{{route('update.tracking')}}">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <div class="form-group"><textarea class="form-control" name="tracking_url" >{{$order->tracking_url}}</textarea></div>
                                <div class="text-xs-right"><button class="btn btn-rounded btn-info">{{__('Submit')}}</button></div>
                            </form>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Company Order PDF')}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form method="post" action="{{route('update.pdf')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <input type="hidden" name="old_pdf" value="{{$order->pdf}}">
                                <div class="form-group"><input type="file" class="form-control" name="order_pdf" /></div>
                                @error('order_pdf')
                                <span class="text-tenger red" style="color:red">{{$message}}</span>
                                @enderror
                                <div class="text-xs-right"><button class="btn btn-rounded btn-info">{{__('Submit')}}</button></div>
                                @if(!empty($order->pdf))
                                <br>
                                <iframe src="{{ asset('public/'.$order->pdf) }}" style="width:100%; height:200px;" frameborder="0"></iframe>
                                <a href="{{ route('remove-order-pdf',$order->id)}}" class="btn btn-rounded btn-danger mb-5">{{__('Remove PDF')}}</a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div><!-- Order status -->

            </div>
        </div><!-- Row -->

    </section>
</div>


@endsection
@section('js')
<script>
function getdetail(that,id){
    //$('#myModal').modal('show');
    $.ajax({
        url: "{{  url('/company/user/getdetail/ajax') }}/"+id,
        type:"GET",
        dataType:"json",
        success:function(data) {
            //console.log(data);
            var html="";
            html+='<div class="row">';
            html+='<div class="col-md-4 offset-md-4">';
            if (data.profile_photo_path == null || data.profile_photo_path==''){
                html+='<div><img src="{{url("/")}}/public/uploads/no_image.jpg" style="height:100px;width:auto"></div>';
            }else{
                html+='<div><img src="{{url("/")}}/public/'+data.profile_photo_path+'" style="height:100px;width:auto"></div>';

            }
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Name</label><input class="form-control " type="text" value="'+data.name+'" readonly>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Email</label><input class="form-control " type="text" value="'+data.email+'" readonly>';
            html+='</div>';

            html+='<div class="col-md-6">';
            html+='<label>Phone</label><input class="form-control " type="text" value="'+data.phone+'" readonly>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Company</label><input class="form-control " type="text" value="'+data.company+'" readonly>';
            html+='</div>';

            html+='<div class="col-md-6">';
            html+='<label>Zip Code</label><input class="form-control " type="text" value="'+data.zip+'" readonly>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>CVR-Number</label><input class="form-control " type="text" value="'+data.crv_number+'" readonly>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Address</label><textarea class="form-control" readonly>'+data.address+'</textarea>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Address2</label><textarea class="form-control" readonly>'+data.address2+'</textarea>';
            html+='</div>';

            html+='</div>';


            $('.modal-body').html(html)
            $('#myModal').modal('show');
        },
    });

}
</script>
@endsection
