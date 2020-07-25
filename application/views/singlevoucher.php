<?php include 'include/header.php';?>
<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="<?= base_url(); ?>"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Voucher</a> <span class="mdi mdi-chevron-right"></span> <a href="#"><?= $vocherdetail->voucher_name ?></a>
            </div>
        </div>
    </div>
</section>
<section class="shop-single section-padding pt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="shop-detail-left">
                    <div class="shop-detail-slider">
                        <img alt="" src="<?= $vocherdetail->image_path ?>" class="">
                    </div>
                </div>
                 <div class="short-description">
                        <h5>Term & Condition :</h5>
                        <ul>
                        <li><?= $vocherdetail->voucher_name ?> is application on selected items only. </li>
                        <li> No two or more vouchers can be clubbed together for a single transaction.</li>
                        <li><?= $vocherdetail->voucher_name ?>  is application only in the area with zipcode : <?= $zipcode ?> </li>
                    </ul>

                    </div>
            </div>
            <div class="col-md-6">
                <div class="shop-detail-right">
                    <h2><?= $vocherdetail->voucher_name ?></h2>
                    <h6>Voucher Worth</h6>
                    <p class="offer-price mb-0">Discounted price :<span class="text-success">Rs <?= $vocherdetail->discount_amount ?></span></p>
                    <h6></h6>
                    <h6><strong><span class="mdi mdi-approval"></span> Validity : </strong><?= date('M d Y',strtotime($vocherdetail->valid_from)) ; ?> to <?= date('M d Y',strtotime($vocherdetail->valid_upto)) ; ?></h6>
                    <h6><span class="mdi mdi-approval"></span><?= $vocherdetail->voucher_details ?></h6>
                    
                    <div class="short-description">
                        <?php 
                        	$attributes = array('method' => 'post' , 'class' => 'form_horizontal');
                         	echo form_open('setting',$attributes);
                        ?>
								<div class="row">                              
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Qty<span class="required">*</span></label>
                                            <input type="number" class="form-control" name="">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">                              
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Please Select Payment Type<span class="required">*</span></label>
                                             <label><input type="radio" name="client_gender" checked="" value="male"> Wallet</label>
                                             <label><input type="radio" name="gender" value="female"> Online Payment</label>
                                       </div>
                                    </div>
                                 </div>
                                  <a href="checkout.html"><button type="button" class="btn btn-secondary btn-lg"><i class="mdi mdi-cart-outline"></i>Buy Now</button> </a>
                        <?php echo form_close(); ?> 
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'include/footer.php';?>