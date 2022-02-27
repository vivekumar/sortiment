@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-12">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Order List')}}</h3>
                    <form method="get" class="pull-right" id="comform">
                      <select name="company" class="select2 pull-left ml-20" onchange='submitForm();'>
                      <option value="" selected="" disabled="">{{__('Select company')}}</option>
                          @foreach($users as $user)
                          <option value="{{$user->id}}" @if(isset($_GET['company']) && $_GET['company']==$user->id) selected @endif>{{$user->company}} ({{$user->name}})</option>
                          @endforeach
                      </select>
                  </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example11" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{__('Order number')}}</th>
                                <th>{{__('Products')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Total')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                    <div>{{$orderItem->product_name}} </div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($orderItems as $orderItem)
                                    <div>{{ $orderItem->qty }}</div>
                                    @endforeach

                                </td>
                                <td>{{$order->amount+$order->delivery_costs}}</td>
                                <td>
                                    <span class="btn btn-status @if($order->status=='Completed') {{'blue'}} @endif">{{__($order->status)}}</span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{route('view.order',$order->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.download.invoice',$order->id)}}" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                                        <a href="{{ route('order.delete',$order->id)}}" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a>
                                        
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                </div>

            </div>


  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">User Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>



        <div>
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
$('#example11').dataTable({
    language: {
        url: '/public/backend/da.json',
    },
    "order": []
});
</script>

<script>
    function submitForm(){
        $("form").submit();
    }
</script>

@endsection
