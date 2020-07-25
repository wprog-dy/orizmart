<?php include('include/header.php'); ?>   
      <section class="carousel-slider-main text-center border-top border-bottom bg-white">
         <div class="owl-carousel owl-carousel-slider">
            <div class="item">
               <a href="#"><img style="width: 1159px; height: 398px;" class="img-fluid" src="https://c8.alamy.com/comp/W2CPDB/farm-fresh-vegetables-vector-banner-store-shop-grocery-detailed-illustrations-poster-W2CPDB.jpg" alt="First slide"></a>
            </div>
            <div class="item">
               <a href="#"><img style="width: 1159px; height: 398px;" style="width: 1159px; height: 398px;" class="img-fluid" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTI9kGOQBW1UpuddmRmiSnYsJI45KZ9PDmRfv1Ifu1CvCehvOT4&usqp=CAU" alt="First slide"></a>
            </div>
      <div class="item">
               <a href="#"><img style="width: 1159px; height: 398px;" class="img-fluid" src="https://asset21.ckassets.com/blog/wp-content/uploads/sites/5/2019/03/Paytm-Mall-Grocery-Offers.jpg" alt="First slide"></a>
            </div>
            <div class="item">
               <a href="#"><img style="width: 1159px; height: 398px;" class="img-fluid" src="https://previews.123rf.com/images/seamartini/seamartini1610/seamartini161000598/64877503-organic-food-fruits-banner-vector-design-for-grocery-store-food-market-magazine-book-cover-icons-of-.jpg" alt="First slide"></a>
            </div>
         </div>
      </section>
      <section class="top-category section-padding" id="mercahants">
         <div class="container">
            <div class="owl-carousel owl-carousel-category">
               <div class="item" style="display: none;" >
                  <div class="category-item">
                     <a href="#">
                        <img class="img-fluid" src="<?= base_url(); ?>assets/img/small/1.jpg" alt="">
                        <h6>Fruits & Vegetables</h6>
                        <p>150 Items</p>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="product-items-slider section-padding">
         <div class="container">
            <div class="section-header">
               <h5 class="heading-design-h5">Mercahants<span class="badge badge-primary" style="display: none;" >20% OFF</span>
                  <a class="float-right text-secondary" href="shop.html">View All</a>
               </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">
               <?php
               foreach ($allmerchant as $value) 
               {
               ?>   
               <div class="item">
                  <div class="product">
                     <a href="<?= base_url('showitems/').$value->mer_type.'/'.$value->distributor_zipcode.'/'.$value->mer_id; ?>">
                        <div class="product-header">
                           <span class="badge badge-success d-none">50% OFF</span>
                           <?php if($value->merchant_profile_image) { ?>
                           <img class="img-fluid" src="<?= $value->merchant_profile_image; ?>" style="width: 181px; " alt="">
                           <?php } else {  ?>
                           <img class="img-fluid" src="<?= base_url(); ?>assets/img/item/1.jpg" alt="">
                           <?php } ?>
                           <span class="veg d-none text-success mdi mdi-circle"></span>
                        </div>
                        <div class="product-body">
                           <h5><?= ucfirst($value->mer_company); ?></h5>
                           <h6><strong><span class="mdi mdi-approval"></span>Distributor</strong> <?= $value->distributor_organization; ?></h6>
                        </div>
                     </a>
                  </div>
               </div>
               <?php
            }
            ?>
            </div>
         </div>
      </section>     
<?php include('include/footer.php'); ?>      
</body>
</html>