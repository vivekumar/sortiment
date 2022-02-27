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
                                <input type="text" name="cartQty" class="qty-input" placeholder="0" value="{{$row->qty}}">
                                <a href="{{ url('/company/cart/update/'.$row->rowId.'/plus')}}" class="qty-inc"><i class="fas fa-plus"></i></a>
                            </div>
                        </td>
                        <td data-label="{{__('Price')}}">{{$formatter->formatCurrency($row->price, 'DKK'), PHP_EOL;}}</td>
                        <td data-label="Slet"><a href="{{route('cart.delete',$row->rowId)}}" class="delete"><i class="fas fa-times"></i></a> </td>
                    </tr>

                </table>
                <div class="btn-group-sm float-end"><button type="button" class="btn btn-blue  btn-sm" onclick="updateCart('{{$row->rowId}}',this)">{{__('Update cart')}}</button></div>

            </div><!-- Cart table -->

            <ul class="tabs btn-row d-flex justify-content-center align-items-center pb-45">
                <li class="btn btn-tabs active-tab"><a href="{{route('view.cart')}}" data-or="eller">{{__('Write product information yourself')}}</a></li>

                <li class="btn btn-tabs"><a href="{{route('view.cart1')}}">{{__('Let employees choose')}}</a></li>
            </ul><!-- Button row -->




            <ul class="tabs-content1 cart-prod-info">
                <li>
                    <div class="top-tab">

                    @if($products[$i]['name_on_product']=="yes")<span class="seleccted">{{__('Upload name list')}}</span>@endif
                    @if(count($products[$i]['attributes'])>0 || $products[$i]['name_on_product']=="yes")
                        <span><a href="javascript:void(0);" data-bs-toggle="modal1" data-bs-target="#excelModal1" class="modal-btn" onclick="namelistModel('{{$row->id}}',this)">{{__('Upload your excel name list by clicking the button')}}</a></span>

                    @endif
                    </div><!-- top tab-->
                    <div class="cart-items-table table-responsive">
                        <table  class="table table{{$row->id}}">
                            <input class="uploadExcel" name="uploadExcel[{{$row->id}}][]" type="hidden" value="0">
                            @php
                            $product=$products[$i];

                            @endphp
                            {{--@foreach($products as $product)--}}
                                @for ($count = 1; $count <= $product['qty']; $count ++)
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
                            {{--@endforeach--}}

                        </table>
                    </div><!-- Cart items table -->
                </li>


                {{--<li style="display: none">
                    <div class="employees-dts text-center">
                        <h3>We have found 12 employees in your company</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="media">
                                    <div class="media-left">
                                        <div class="img-style">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#excelModal"><img src="{{asset('frontend/assets/img/file-excel-solid.png') }}" alt="" class="img-responsive"></a>
                                        </div>
                                    </div>

                                    <div class="media-body">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#excelModal"><h3>Import employees using Execel</h3></a>
                                        <p>Click here to download Excel template</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="media">
                                    <a href="#">
                                        <div class="media-left">
                                            <div class="img-style">
                                                <a href="#"> <img src="{{asset('frontend/assets/img/Group 98.png') }}" alt="" class="img-responsive"></a>
                                            </div>
                                        </div>

                                        <div class="media-body">
                                            <a href="#"> <h3>Add employees manually</h3></a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>--}}
            </ul><!-- Cart product information -->


            {{--<div class="modal fade" id="excelModal" role="dialog" aria-labelledby="excelModalLabel" aria-hidden="true">
                <div class="modal-dialog excel-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center text-center">
                    <h5 class="modal-title" id="excelModalLabel"><strong>
                        Import employees using Execel</strong></h5>
                    <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="price-form">

                            <div class="company-info">
                                <div class="form-group mb-3 upload-logo">
                                    <button type="button" id="btnup" class="upload-btn">
                                        <p id="namefile" class="">Upload a file</p>
                                        <img src="{{asset('frontend/assets/img/upload-icon.png') }}" class="upload-icon" alt="">
                                    </button>
                                    <input type="file" value="" name="fileup" id="fileup">
                                </div><!-- row-->

                                <div class="form-group">
                                    <button type="submit" class="btn btn-blue f-width">Upload Excel file</button>
                                </div>
                            </div>
                        </form><!-- Price form-->
                    </div>
                </div>
                </div>
            </div>--}}

            @php $i=$i+1; @endphp
            @endforeach

            @if(count(Cart::content()) <= 0)
                Product not found
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
                            <p id="namefile" class="">{{__('upload a file')}}</p>
                            <img src="{{ asset('frontend/assets/img/upload-icon.png')}}" class="upload-icon" alt="">
                        </button>
                        <input type="file" value="" name="fileup" id="fileup">
                        <input type="hidden" pid="" id="pid">
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
@endsection
@section('js')
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
</script>

<script>

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

    $('#submit').click(function(){
        console.log('ewrwe');
      // Get the selected file
      var files = $('#fileup')[0].files;

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
                $('.table'+response.pid+' .uploadExcel').val(1);
                /*$(".table"+response.pid+" > tbody > tr").each(function(){
                    var productVal = $('td:eq(0) input', this).val('ewwe');
                });*/
                // var label1 = response.data[0][0];
                // var size1 = response.data[0][1];
                // var color1 = response.data[0][2];
                // var qtyyy1 = response.data[0][3];

                $.each( response.data, function( key, cdata1 ) {
                    //console.log(cdata1[1]);
                    console.log(cdata1);
                    //var ar[] = cdata1[0]

                    if(key>0){
                        //coldata = cdata1.split(",");
                   // console.log(coldata[0]);
                    //$('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td:eq(0) input').val(cdata1);
                        if(response.label=="yes"){

                            $('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tlabel input').val(cdata1[0]);
                        }
                        if(response.Size){
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
  </script>
@endsection




