<?php include 'include/header.php'; ?>
 <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                    <a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a>
                    <span class="mdi mdi-chevron-right"></span> <a href="#">Checkout</a>
               </div>
            </div>
         </div>
      </section>
      <section class="cart-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <?php
                   if ($this->session->flashdata('success')) 
                     {
                       echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                     }
                     if ($this->session->flashdata('fail')) 
                     {
                        echo '<div class="alert alert-danger">' . $this->session->flashdata('fail') . '</div>';
                     }
                  ?>     
                  <div class="card card-body">
                     <h5 class="card-header">Order Details</h5>
                        <div class="cart-table">
                     <?php            
                        $attributes = array('method' => 'post' , 'class' => 'form_horizontal');
                        echo form_open('checkoutsmt/'.$merchant_type_id.'/'.$merchant_id,$attributes);
                     ?>
                     <div class="table-responsive">
                        <table class="table cart_summary">
                           <thead>
                              <tr>
                                 <th class="cart_product">Product</th>
                                 <th>Description</th>
                                 <th>Avail.</th>
                                 <th>Price</th>
                                 <th>Qty</th>
                                 <th>Total</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $total_discount = 0;
                              $total= 0;
                              foreach ($this->cart->contents() as $items) 
                              {
                                    if($items['options']['merchant_type_id'] == $merchant_type_id)
                                    {
                                        $total_discount += $items['options']['item_discount']*$items['qty'];
                                        $total += $items['subtotal'];
                                 ?>
                                 <tr>
                                    <td class="cart_product">

                                       <a href="#">
                                       <?php
                                       if($items['image'])
                                       {
                                          ?>
                                          <img class="img-fluid" src="<?= $items['image']; ?>" alt="">
                                       <?php
                                       }
                                       else
                                       {
                                          ?>
                                          <img class="img-fluid" src="img/item/11.jpg" alt="">
                                          <?php

                                       }
                                       ?>
                                       </a>
                                    </td>
                                    <td class="cart_description">
                                       <h5 class="product-name"><a href="#"><?= $items['name']; ?></a></h5>
                                       <h6 class="d-none"><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                                       <?php
                                       if($items['options']['item_discount'])
                                       {
                                          
                                          ?>
                                       <span class="badge badge-success"><?= $items['options']['item_discount']*$items['qty']; ?>% OFF</span>
                                       <?php
                                       } 
                                       ?>
                                    </td>
                                    <td class="availability in-stock"><span class="badge badge-success">In stock</span></td>
                                    <td class="price"><span>Rs. <?= $items['price']; ?></span></td>
                                    <td class="qty"><span><?= $items['qty']; ?></span></td>
                                    <td class="price"><span>Rs. <?= $items['subtotal']; ?></span></td>
                                 </tr>
                              <?php
                                 }
                              }
                              ?>
                           </tbody>
                        </table>
                     </div>
                 </div>
             </div>
                     <div class="card card-body">
                        <h5 class="card-header">Bill Details</h5>
                            
                        <div class="card-body pt-0 pr-0 pl-0 pb-0">
                            <div class="cart-list-product">
                                    <h5><a href="#">Item Total (<?= count($this->cart->contents()) ?> Item )</a></h5>
                                    <p class="float-right remove-cart">Rs <?= number_format($this->cart->total()); ?></p>
                            </div>
                            <div class="cart-list-product">
                                    <h5><a href="#">Delivery Fee </a></h5>
                                    <p class="float-right remove-cart">Rs 70</p>
                            </div>
                            <div class="cart-list-product">
                                    <h5><a href="#">Total</a></h5>
                                    <p class="float-right remove-cart">Rs <?= number_format($this->cart->total()); ?></p>
                            </div>
                            <div class="card-footer cart-sidebar-footer">
                                <div class="cart-store-details">
                                    <p>Delivery To  <?= $_POST['usa_complete_address'] ?>,<?= $_POST['area'] ?> <a href="<?= base_url('deliveryaddress/'.$merchant_type_id.'/'.$zipcode.'/'.$merchant_id) ?>"><strong class="float-right text-danger">CHANGE</strong></a></p>
                                    <input type="hidden" name="usa_geo_address" value="<?= $_POST['usa_geo_address'] ?>" >
                                    <input type="hidden" name="usa_complete_address" value="<?= $_POST['usa_complete_address'] ?>" >
                                    <input type="hidden" name="usa_long" value="<?= $_POST['usa_long'] ?>" >
                                    <input type="hidden" name="usa_lat" value="<?= $_POST['usa_lat'] ?>" >
                                </div>
                            </div>  
                        </div>
                         <button class="btn btn-secondary btn-lg btn-block text-left" type="submit"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Place Order </span><span class="float-right"><strong>Rs. <?= number_format($this->cart->total()); ?></strong> <span class="mdi mdi-chevron-right"></span></span></button>
                     <?php echo form_close(); ?> 
                       
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