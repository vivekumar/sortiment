@extends('company.main_master')
@section('css')
<style>
    .products-con div#namListModal .modal-dialog {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
    div#namListModal .modal-body {
        text-align: center;
    }

    div#namListModal .modal-body a.download-sample {
        font-size: 20px;
        color: #3020d1;
        font-weight: 600;
    }

    div#emp0model .modal-dialog.modal-dialog-scrollable {
        margin-top: 0;
        transform: translateX(-50%);
        top: 70px;
        height: auto;
    }
    @media (max-width: 1440px) and (min-width: 1023px){
        div#emp0model .modal-dialog.modal-dialog-scrollable {
            left: 33%;
        }
    }



    div#emp0model .modal-dialog.modal-dialog-scrollable p, div#emp0model .modal-dialog.modal-dialog-scrollable button {
        text-align: center;
        margin: 0 auto;
        display: block;
    }


</style>
@endsection
@section('content')

<div class="cart-wrap shadow-box p-40">
<form action="{{ route('checkout')}}" class="form" method="post">

    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="page-title">
                <h1><img src="{{asset('frontend/assets/img/shopping-cart-solid.png') }}" alt=""> {{__('Cart')}}</h1>
            </div><!-- Page title -->
            @php $i=0; $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY); @endphp

            @foreach(Cart::content() as $key11=>$row)

            <div class="cart-table table-responsive ptb-45">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">{{__('Product')}}</th>
                            <th scope="col">{{__('Quantity')}}</th>
                            <th scope="col">{{__('Price')}}</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>

                    <tr>
                        <td scope="row" data-label="{{__('Product')}}">
                            <div class="product-name d-flex align-items-center">
                                <img src="{{ asset(($row->options->has('image') ? $row->options->image : ''))}}" alt="" style="width:100px; height:auto">
                                <h5><a href="#">{{$row->name}}</a> <small class="small-text"></small></h5>
                            </div>
                        </td>
                        <td data-label="{{__('Quantity')}}">
                            <div class="qty">
                                <a href="{{ url('/company/cart/update/'.$row->rowId.'/minus')}}" class="qty-dec"><i class="fas fa-minus"></i></a>
                                <input type="text" class="qty-input" placeholder="0" value="{{$row->qty}}">
                                <a href="{{ url('/company/cart/update/'.$row->rowId.'/plus')}}" class="qty-inc"><i class="fas fa-plus"></i></a>
                            </div>
                        </td>
                        <td data-label="{{__('Price')}}">{{$formatter->formatCurrency($row->price, 'DKK'), PHP_EOL;}}</td>
                        <td data-label="Slet"><a href="{{route('cart.delete',$row->rowId)}}" class="delete"><i class="fas fa-times"></i></a> </td>
                    </tr>

                </table>
                <div class="btn-group-sm float-end"><button type="button" class="btn btn-blue  btn-sm" onclick="updateCart('{{$row->rowId}}',this)">{{__('Update cart')}}</button></div>
            </div><!-- Cart table -->

            <ul class="tabs btn-row d-flex justify-content-center align-items-center pb-25">
                <li class="btn btn-tabs "><a href="{{route('view.cart')}}" data-or="eller">{{__('Write product information yourself')}}</a></li>

                <li class="btn btn-tabs active-tab"><a href="{{route('view.cart1')}}">{{__('Let employees choose')}}</a></li>
            </ul><!-- Button row -->




            <ul class="tabs-content cart-prod-info">
                <li style=" margin-bottom: 30px; background: #fff;">
                    <br>
                    <div class="employees-dts text-center">
                        <h3>Vi har fundet {{$employees->count()}} medarbejder på din profil </h3>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="employee-cech-list">
                                    @php
                                        $ccount=Cart::count();
                                        $z=1;
                                    @endphp
                                    @foreach($employees as $employee)
                                       @if($z<=$ccount)

                                    <li>
                                        <lable><input type="checkbox" name="employee[{{$row->id}}][]" value="{{$employee->id}}" checked>{{$employee->name}}</lable>
                                    </li>
                                    @else

                                    <li>
                                        <lable><input type="checkbox" name="employee[{{$row->id}}][]" value="{{$employee->id}}">{{$employee->name}}</lable>
                                    </li>

                                    @endif
                                    @php $z = $z+1; @endphp

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        {{--<div class="row">
                            <div class="col-md-6">
                                <div class="media">
                                    <div class="media-left">
                                        <div class="img-style">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#excelModal"><img src="{{asset('frontend/assets/img/file-excel-solid.png') }}" alt="" class="img-responsive"></a>
                                        </div>
                                    </div>

                                    <div class="media-body">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#excelModal" class="modal-btn"><h3>{{__('Import employees using Execel')}}</h3></a>
                                        <p><a href="{{ url('/')}}/public/uploads/excel/employee-sample-data.xlsx" class="dwn-file" download>{{__('Click here to download Excel template')}}</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="media">
                                    <a href="#">
                                        <div class="media-left">
                                            <div class="img-style">
                                            <a href="#" class="add-employee modal-btn" data-bs-toggle="modal" data-bs-target="#employeeseModal"> <img src="{{asset('frontend/assets/img/Group 98.png') }}" alt="" class="img-responsive"></a>
                                            </div>
                                        </div>

                                        <div class="media-body">
                                        <a href="#" class="add-employee modal-btn" data-bs-toggle="modal" data-bs-target="#employeeseModal"> <h3>{{__('Add employees manually')}}</h3></a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </li>
                
                @if(Cart::count() != $employees->count())
                <li>
                    <div class="top-tab">
                    @if($products[$i]['name_on_product']=="yes")<span class="seleccted">{{__('Upload name list')}}</span>
                        <span><a href="javascript:void(0);" data-bs-toggle="modal1" data-bs-target="#excelModal1" class="modal-btn" onclick="namelistModel('{{$row->id}}',this)">{{__('Upload your excel name list by clicking the button')}}</a></span>@endif
                    </div><!-- top tab-->
                    <div class="cart-items-table table-responsive">
                        <table  class="table table{{$row->id}}">
                            <input class="uploadExcel" name="uploadExcel[{{$row->id}}][]" type="hidden" value="0">
                            @php
                                $product=$products[$i];                                
                            @endphp
                            @if(Cart::count() > $employees->count())
                                @php
                                    
                                    $loop = (int) ($row->qty - $employees->count());
                                    $loop2=(int) $loop;
                                    //print_r($loop);die;
                                @endphp
                                @for ($count = 1; $count <= $loop2; $count ++)
                                    <tr>
                                        @if($product['name_on_product']=="yes")
                                        <td class="tlabel">
                                            <input type="text" name="lable[{{$row->id}}][]" placeholder="{{__('Write name label')}}" class="form-control" required>
                                        </td>
                                        @endif
                                        @foreach ($product['attributes'] as $attribute)

                                            <td class="t{{ $attribute['name'] }}">
                                                <select name="product_attribute[{{$row->id}}][{{ $attribute['attribute_id'] }}][]" id="product-attribute-{{ $attribute['attribute_id'] }}" class="form-select" required>
                                                    <option value="">{{__('Choose')}} {{__($attribute['name']) }}</option>
                                                    @php $atttt=[];@endphp
                                                    @foreach($attribute['values'] as $key=>$attribut)
                                                        @php
                                                        $atttt[$attribut['value']]=\App\Models\AttributeValue::where('id',$attribut['attribute_value_id'])->value('attr_order');
                                                        @endphp
                                                    @endforeach
                                                    @php
                                                    asort($atttt);
                                                    @endphp

                                                    @foreach ($atttt as $key11=>$value)
                                                        <option value="{{ $key11 }}">{{ $key11 }}</option>
                                                    @endforeach
                                                    {{--
                                                    @foreach ($attribute['values'] as $value)
                                                        <option value="{{ $value['value'] }}">{{ $value['value'] }}</option>
                                                    @endforeach
                                                    --}}
                                                </select>
                                            </td>
                                        @endforeach
                                        <td class="tqty">
                                            <div class="cart-qty d-flex align-items-center">
                                                <input type="text" value="1" class="form-control" name="qty[{{$row->id}}][]" required>
                                                <span>{{__('Quantity')}}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="delete" onclick="confirm('Er du sikker?') ? $(this).parent().parent().remove() : false"><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endfor
                            @endif

                        </table>
                    </div><!-- Cart items table -->
                </li>
                @endif


            </ul><!-- Cart product information -->


            @php $i=$i+1; @endphp
            @endforeach


            @if(Cart::count() != $employees->count())
            @if(count(Cart::content()) <= 0)
                Product not found
            @endif
            <div class="employees-dts ">
            <div class="row">
                <div class="col-md-6">
                    <div class="media">
                        <div class="media-left">
                            <div class="img-style">
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#excelModal" class="modal-btn"><img src="{{asset('frontend/assets/img/file-excel-solid.png') }}" alt="" class="img-responsive"></a>
                            </div>
                        </div>

                        <div class="media-body">
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#excelModal" class="modal-btn"><h3>{{__('Import employees using Excel')}}</h3></a>
                            <p><a href="{{ url('/')}}/public/uploads/excel/Oprettelses skabelon.xlsx" class="dwn-file" download>{{__('Click here to download Excel template')}}</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="media">
                        <a href="#">
                            <div class="media-left">
                                <div class="img-style">
                                <a href="#" class="add-employee modal-btn" data-bs-toggle="modal" data-bs-target="#employeeseModal"> <img src="{{asset('frontend/assets/img/Group 98.png') }}" alt="" class="img-responsive"></a>
                                </div>
                            </div>

                            <div class="media-body">
                            <a href="javascript:;" class="add-employee modal-btn"  onclick="showAddEmployeeModel(this,'employeeseModal')"> <h3>{{__('Add employees manually')}}</h3></a>
                            <!--data-bs-toggle="modal1" data-bs-target="#employeeseModal1"-->
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            </div>
        @endif
        </div><!-- Col -->
        <aside class="col-md-4">
            <div class="shadow-box user-info-form">
                <h4>{{__('Your information')}}</h4>

                    <div class="form-group mb-3">
                        <input type="text" placeholder="{{__('Name')}}" class="form-control" value="{{ Auth::user()->name }}" name="name">
                        <span class="requ">*</span>
                        @error('name')
                            <span class="text-tenger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="{{__('Email')}}" class="form-control" value="{{ Auth::user()->email }}" name="email">
                        <span class="requ">*</span>
                        @error('email')
                            <span class="text-tenger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="{{__('Phone number')}}" class="form-control" value="{{ Auth::user()->phone }}" name="phone">
                        <span class="requ">*</span>
                        @error('phone')
                            <span class="text-tenger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="{{__('Company name')}}" class="form-control" value="{{ Auth::user()->company }}" name="company">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="{{__('Postal code')}}" class="form-control" value="{{ Auth::user()->zip }}" name="zip">
                        <span class="requ">*</span>
                        @error('zip')
                            <span class="text-tenger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="{{__('Address')}}" class="form-control" value="{{ Auth::user()->address }}" name="address">
                        <span class="requ">*</span>
                        @error('address')
                            <span class="text-tenger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-blue">{{__('Next')}}</button>
                    </div>

            </div><!-- user info form -->
        </aside><!-- Col -->
    </div>
    </form>
</div><!-- Cart wrap  -->

<div class="modal fade pop-bottom" id="excelModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="excelModalLabel"><strong>
        {{__('Import employees using Execel')}}</strong></h5>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <form action="" class="price-form">
                <div id="errors"></div>
                <div class="company-info">
                    <div class="form-group mb-3 upload-logo">
                        <button type="button" id="btnup" class="upload-btn">
                            <p  id="namefile">{{__('upload a file')}}</p>
                            <img src="{{ asset('frontend/assets/img/upload-icon.png')}}" class="upload-icon" alt="">
                        </button>
                        <input type="file" value="" name="fileup" id="fileup" >
                    </div><!-- row-->
                    <div id="responseMsg" ></div>
                    <div class='alert alert-danger mt-2 d-none text-danger' id="err_file"></div>
                    <div class="form-group">
                        <button type="button" id="submit" class="btn btn-blue f-width">{{__('Upload Excel file')}}</button>
                    </div>
                </div>
            </form><!-- Price form-->
        </div>
    </div>
    </div>
</div>

<div class="modal fade pop-bottom" id="employeeseModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header text-center">
        <h5 class="modal-title">{{__('Add employees manually')}}</h5>
        <p>{{__('We will automatically generate a user and password for each employee')}}</p>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close" onclick="closeModel3()" ><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <form class="add-emp-form" id="form-employee">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{__('Name & last name')}}</th>
                            <th>{{__('Email')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody id="employee-container">
                        <tr>
                            <td><input type="text" class="form-control employee-name" name="employee[0][name]" placeholder="{{__('Employee name')}}" value=""></td>
                            <td><input type="text" class="form-control employee-email" name="employee[0][email]" placeholder="{{__('Employee email')}}" value=""></td>
                            <td>
                                <button class="btn btn-danger" type="button" onclick="confirm('Are you sure?') ? $(this).parent().parent().remove() : false">
                                    <i class="fa fa-minus-circle"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-end">
                                <button class="btn btn-lg btn-primary" id="add-employe-button" data-toggle="tooltip" title="{{__('Add Another')}}" type="button">
                                    <i class="fa fa-plus-circle"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-lg btn-success" data-toggle="tooltip" title="{{__('Save')}}" onclick="saveEmployee()">
                                    <i class="fa fa-save"></i>
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    </div>
</div>


<div class="modal fade pop-bottom" id="namListModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="excelModalLabel"><strong>
        {{__('Import name list using Execel')}}</strong></h5>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close" onclick="closeModel()"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <a href="{{asset('/public/uploads/excel/Excel skabelon.xlsx')}}" class="download-sample" download>{{__('Download sample data')}}</a>
            <form action="" class="price-form">
                <div id="errors"></div>
                <div class="company-info">
                    <div class="form-group mb-3 upload-logo">
                        <button type="button" id="btnup" class="upload-btn">
                            <p id="namefile2" class="">{{__('upload a file')}}</p>
                            <img src="{{ asset('frontend/assets/img/upload-icon.png')}}" class="upload-icon" alt="">
                        </button>
                        <input type="file" value="" name="fileup" id="fileup2" class="fileup">
                        <input type="hidden" pid="" id="pid">
                    </div><!-- row-->
                    <div id="responseMsg" ></div>
                    <div class='alert alert-danger mt-2 d-none text-danger' id="err_file"></div>
                    <div class="form-group">
                        <button type="button" id="submit2" class="btn btn-blue f-width">{{__('Upload Excel file')}}</button>
                    </div>
                </div>
            </form><!-- Price form-->
        </div>
    </div>
    </div>
</div>


@if($employees->count()==0)
<div class="modal fade pop-bottom show" id="emp0model" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="excelModalLabel"><strong>
        {{__('Ingen medarbejdere fundet')}}</strong></h5>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close" onclick="closeModel2()"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <p> Du skal først oprette dine medarbejdere før du kan tildele dem produkter.</p>
            <btton onclick="showemployee(this)" class="btn btn-primery">Opret medarbejdere her</btton>
        </div>
    </div>
    </div>
</div>
@endif

@endsection
@section('js')
<script type="text/javascript">
    saveEmployee = () => {
        if (!validateEmployeeForm()) {
            snackbar.warning("Warning: Email should be unique!");
            return;
        }

        //$('#form-employee').prepend('<input type="hidden" name="_token" value="{{ csrf_token() }}" />');

        $.ajax({
            url: base_url + '/company/create-employee',
            type: 'post',
            dataType: 'json',
            data: $('#form-employee').serialize(),
            success: (json) => {
                if (json.errors) {
                    for (let e in json.errors) {
                        if (json.errors[e]['name']) {
                            $('input[name="employe[' + e + '][name]"]').after('<divv class="text-danger">' + json.errors[e]['name'] + '</div>');
                        }

                        if (json.errors[e]['email']) {
                            $('input[name="employe[' + e + '][email]"]').after('<divv class="text-danger">' + json.errors[e]['email'] + '</div>');
                        }
                    }
                }

                if (json.success) {
                    //getemployee();
                    snackbar.success('Employees were saved!');
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            }
        });
    }
    (() => {
        setTimeout(() => {
            @if (Session::has('message'))
                snackbar.success("{{ Session::get('message') }}");
            @endif
        }, 500);
    })();

</script>
<script>
  var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

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
           url: "{{route('uploadFile')}}",
           method: 'post',
           data: fd,
           contentType: false,
           processData: false,
           dataType: 'json',
           success: function(response){
            $("#errors").html('');
             // Hide error container
             $('#err_file').removeClass('d-block');
             $('#err_file').addClass('d-none');

             if(response.success == 1){ // Uploaded successfully
                //getemployee();
                $('.table'+response.pid+' .uploadExcel').val(1);

               // Response message
               $('#responseMsg').removeClass("alert alert-danger");
               $('#responseMsg').addClass("alert alert-success");
               $('#responseMsg').html(response.message);
               $('#responseMsg').show();
               setTimeout(() => {
                        location.reload();
                    }, 3000);
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
  /*$(document).ready(function(){
    getemployee();
  });
  function getemployee(){
    $.ajax({
        url: "{{route('getEmployee')}}",
        type: 'get',
        dataType: 'json',
        data: $('#form-employee').serialize(),
        success: function(json){
            $('.employee-cech-list').html(json.data);
            if (json.success) {
                snackbar.success('Employees were saved!');
                setTimeout(() => {
                    location.reload();
                }, 3000);
            }
        }
    });
  }*/
  </script>
  <script>
function updateCart(rowid,that) {
    var item_qty=$(that).parent().parent().find('input').val();
    console.log(item_qty);
    $.ajax({
        url: "{{url('/')}}/company/cart/updatebulk/"+rowid+"/"+item_qty,
        method: 'get',
        data: item_qty,
        contentType: false,
        processData: false,
        //dataType: 'json',
        success: function(response){
            location.reload();
            //window.location.reload();
        },
    });
}
function showAddEmployeeModel(){
    $('#employeeseModal').show();
    $('#employeeseModal').addClass('show');
    $('.products-con').append('<div class="modal-backdrop fade show"></div>');
}
function showemployee(that){
    console.log('joikjoik');
    $('#emp0model').hide();
    $('#emp0model').removeClass('show');

    $('#employeeseModal').show();
    $('#employeeseModal').addClass('show');

     $(window).scrollTop($('.products-con').height()-($(window).height()-200));
}
function closeModel3(){
    $('#employeeseModal').addClass('fade');
    $('.modal-backdrop').remove();
    $('body').css('overflow','auto');
    $('#employeeseModal').hide();
}

function namelistModel(id,that){
    $('#namListModal').removeClass('fade');
    $('.products-con').append('<div class="modal-backdrop fade show"></div>');
    $("#pid").val(id);
    $('#namListModal').show();
    $(window).scrollTop(0);
}
function closeModel(){
    $('#namListModal').addClass('fade');
    $('.modal-backdrop').remove();

    $('#namListModal').hide();
}
var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

$(document).ready(function(){
  //$('.table4 > tbody > tr:nth-child(2) > td:eq(0) input', this).val('vivek');

  //$('.table4 > tbody > tr:nth-child(1) > td.tColor select option[value="White"]').prop('selected', true);

  $('#submit2').click(function(){
      console.log('ewrwe');
    // Get the selected file
    var files = $('#fileup2')[0].files;

    if(files.length > 0){
       var fd = new FormData();

       // Append data
       fd.append('file',files[0]);
       fd.append('_token',CSRF_TOKEN);
       fd.append('pid',$("#pid").val());
       // Hide alert
       $('#responseMsg').hide();

       // AJAX request
       $.ajax({
         url: "{{route('uploadList')}}",
         method: 'post',
         data: fd,
         contentType: false,
         processData: false,
         dataType: 'json',
         success: function(response){
          $("#errors").html('');
           // Hide error container
           $('#err_file').removeClass('d-block');
           $('#err_file').addClass('d-none');
              console.log(response);
           if(response.success == 1){ // Uploaded successfully

              /*$(".table"+response.pid+" > tbody > tr").each(function(){
                  var productVal = $('td:eq(0) input', this).val('ewwe');
              });*/

              $.each( response.data, function( key, cdata1 ) {
                  //console.log(cdata1[1]);
                  console.log(response.label);
                  if(key>0){
                      //coldata = cdata1.split(",");
                 // console.log(coldata[0]);
                  //$('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td:eq(0) input').val(cdata1);
                      if(response.label=="yes"){

                          $('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tlabel input').val(cdata1[0]);
                      }
                      if(response.Size){
                          //$("'.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tSize select option:selected").prop("selected",false);
                          //console.log('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tSize select option[value="'+cdata1[1]+'"]');
                          size=cdata1[1];
                          $('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tSize select option[value="'+size.trim()+'"]').prop("selected", true);
                          //$('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tSize select').val(cdata1[1]).change();
                      }
                      if(response.Color){
                          //console.log('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tColor select option[value="'+cdata1[2]+'"]');
                          color=cdata1[2];
                          $('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tColor select option[value="'+color.trim()+'"]').prop("selected", true);
                      }
                      $('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td:eq(3) input').val(cdata1[3]);
                  }

              });

             // Response message
             $('#responseMsg').removeClass("alert alert-danger");
             $('#responseMsg').addClass("alert alert-success");
             $('#responseMsg').html(response.message);
             $('#responseMsg').show();

             // File preview
             $('#filepreview').show();
             $('#filepreview img,#filepreview a').hide();

             setTimeout(() => {
                $('#namListModal').addClass('fade');
                $('.modal-backdrop').remove();
                $('#namListModal').hide();
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
         },
         error: function(xhr, status, errors)
          {
              $('#err_file').text('');
              $('#err_file').removeClass('d-block');
              $('#err_file').addClass('d-none');
              $.each(xhr.responseJSON.errors, function (key, item)
              {
                  $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
              });
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

var a = {{$employees->count()}};

if(a==0){
    $('#emp0model').show();
    $('.products-con').append('<div class="modal-backdrop fade show"></div>');
}

function closeModel2(){
    $('#emp0model').addClass('fade');
    $('#emp0model').removeClass('show');
    $('.modal-backdrop').remove();
    $('#emp0model').hide();

}
</script>
@endsection
