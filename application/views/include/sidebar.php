<div class="col-md-3">
   <div class="card account-left">
      <div class="user-profile-header">
      	<?php 
            $orderid = (isset($orderid)) ? $orderid : '';
            $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
         	if($userdata->client_data->client_profile_image)
         	{
         		?>
         		<img alt="logo" src="<?=$userdata->client_data->client_profile_image; ?>">
         		<?php
         	}
         	else
         	{
         		?>
         		<img alt="logo" src="<?= base_url('assets/'); ?>img/user.jpg">
         		<?php
         	}
      	?>
         <h5 class="mb-1 text-secondary"><strong>Hi </strong> <?= ucfirst($userdata->client_data->client_firstname).' '.ucfirst($userdata->client_data->client_lastname); ?></h5>
         <p><?= $userdata->client_data->mobile_no; ?></p>
      </div>
      <div class="list-group">
         <a href="<?= base_url('myprofile'); ?>" class="list-group-item list-group-item-action <?= ($current_url == base_url('myprofile'))  ? 'active':''; ?>  "><i aria-hidden="true" class="mdi mdi-account-outline"></i>Personal Information </a>
         <a href="<?= base_url('myaddress'); ?>" class="list-group-item list-group-item-action <?= ($current_url == base_url('myaddress'))  ? 'active':''; ?> "><i aria-hidden="true" class="mdi mdi-map-marker-circle"></i>Address Information </a>
         <a href="<?= base_url('changepassword'); ?>" class="list-group-item list-group-item-action <?= ($current_url == base_url('changepassword'))  ? 'active':''; ?>"><i aria-hidden="true" class="mdi mdi-account-location"></i>Change Password</a>
         <a href="<?= base_url('setting'); ?>" class="list-group-item list-group-item-action <?= ($current_url == base_url('setting'))  ? 'active':''; ?>"><i aria-hidden="true" class="mdi mdi-settings"></i>Setting</a>
         <a href="<?= base_url('log'); ?>" class="list-group-item list-group-item-action <?= (($current_url == base_url('log')))  ? 'active':''; ?>"><i aria-hidden="true" class="mdi mdi-reorder-horizontal"></i>Log</a>
         <a href="<?= base_url('orderlist'); ?>" class="list-group-item list-group-item-action <?= (($current_url == base_url('orderlist')||($current_url == base_url('orderdetail/'.$orderid))))  ? 'active':''; ?>"><i aria-hidden="true" class="mdi mdi-reorder-horizontal"></i>Order List</a>
         <a href="<?= base_url('logout'); ?>" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-lock"></i>  Logout</a> 
      </div>
   </div>
</div>