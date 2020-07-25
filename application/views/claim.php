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
                                    <div class="col-sm-12">
                                       <div class="form-group">   
                                             <p>To claim discount amount select below option</p>
                                             <label><input type="radio" name="claim_type"  value="1"> Cashback </label>
                                             <br>
                                             <label><input type="radio" name="claim_type"   value="2"> Voucher</label>
                                       </div>
                                    </div>
                                    <div class="card availablevouchers card-body col-sm-8"  style="display: none;">
                                        <h5 class="card-header">AVAILABLE VOUCHERS</h5>
                                        <div class="card-body availablevoucherscard pt-0 pr-0 pl-0 pb-0">
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
$("input[name='claim_type']").change(function()
{
    var claim_type_val = $(this).val();
    if(claim_type_val == '2')
    {
         $('.availablevoucherscard').empty();
        var allca = document.cookie.split(';');
        var data =  { 'zipcode' : allca[1].trim() };
        data[csfr_token_name] = csfr_token_value;

        $('#loader').show();
        $.ajax({
            type:"POST",
            url:'<?= base_url('ordermanage/showVouchers') ?>',
            data: data,
            dataType: "json",
            success: function(response)
            {
                $('#loader').hide();
                $('.availablevouchers').show();
                $.each(response.data, function(key, value) 
                {
                    var available_vouchers = '<div class="cart-list-product"><h5><a href="#">'+ value.voucher_name +'</a></h5><h5><a href="#">'+ value.voucher_details +'</a></h5><h5><a href="#">Voucher Amount : <b> Rs '+ value.discount_amount +'</b> <del>Rs '+ value.voucher_amount +'</del> </a>   </h5><p class="float-right remove-cart"><input type="checkbox" name=""></p></div>';
                    $('.availablevoucherscard').append(available_vouchers);    
                });  
            }
        });
    }
    if(claim_type_val == '1')
    {
        $('.availablevoucherscard').empty();
        $('.availablevouchers').hide();
    }   
});
</script>
</body>
</html>