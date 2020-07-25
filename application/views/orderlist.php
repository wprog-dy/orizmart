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
                    <div class="col-md-9">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                    Order List
                                 </h5>
                              </div>
                              <div class="order-list-tabel-main table-responsive">
                                 <table class="datatabel table table-striped table-bordered order-list-tabel" width="100%" cellspacing="0">
                                      <thead>
                                        <tr>
                                           <th>Order Id</th>
                                           <th>Amount</th>
                                           <th>On Date</th>
                                           <th>Action</th>
                                         </tr>
                                       </thead>
                                    </table>
                                 </table>
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
<link href="<?= base_url(); ?>assets/vendor/datatables/datatables.min.css" rel="stylesheet" />
<script src="<?= base_url(); ?>assets/vendor/datatables/datatables.min.js"></script>
<script>
   $(document).ready(function() 
   {
        $('.datatabel').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= base_url(); ?>ordermanage/ordertabledata',
            'type': "POST",
            'data': { '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>' }
        },
        'columns': [
            { data: 'order_no' },
            { data: 'order_amount' },
            { data: 'order_on' },
            { data: 'order_view' }
        ]
      });
   });
</script>
</body>
</html>