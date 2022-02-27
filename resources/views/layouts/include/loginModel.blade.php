<div class="modal fade login-modal-main" id="bd-example-modal">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="login-modal">
               <div class="row">
                  <div class="col-lg-6 pad-right-0">
                     <div class="login-modal-left">
                     </div>
                  </div>
                  <div class="col-lg-6 pad-left-0">
                     <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     <span class="sr-only">Close</span>
                     </button>
                     <!--<form>-->
                        <div class="login-modal-right">
                           <!-- Tab panes -->
                           <div class="tab-content">
                              <div class="tab-pane active" id="login" role="tabpanel">
                                 <form id="loginForm2" method="post" action="{{ route('login') }}">
                                    @csrf
                                 <h5 class="heading-design-h5">Login to your account</h5>
                                 <fieldset class="form-group">
                                    <label for="formGroupExampleInput">Enter Email/Mobile number</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="email" placeholder="+91 123 456 7890">
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <label for="formGroupExampleInput2">Enter Password</label>
                                    <input type="password" class="form-control" id="formGroupExampleInput2" name="password" placeholder="********">
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <button type="submit" id="ajaxlogin2" class="btn btn-lg btn-theme-round btn-block">Enter to your account</button>
                                 </fieldset>
                                 <div class="login-with-sites text-center">
                                    <p>or Login with your social profile:</p>
                                    <button class="btn-facebook login-icons btn-lg"><i class="fa fa-facebook"></i> Facebook</button>
                                    <button class="btn-google login-icons btn-lg"><i class="fa fa-google"></i> Google</button>
                                    <button class="btn-twitter login-icons btn-lg"><i class="fa fa-twitter"></i> Twitter</button>
                                 </div>
                                 <p><label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Remember me </span>
                                    </label>
                                 </p>
                                 </form>
                              </div>
                              <div class="tab-pane" id="register" role="tabpanel">
                                 <h5 class="heading-design-h5">Register Now!</h5>
                                 <fieldset class="form-group">
                                    <label for="formGroupExampleInput">Enter Email/Mobile number</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="+91 123 456 7890">
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <label for="formGroupExampleInput2">Enter Password</label>
                                    <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="********">
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <label for="formGroupExampleInput3">Enter Confirm Password </label>
                                    <input type="password" class="form-control" id="formGroupExampleInput3" placeholder="********">
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <button type="submit" class="btn btn-lg btn-theme-round btn-block">Create Your Account</button>
                                 </fieldset>
                                 <p>
                                    <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">I Agree with Term and Conditions  </span>
                                    </label>
                                 </p>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <div class="text-center login-footer-tab">

                              <ul class="nav nav-tabs" role="tablist">
                                  {{--
                                  <li class="nav-item">
                                       <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                   </li>
                                   <li class="nav-item">
                                       @if (Route::has('register'))
                                           <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                       @endif
                                   </li>--}}
                                 <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#login" role="tab"><i class="icofont icofont-lock"></i> LOGIN</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#register" role="tab"><i class="icofont icofont-pencil-alt-5"></i> REGISTER</a>
                                 </li>
                              </ul>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                     <!--</form>-->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>