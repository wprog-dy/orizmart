<?php include 'include/header.php';?>
<section class="account-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 mx-auto">
                  <div class="row no-gutters">
                     <?php include 'include/sidebar.php'; ?>
                     <div class="col-md-9">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                    <?= $title; ?>
                                 </h5>
                              </div>
                              <?php 
                                 if ($this->session->flashdata('fail')) 
                                 {
                                    echo '<div class="alert alert-danger">'.$this->session->flashdata('fail').'</div>';
                                 }
                                 if ($this->session->flashdata('success')) 
                                 {
                                    echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
                                 } 
                                 $attributes = array('method' => 'post' , 'class' => 'form_horizontal');
                                 echo form_open_multipart('myprofile',$attributes);
                              ?>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                          <label class="control-label">Profile Image<span class="required">*</span></label>
                                            
                                             <div class="user-profile-header">
                                                <?php 
                                                if($userdata->client_data->client_profile_image)
                                                {
                                                   ?>
                                                   
                                                   <img alt="logo" style="object-fit:cover;" id="profileImage" src="<?=$userdata->client_data->client_profile_image; ?>">
                                                   <input class="d-none" name="client_profile_image" id="imageUpload" value="<?= ucfirst($userdata->client_data->client_profile_image); ?>" type="file" capture>
                                                   
                                                   <?php
                                                }
                                                else
                                                {
                                                   ?>
                                                   <img alt="logo" style="object-fit:cover;"  id="profileImage" src="<?= base_url('assets/'); ?>img/user.jpg">
                                                   <input class="d-none"  name="client_profile_image" id="imageUpload" value="<?= ucfirst($userdata->client_data->client_profile_image); ?>" type="file">
                                                   <?php
                                                }
                                                ?>
                                             </div>
                                             
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">First Name <span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="client_firstname" value="<?= ucfirst($userdata->client_data->client_firstname); ?>" placeholder="First Name" type="text">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Last Name <span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="client_lastname" value="<?= ucfirst($userdata->client_data->client_lastname); ?>" placeholder="Last Name" type="text">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Gender<span class="required">*</span></label>
                                             <label><input type="radio" name="client_gender" <?= ($userdata->client_data->client_gender == 'male') ? 'checked' : ''; ?> value="male">Male</label>
                                             <label><input type="radio" name="gender"  <?= ($userdata->client_data->client_gender == 'female') ? 'checked' : ''; ?> value="female">Female</label>
                                       </div>
                                    </div>
                                 </div>
                                 <h6>ID/ Address Proof</h6>
                                 <div class="row">
                                    <div class="col-sm-6">
                                    	
                                       <div class="form-group">
                                          <label class="control-label">Addaar Card<span class="required">*</span></label>
                                          <input class="form-control border-form-control onlynumber" value="<?= $userdata->client_data->client_aadhaar_number; ?>" name="client_aadhaar_number" placeholder="Addaar Card" type="text">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">   
                                       <div class="form-group">
                                          <label class="control-label">Pan Card<span class="required">*</span></label>
                                          <input class="form-control border-form-control" name="client_pan_number"  value="<?= $userdata->client_data->client_pan_number; ?>" placeholder="Pan Card"  type="text">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12 text-right">
                                       <button type="reset" class="btn btn-danger btn-lg"> Cencel </button>
                                       <input type="submit" name="submit" class="btn btn-success btn-lg" value="Save Changes">
                                    </div>
                                 </div>
                              <?php echo form_close(); ?> 
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
        <section class="section-padding bg-white border-top">
         <div class="container">
            <div class="row">
               <div class="col-lg-4 col-sm-6">
                  <div class="feature-box">
                     <i class="mdi mdi-truck-fast"></i>
                     <h6>Free & Next Day Delivery</h6>
                     <p>Lorem ipsum dolor sit amet, cons...</p>
                  </div>
               </div>
               <div class="col-lg-4 col-sm-6">
                  <div class="feature-box">
                     <i class="mdi mdi-basket"></i>
                     <h6>100% Satisfaction Guarantee</h6>
                     <p>Rorem Ipsum Dolor sit amet, cons...</p>
                  </div>
               </div>
               <div class="col-lg-4 col-sm-6">
                  <div class="feature-box">
                     <i class="mdi mdi-tag-heart"></i>
                     <h6>Great Daily Deals Discount</h6>
                     <p>Sorem Ipsum Dolor sit amet, Cons...</p>
                  </div>
               </div>
            </div>
         </div>
      </section>
<?php include 'include/footer.php'; ?>
</body>
</html>