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
                        <?php
                            if($this->session->flashdata('fail')) 
                            {
                                echo '<div class="alert alert-danger">'.$this->session->flashdata('fail').'</div>';
                            }
                            if ($this->session->flashdata('success')) 
                            {
                                echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
                            }
                        ?>    
                        <div class="card card-body">
                            <h5 class="card-header">Available Balance</h5>   
                            <div class="card-body pt-0 pr-0 pl-0 pb-0">
                                <div class="cart-list-product">
                                    <p> Rs 0 </p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url('addmoney') ?>"><button class="btn btn-secondary text-left float-right" type="button">Add Wallet</button></a>
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