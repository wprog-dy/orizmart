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
      <section class="top-category section-padding">
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
         <div class="container "   >
            <div class="section-header">
               <h5 class="heading-design-h5">Vouchers</h5>
            </div>
            <div class="owl-carousel  owl-carousel-featured">
               <div class="item">
                  <div class="product">
                     <a href="single.html">
                        <div class="product-header">
                           <span class="badge badge-success">50% OFF</span>
                           <img class="img-fluid" src="<?= base_url(); ?>assets/img/item/1.jpg" alt="">
                           <span class="veg text-success mdi mdi-circle"></span>
                        </div>
                        <div class="product-body">
                           <h5>Product Title Here</h5>
                           <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                        </div>
                        <div class="product-footer">
                           <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                           <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$800.99</span></p>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="owl-controls clickable"><div class="owl-buttons"><div class="owl-prev"><i class="mdi mdi-chevron-left"></i></div><div class="owl-next"><i class="mdi mdi-chevron-right"></i></div></div></div>
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
<?php include('include/footer.php'); ?>      
<script type="text/javascript">
    function displayVoucher(zipcode_val)
    {
        $(".owl-wrapper:not(:first)").addClass("vouchers-data").css("width", "3336px");
        var numItems = $('.owl-wrapper').length;
        var numItems4 = 3;
        var i = 0;
        $('.owl-wrapper').each(function()
        {
            i++;
            if(i==numItems4)
            {
                $(this).addClass("vouchers-data").css("width", "3336px");
            }
            else
            {
               $(this).removeClass("vouchers-data");
            }
        }); 
        var data = { zipcode : zipcode_val };
            data[csfr_token_name] = csfr_token_value;
            var html_data = '';
            $.ajax({
               type:"POST",
               url:base_url+'ordermanage/showVouchers',
               data:data,
               dataType: "json",
            success: function(response)
            {
                if(response.status == '1')
                {
                    var vouchersdata = response.data;
                    vouchersdata.forEach(function (value) 
                    {

                        const valid_from = new Date(value.valid_from);
                        var valid_froms =  valid_from.toLocaleDateString('en-GB', { month: 'short', day: 'numeric', year: 'numeric' });
                        const valid_upto = new Date(value.valid_upto);
                        var valid_uptos =  valid_from.toLocaleDateString('en-GB', { month: 'short', day: 'numeric', year: 'numeric' });

                        html_data += '<div class="owl-item" style="width: 222px;"><div class="item"><div class="product" style="height: 340px;">   <a href="'+base_url+'singlevoucher/'+value.id+'/'+zipcode_val+'"><div class="product-header"><img class="img-fluid" style="border-radius: 109%; height:80px !important; "  src="'+ value.image_path +'" alt=""></div><div class="product-body"><h5>'+ value.merchant_company +'</h5><h6><strong>'+ value.voucher_name +'</strong></h6></div><div class="product-footer"><p class="offer-price mb-0">Rs '+ value.discount_amount +' <span class="regular-price">Rs '+ value.voucher_amount +'</span></p>  <p><i class="mdi mdi-tag-outline"></i>'+ valid_froms +' to '+ valid_uptos +'</p><p>'+ value.voucher_details +'</p>    </div>   </a></div></div></div>';
                    });
                    $('.vouchers-data').html(html_data);   
                }
            }
        });        
    }
</script>
</body>
</html>