@extends('company.main_master')
@section('content')
<div class="order-history-wrap shadow-box">
    <div class="order-head d-flex align-items-center justify-content-between">
        <h3><i class="fas fa-receipt"></i> {{__('Order history')}}</h3>
        <p>{{__('Number of orders')}}: #{{count($orders)}}</p>
    </div><!-- Order head -->
    @php
    $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
    @endphp
    <div class="table-content">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{__('Order number')}}</th>
                        <th>{{__('Products')}}</th>
                        <th>{{__('Quantity')}}</th>
                        <th>{{__('Total')}}</th>
                        <th>{{__('status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                @foreach($orders as $order)
                @php
                    $orderItems=DB::table('order_items')->where('order_id',$order->id)->get();
                @endphp
                <tr>
                    <td>
                        <strong>Order: #{{$order->order_number}}</strong>
                    </td>
                    <td>
                        @foreach($orderItems as $orderItem)
                        <div>{{\App\Models\CustomizeProduct::where('id',$orderItem->product_id)->value('product_name')}} </div>
                        @endforeach
                    </td>
                    <td>
                        @foreach($orderItems as $orderItem)
                        <div>{{ $orderItem->qty }}</div>
                        @endforeach

                    </td>
                    <td>{{$formatter->formatCurrency($order->amount, 'DKK'), PHP_EOL;}}</td>
                    <td>
                        <span class="btn btn-status @if($order->status=='Completed') {{'blue'}} @endif">{{__($order->status)}}</span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{route('order.details',$order->id)}}"><i class="fas fa-eye"></i></a>
                            @if($order->status=='Completed')
                            <a href="#"><i class="fas fa-file-pdf"></i></a>
                            <a href="#"><i class="fas fa-shopping-cart"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach

            </table>
        </div><!-- table details -->
    </div>
</div><!-- Order History -->

<div class="modal fade" id="viewModal_order" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="excelModalLabel"><strong>
        {{__('Import employees using Execel')}}</strong></h5>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <form action="" class="price-form">

                <div class="company-info">
                    <div class="form-group mb-3 upload-logo">
                        <button type="button" id="btnup" class="upload-btn">
                            <p id="namefile" class="">{{__('Upload a file')}}</p>
                            <img src="assets/img/upload-icon.png" class="upload-icon" alt="">
                        </button>
                        <input type="file" value="" name="fileup" id="fileup">
                    </div><!-- row-->

                    <div class="form-group">
                        <button type="submit" class="btn btn-blue f-width">{{__('Upload Excel file')}}</button>
                    </div>
                </div>
            </form><!-- Price form-->
        </div>
    </div>
    </div>
</div>
@endsection
