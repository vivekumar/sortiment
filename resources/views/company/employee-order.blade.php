@extends('company.main_master')
@section('css')
<style>
    .products-con div#orderModal .modal-dialog {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
    .select-product-type .form-group .form-control {
        border: 1px solid rgba(0, 31, 209, 0.3);
        height: 50px;
        color: #001fd1;
        -webkit-appearance: auto;
        -moz-appearance: auto;
        appearance: auto;
    }
    .select-product-type .form-group {
        margin-bottom: 15px;
    }
</style>
@endsection
@section('content')
<div class="emp-order-wrap shadow-box p-40">
    <div class="row">
        <div class="col-md-8">
            <div class="emp-short-info d-flex align-items-center">
            <figure class="emp-pic"><img src="{{(!empty($employee->profile_photo_path))?asset($employee->profile_photo_path):asset('public/image/user.png')}}" alt=""></figure>
            <div class="emp-name">
                <h5>{{__('You are viewing the products of')}}</h5>
                <h4>{{$employee->name}}</h4>
                <span class="login-time">{{__('Last logged in')}}: @if(!empty($employee->last_login_at)){{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $employee->last_login_at)->format('d. F')}} @endif</span>
            </div>
            </div><!-- Wmployee short info -->
            <div class="cart-table table-responsive ptb-45">



                @if(count($products_approve)>0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{__('Approved products')}}</th>
                            <th>{{__('Size')}}</th>
                            <th>{{__('Color')}}</th>
                            <th>{{__('Name label')}}</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    @foreach($products_approve as $pro_approve)

                    <tr>
                        <td>
                            <div class="product-name d-flex align-items-center">
                                <img src="{{(!empty($pro_approve->product_thambnail))?asset($pro_approve->product_thambnail):asset('public/image/no_image.jpg')}}" alt="" height="60">
                                <h5><a href="#">{{$pro_approve->product_name}}</a> {{--<small class="small-text">Product category</small>--}}</h5>
                            </div>
                        </td>
                        <td>{{$pro_approve->size}}</td>
                        <td>{{$pro_approve->color}}</td>
                        <td>{{$pro_approve->label}}</td>
                        <td><a href="#" onclick="showpop(this,'{{$pro_approve->id}}')" class="edit"><i class="fas fa-pen"></i></a> </td>
                    </tr>
                    @endforeach
                </table>
                @else
                    <p>{{__('Approved products')}} : 0 </p>
                @endif

                @if(count($products_pending)>0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{__('Waiting approval products')}}</th>
                            <th>{{__('Size')}}</th>
                            <th>{{__('Color')}}</th>
                            <th>{{__('Name label')}}</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    @foreach($products_pending as $pro_pending)
                    <tr>
                        <td>
                            <div class="product-name d-flex align-items-center">
                                <img src="{{(!empty($pro_pending->product_thambnail))?asset($pro_pending->product_thambnail):asset('public/image/no_image.jpg')}}" alt="" height="60">
                                <h5><a href="#" >{{$pro_pending->product_name}}</a> {{--<small class="small-text">Product category</small>--}}</h5>
                            </div>
                        </td>
                        <td class="none">N/A</td>
                        <td class="none">N/A</td>
                        <td class="none">N/A</td>
                        <td><a href="#" onclick="showpop(this,'{{$pro_pending->id}}')" class="edit"><i class="fas fa-pen"></i></a> </td>
                    </tr>
                    @endforeach

                </table>
                @else
                    <p>{{__('Waiting approval products')}} : 0 </p>
                @endif
            </div><!-- Cart table -->
        </div><!-- Col -->
        <aside class="col-md-4">
            <div class="shadow-box emp-order-list">
                <h4>{{__('See other employees orders')}}</h4>
                <div class="order-list">
                    <ul class="scrollbar">
                    @foreach($employees as $emp)
                        @if($emp->id!=last(request()->segments()))
                        <li class="emp-short-info d-flex align-items-center justify-content-between">
                            <div class="d-flex">
                                <figure class="emp-pic"><img src="{{(!empty($emp->profile_photo_path))?asset($emp->profile_photo_path):asset('public/image/user.png')}}" alt="" width="50"></figure>
                                <div class="emp-name">
                                    <h4><a href="#">{{$emp->name}}</a></h4>
                                    <span class="login-time">{{__('Last logged in')}}: @if(!empty($emp->last_login_at)) {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $emp->last_login_at)->format('d. F')}} @endif</span>
                                </div>
                            </div>
                            <div class="actions">
                                <a href="{{ url('/company/view-employee/' . $emp->id) }}"><i class="fas fa-eye"></i></a>
                            </div>
                        </li>
                        @endif
                        @endforeach

                    </ul>
                </div>
            </div><!-- Employee order list -->
        </aside><!-- Col -->
    </div>
</div><!-- Cart wrap  -->


<!-- Modal -->
<div class="modal fade" id="orderModal" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <!--<h5 class="modal-title" id="orderModalLabel"><strong></strong></h5>-->
        <button type="button" onclick="closeModel()"  class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">


        </div>
    </div>
    </div>
</div><!-- Price modal-->




@endsection
@section('js')
<script>
function showpop(that,id) {

    $.ajax({
         url: "{{url('company/ajax/show-employee-popdata/')}}/"+id,
         method: 'get',
         //data: fd,
         contentType: false,
         processData: false,
         dataType: 'json',
         success: function(response){
           $("#orderModal .modal-body").html('');
           $("#orderModal .modal-body").html(response);
            $('#orderModal').removeClass('fade');
            $('.products-con').append('<div class="modal-backdrop fade show"></div>');
            //$("#pid").val(id);
            $('#orderModal').show();
         }
    });
}
function closeModel(){
    $('#orderModal').addClass('fade');
    $('.modal-backdrop').remove();

    $('#orderModal').hide();
}
</script>
@endsection
