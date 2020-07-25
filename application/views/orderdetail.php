<?php include 'include/header.php';?>
<style type="text/css">
    .page-link 
    {
    display: unset !important;
    }
</style>
<section class="account-page section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="row no-gutters">
                    <?php include 'include/sidebar.php'; ?>
                    <div class="col-md-9  account-right">
                        <div class="card card-body">
                            <h5 class="card-header">Order Id : <?= $orderdetails->order->order_no; ?><a href="" class="text-secondary float-right" onclick="window.history.go(-1); return false;" >Back</a></h5>
                            <?php /*echo '<pre>'; print_r($orderdetails);*/ ?>    
                            <div class="card-body pt-0 pr-0 pl-0 pb-0">
                                <div class="cart-list-product">
                                    <ol class="progtrckr" data-progtrckr-steps="5">
                                    <li class="progtrckr-done">Ordered on <br><?= date('d M Y h:i  A',strtotime($orderdetails->order->created_at)) ; ?> </li>
                                    <?php
                                        if(($orderdetails->order->status_name == 'Pending')||($orderdetails->order->status_name == 'Processing'))
                                        {
                                            ?>
                                                <li class="progtrckr-done">Processing on <br> <?= date('d M Y h:i  A',strtotime($orderdetails->order->updated_at)); ?></li>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <li class="progtrckr-todo">Processing</li>
                                            <?php
                                        }
                                    ?>
                                    <?php
                                        if($orderdetails->order->status_name == 'Packing')
                                        {
                                            ?>
                                                <li class="progtrckr-done">Packing</li>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <li class="progtrckr-todo">Packing</li>
                                            <?php
                                        }
                                    ?>
                                    <?php
                                        if($orderdetails->order->status_name == 'Shipping')
                                        {
                                            ?>
                                                <li class="progtrckr-done">Shipping</li>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <li class="progtrckr-todo">Shipping</li>
                                            <?php
                                        }
                                    ?>
                                    <?php
                                        if($orderdetails->order->status_name == 'Delivered')
                                        {
                                            ?>
                                                <li class="progtrckr-done">Delivered</li>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <li class="progtrckr-todo">Delivered</li>
                                            <?php
                                        }
                                    ?>
                                </ol>
                                </div>
                        </div>
                        <?php
                        if((($orderdetails->order->order_status == 1)||($orderdetails->order->order_status == 2))&&($orderdetails->order->order_confirmed_by_client == 0 ))
                        {
                            ?>
                        <div class="card-footer">
                            <a href="checkout.html"><button class="btn btn-secondary text-left float-right" type="button">Cancel Order</button></a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="card card-body">
                        <h5 class="card-header">BILL DETAIL</h5>
                        <?php /*echo '<pre>'; print_r($orderdetails->order_details);*/ ?>    
                        <div class="card-body pt-0 pr-0 pl-0 pb-0">
                            <?php
                            foreach ($orderdetails->order_details as $key => $value) 
                            {
                            ?>
                                <div class="cart-list-product">
                                    <h5><a href="#"><?= $value->item_qty ?> * <?= $value->item_name ?></a></h5>
                                    <p class="float-right remove-cart">Rs <?= $value->item_net_amount ?></p>
                                </div>
                            <?php 
                            }
                            ?>    
                            </div>
                            <div class="card-footer cart-sidebar-footer">
                                <div class="cart-store-details">
                                    <p>Item Total <strong class="float-right">Rs <?= $orderdetails->order->sub_total ?></strong></p>
                                    <p>Delivery Fess <strong class="float-right text-danger">+ Rs <?= $orderdetails->order->delivery_amount ?></strong></p>
                                    <p>Payment Status : <?= $orderdetails->order->status_name ?> <strong class="float-right ">Total <span class="text-danger">Rs <?= $orderdetails->order->order_amount ?></span></strong></p>
                                </div>
                            </div>  
                        </div> 
                         <?php
                        if(($orderdetails->order->order_status == 2)&&($orderdetails->order->order_confirmed_by_client == 0 ))
                        {
                            ?>
                        <div class="card card-body">
                            <h5 class="card-header"><p>Total Discount : <?= $orderdetails->order->discount_amount ?> <a href="<?= base_url('claimhere/'.$orderdetails->order->id)  ?>" class="btn btn-secondary text-left float-right">CLAIM HERE</a></p></h5>
                        </div>
                        <div class="card card-body">
                            <h5 class="card-header">Payment</h5>   
                            <div class="card-body pt-0 pr-0 pl-0 pb-0">
                                <div class="cart-list-product">
                                    <?= $orderdetails->order->payment_mode; ?>
                                    <label><p><input type="radio" <?= ($orderdetails->order->payment_mode == Null) ? 'checked' : ''  ?>   <?= ($orderdetails->order->payment_mode == 'cod') ? 'checked' : '' ?> name="payment_mode" value="COD (Cash On Delivery)"> COD (Cash On Delivery) </p></label><br>
                                    <label><p><input type="radio" <?= ($orderdetails->order->payment_mode == 'wallet') ? 'checked' : '' ?> name="payment_mode" value="Wallet (Balance Rs 0.0)"> Wallet (Balance Rs 0.0) </p></label><br>
                                    <label><p><input type="radio" <?= ($orderdetails->order->payment_mode == 'online') ? 'checked' : '' ?> name="payment_mode" value="Online Payment"> Online Payment </p></label>
                                </div> 
                            </div>
                            <div class="card-footer cart-sidebar-footer">
                                <a href="checkout.html"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>Rs <?= $orderdetails->order->order_amount ?></strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
                            </div>  
                        </div>
                        <?php
                        }
                        ?>
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