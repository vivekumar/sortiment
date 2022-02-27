@extends('company.main_master')
@section('content')

<div class="cart-wrap shadow-box p-40">
<form action="{{ route('checkout')}}" class="form" method="post">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="page-title">
                <h1><img src="{{asset('frontend/assets/img/shopping-cart-solid.png') }}" alt=""> Cart</h1>
            </div><!-- Page title -->
            @php $i=0; @endphp

            @foreach(Cart::content() as $key11=>$row)

            <div class="cart-table table-responsive ptb-45">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tr>
                        <td>
                            <div class="product-name d-flex align-items-center">
                                <img src="{{ asset(($row->options->has('image') ? $row->options->image : ''))}}" alt="" style="width:100px; height:auto">
                                <h5><a href="#">{{$row->name}}</a> <small class="small-text">Product category</small></h5>
                            </div>
                        </td>
                        <td>
                            <div class="qty">
                                <a href="{{ url('/company/cart/update/'.$row->rowId.'/minus')}}" class="qty-dec"><i class="fas fa-minus"></i></a>
                                <input type="text" class="qty-input" placeholder="0" value="{{$row->qty}}">
                                <a href="{{ url('/company/cart/update/'.$row->rowId.'/plus')}}" class="qty-inc"><i class="fas fa-plus"></i></a>
                            </div>
                        </td>
                        <td>{{$row->price}} DKK</td>
                        <td><a href="{{route('cart.delete',$row->rowId)}}" class="delete"><i class="fas fa-times"></i></a> </td>
                    </tr>

                </table>
                <div class="btn-row d-flex justify-content-center align-items-center">
                    <li class="btn btn-tabs active-tab"><a href="#" class="btn btn-blue">Write product information yourself</a>
                    <span>OR</span>
                    <a href="#" class="btn btn-outline">Let employees choose</a>
                </div><!-- Button row -->
            </div><!-- Cart table -->
            <div class="cart-prod-info">
                <div class="top-tab">
                    <span class="seleccted">Upload name list</span>
                    <span>Upload your excel name list by clicking the button</span>
                </div><!-- top tab-->
                <div class="cart-items-table table-responsive">
                    <table  class="table">

                        @php
                        $product=$products[$i];

                        @endphp
                        {{--@foreach($products as $product)--}}
                            @for ($count = 1; $count <= $product['qty']; $count ++)
                                <tr>
                                    @if($product['name_on_product']=="yes")
                                    <td>
                                        <input type="text" name="lable[{{$row->id}}][]" placeholder="Write name label" class="form-control">
                                    </td>
                                    @endif
                                    @foreach ($product['attributes'] as $attribute)

                                        <td>
                                            <select name="product_attribute[{{$row->id}}][{{ $attribute['attribute_id'] }}][]" id="product-attribute-{{ $attribute['attribute_id'] }}" class="form-select">
                                                <option value="">Choose {{ $attribute['name'] }}</option>
                                                @foreach ($attribute['values'] as $value)
                                                    <option value="{{ $value['value'] }}">{{ $value['value'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    @endforeach
                                    <td>
                                        <div class="cart-qty d-flex align-items-center">
                                            <input type="text" value="1" class="form-control" name="qty[{{$row->id}}][]">
                                            <span>Quantity</span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="delete" onclick="confirm('Are you sure?') ? $(this).parent().parent().remove() : false"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endfor
                        {{--@endforeach--}}

                    </table>
                </div><!-- Cart items table -->
            </div><!-- Cart product information -->
            @php $i=$i+1; @endphp
            @endforeach

            @if(count(Cart::content()) <= 0)
                Product not found
            @endif
        </div><!-- Col -->
        <aside class="col-md-4">
            <div class="shadow-box user-info-form">
                <h4>Your information</h4>

                    <div class="form-group mb-3">
                        <input type="text" placeholder="Name" class="form-control" value="{{ Auth::user()->name }}" name="name">
                        <span class="requ">*</span>
                        @error('name')
                            <span class="text-tenger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Email" class="form-control" value="{{ Auth::user()->email }}" name="email">
                        <span class="requ">*</span>
                        @error('email')
                            <span class="text-tenger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Phone number" class="form-control" value="{{ Auth::user()->phone }}" name="phone">
                        <span class="requ">*</span>
                        @error('phone')
                            <span class="text-tenger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Company name" class="form-control" value="{{ Auth::user()->company }}" name="company">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Postal code" class="form-control" value="{{ Auth::user()->zip }}" name="zip">
                        <span class="requ">*</span>
                        @error('zip')
                            <span class="text-tenger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Address" class="form-control" value="{{ Auth::user()->address }}" name="address">
                        <span class="requ">*</span>
                        @error('address')
                            <span class="text-tenger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-blue">Next</button>
                    </div>

            </div><!-- user info form -->
        </aside><!-- Col -->
    </div>
    </form>
</div><!-- Cart wrap  -->
@endsection
