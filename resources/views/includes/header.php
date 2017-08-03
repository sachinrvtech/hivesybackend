<!-- Login -->
<div id="login" class="modal fade login_form_main wow bounceInDown" data-wow-duration="1s" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal">&times;</button> 
      <div class="modal-header">
           <h2>Member Login</h2>
      </div>
      <div class="modal-body">
        <div class="facebook_wrapper">
          <a href="redirect">
            <div class="facebook_icon"><i class="fa fa-facebook"></i></div>
              <h5>Log in with Facebook</h5>
            </a>
        </div>
        
        <form id="loginForm" method="post" action="<?php echo url('/').'/auth/userPostLogin'; ?>">
              <div class="form-group">
                <input type="hidden" value="<?php echo csrf_token(); ?>" name="_token">
                 <i class="fa fa-envelope" style="padding:11px 13px;"></i>
                 <input type="email" class="form-control" name="email" placeholder="abc@gmail.com" />
              </div>
              <div class="form-group">
                 <i class="fa fa-unlock-alt"></i>
                 <input type="password" class="form-control" name="password" placeholder="Password" />
              </div>
              <span class="loginerror" style="color:#a94442;display:none;">These credentials do not match our records.</span>
              <input class="form-submit" type="submit" value="Login" />
        </form>
        <span class="text-center forgot-pass"><a id="forgotpasslink" href="javascript:void(0);">Forgot Your Password?</a></span>
        <p>Do not have an account?</p>
        <span class="text-center forgot-pass"><a id="createanaccount" href="javascript:void(0);">Create an Account</a></span>
      </div>
    </div>

  </div>
</div>
<!-- Login -->
<!-- Sign up -->
<div id="signup" class="modal fade login_form_main wow bounceInDown" data-wow-duration="1s" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal">&times;</button> 
      <div class="modal-header">
           <h2>Member Sign up</h2>
      </div>
      <div class="modal-body">
        <div class="facebook_wrapper">
          <a href="redirect">
            <div class="facebook_icon"><i class="fa fa-facebook" style="padding:11px 17.5px;"></i></div>
              <h5>Register with Facebook</h5>
            </a>
        </div>
        <form method="post" id="signupform" action="<?php echo url('/').'/auth/register'; ?>" autocomplete="off">
          <input type="hidden" value="<?php echo csrf_token(); ?>" name="_token">
              <div class="form-group">
                 <i class="fa fa-user" style="padding:11px 16px;"></i>
                 <input type="text"  class="form-control" name="first_name" placeholder="First Name" requird />
              </div>
              <div class="form-group">
                 <i class="fa fa-user" style="padding:11px 16px;"></i>
                 <input type="text"  class="form-control" name="last_name" placeholder="Last Name" requird />
              </div>
               <div class="form-group">
                 <i class="fa fa-map-marker" style="padding:11px 18px;"></i>
                 <input type="text"  class="form-control" name="state" placeholder="State" requird />
              </div>
               <div class="form-group">
                 <i class="fa fa-home" style="padding:11px 14px;"></i>
                 <input type="text"  class="form-control" name="city" placeholder="City" requird />
              </div>
              <div class="form-group">
                 <i class="fa fa-envelope" style="padding:11px 13px;"></i>
                 <input type="email" class="form-control" name="email" placeholder="abc@gmail.com" requird />
                 <span class="existemail" style="color:#a94442;display:none;">Email already exist</span>
              </div>
              <div class="form-group">
                 <i class="fa fa-unlock-alt"></i>
                 <input type="password" class="form-control" name="password" placeholder="Password" requird />
              </div>
              <div class="form-group">
                 <i class="fa fa-unlock-alt"></i>
                 <input type="password" class="form-control" name="confirm" placeholder="Confirm Password" requird />
              </div>
              <input class="form-submit" type="submit" value="Sign up" />
        </form>
         <p>Already have an account?</p>
        <span class="text-center forgot-pass"><a id="signuphere" href="javascript:void(0);">Sign in here</a></span>
      </div>
    </div>

  </div>
</div>
<!-- Sign up -->
<!-- forgot password -->
<div id="forgotpass" class="modal fade login_form_main wow bounceInDown" data-wow-duration="1s" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal">&times;</button> 
      <div class="modal-header">
           <h2>Forgot Password</h2>
      </div>
      <div class="modal-body">
         <form>
            <div class="form-group">
                 <i class="fa fa-envelope"></i>
                 <input type="email" class="form-control" placeholder="abc@gmail.com" requird />
              </div>
            <input class="form-submit" type="submit" value="Send" />
        </form>
         <!-- <p>Already have an account?</p>
        <span class="text-center forgot-pass"><a id="signuphere" href="javascript:void(0);">Sign in here</a></span> -->
      </div>
    </div>

  </div>
</div>
<!-- forgot password-->
<div class="top_header">
  <div class="bg_row"></div>
  <div class="container">
      <div class="header_row_top">
            <ul class="social-icons pull-left">
                <li><a href="#"><img src="<?php echo asset('public/images/social_icon1.png');?>" alt="" /></a></li>
                <li><a href="#"><img src="<?php echo asset('public/images/social_icon2.png');?>" alt="" /></a></li>
                <li><a href="#"><img src="<?php echo asset('public/images/social_icon3.png');?>" alt="" /></a></li>
            </ul>
            <div class="login-links pull-right">
                <ul>
               <?php  //print_r(\Illuminate\Support\Facades\Auth::user()->email); 
                    if(\Illuminate\Support\Facades\Auth::user()){ ?> 
                    <li><a href="<?php echo url('/').'/auth/userlogout';?>">Logout</a></li>
                   <?php } else{ ?>
                     <li><a href="#" data-toggle="modal" data-target="#login">Login</a></li>
                     <li><a href="#" data-toggle="modal" data-target="#signup">Sign Up</a></li>
                    <?php } ?>
                </ul>
                <div class="search_wrapper dropdown">
                  <div class="search_toggle dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-search"></i> </div>
                    <form class="dropdown-menu">
                      <div class="search_dropdown form-group">
                          <input class="form-control" type="search" placeholder="search here" />
                            <input class="form-submit" type="submit" />
                        </div>
                    </form>
                </div>
           </div>
        </div>
    </div>
</div>

<header>
  <div class="container">
      <div class="navbar-brand wow bounceInDown">
          <a href="#"><img src="<?php echo asset('public/images/logo.png');?>" alt="" /></a>
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
          </button>
        </div>
       
        <nav id="navbar" class="pull-right navbar-collapse collapse wow bounceInDown">
          <ul class="nav navbar-nav">
              <li><a href="<?php echo url('/');?>" class="<?php echo Request::path()=='/'?'active':''; ?>">Home</a></li>
                <li class="nav_drop"><a href="<?php echo url('/').'/frontfish';?>" class="<?php if(Request::path()=='frontfish' || Request::path()=='freshwater' || Request::path()=='saltwater' || Request::path()=='brackishwater' || Request::path()=='fishid' || Request::path()=='claimfish'){echo 'active';}else{ echo ''; } ?>">Fish</a>
                  <ul class="sub-menu">
                      <li><a href="<?php echo url('/').'/freshwater';?>" class="<?php echo Request::path()=='freshwater'?'active':''; ?>">Freshwater
                         </a></li>
                        <li><a href="<?php echo url('/').'/saltwater';?>" class="<?php echo  Request::path()=='saltwater'?'active':''; ?>">Saltwater</a></li>
                        <li><a href="<?php echo url('/').'/brackishwater';?>" class="<?php echo Request::path()=='brackishwater'?'active':''; ?>">Brackish</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo url('/').'/frontcoral';?>" class="<?php if(Request::path()=='frontcoral' || Request::path()=='addeditcoral' || Request::path()=='coralspecies' || Request::path()=='coralid' || Request::path()=='coralclaim'){echo 'active';}else{ echo ''; } ?>">Corals</a>
                     <ul class="sub-menu">
                       <!--  <li><a href="coralspecies">Coral Species</a></li> -->
                      <!--   <li><a href="coralid">Coral ID</a></li>
                        <li><a href="addeditcoral">New / Edit Coral</a></li>
                        <li><a href="coralclaim">Claim Coral</a></li> -->
                    </ul>
                </li>
                <li class="nav_drop"><a class="<?php if(Request::path()=='frontinvertebrate' || Request::path()=='freshwaterinvertebrate' || Request::path()=='saltwaterinvertebrate' || Request::path()=='brackishwaterinvertebrate' || Request::path()=='invertebrateid' || Request::path()=='invertebrateclaim' ){echo 'active';}else{ echo ''; }?>" href="<?php echo url('/').'/frontinvertebrate';?>">Invertebrates</a>
                  <ul class="sub-menu">
                      <li><a class="<?php echo Request::path()=='freshwaterinvertebrate'?'active':''; ?>" href="<?php echo url('/').'/freshwaterinvertebrate';?>">Freshwater</a></li>
                        <li><a class="<?php echo Request::path()=='saltwaterinvertebrate'?'active':''; ?>" href="<?php echo url('/').'/saltwaterinvertebrate';?>">Saltwater</a></li>
                        <li><a class="<?php echo Request::path()=='brackishwaterinvertebrate'?'active':''; ?>" href="<?php echo url('/').'/brackishwaterinvertebrate';?>">Brackish</a></li>
                    </ul>
                </li>
                <li class="nav_drop"><a class="<?php echo Request::path()=='articlefront'?'active':''; ?>" href="<?php echo url('/').'/articlefront';?>">Articles</a>
                  <ul class="sub-menu">
                      <li><a class="<?php echo Request::path()=='articlefront/featured'?'active':''; ?>" href="<?php echo url('/').'/articlefront/featured';?>">Featured Articles</a></li>
                        <li><a class="<?php echo Request::path()=='articlefront/populararticle'?'active':''; ?>" href="<?php echo url('/').'/articlefront/populararticle';?>">Popular Articles</a></li>
                        <li><a class="commonforcheckauth <?php echo Request::path()=='neweditarticle'?'active':''; ?>" href="<?php echo url('/').'/neweditarticle';?>">New Articles</a></li>
                    </ul>
                </li>
                <li><a class="commonforcheckauth <?php echo Request::path()=='mytank'?'active':''; ?>" href="<?php echo url('/').'/mytank';?>">My Tank(s)</a>
                      <!-- <ul class="sub-menu">
                      <li><a href="mytanksetting">Setting</a></li>
                      <li><a href="typeoftank">Type Of Tank</a></li>
                       <li><a href="Saltwatertankedit">Saltwater Tank Edit</a></li>
                       <li><a href="saltwatertankview">Saltwater Tank View</a></li>
                      </ul> -->
                </li>
            </ul>
        </nav>
    </div>
       <?php if(session('status')){?>
       <div class="alert alert-success">
      <?php echo session('status'); ?>
       </div>
     <?php }?>
</header>
<script src="http://formvalidation.io/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="http://formvalidation.io/vendor/formvalidation/js/framework/bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    //for go to login popup from signup popup
      $('#signuphere').on('click',function(){
       $('#signup').modal('hide');
       $('#login').modal('show');
      });
    //for go to signup popup from login popup 
      $('#createanaccount').on('click',function(){
        $('#login').modal('hide');
        $('#signup').modal('show');
      });
      $('#forgotpasslink').on('click',function(){
         $('#login').modal('hide');
        $('#forgotpass').modal('show');
      });
       $('#loginForm').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();
           $('.loaderggdiv').show();
            var $form = $(e.target),
                fv    = $form.data('formValidation');

            // Use Ajax to submit form data
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                  $('.loaderggdiv').hide();
                      if(result==1)
                      {
                        $('.loginerror').hide();
                        //alert('successfully login!');
                        location.reload(true);
                      } 
                      else
                      {
                        $('.loginerror').show();
                      } 
                }
            });
        });
        $('#signupform').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    }
                }
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required'
                    }
                }
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'The state is required'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'The city is required'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required'
                    }
                }
            },
        password: {
            validators: {
                identical: {
                    field: 'confirm',
                    message: 'The password and its confirm are not the same'
                },
                 notEmpty: {
                        message: 'The password is required'
                    },
                   callback: {
                    callback: function(value, validator, $field) {
                            var password = $field.val();
                        if (password == '') {
                            return true;
                        }
                      if (password.length < 6) {
                            return {
                                valid: false,
                                message: 'The password must be at least 6 characters'    // Yeah, this will be set as error message
                            }
                        }
                        return true;
                    }
                }
            }
        },
        confirm: {
            validators: {
                identical: {
                    field: 'password',
                    message: 'The password and its confirm are not the same'
                },
                notEmpty: {
                        message: 'The confirm password is required'
                    }
            }
        }
    
        }
    }).on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();
           $('.loaderggdiv').show();
            var $form = $(e.target),
                fv    = $form.data('formValidation');

            // Use Ajax to submit form data
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                  $('.loaderggdiv').hide();
                      if(result.message=='success')
                      {
                        $('.existemail').hide();
                        //alert('registration successfully!');
                        location.reload(true);
                      } 
                      else
                      {
                        $('.existemail').show();
                      } 
                }
            });
        });
       $('#login').on('hidden.bs.modal', function() {
    $('#loginForm').formValidation('resetForm', true);
      });
       $('#signup').on('hidden.bs.modal', function() {
    $('#signupform').formValidation('resetForm', true);
      });
      
var maindivh=$('.fish_name').height();
              var h2hei=$('.mainarticle_div').children('div').children('h2').height();
              $('.mainarticle_div').children('div').children('a').children('img').height(maindivh-h2hei-11);

  });
</script>




