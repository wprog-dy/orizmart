<?php include 'include/header.php'; ?>
 <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Cart</a>
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
                  <div class="card card-body cart-table">
                     <?php            
                        $attributes = array('method' => 'post' , 'class' => 'form_horizontal');
                        echo form_open('updatecart/'.$merchant_type_id.'/'.$zipcode.'/'.$merchant_id,$attributes);
                     ?>
                     <div class="table-responsive">
                        <table class="table cart_summary">
                           <thead>
                              <tr>
                                 <th class="cart_product">Product</th>
                                 <th>Description</th>
                                 <th>Avail.</th>
                                 <th>Unit price</th>
                                 <th>Qty</th>
                                 <th>Total</th>
                                 <th class="action"><i class="mdi mdi-delete-forever"></i></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $total_discount = 0;
                              foreach ($this->cart->contents() as $items) 
                              {
                                 if($items['options']['merchant_type_id'] == $merchant_type_id)
                                 {
                                    
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
                                       <input type="hidden" name="rowid[]" value="<?= $items['rowid']; ?>">
                                       <h5 class="product-name"><a href="#"><?= $items['name']; ?></a></h5>
                                       <h6 class="d-none"><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                                       <?php
                                       if($items['options']['item_discount'])
                                       {
                                          $total_discount += $items['options']['item_discount']*$items['qty'];
                                          ?>
                                       <span class="badge badge-success"><?= $items['options']['item_discount']*$items['qty']; ?>% OFF</span>
                                       <?php
                                       } 
                                       ?>
                                       <input type="hidden" name="item_discount[]" value="<?=  $items['options']['item_discount']; ?>" >
                                    </td>
                                    <td class="availability in-stock"><span class="badge badge-success">In stock</span></td>
                                    <td class="price"><span>Rs. <?= $items['price']; ?></span></td>
                                    <td class="qty">
                                       <div class="input-group">
                                          <span class="input-group-btn minus" data-id="<?= $items['id']; ?>" ><button  class="btn btn-theme-round btn-number" type="button">-</button></span>
                                          <input type="number" max="10" min="1" value="<?= $items['qty']; ?>" class="form-control border-form-control form-control-sm input-number<?= $items['id']; ?>"  name="qty[]">
                                          <span class="input-group-btn plus" data-id="<?= $items['id']; ?>"><button class=" btn btn-theme-round btn-number" type="button">+</button>
                                          </span>
                                       </div>
                                    </td>
                                    <td class="price"><span>Rs. <?= $items['subtotal']; ?></span></td>
                                    <td class="action">
                                       <a class="btn btn-sm btn-danger" data-original-title="Remove" href="<?= base_url('deletereloadcart/').$merchant_type_id.'/'.$zipcode.'/'.$merchant_id.'/'.$items['rowid']; ?>" title="" data-placement="top" data-toggle="tooltip"><i class="mdi mdi-close-circle-outline"></i></a>
                                    </td>
                                 </tr>
                              <?php
                                 }
                              }
                              ?>
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td colspan="2"></td>
                                 <td class="text-right" colspan="3">Discount</td>
                                 <td colspan="2">Rs. <?= $total_discount; ?></td>
                              </tr>
                              <tr>
                                 <td class="text-right" colspan="5"><strong>Total</strong></td>
                                 <td class="text-danger " colspan="5"><strong>Rs. <?= number_format($this->cart->total()); ?></strong></td>
                              </tr>
                              <tr>
                                 <td colspan="10">
                                    <div class="text-right">
                                                <a href="<?= base_url('showitems/'.$merchant_type_id.'/'.$zipcode.'/'.$merchant_id); ?>" ><button type="button"  class="btn btn-danger btn-lg"> Continue </button> </a> 
                                       <button class="btn btn-success btn-lg"  type="submit">Update Cart</button>
                                    </div>   
                                 </td>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                     <?php echo form_close(); ?> 
                     <a href="<?= base_url('deliveryaddress/'.$merchant_type_id.'/'.$zipcode.'/'.$merchant_id); ?>">
                        <button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed </span><span class="float-right"><strong>Rs. <?= number_format($this->cart->total()); ?></strong> <span class="mdi mdi-chevron-right"></span></span></button>
                     </a>
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
   setTimeout(function() { $(".alert-success").hide(); }, 8000);
   $('.plus').click(function() 
   {
      var itemid = $(this).attr('data-id');
      var currentValue = $('.input-number'+itemid).val(); 
       currentValue++;
       $('.input-number'+itemid).val(currentValue);
   });
   $('.minus').click(function() 
   {
      var itemid = $(this).attr('data-id');
      var currentValue = $('.input-number'+itemid).val();
      
      if (currentValue > 1) 
      {
            currentValue--;
            $('.input-number'+itemid).val(currentValue);
      }
   });
</script>
</body>
</html>