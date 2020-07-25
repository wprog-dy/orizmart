<?php include 'include/header.php'; ?>
<style type="text/css">
.pagination 
{
    display: inline-block;
}
.pagination a 
{
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
}
.pagination strong 
{
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    z-index: 3;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
.pagination a:hover:not(.active) {background-color: #ddd;}
.paginationcenter{ text-align: center;  }
</style>
	<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Items</a>
               </div>
            </div>
         </div>
      </section>
      <section class="shop-list section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-3">
				   <div class="shop-filters">
					  <div id="accordion">
						 <div class="card">
							<div class="card-header" id="headingOne">
							   <h5 class="mb-0">
								  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								  Category <span class="mdi mdi-chevron-down float-right"></span>
								  </button>
							   </h5>
							</div>
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							   <div class="card-body card-shop-filters">
								  <form class="form-inline mb-3">
									 <div class="form-group">
										<input type="text" class="form-control" placeholder="Search By Category">
										<button type="submit" class="pl-2 pr-2 btn btn-secondary btn-lg"><i class="mdi mdi-file-find"></i></button>
									 </div>
								  </form>
							   </div>
							</div>
						 </div>
					  </div>
				   </div>
				   <div class="left-ad mt-4">
					  <img class="img-fluid" src="http://via.placeholder.com/254x557" alt="">
				   </div>
				</div>
               <div class="col-md-9">
                    <span class="message"></span>
                    <a href="<?= base_url('cart/'.$merchant_type_id.'/'.$zipcode.'/'.$merchant_id); ?>" class="showcart">
                        <button class="btn btn-secondary btn-lg btn-block text-left" type="button">
                            <span class="float-right">
                                <i class="mdi mdi-cart-outline"></i> View Cart </span>
                                <span class="mdi mdi-chevron-right"></span>
                        </button>
                    </a>

                  <a href="#"><img class="d-none img-fluid mb-3" src="<?= base_url('assets/');?>img/shop.jpg" alt=""></a>
                  <div class="shop-head">
                     <a href="<?= base_url(); ?>"><span class="mdi mdi-home"></span> Home</a> <span class="mdi mdi-chevron-right"></span> <a href="#">Category</a> <span class="mdi mdi-chevron-right"></span><a href="#">Merchant</a> <span class="mdi mdi-chevron-right"></span> <a href="#">Items</a>
                     <div class="btn-group float-right mt-2 d-none">
                        <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort by Products &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                           <a class="dropdown-item" href="#">Relevance</a>
                           <a class="dropdown-item" href="#">Price (Low to High)</a>
                           <a class="dropdown-item" href="#">Price (High to Low)</a>
                           <a class="dropdown-item" href="#">Discount (High to Low)</a>
                           <a class="dropdown-item" href="#">Name (A to Z)</a>
                        </div>
                     </div>
                     <h5 class="mb-3">Items</h5>
                  </div>
                    <div class="row no-gutters itemsList">
                    </div>
                    <nav>
                        <div class="paginationcenter mt-4">
                            <div class="pagination"></div>
                        </div>
                    </nav>
               </div>
            </div>
         </div>
      </section>

<?php include 'include/footer.php'; ?>
<script type="text/javascript">
$(document).ready(function()
{
    // Detect pagination click
    $('.pagination').on('click','a',function(e)
    {
        e.preventDefault(); 
        var pageno = $(this).attr('data-ci-pagination-page');
        loadPagination(pageno);
    });

    loadPagination(0);
    // Load pagination
    function loadPagination(pagno)
    {
        $('#loader').show();
        var data =  
        {
            merchant_id : <?= $merchant_id; ?>,
            zipcode : <?= $zipcode; ?>,
            merchant_type_id : <?= $merchant_type_id; ?>,
        }
        data[csfr_token_name] = csfr_token_value;
        $.ajax({
        url: '<?= base_url(); ?>EcommercePages/loadRecord/'+pagno,
        data : data,
        type: 'GET',
        dataType: 'json',
        success: function(response)
        {   
            $('#loader').hide();
            $('.pagination').html(response.pagination);
            createDivItems(response.result,response.row);
        }
        });
    }

    // Create div items list
    function createDivItems(result,sno)
    {
        sno = Number(sno);
        $('.itemsList').empty();
        for (let [key, value] of Object.entries(result)) 
        {
            var discount = '';
            var item_discount='';
            if(value.item_discount)
            {
                discount = '<span class="badge badge-success">'+value.item_discount+'% OFF</span>';
                item_discount = value.item_discount;
            }    
            var items = '<div class="col-md-4"><div class="product"><a href="javascript:void(0);"><div class="product-header">'+discount+'<img class="img-fluid" src="'+value.item_image+'" alt=""><span class="veg text-success mdi mdi-circle"></span></div><div class="product-body"><h5>'+value.item_name +'</h5><h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - '+value.qty_per_unit+value.item_unit_name+'</h6></div><div class="product-footer"> <a href="javascript:void(0);" data-id="'+value.id+'" data-merchant_type_id="'+value.merchant_type_id+'" data-item_discount="'+value.item_discount+'"  data-item_name="'+value.item_name+'" data-item_price="'+value.item_price+'"  data-item_image="'+value.item_image+'"  class="add_cart btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</a> <p class="offer-price mb-0">Rs. '+value.item_price+'<br></p></div></a></div></div>';
            $('.itemsList').append(items);
        }
    }
    $(document).on('click', '.add_cart', function()
    {
		$('#loader').show();
        var data =  
        {   
            id: $(this).data("id"),
            item_name: $(this).data("item_name"),
            item_price: $(this).data("item_price"),
            item_image: $(this).data("item_image"),
            merchant_type_id: $(this).data("merchant_type_id"),
            item_discount: $(this).data("item_discount"),
            quantity: 1
        }
        data[csfr_token_name] = csfr_token_value;
       
        $.ajax({
            url : base_url+'EcommercePages/addToCart',
            method : "POST",
            data : data,
            async:true,
            success: function(response)
            {
				$('#loader').hide();
                $('.message').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>Item has been added to your cart.</div>');
                    setTimeout(function() { $(".alert-success").hide(); }, 8000);
                $('.cart-sidebar').html(response);
                $('.cart-value').load(base_url+'EcommercePages/loadCountCartItems');
                $('.showcart').show();
                $(window).scrollTop(0);
            }
        });
    });
});
</script>
</body>
</html>