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
                                 echo form_open_multipart('myaddress',$attributes);
                              ?>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                          <label class="control-label">Address<span class="required">*</span></label>
                                          <textarea maxlength="250" name="client_address" class="form-control border-form-control"><?= $userdata->client_data->client_address; ?></textarea>
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Zip Code <span class="required">*</span></label>
                                          <input class="form-control border-form-control onlynumber " name="client_zipcode" value="<?= $userdata->client_data->client_zipcode; ?>" placeholder="Zipcode" type="text">
                                       </div>
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Country <span class="required">*</span></label>
                                          <select id="country" name="country_id"  class="select2 form-control border-form-control">
                                             <?php
                                                foreach ($countries as $key => $value) 
                                                {
                                                ?>
                                                   <option <?= ($userdata->client_data->country_id == $value->id) ? 'selected' : ''; ?> value="<?= $value->id; ?>"><?= $value->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">State <span class="required">*</span></label>
                                          <select  id="region" name="state_id" class="select2 form-control border-form-control">
                                             <option value="">Select State</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">City <span class="required">*</span></label>
                                          <select id="city" name="city_id"  class="select2 form-control border-form-control">
                                             <option value="">Select City</option>
                                          </select>
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
<script type="text/javascript">
    $( "#country" ).change(function() 
    {
        var countrydata =  
        {
            country : this.value,
        }
        countrydata[csfr_token_name] = csfr_token_value;
        alreadySelectedCountry(countrydata);
    });
    var country = $( "#country" ).val();
    var countrydata =  
    {
        country : country,
    }
    countrydata[csfr_token_name] = csfr_token_value;
    alreadySelectedCountry(countrydata);
   function alreadySelectedCountry(countrydata)
   {
        var country = $( "#country" ).val();
        $("#country option[value='0']").remove();

        $.ajax({ 
            url: "<?= base_url('auth/getState') ?>",
            data: countrydata,
            type: 'POST',
            dataType: "json",
            success:function(response) 
            {
               $('#region').find('option').remove().end();
               var region = response.data;
               for(var i = 0 ; i < region.length ; i++)
               {
                    $('#region').append('<option value="'+region[i].id+'">'+region[i].state_name+'</option>');
               }
            }
        });
        $('#city').find('option').remove().end();
        $('#city').append('<option value="0">Please choose a Region/State</option>');

   }
   $( "#region" ).change(function() 
   {
        var region = $( "#region" ).val();
        var statedata =  
        {
            region_id : region,
        }
        statedata[csfr_token_name] = csfr_token_value;
        alreadySelectedCity(statedata);
    });
    var region = $( "#region" ).val();
    var statedata =  
    {
        region_id : region,
    }
    statedata[csfr_token_name] = csfr_token_value;
   alreadySelectedCity(statedata);
   function alreadySelectedCity(statedata)
   {
        $.ajax({ 
            url: "<?= base_url('auth/getCity') ?>",
            data: statedata,
            type: 'POST',
            dataType: "json",
            success:function(msg) 
            {
                $('#city').find('option').remove().end();
                var city = msg.data;
                for(var i = 0 ; i < city.length ; i++)
                {
                    $('#city').append('<option value="'+city[i].id+'">'+city[i].city_name+'</option>');
                }
            }
        });
   }
</script>

</body>
</html>