@extends('admin.admin_master')
@section('admin')

<style>
    /*PRELOADING------------ */
div#exampleModal .modal-dialog {
 margin-top: 8%;
}
</style>
<!-- Button trigger modal -->
<div id="overlayer" style="display:none"></div>
<span class="loader" style="display:none">
  <span class="loader-inner"></span>
</span>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Excel file</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" class="product-form">
            @csrf
            <div id="errors"></div>
            <div class="company-info">
                <div class="form-group mb-3 upload-logo">
                    <!--<button type="button" id="btnup" class="upload-btn">
                        <p id="namefile" class="">Upload a file</p>
                        <img src="{{ asset('frontend/assets/img/upload-icon.png')}}" class="upload-icon" alt="">
                    </button>-->
                    <input type="file" value="" name="fileup" id="fileup">
                </div><!-- row-->
                <div id="responseMsg" ></div>
                <div class='alert alert-danger mt-2 d-none text-danger1' id="err_file"></div>
                <!--<div class="form-group">
                    <button type="button" id="submit" class="btn btn-blue f-width">Upload Excel file</button>
                </div>-->
            </div>
        </form><!-- Price form-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="submit" class="btn btn-info">Upload</button>
      </div>
    </div>
  </div>
</div>


  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">
		  <div class="row">



			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">{{__('Product list')}}</h3>
                  <button type="button" class="btn btn-info pull-right ml-10" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-upload fa-1x" aria-hidden="true"></i> {{__('Upload product')}}</button>
                  <a href="{{url('/')}}/public/uploads/excel/sample-product.xlsx" class="btn btn-primary pull-right" download><i class="fa fa-download fa-1x" aria-hidden="true"></i> {{__('Sample file')}}</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example111" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>{{__('Image')}} </th>
								<th>{{__('Product Name')}}</th>
								<th>{{__('Price')}} </th>
								<th>{{__('SKU')}}</th>
								<!--<th>Discount </th>-->
								<th>{{__('Status')}} </th>
								<th>{{__('Action')}}</th>

							</tr>
						</thead>
						<tbody>
	 {{-- @foreach($products as $item)
	 <tr>
		<td> <img src="{{ asset($item->product_thambnail) }}" style="width: 60px; height: 50px;">  </td>
		<td>{{ $item->product_name }}</td>
		 <td>{{ $item->product_price }}</td>
		 <td>{{ $item->product_sku }}</td>


		 <td>
		 	@if($item->status == 1)
		 	<span class="badge badge-pill badge-success"> Active </span>
		 	@else
           <span class="badge badge-pill badge-danger"> InActive </span>
		 	@endif

		 </td>

		<td width="30%">
 			<!--<a href="{{ route('product.edit',$item->id) }}" class="btn btn-primary" title="Product Details Data"><i class="fa fa-eye"></i> </a>-->
			<a href="{{ route('product.edit',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>
			<a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger" title="Delete Data" id="delete">
 				<i class="fa fa-trash"></i></a>
			@if($item->status == 1)
				<a href="{{ route('product.inactive',$item->id) }}" class="btn btn-danger" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
			@else
				<a href="{{ route('product.active',$item->id) }}" class="btn btn-success" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
			@endif
		</td>

	 </tr>
	  @endforeach
      --}}
						</tbody>

					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->


			</div>
			<!-- /.col -->





		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>




@endsection
@section('js')
<script>
  var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");


$(document).ready(function(){

      // DataTable
      $('#example111').DataTable({
        language: {
            url: '/public/backend/da.json',
        },
         processing: true,
         serverSide: true,
         ajax: "{{route('prodeuct.getAjaxList')}}",
         columns: [
            {
                data: 'product_thambnail','render': function ( data, type, row ) {
                    return '<img src="/'+data+'" style="width:auto;height:50px;"">';
                }
             },
            { data: 'product_name' },
            { data: 'product_price' },
            { data: 'product_sku' },
            { data: 'status','render': function ( data, type, row ) {
                    if(data == 1){
                        return '<span class="badge badge-pill badge-success"> Active </span>';
                    }else{
                        return '<span class="badge badge-pill badge-danger"> InActive </span>';
                    }


                }
            },
            { data: 'id' ,'render': function ( data, type, row ) {
                    var btn= `<a href="{{url('/sample-product/edit/')}}/`+data+`" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>`;
                    btn+= `<a href="{{url('/sample-product/delete/')}}/`+data+`" class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>`;
                    if(row.status == 1){
                        btn+= `<a href="{{url('/sample-product/inactive')}}/`+data+`" class="btn btn-danger" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>`;
                    }else{
                        btn+= `<a href="{{url('/sample-product/active')}}/`+data+`" class="btn btn-success" title="Active Now"><i class="fa fa-arrow-up"></i> </a>`;
                    }
                    return btn;
                }
            },
         ]
      });

    });


  $(document).ready(function(){

    $('#submit').click(function(){
        console.log('ewrwe');
      // Get the selected file
      var files = $('#fileup')[0].files;

      if(files.length > 0){
         var fd = new FormData();

         // Append data
         fd.append('file',files[0]);
         fd.append('_token',CSRF_TOKEN);

         // Hide alert
         $('#responseMsg').hide();

         // AJAX request
         $.ajax({
           url: "{{route('product.upload')}}",
           method: 'post',
           data: fd,
           contentType: false,
           processData: false,
           dataType: 'json',
           beforeSend: function() {
            $(".loader").show();
            $("#overlayer").show();
            },
           success: function(response){
            $("#errors").html('');
             // Hide error container
             $('#err_file').removeClass('d-block');
             $('#err_file').addClass('d-none');

             if(response.success == 1){ // Uploaded successfully

               // Response message
               $('#responseMsg').removeClass("alert alert-danger");
               $('#responseMsg').addClass("alert alert-success");
               $('#responseMsg').html(response.message);
               $('#responseMsg').show();

               // File preview
               $('#filepreview').show();
               $('#filepreview img,#filepreview a').hide();

                setTimeout(() => {
                    location.reload();
                }, 1000);

             }else if(response.success == 2){ // File not uploaded

               // Response message
               $('#responseMsg').removeClass("alert alert-success");
               $('#responseMsg').addClass("alert alert-danger");
               $('#responseMsg').html(response.message);
               $('#responseMsg').show();
             }else{
               // Display Error
               $('#err_file').text(response.error);
               $('#err_file').removeClass('d-none');
               $('#err_file').addClass('d-block');
             }
             //$(".loader").hide();
             //$("#overlayer").hide();
           },
           error: function(xhr, status, error)
            {
                $('#err_file').text('');
                $('#err_file').removeClass('d-block');
                $('#err_file').addClass('d-none');
                $.each(xhr.responseJSON.errors, function (key, item)
                {
                    $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                });
                //$(".loader").hide();
               // $("#overlayer").hide();
            },
           /*error: function(response){
              console.log("error : " + JSON.stringify(response) );
           }*/
         });
      }else{
         alert("Please select a file.");
      }

    });
  });
  </script>
@endsection






