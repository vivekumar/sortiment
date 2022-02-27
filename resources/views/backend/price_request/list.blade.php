@extends('admin.admin_master')
@section('admin')


  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">
		  <div class="row">



			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">{{__('Alle forspørgsler')}}</h3>
                  <a href="{{route('companyp.add')}}" class="btn btn-info pull-right ml-10"><i class="fa fa-add fa-1x" ></i> {{__('Opret forspørgsel')}}</a>
                  <form method="get" class="pull-right" id="comform">
                      <select name="company" class="select2 pull-left ml-20" onchange='submitForm();'>
                      <option value="" selected="" disabled="">Vælg virksomhed</option>
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
								{{--<th>{{__('Image')}} </th>
								<th>{{__('Product Name')}}</th>
								<th>{{__('Price')}} </th>--}}
								<th>{{__('Name')}} </th>
                                <th>{{__('Company')}} </th>
                                <th>{{__('Logo on product')}} </th>
                                <th>{{__('Text on product')}} </th>
								<th>{{__('Action')}}</th>

							</tr>
						</thead>
						<tbody>
                            @foreach($products as $item)
                            <tr>
                                {{--<td> <img src="{{ asset(@$item->product->product_thambnail) }}" style="width: 60px; height: 50px;">  </td>
                                <td>{{ @$item->product->product_name }}</td>
                                <td>{{ @$item->product->product_price }}</td>--}}
                                <td>{{ \App\Models\User::where('id',$item->user_id)->value('name') }}</td>
                                <td>{{ \App\Models\User::where('id',$item->user_id)->value('company') }}</td>
                                <td> @if($item->logo_on_product==1){{__('Yes')}} @else {{__('No') }}@endif</td>
                                <td> @if($item->text_on_product==1){{__('Yes')}} @else {{__('No') }}@endif</td>

                                <td>
                                    <a href="{{ route('companyp.view',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-eye"></i> </a>
                                </td>

                            </tr>
                            @endforeach
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

<script src="{{ asset('./assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
 <script>
 $(function () {
    "use strict";
    //Initialize Select2 Elements
    $('.select2').select2();
 });
 $('#example11').dataTable({
        "order": []
    });
 function submitForm(){
    document.getElementById('comform').submit();
 }
 </script>
 @endsection
