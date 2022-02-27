@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Company info')}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                            @if(!empty($user->profile_photo_path))
                                <img src="{{asset($user->profile_photo_path)}}" style="height:100px;width:auto" class="img-responsive">

                                <p><a href="{{ asset($user->profile_photo_path)}}" class="btn btn-file btn-info" download>{{__('Click here to download')}} </a></p>

                            @else
                                <img src="{{asset('public/uploads/no_image.jpg')}}"  class="img-responsive">
                            @endif

                            </div>
                            <div class="col-md-9">

                                <div class="row">
                                    <div class="col-md-6">
                                        <p>{{__('Contact person')}} : {{$user->name}}</p>
                                        <p>{{__('Bookingkeeper')}} : {{$user->email}}</p>
                                        <p>{{__('Company name')}} : {{$user->company}}</p>
                                        <p>{{__('Phone number')}} : {{$user->phone}}</p>

                                    </div>
                                    <div class="col-md-6">
                                        <p>{{__('CVR-Number')}} : {{$user->crv_number}}</p>
                                        <p>{{__('Address')}} : {{$user->address}}</p>
                                        <p>{{__('Address')}} 2 : {{$user->address2}}</p>
                                        <p>{{__('Zip Code')}} : {{$user->zip}}</p>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12">
                            <hr>
                            </div>
                            <div class="col-md-12">

                                <div class="row">
                                    @php
                                        $allimages = DB::table('company_uploads')->where('user_id',$user->id)->get();
                                    @endphp
                                    @foreach($allimages as $allimage)
                                    <div class="col-md-2">
                                        <a href="{{asset($allimage->image) }}" download>
                                            <img src="{{asset($allimage->image) }}" class="img-responsive" style="max-width: 100%;"/>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('View Employee')}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Order')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                <tr>
                                    <td> {{ $employee->name}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{\App\Models\OrderEmployee::where('employee_id',$employee->id)->count()}}</td>
                                    <td><button onclick="getdetail(this,{{$user->id}})" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-eye" aria-hidden="true" style="font-size:1rem"></i></button></td>

                                </tr>
                                @endforeach
                            </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        <div>
    </section>
</div>


<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">{{__('User Orders')}}</h4>
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

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment-with-locales.min.js"></script>
<script>
function getdetail(that,id){
    //$('#myModal').modal('show');
    var base_url="{{url('/')}}";
    $.ajax({
        url: "{{  url('/company/employee/orderdetail/ajax') }}/"+id,
        type:"GET",
        dataType:"json",
        success:function(data) {
            //console.log(data);
            var html="";
            html+='<table id="example1" class="table">';

            html+='<tr>';
            html+='<th>Image</th><th>Product</th><th>Order no</th><th>Status</th><th>Date</th><th>Action</th>';
            html+='</tr>';
            $.each(data, function( key, cdata1 ) {
                var date = new Date(cdata1.created_at);
                var newDate = date.toString('dd-MM-yy');

                var date11 = moment(new Date(newDate.substr(0, 16)));
                if(cdata1.status=='approved'){
                    var badge='success';
                    var faicon='on';
                }else{
                    var badge='danger';
                    var faicon='off';
                }

            html+='<tr class="col-md-6">';
            html+='<td><img src="'+base_url+'/'+cdata1.product_thambnail+'" width="100"></td>';
            html+='<td>'+cdata1.product_name+'</td>';
            html+='<td>'+cdata1.order_number+'</td>';
            html+='<td><span class="badge badge-pill badge-'+badge+'"> '+cdata1.status+' </span></td>';
            html+='<td>'+date11.format("DD-MMM-YYYY")+'</td>';
            html+='<td><button onclick="emporderstatus(this,'+cdata1.id+')" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-toggle-'+faicon+'" aria-hidden="true" style="font-size:2rem; margin-top:5px"></i></button></td>';
            html+='</tr>';

            });


            html+='</table>';


            $('.modal-body').html(html)
            $('#myModal').modal('show');
        },
    });

}
function emporderstatus(thhat,id){
    var status=$(thhat).parent().parent().find('td:eq(3) span').text();
    var base_url="{{url('/')}}";
    $.ajax({
        url: "{{  url('/company/employee/orderstatus-change/ajax') }}/"+id+'/'+status,
        type:"GET",
        dataType:"json",
        success:function(data) {
            if(data=="pending"){
                $(thhat).parent().parent().find('td:eq(3) span').text(data);
                $(thhat).parent().parent().find('td:eq(3) span').removeClass('badge-success');
                $(thhat).parent().parent().find('td:eq(3) span').addClass('badge-danger');

                $(thhat).find('i').removeClass('fa-toggle-on');
                $(thhat).find('i').addClass('fa-toggle-off');
            }else{
                $(thhat).parent().parent().find('td:eq(3) span').text(data);
                $(thhat).parent().parent().find('td:eq(3) span').removeClass('badge-danger');
                $(thhat).parent().parent().find('td:eq(3) span').addClass('badge-success');

                $(thhat).find('i').removeClass('fa-toggle-off');
                $(thhat).find('i').addClass('fa-toggle-on');
            }
            console.log(data);
        }
    });
}
</script>

@endsection
