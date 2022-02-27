@extends('company.main_master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.css">
<style>
    input[type="checkbox"][readonly] {
        pointer-events: none;
    }

.custom_tooltip {
    position: absolute;
    right: 0;
    background: #fff;
    padding: 5px 15px;
    border-radius: 10px;
    z-index: 9;
    top: 20px;
    left: 0;
    width: auto;
    right: auto;
    display: none;
}
.custom_tooltip:after {content: '';position: absolute;width: 0;height: 0;border-left: 6px solid transparent;border-right: 6px solid transparent;border-top: 12px solid #ffffff;bottom: -10px;left: 30%;}

span.info_icon {
    float: none!important;
    font-size: 13px;
    background: #fff;
    width: 24px;
    height: 24px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    border-radius: 100%;
}
span.info_icon:hover .custom_tooltip {
    display: block;
}
</style>
<!--<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/cosmo/bootstrap.min.css'>-->

<style>

.multi-step-form fieldset {
  display: none;
}
.multi-step-form fieldset:first-of-type {
  display: block;
}
.multi-step-form fieldset.hidden {
  display: none;
}
.multi-step-form fieldset.visible {
  display: block;
}
.multi-step-form .steps button {
  border: 0;
}
.multi-step-form .steps [disabled] {
  background: none;
}
.multi-step-form .steps .active {
  background: #eee;
}

.error {
  color: red;
}

</style>
@endsection
@section('content')
@php //print_r($request->product_attribute) @endphp
<div class="cart-wrap shadow-box p-40 multi-step-form">
    <form action="{{route('payments')}}" class="form" method="post">
        @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="page-title">
                <h1><img src="{{asset('frontend/assets/img/shopping-cart-solid.png') }}" alt=""> {{__('Checkout')}}</h1>
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

                        </tr>
                    </thead>

                    <tr>
                        <td scope="row" data-label="{{__('Product')}}">
                            <div class="product-name d-flex align-items-center">
                                <img src="{{ asset(($row->options->has('image') ? $row->options->image : ''))}}" alt="" style="width:100px; height:auto">
                                <h5><a href="#">{{$row->name}}</a> <!--<small class="small-text">Product category</small>--></h5>
                            </div>
                        </td>
                        <td data-label="{{__('Quantity')}}">
                            <div class="qty">

                                <input type="text" class="qty-input" readonly="" value="{{$row->qty}}" >

                            </div>
                        </td>
                        <td data-label="{{__('Price')}}">{{$formatter->formatCurrency($row->price, 'DKK'), PHP_EOL;}} </td>

                    </tr>

                </table>
                <!--<div class="btn-row d-flex justify-content-center align-items-center">
                    <a href="#" class="btn btn-blue">Write product information yourself</a>
                    <span>OR</span>
                    <a href="#" class="btn btn-outline">Let employees choose</a>
                </div>--><!-- Button row -->
            </div><!-- Cart table -->
            <div class="cart-prod-info">
                <!--<div class="top-tab">
                    <span class="seleccted">Upload name list</span>
                    <span>Upload your excel name list by clicking the button</span>
                </div>--><!-- top tab-->
                <div class="cart-items-table table-responsive">
                    <table  class="table">
                        
                        <input class="uploadExcel" name="uploadExcel[{{$row->id}}][]" type="hidden" value="{{@$request->uploadExcel[$row->id][0]}}">
                        @php
                        $product=$products[$i];
                        //print_r($input);die;
                        @endphp

                        @if(array_key_exists('qty',$input))
                        @if(isset($request->qty[$row->id]) && !empty($request->qty[$row->id]))

                        @for ($count = 0; $count < count($request->qty[$row->id]); $count ++)
                            <tr>
                                @if($product['name_on_product']=="yes")
                                <td>
                                    <input type="text" name="lable[{{$row->id}}][]" placeholder="{{__('Write name label')}}" value="{{$request->lable[$row->id][$count]}}" class="form-control" readonly>
                                </td>
                                @endif

                                @php
                                    $j=0;
                                    //echo "<pre>";
                                    //print_r($request['product_attribute'][$row->id]);
                                @endphp

                                @if (isset($request['product_attribute'][$row->id]))
                                @foreach ($request['product_attribute'][$row->id] as $key1=>$attribute)
                                    @php
                                        //print_r($attribute);
                                        //echo $j;
                                    @endphp

                                    <td>
                                        <input type="text" name="product_attribute[{{$row->id}}][{{ $key1 }}][]" value="{{$attribute[$count]}}" class="form-control" readonly>
                                    </td>

                                    @php
                                    $j=$j+1;
                                    @endphp
                                @endforeach
                                @endif
                                <td>
                                    <div class="cart-qty d-flex align-items-center">
                                        <input type="text" name="qty[{{$row->id}}][]" value="{{$request->qty[$row->id][$count]}}" class="form-control" readonly>
                                        <span>{{__('Quantity')}}</span>
                                    </div>
                                </td>

                            </tr>
                        @endfor
                        @endif
                        @endif

                    </table>
                    @if(array_key_exists('employee',$input))
                        @if(isset($request->employee[$row->id]) && !empty($request->employee[$row->id]))
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="employee-cech-list">
                                    @foreach($request->employee[$row->id] as $employee)

                                    <li>
                                        <lable><input type="checkbox" name="employee[{{$row->id}}][]" value="{{$employee}}" checked readonly>{{App\Models\Employee::where('id',$employee)->value('name')}}</lable>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    @endif
                </div><!-- Cart items table -->
            </div><!-- Cart product information -->
            @php $i=$i+1; @endphp
            @endforeach
        </div><!-- Col -->
        <aside class="col-md-4">

            <fieldset aria-label="Step One" tabindex="-1" id="step-1">

                <div class="shadow-box user-info-form">
                @php $j=0; @endphp
                  @foreach(Cart::content() as $key11=>$row)
                  @php
                    $delivery=\App\Models\CustomizeProduct::where('id',$row->id)->select('delevery_days','express_delivery_status','express_delivery_days')->first();

                    $days=$delivery->delevery_days;
                    if (trim($days) == ''){
                        $days=7;
                    }
                    //date_default_timezone_set('GMT');
                    $today = date('Y-m-d');

                    $delivery_date=date('d-m-Y', strtotime('+'.$days.' day', strtotime($today)));
                    //dd($delivery_date);

                    $weekday=date('l',strtotime($delivery_date));
                    if($weekday=='Saturday'){
                        $delivery_date=date('d-m-Y', strtotime('+2 day', strtotime($delivery_date)));
                    }else if($weekday=='Sunday'){
                        $delivery_date=date('d-m-Y', strtotime('+1 day', strtotime($delivery_date)));
                    }

                    $express_delivery_days=$delivery->express_delivery_days;
                    $express_delevery_date=date('d-m-Y', strtotime('-'.$express_delivery_days.' day', strtotime($delivery_date)));
                    $weekday_express=date('l',strtotime($express_delevery_date));
                    if($weekday_express=='Saturday'){
                        $express_delevery_date=date('d-m-Y', strtotime('-1 day', strtotime($express_delevery_date)));
                    }else if($weekday_express=='Sunday'){
                        $express_delevery_date=date('d-m-Y', strtotime('-2 day', strtotime($express_delevery_date)));
                    }



                  @endphp
                  <h5>{{__('Delivery method for')}} : {{$row->name}} </h5>
                    <div class="form-group mb-3">
                        <input type="radio" id="exp0{{$j}}" name="delivery_method[{{$row->id}}][]" value="Standard" checked data-price="{{ $row->price * $row->qty }}" data-percentage="0" data-date="{{$delivery_date}}">
                        <label for="exp0{{$j}}">{{__('Standard')}}<span></span> </label><br>
                        <div class="form-group">
                            <div class='input-group date' >
                                <input type='text' class="form-control standardate datepicker{{$row->id}}"  name="estimated_delivery_date[{{$row->id}}][]" value="{{$delivery_date}}" required  readonly/>
                                <input type='text' class="form-control d-none expressdate"  name="estimated_delivery_date2[{{$row->id}}][]" value="{{$express_delevery_date}}" required readonly />
                                <span class="input-group-addon"><i class="fas fa-calendar"></i> </span>
                                </span>
                            </div>
                        </div>
                        @if($delivery->express_delivery_status>0)
                            <label for="exp24{{$j}}"><input type="radio" id="exp24{{$j}}" name="delivery_method[{{$row->id}}][]" value="Ekspress" data-price="{{ $row->price * $row->qty }}" data-percentage="100" data-date="{{$delivery_date}}" data-expdays="{{$delivery->express_delivery_days}}"> {{__('Ekspress')}} <span class="info_icon"><i class="fas fa-question" ></i><div class="custom_tooltip">Haster din ordre kan du vælge express. Klik på ekspress får at se den hurtigst mulig levering af din ordre. *Ekspress gebyr pålægges </div></span></label>



                        @endif
                        {{--<label for="exp72{{$j}}"><input type="radio" id="exp72{{$j}}" name="delivery_method[{{$row->id}}][]" value="Express 72" data-price="{{ $row->price * $row->qty }}" data-percentage="25">
                        Express 72<span>25%</span> </label><br>

                        <label for="exp48{{$j}}"><input type="radio" id="exp48{{$j}}" name="delivery_method[{{$row->id}}][]" value="Express 48" data-price="{{ $row->price * $row->qty }}" data-percentage="50">
                        Express 48 <span>50%</span></label><br>

                        <label for="exp24{{$j}}"><input type="radio" id="exp24{{$j}}" name="delivery_method[{{$row->id}}][]" value="Express 24" data-price="{{ $row->price * $row->qty }}" data-percentage="100">
                        Express 24 <span>100%</span> </label>--}}

                    </div>
                    <hr />
                    @php $j=$j+1; @endphp
                  @endforeach
                  <div class="product-costs form-group mb-3">
                        @php  $cartTotal=Cart::total();
                        //echo $additional=(25 / 100) * 1000.05;
                        $additional=(0 / 100) * $cartTotal;
                        $totalwithAdditional=$cartTotal+$additional;
                        @endphp
                        <h3>{{__('Product costs')}}: <span id="price">{{$formatter->formatCurrency(Cart::total(), 'DKK'), PHP_EOL;}}</span></h3>
                        <h3><div style="display: inline;" id="shipping">{{__('Shipping')}} :</div> <span class="additional">@php  @endphp {{$formatter->formatCurrency($additional, 'DKK'), PHP_EOL;}}</span></h3>
                        <input type="hidden" name="delivery_costs" value="@php echo $additional @endphp">
                        <h3><strong>{{__('Total costs')}}: <span class="total_price">{{$formatter->formatCurrency($totalwithAdditional, 'DKK'), PHP_EOL;}} </span></strong></h3>
                    </div>

                  <div class="form-group d-flex align-items-center flex-wrap justify-content-between">
                        <a href="{{ route('view.cart')}}" class="btn btn-blue go_back">{{__('Go back')}}</a>
                        <button class="btn btn-blue btn-next pull-right " type="button" aria-controls="step-2">{{__('Next')}}</button>
                    </div>
                </div>
            </fieldset>

            <fieldset aria-label="Step Two" tabindex="-1" id="step-2">
                <div class="shadow-box user-info-form">
                    <h4>{{__('Payment information')}}</h4>
                    <h5>{{__('Choose your payment method')}}</h5>

                    <div class="form-group mb-3">
                        <input type="radio" id="invoice" name="payment_method" value="Invoice" checked>
                        <label for="invoice">{{__('Invoice')}}</label><br>

                        <input type="radio" id="ean" name="payment_method" value="EAN payment" >
                        <label for="ean">{{__('EAN payment')}}</label>
                    </div>
                    <div class="form-group mb-3">
                        <input id="cvr" type="text" placeholder="{{__('CVR nummer')}}" name="cvr_no" class="form-control"  maxlength="8"  required data-validation-required-message="{{__('This field is required')}}">

                        <input id="ean_no" type="text" placeholder="{{__('EAN nummer')}}" name="ean_no" class="form-control"  maxlength="13" style="display:none" disabled required data-validation-required-message="{{__('This field is required')}}">

                        <span class="requ">*</span>
                    </div>
                    {{--<div class="form-group mb-3" >
                        <input type="text" name="bank_account_no" placeholder="Bank account nr." class="form-control">
                        <span class="requ">*</span>
                    </div>--}}
                    <div class="form-group mb-3 ref_no" >
                        <input type="text" name="ref_no" placeholder="{{__('Ref nr.')}}" class="form-control" required>
                    </div>





                    <!--<p class="yellow-text">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> {{__('Please fill out all fields and product information')}}
                    </p>-->
                    <input type="hidden" name="name" value="{{$userinfo->name}}">
                    <input type="hidden" name="email" value="{{$userinfo->email}}">
                    <input type="hidden" name="phone" value="{{$userinfo->phone}}">
                    <input type="hidden" name="company" value="{{$userinfo->company}}">
                    <input type="hidden" name="zip" value="{{$userinfo->zip}}">
                    <input type="hidden" name="address" value="{{$userinfo->address}}">
                    <div class="form-group d-flex align-items-center flex-wrap justify-content-between">
                        <button class="btn btn-default btn-prev go_back" type="button" aria-controls="step-1">{{__('Previous')}}</button>
                        <button type="submit" class="btn btn-blue pay_now">{{__('Pay now')}}</button>
                    </div>

                </div><!-- user info form -->


                </p>
            </fieldset>


        </aside><!-- Col -->
    </div>
    </form>
</div><!-- Cart wrap  -->

{{--
<section class="multi-step-form1">

	<h1>Multi-step form</h1>

	<div class="steps">
		<button class="active" type="button" disabled>Step One</button> |
		<button type="button" disabled>Step Two</button> |
		<button type="button" disabled>Step Three</button>
	</div>

	<form action="#" method="post">

		<fieldset aria-label="Step One" tabindex="-1" id="step-1">
			<h2>Step One</h2>
			<p>
				<label for="first-name">First Name</label>
				<input class="form-control" type="text" name="first-name" id="first-name" required>
			</p>
			<p>
				<label for="last-name">Last Name</label>
				<input class="form-control" type="text" name="last-name" id="last-name" required>
			</p>
			<p>
				<button class="btn btn-default btn-next" type="button" aria-controls="step-2">Next</button>
			</p>
		</fieldset>

		<fieldset aria-label="Step Two" tabindex="-1" id="step-2">
			<h2>Step Two</h2>
			<p>
				<label for="email-address">Email Address</label>
				<input class="form-control" type="email" name="email-address" id="email-address" required>
			</p>
			<p>
				<label for="phone-number">Phone Number <span class="optional">(optional)</span></label>
				<input class="form-control" type="tel" name="phone-number" id="phone-number">
			</p>
			<p>
				<button class="btn btn-default btn-prev" type="button" aria-controls="step-1">Previous</button>
				<button class="btn btn-default btn-next" type="button" aria-controls="step-3">Next</button>
			</p>
		</fieldset>

		<fieldset aria-label="Step Three" tabindex="-1" id="step-3">
			<h2>Step Three</h2>
			<p>
				<label for="message"></label>
				<textarea class="form-control" rows="3" name="message" id="message" required></textarea>
			</p>
			<p>
				<button class="btn btn-success" type="submit">Submit</button>
				<button class="btn btn-default btn-edit" type="button">Edit</button>
				<button class="btn btn-danger" type="reset">Start Over</button>
			</p>
		</fieldset>

	</form>
</section>
--}}



@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.da.min.js"></script>
<script>
/**
 * @name Multi-step form - WIP
 * @description Prototype for basic multi-step form
 * @deps jQuery, jQuery Validate
 */

var app = {

init: function(){
    this.cacheDOM();
    //this.setupAria();
    this.nextButton();
    this.prevButton();
    this.validateForm();
    //this.startOver();
    //this.editForm();
    //this.killEnterKey();
    //this.handleStepClicks();
},

cacheDOM: function(){
    if($(".multi-step-form").length === 0){ return; }
    this.$formParent = $(".multi-step-form");
    this.$form = this.$formParent.find("form");
    this.$formStepParents = this.$form.find("fieldset"),

    this.$nextButton = this.$form.find(".btn-next");
    this.$prevButton = this.$form.find(".btn-prev");
    this.$editButton = this.$form.find(".btn-edit");
    this.$resetButton = this.$form.find("[type='reset']");

    this.$stepsParent = $(".steps");
    this.$steps = this.$stepsParent.find("button");
},

htmlClasses: {
    activeClass: "active",
    hiddenClass: "hidden",
    visibleClass: "visible",
    editFormClass: "edit-form",
    animatedVisibleClass: "animated fadeIn",
    animatedHiddenClass: "animated fadeOut",
    animatingClass: "animating"
},

setupAria: function(){

    // set first parent to visible
    this.$formStepParents.eq(0).attr("aria-hidden",false);

    // set all other parents to hidden
    this.$formStepParents.not(":first").attr("aria-hidden",true);

    // handle aria-expanded on next/prev buttons
    app.handleAriaExpanded();

},

nextButton: function(){

    this.$nextButton.on("click", function(e){

        e.preventDefault();

        // grab current step and next step parent
        var $this = $(this),
        currentParent = $this.closest("fieldset"),
        nextParent = currentParent.next();

        // if the form is valid hide current step
        // trigger next step
        if(app.checkForValidForm()){

            currentParent.removeClass(app.htmlClasses.visibleClass);
            app.showNextStep(currentParent, nextParent);
        }

    });
},

prevButton: function(){

    this.$prevButton.on("click", function(e){

        e.preventDefault();

        // grab current step parent and previous parent
        var $this = $(this),
        currentParent = $(this).closest("fieldset"),
        prevParent = currentParent.prev();

        // hide current step and show previous step
        // no need to validate form here
        currentParent.removeClass(app.htmlClasses.visibleClass);
        app.showPrevStep(currentParent, prevParent);

    });
},

showNextStep: function(currentParent,nextParent){

    // hide previous parent
    currentParent
        .addClass(app.htmlClasses.hiddenClass)
        .attr("aria-hidden",true);

    // show next parent
    nextParent
        .removeClass(app.htmlClasses.hiddenClass)
        .addClass(app.htmlClasses.visibleClass)
        .attr("aria-hidden",false);

    // focus first input on next parent
    nextParent.focus();

    // activate appropriate step
    app.handleState(nextParent.index());

    // handle aria-expanded on next/prev buttons
    app.handleAriaExpanded();

},

showPrevStep: function(currentParent,prevParent){

    // hide previous parent
    currentParent
        .addClass(app.htmlClasses.hiddenClass)
        .attr("aria-hidden",true);

    // show next parent
    prevParent
        .removeClass(app.htmlClasses.hiddenClass)
        .addClass(app.htmlClasses.visibleClass)
        .attr("aria-hidden",false);

    // send focus to first input on next parent
    prevParent.focus();

    // activate appropriate step
    app.handleState(prevParent.index());

    // handle aria-expanded on next/prev buttons
    app.handleAriaExpanded();

},

handleAriaExpanded: function(){

    /*
        Loop thru each next/prev button
        Check to see if the parent it conrols is visible
        Handle aria-expanded on buttons
    */
    $.each(this.$nextButton, function(idx,item){
        var controls = $(item).attr("aria-controls");
        if($("#"+controls).attr("aria-hidden") == "true"){
            $(item).attr("aria-expanded",false);
        }else{
            $(item).attr("aria-expanded",true);
        }
    });

    $.each(this.$prevButton, function(idx,item){
        var controls = $(item).attr("aria-controls");
        if($("#"+controls).attr("aria-hidden") == "true"){
            $(item).attr("aria-expanded",false);
        }else{
            $(item).attr("aria-expanded",true);
        }
    });

},

validateForm: function(){
    console.log('currentParent2');
    // jquery validate form validation
    this.$form.validate({
        ignore: ":hidden", // any children of hidden desc are ignored
        errorElement: "span", // wrap error elements in span not label

        rules: {
            cvr_no: {
                minlength:8,maxlength:8,
                required: true,
                number: true
            },
            ean_no: {
                minlength:13,maxlength:13,
                required: true,
                number: true
            },
            bank_account_no:{
                required: true,
                number: true
            },

        },

        invalidHandler: function(event, validator){ // add aria-invalid to el with error
            $.each(validator.errorList, function(idx,item){
                console.log(item);
                if(idx === 0){
                    $(item.element).focus(); // send focus to first el with error
                }
                $(item.element).attr("aria-invalid",true); // add invalid aria
            })
        },
        submitHandler: function(form) {
           // alert("form submitted!");
           $('form .pay_now').attr("disabled", true);
            form.submit();
        }
    });
},

checkForValidForm: function(){
    if(this.$form.valid()){

        return true;
    }
},

startOver: function(){

    var $parents = this.$formStepParents,
    $firstParent = this.$formStepParents.eq(0),
    $formParent = this.$formParent,
    $stepsParent = this.$stepsParent;

    this.$resetButton.on("click", function(e){

        // hide all parents - show first
        $parents
            .removeClass(app.htmlClasses.visibleClass)
            .addClass(app.htmlClasses.hiddenClass)
            .eq(0).removeClass(app.htmlClasses.hiddenClass)
            .eq(0).addClass(app.htmlClasses.visibleClass);

            // remove edit state if present
            $formParent.removeClass(app.htmlClasses.editFormClass);

            // manage state - set to first item
            app.handleState(0);

            // reset stage for initial aria state
            app.setupAria();

            // send focus to first item
            setTimeout(function(){
                $firstParent.focus();
            },200);

    }); // click

},

handleState: function(step){

    this.$steps.eq(step).prevAll().removeAttr("disabled");
    this.$steps.eq(step).addClass(app.htmlClasses.activeClass);

    // restart scenario
    if(step === 0){
        this.$steps
            .removeClass(app.htmlClasses.activeClass)
            .attr("disabled","disabled");
        this.$steps.eq(0).addClass(app.htmlClasses.activeClass)
    }

},

editForm: function(){
    var $formParent = this.$formParent,
    $formStepParents = this.$formStepParents,
    $stepsParent = this.$stepsParent;

    this.$editButton.on("click",function(){
        $formParent.toggleClass(app.htmlClasses.editFormClass);
        $formStepParents.attr("aria-hidden",false);
        $formStepParents.eq(0).find("input").eq(0).focus();
        app.handleAriaExpanded();
    });
},

killEnterKey: function(){
    $(document).on("keypress", ":input:not(textarea,button)", function(event) {
        return event.keyCode != 13;
    });
},

handleStepClicks: function(){

    var $stepTriggers = this.$steps,
    $stepParents = this.$formStepParents;

    $stepTriggers.on("click", function(e){

        e.preventDefault();

        var btnClickedIndex = $(this).index();

            // kill active state for items after step trigger
        $stepTriggers.nextAll()
            .removeClass(app.htmlClasses.activeClass)
            .attr("disabled",true);

        // activate button clicked
        $(this)
            .addClass(app.htmlClasses.activeClass)
            .attr("disabled",false)

        // hide all step parents
        $stepParents
            .removeClass(app.htmlClasses.visibleClass)
            .addClass(app.htmlClasses.hiddenClass)
            .attr("aria-hidden",true);

        // show step that matches index of button
        $stepParents.eq(btnClickedIndex)
            .removeClass(app.htmlClasses.hiddenClass)
            .addClass(app.htmlClasses.visibleClass)
            .attr("aria-hidden",false)
            .focus();

    });

}

};

app.init();

</script>

<script type="text/javascript">

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}
let data_percentage = document.querySelectorAll('input[data-percentage]');
(() => {
    data_percentage.forEach((el, index) => {
        el.addEventListener('change', (event) => {
            percent2=event.target.dataset.percentage;
            date2=event.target.dataset.date;
            expdays=event.target.dataset.expdays;


            var date=date2.split('-')
            var year=date[2];
            var month=date[1];
            var day=date[0];

            var d = new Date(year+'-'+month+'-'+day);
            var date=d.setDate(d.getDate() - expdays);
            var date1= new Date(date);

            var day2 = date1.getDay();
            if(day2==6){
                var date=date1.setDate(date1.getDate() - 1);
                var date1= new Date(date);
            }else if(day2==0){
                var date=date1.setDate(date1.getDate() - 2);
                var date1= new Date(date);
            }

            var newdate = new Date(date1);

            //console.log(newdate);

            var newmonth=parseInt(newdate.getMonth())+1;

            if(percent2>0){

                //$(event.target).parent().parent().find('input[type=text]').attr("redonly", true);
                //$(event.target).parent().parent().find('input[type=text]').val(newdate.getDate()+'-'+newmonth+'-'+newdate.getFullYear());



                $(event.target).parent().parent().find('.expressdate').removeClass('d-none');
                $(event.target).parent().parent().find('.standardate').addClass('d-none');

            }else{
                //$(event.target).parent().find('input[type=text]').attr("redonly", false);
                //$(event.target).parent().find('input[type=text]').attr("redonly", false);
                //$(event.target).parent().find('.standardate').val(day+'-'+month+'-'+year);

                $(event.target).parent().find('.expressdate').addClass('d-none');
                $(event.target).parent().find('.standardate').removeClass('d-none');



            }
            calculatePrice(event.target)
        })
    })
})()


calculatePrice = (event) => {
    let data_percentage = document.querySelectorAll('input[data-percentage]');
    let total = parseFloat({{Cart::total()}})
    let additional = 0;
    data_percentage.forEach((el, index) => {

        if (el.checked === true) {
            if(el.dataset.percentage==0){
                $('#shipping').html('Forsendelse');
            }else{
                $('#shipping').html('Express gebyr');
            }


            let percent = parseFloat(el.dataset.percentage)
            let amount = parseFloat(el.dataset.price)
            let percentage = (amount * percent) / 100
            additional += percentage
            if (percentage && amount) {
                total += percentage
            }
        }
    })
    $('.additional').text(additional.toLocaleString("de-DE") + ' DKK')
    $('input[name=delivery_costs]').val(additional.toFixed(2));
    $('.total_price').text(total.toLocaleString("de-DE") + ' DKK')
}



$("input[name='payment_method']").on('change', function() {
  var payment=$(this).val();
  if(payment=='Invoice'){
    $("input[name=cvr_no]").val('');
    $("#cvr").attr("maxlength", "8");

    $("#ean_no").prop('disabled', true);
    $("#cvr").prop('disabled', false);

    $("#ean_no").css("display", "none");
    $("#cvr").css("display", "block");
    //$('.ref_no').css("display", "block");
  }else{
    $("input[name=cvr_no]").val('');
    $("#ean_no").attr("maxlength", "13");
    $("#cvr").prop('disabled', true);
    $("#ean_no").prop('disabled', false);

    $("#cvr").css("display", "none");
    $("#ean_no").css("display", "block");
    //$('.ref_no').css("display", "none");
  }
 });


</script>
@foreach(Cart::content() as $key11=>$row)
    @php
    $delivery_days=\App\Models\CustomizeProduct::where('id',$row->id)->value('delevery_days');
    $delivery_days2=$delivery_days?$delivery_days:'null';
    @endphp
    <script>
    $(document).ready(function() {
    var FromEndDate = new Date();
    days={{$delivery_days2}};
    if ($.trim(days) == '' || $.trim(days) == null){
        days=7;
    }

    FromEndDate.setDate(FromEndDate.getDate() + days);
    //console.log(FromEndDate);
    $('.datepicker{{$row->id}}').datepicker({
        daysOfWeekDisabled: [0,6],
            format: 'dd-mm-yyyy',
             startDate: FromEndDate,
             ignoreReadonly: true,
            autoclose: true,
            language: 'da'
            /*onClose: function() {
                $( this ).valid();
            }
            beforeShowDay: function() {
                return false;
            }*/
        });
    });



    </script>
@endforeach

@endsection

