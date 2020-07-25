<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Askbootstrap">
      <meta name="author" content="Askbootstrap">
      <title><?= isset($title)? $title : 'Groci - Organic Food & Grocery Market Template'; ?></title>
      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon.png">
      <!-- Bootstrap core CSS -->
      <link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Icons -->
      <link href="<?= base_url(); ?>assets/vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
      <!-- Select2 CSS -->
      <link href="<?= base_url(); ?>assets/vendor/select2/css/select2-bootstrap.css" />
      <link href="<?= base_url(); ?>assets/vendor/select2/css/select2.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="<?= base_url(); ?>assets/css/osahan.css" rel="stylesheet">
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/owl-carousel/owl.theme.css">
      <link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.css">
   </head>
   <body >
   <div id="myModal" class="modal fade" style="top: 250px;" >
      
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close  modal-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
            <h5>When would you like us to deliver?</h5>
               <div class="message"></div>
                <form action="<?= base_url('checkzipcode'); ?>" method="POST" class="checkzipCode" autocomplete="off">
                  <?php echo form_open('class="checkzipCode"'); ?>
                     <div class="form-group">
                        <input type="text" class="form-control onlynumber chkzipcode" maxlength="6" name="zipcode" placeholder="Enter Zipcode">
                     </div>
                     <span class="zipcode_modal_error text-danger"></span>
                    <button type="submit" class="smtzipcode btn btn-lg btn-secondary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
      <div class="modal fade login-modal-main" id="bd-example-modal">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
                           <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                           <span class="sr-only">Close</span>
                           </button>
                              <div class="login-modal-right">
                                 <!-- Tab panes -->
                                 <div class="tab-content">
                                       
                                    <div class="tab-pane active" id="login" role="tabpanel">
                                       <div class="message"></div>
                                       <form action="<?= base_url('userlogin'); ?>" method="POST" class="checkLogin" autocomplete="off" >
                                          <?php echo form_open('class="checkLogin"'); ?>
                                          <h5 class="heading-design-h5">Login to your account</h5>
                                          <fieldset class="form-group">
                                             <label>Enter Email/Mobile number</label>
                                             <input type="text" class="form-control" name="userName" placeholder="Enter Email/Mobile number">
                                             <span id="userName_error" class="text-danger"></span>
                                          </fieldset>
                                          <fieldset class="form-group">
                                             <label>Enter Password</label>
                                             <input type="password" name="password" class="form-control" placeholder="********">
                                             <span id="password_error" class="text-danger"></span>
                                             <a href="javascript:void(0);" class="forgetpass" style="float: right;" >Forget Password </a>
                                          </fieldset>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="customCheck1">
                                             <label class="custom-control-label" for="customCheck1">Remember me</label>
                                          </div>
                                          <fieldset class="form-group">
                                             <button type="submit" class="smtlogin btn btn-lg btn-secondary btn-block">Enter to your account</button>
                                          </fieldset>
                                          <div class="login-with-sites text-center" style="display: none;">
                                             <p>or Login with your social profile:</p>
                                             <button class="btn-facebook login-icons btn-lg"><i class="mdi mdi-facebook"></i> Facebook</button>
                                             <button class="btn-google login-icons btn-lg"><i class="mdi mdi-google"></i> Google</button>
                                             <button class="btn-twitter login-icons btn-lg"><i class="mdi mdi-twitter"></i> Twitter</button>
                                          </div>
                                       </form>
                                       <form action="<?= base_url('forgotpass'); ?>" method="POST" style='display: none;' autocomplete="off" class="changepass" >
                                          <?php echo form_open('class="changepass"'); ?>
                                          <fieldset class="form-group">
                                             <label>Mobile No.</label>
                                             <input type="text" class="form-control" name="userData" placeholder="Enter Mobile number">
                                             <span class="userData_error text-danger"></span>
                                          </fieldset>
                                          <fieldset class="form-group">
                                             <button type="submit" class="smtfp btn btn-lg btn-secondary btn-block">Submit</button>
                                          </fieldset>
                                       </form>
                                       <form action="<?= base_url('newpwd'); ?>" method="POST" style='display: none;' autocomplete="off" class="newpass" >
                                          <?php echo form_open('class="newpass"'); ?>
                                          <fieldset class="form-group">
                                             <label>Mobile No.</label>
                                             <input type="hidden" name="otp" class="otp_field" >
                                             <input type="hidden" name="timeFrom" class="timeFrom_field" >
                                             <input type="hidden" name="userData" class="userData_field" >
                                             <input type="hidden" name="userDataType" class="userDataType_field" >
                                             <input type="hidden" name="userId" class="userId_field" >
                                             <input type="hidden" name="usersUId" class="usersUId_field" >
                                             <input type="password" class="form-control" name="newPassword" placeholder="Enter New Password">
                                             <span class="newPassword_error text-danger"></span>
                                          </fieldset>
                                          <fieldset class="form-group">
                                             <label>Conform Password</label>
                                             <input type="password" class="form-control" name="newPassword_confirmation" placeholder="Enter Conform Password">
                                             <span class="newPassword_confirmation_error text-danger"></span>
                                             <a href="javascript:void(0);" class="smtressendotp" data-url="<?= base_url('resenduserotp'); ?>" style="float: right;" >Resend Otp</a>
                                          </fieldset>
                                          <fieldset class="form-group">
                                             <button type="submit" class="smtnewpass btn btn-lg btn-secondary btn-block">Submit</button>
                                          </fieldset>
                                       </form>
                                    </div>
                                    <div class="tab-pane" id="register" role="tabpanel">
                                       <div class="message"></div>
                                       <form action="<?= base_url('verifyuserotp'); ?>" style="display: none;" autocomplete="off"  method="POST" class="verifymyFormOtp" >
                                          <fieldset class="form-group">
                                               <?php echo form_open('class="verifymyFormOtp"'); ?>
                                                <label>Otp</label>
                                                <input type="hidden" name="mobilenumber" class="mobilenumber">
                                                <input type="hidden" name="userId" class="clientId">
                                                <input type="hidden" name="userName" class="userName">
                                                <input type="hidden" name="timeFrom" class="timeFrom">
                                                <input type="text" name="code" class="form-control" placeholder="Enter Otp" required>
                                                <span class="code_error text-danger"></span>
                                                <a href="javascript:void(0);" class="smtressendotp" data-url="<?= 'resenduserotp'; ?>" style="float: right;" >Resend Otp</a>
                                          </fieldset>   
                                          <fieldset class="form-group">
                                             <input type="submit"  class="verifysmtotp btn btn-lg btn-secondary btn-block" value="Submit Otp" >
                                          </fieldset>
                                       </form>
                                       <form action="<?= base_url('userregistration'); ?>"  method="POST" class="myForm" autocomplete="off" >
                                       <h5 class="heading-design-h5">Register Now!</h5>
                                       <fieldset class="form-group">
                                            <?php echo form_open('class="myForm"'); ?>
                                          <label>Country</label>
                                          <select class="form-control countryId" required name="countryId" style="width: 100%;">
                                             <option value="">Select...</option>
                                             <?php
                                                foreach ($countries as $key => $value) 
                                                {
                                                ?>
                                                   <option data-countrycode="<?= $value->phone_code; ?>" value="<?= $value->id; ?>"><?= $value->name; ?></option>
                                                <?php
                                             }
                                             ?>
                                          </select>
                                          <span class="countryId_error text-danger"></span>
                                          <label class="label-firstName">First Name</label>
                                          <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name" required>
                                          <span class="firstname_error text-danger"></span>
                                          <label>Last Name</label>
                                          <input type="text" name="lastname" class="form-control" placeholder="Enter last Name" required>
                                          <span class="lastname_error text-danger"></span>
                                          <label>Email Address </label>
                                          <input type="email" class="form-control" name="userEmail" placeholder="Enter Email Address" required>
                                          <span class="userEmail_error text-danger"></span>
                                          <label>Mobile Number</label>
                                          <input type="text" class="form-control countrycode" style="width: 20%;" readonly="readonly"  required>
                                          <input type="text" style="float: right;width: 80%;margin-top: -35px;" class="form-control mobileuse onlynumber" name="clientmobile" placeholder="Enter Mobile Number" required>
                                          <span class="clientmobile_error text-danger"></span>
                                          <label>Password</label>
                                          <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                          <span class="password_error text-danger"></span>
                                          <label>Zipcode</label>
                                          <input type="text" class="form-control" name="zipcode" placeholder="Enter Zipcode" required>
                                          <span class="zipcode_error text-danger"></span>
                                          <label>Gender</label>
                                             <label><input type="radio" name="gender" value="male">Male</label>
                                             <label><input type="radio" name="gender" value="female">Female</label>
                                          <span class="gender_error text-danger"></span>   
                                       </fieldset>
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" required="required" class="custom-control-input" id="customCheck2">
                                          <label class="custom-control-label" for="customCheck2">I Agree with <a href="#">Term and Conditions</a></label>
                                       </div>
                                       <fieldset class="form-group">
                                          <input type="submit" name="submit"  class="smt btn btn-lg btn-secondary btn-block" value="Create Your Account" >
                                       </fieldset>
                                       </form>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="text-center login-footer-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                       <li class="nav-item">
                                          <a class="nav-link active login" data-toggle="tab" href="#login" role="tab"><i class="mdi mdi-lock"></i> LOGIN</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#register" role="tab"><i class="mdi mdi-pencil"></i> REGISTER</a>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="navbar-top bg-success pt-2 pb-2">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12 text-center">
                  <a href="shop.html" class="mb-0 text-white">
                  20% cashback for new users | Code: <strong><span class="text-light">OGOFERS13 <span class="mdi mdi-tag-faces"></span></span> </strong>  
                  </a>
               </div>
            </div>
         </div>
      </div>
      <nav class="navbar navbar-light navbar-expand-lg bg-dark bg-faded osahan-menu">
         <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url(); ?>"> <img src="<?= base_url(); ?>assets/img/logo.png" alt="logo"> </a>
            <a class="location-top"  href="javascript:void(0);"><i class="mdi mdi-map-marker-circle" aria-hidden="true"></i><b><span class="setzipcode extrahideshow" ></span></b></a>
            <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse" id="navbarNavDropdown">
               <div class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto top-categories-search-main">
                  <div class="top-categories-search">
                     <div class="input-group">
                        <span class="input-group-btn categories-dropdown">
                           <select class="form-control-select">
                              <option selected="selected">Your City</option>
                              <option value="0">New Delhi</option>
                              <option value="2">Bengaluru</option>
                              <option value="3">Hyderabad</option>
                              <option value="4">Kolkata</option>
                           </select>
                        </span>
                        <input class="form-control" placeholder="Search products in Your City" aria-label="Search products in Your City" type="text">
                        <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button"><i class="mdi mdi-file-find"></i> Search</button>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="my-2 my-lg-0">
                  <ul class="list-inline main-nav-right">
                     <?php
                     if($this->session->userdata('clientId'))
                     {
                        ?>
                           <li class="list-inline-item dropdown osahan-top-dropdown">
                              <a class="btn btn-theme-round dropdown-toggle dropdown-toggle-top-user" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <img alt="logo" src="<?= base_url(); ?>assets/img/user.jpg"><strong>Hi</strong> <?php echo ucfirst($this->session->userdata('clientName')); ?>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-list-design">
                                 <a href="<?= base_url('myprofile'); ?>" class="dropdown-item"><i aria-hidden="true" class="mdi mdi-account-outline"></i>  My Profile</a>
                                 <a href="<?= base_url('myaddress'); ?>" class="dropdown-item"><i aria-hidden="true" class="mdi mdi-map-marker-circle"></i>  My Address</a>
                                 <a href="<?= base_url('changepassword'); ?>" class="dropdown-item"><i aria-hidden="true" class="mdi mdi-account-location"></i>Change Password</a>
                                 <a href="<?= base_url('setting'); ?>" class="dropdown-item"><i aria-hidden="true" class="mdi mdi-settings"></i>Setting</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>"><i class="mdi mdi-lock"></i> Logout</a>  
                              </div>
                           </li>
                           <li class="list-inline-item cart-btn d-none">
                              <a href="#" data-toggle="offcanvas" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> My Cart <small class="cart-value"></small></a>
                           </li>
                        <?php
                     }
                     else
                     {
                        ?>
                     <li class="list-inline-item">
                        <a href="#" data-target="#bd-example-modal" data-toggle="modal" class="btn btn-link"><i class="mdi mdi-account-circle"></i> Login/Sign Up</a>
                     </li>
                     <?php
                  }
                  ?>
                     
                  </ul>
               </div>
            </div>
         </div>
      </nav>
      <nav class="navbar navbar-expand-lg navbar-light osahan-menu-2 pad-none-mobile">
         <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarText">
               <ul class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto">
                  <li class="nav-item">
                     <a class="nav-link shop" href="<?= base_url(); ?>"><span class="mdi mdi-store"></span> Super Store</a>
                  </li>
          <li class="nav-item">
                     <a href="index.html" class="nav-link">Home</a>
                  </li>
          <li class="nav-item">
                     <a href="about.html" class="nav-link">About Us</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="shop.html">Fruits & Vegetables</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="shop.html">Grocery & Staples</a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Pages
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="shop.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Shop Grid</a>
                        <a class="dropdown-item" href="single.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Single Product</a>
                        <a class="dropdown-item" href="cart.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Shopping Cart</a>
                        <a class="dropdown-item" href="checkout.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Checkout</a> 
                     </div>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     My Account
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="my-profile.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  My Profile</a>
                        <a class="dropdown-item" href="my-address.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  My Address</a>
                        <a class="dropdown-item" href="wishlist.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  Wish List </a>
                        <a class="dropdown-item" href="orderlist.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  Order List</a> 
                     </div>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Blog Page
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="blog.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Blog</a>
                        <a class="dropdown-item" href="blog-detail.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Blog Detail</a>
                     </div>
                  </li>
          <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     More Pages
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="about.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  About Us</a>
                        <a class="dropdown-item" href="contact.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  Contact Us</a>
                        <a class="dropdown-item" href="faq.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  FAQ </a>
                        <a class="dropdown-item" href="not-found.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  404 Error</a> 
                     </div>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="contact.html">Contact</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
