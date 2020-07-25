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
                                 echo form_open('setting',$attributes);
                              ?>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                             <label><input type="checkbox" name="opt_in_mail" <?= ($userdata->client_data->opt_in_mail == '1') ? 'checked' : ''; ?> value="1"> Mail</label>
                                             <br>
                                             <label><input type="checkbox" name="opt_in_sms"  <?= ($userdata->client_data->opt_in_sms == '1') ? 'checked' : ''; ?> value="1"> SMS</label>
                                             <br>
                                             <label><input type="checkbox" name="opt_in_whatsapp"  <?= ($userdata->client_data->opt_in_whatsapp == '1') ? 'checked' : ''; ?> value="1"> Whatapp</label>
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