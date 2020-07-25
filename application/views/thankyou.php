<?php include 'include/header.php'; ?>
<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Thankyou</a>
               </div>
            </div>
         </div>
      </section>
      <section class="checkout-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="checkout-step">
                     <div class="accordion" id="accordionExample">
                        <div class="card checkout-step-two">
                        	<div class="card">
                           <div class="card-header" id="headingThree">
                              <h5 class="mb-0">
                                 <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                 Order Complete
                                 </button>
                              </h5>
                           </div>
                           <div id="collapsefour" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                              <div class="card-body">
                                 <div class="text-center">
                                    <div class="col-lg-10 col-md-10 mx-auto order-done">
                                       <i class="mdi mdi-check-circle-outline text-secondary"></i>
                                       <h4 class="text-success">Congrats! Your Order has been Completed..</h4>
                                       <p>
                                          Your Order has been successfully placed, You soon will get a message regarding order status. Thank you for choosing Oriz.
                                       </p>
                                    </div>
                                    <div class="text-center">
                                       <a href="<?= base_url(); ?>"><button type="submit" class="btn btn-secondary mb-2 btn-lg">Return to store</button></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
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