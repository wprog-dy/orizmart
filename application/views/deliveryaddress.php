<?php include 'include/header.php'; ?>
 <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> 
                  <span class="mdi mdi-chevron-right"></span> <a href="#">Cart</a>
                  <span class="mdi mdi-chevron-right"></span> <a href="#">Add Address</a>
               </div>
            </div>
         </div>
      </section>
      <section class="checkout-page section-padding">
            <?php            
                $attributes = array('method' => 'post' , 'class' => 'form_horizontal checkoutfrom');
                echo form_open(base_url('ecommercepages').'/checkout/'.$merchant_type_id.'/'.$zipcode.'/'.$merchant_id,$attributes);
            ?>
         <div class="container">
            <div class="row">
               <div class="col-md-8">
                  <div class="checkout-step">
                     <div class="accordion" id="accordionExample">
                        <div class="card checkout-step-two">
                            <span class="message"></span>
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-1">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Add Address
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body">
                                    <div class="row">
                                       <div class="col-sm-12">
                                          <div class="form-group">
                                             <label class="control-label">DELIVERING ORDER TO <span class="required">*</span></label>
                                             <input type="text" onFocus="initializeAutocomplete()"  class="form-control border-form-control" id="locality" required="required" name="usa_geo_address" placeholder="Enter a location" >
                                             <span class="usa_geo_address_error text-danger"></span>
                                          </div>
                                            <input type="hidden" name="usa_lat" id ="latitude">
                                            <input type="hidden" name="usa_long" id ="longitude">
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <div class="form-group">
                                                <label class="control-label">Pincode<span class="required">*</span></label>
                                                <input class="form-control border-form-control onlynumber"  required="required" id="postal_code" name="pincode" value="" placeholder="pincode" type="text">
                                                <span class="pincode_error text-danger"></span>
                                          </div>
                                       </div>
                                       <div class="col-sm-6">
                                          <div class="form-group">
                                             <label class="control-label">Flot No, Building Name<span class="required">*</span></label>
                                             <input class="form-control border-form-control" name="usa_complete_address" required="required"  value="" placeholder="Flot No, Building Name" type="text">
                                             <span class="usa_complete_address_error text-danger"></span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <div class="form-group">
                                             <label class="control-label">Area / Locallity<span class="required">*</span></label>
                                             <input class="form-control border-form-control" value=""  required="required" name="area" placeholder="Area / Locallity" type="text">
                                          </div>
                                       </div>
                                    </div>
                                    <button  type="submit" class="btn btn-secondary mb-2 btn-lg " name="submit" value="SAVE ADD PROCEED" >SAVE ADD PROCEED</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php echo form_close(); ?>
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
   setTimeout(function() { $(".alert-success").hide(); }, 8000);
   function initializeAutocomplete(){
    var input = document.getElementById('locality');
    // var options = {
    //   types: ['(regions)'],
    //   componentRestrictions: {country: "IN"}
    // };
    var options = {}

    var autocomplete = new google.maps.places.Autocomplete(input, options);

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      var place = autocomplete.getPlace();
      var lat = place.geometry.location.lat();
      var lng = place.geometry.location.lng();
      var placeId = place.place_id;
      // to set city name, using the locality param
      var componentForm = {
        postal_code: 'short_name'
      };
      for (var component in componentForm) 
      {
         document.getElementById(component).value = '';
         document.getElementById(component).disabled = false;
      }
      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
          document.getElementById(addressType).value = val;
        }
      }
      document.getElementById("latitude").value = lat;
      document.getElementById("longitude").value = lng;
    });
  }
    $(".checkoutfrom").submit(function()
   {
        var allca = document.cookie.split(';');
        if(allca[1].trim()!=$('#postal_code').val())
        {
            $('.message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>Location is too far <br> This location is too far away from the merchant for Oriz to deliver. Please Pick a location near to the merchant.  </div>');
           setTimeout(function() { $(".alert-danger").hide(); }, 8000);
           $(window).scrollTop(0);
           return false;
        }
   });
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBMIqw8GSiNIEW_ccxIPUNcPxDVR1vQ0G0&libraries=places"
       ></script>
       </body>
</html>