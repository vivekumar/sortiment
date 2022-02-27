@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-12">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Kunder')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Company')}}</th>
                                <th>{{__('CRV Number')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td> {{ $user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->company}}</td>
                                <td>{{$user->crv_number}}</td>
                                <td><!--<a href="{{-- route('user.edit',$user->id)--}}" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size:1rem"></i></a><a href="{{-- route('user.delete',$user->id)--}}" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a><button onclick="getdetail(this,{{$user->id}})" href="{{-- route('user.view',$user->id) --}}" class="btn btn-primary" title="Product Details Data"><i class="fa fa-eye"></i> </button>-->
                                <a href="{{ route('user.view',$user->id) }}" class="btn btn-primary" title="Product Details Data"><i class="fa fa-eye"></i> </a>
                                @if($user->approved_at)
                                    <a href="{{ route('admin.users.unapprove',$user->id) }}" class="btn btn-success" title="Active"><i class="fa fa-thumbs-up"></i> </a>
                                @else
                                    <a href="{{ route('admin.users.approve',$user->id) }}" class="btn btn-danger" title="Inactive"><i class="fa fa-thumbs-down"></i> </a>
                                @endif
                                <a href="{{ route('user.delete',$user->id) }}" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i> </a>
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
</script>
@endsection
