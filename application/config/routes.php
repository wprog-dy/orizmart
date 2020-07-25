<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['showallvoucher'] = 'home/showAllVoucher';
$route['singlevoucher/(:num)/(:num)'] = 'home/singleVoucher/$1/$2';

/* user management  */
$route['userregistration'] = 'auth/userRegistration';
$route['verifyuserotp'] = 'auth/verifyUserOtp';
$route['userlogin'] = 'auth/userLogin';
$route['resenduserotp'] = 'auth/resendUserOtp';
$route['forgotpass'] = 'auth/forgotPass';
$route['newpwd'] = 'auth/newPwd';
$route['myprofile'] = 'auth/myProfile';
$route['myaddress'] = 'auth/myAddress';
$route['changepassword'] = 'auth/changePassword';
$route['setting'] = 'auth/Setting';

/* user payment system*/
$route['log'] = 'payment/log';
$route['addmoney'] = 'payment/addMoneyWallet';
$route['resultpayumoney'] = 'payment/resultpayumoney';

/* home */
$route['checkzipcode'] = 'home/checkZipcode';

/* ecommercepages */
$route['getmerchant/(:num)/(:num)'] = 'ecommercepages/getMerchantTypeByZipcode/$1/$2';
$route['showitems/(:any)/(:any)/(:any)'] = 'ecommercepages/showItems/$1/$2/$3';
$route['cart/(:num)/(:num)/(:num)'] = 'ecommercepages/Cart/$1/$2/$3';
$route['updatecart/(:num)/(:num)/(:num)'] = 'ecommercepages/updateCart/$1/$2/$3';
$route['deliveryaddress/(:num)/(:num)/(:num)'] = 'ecommercepages/deliveryAddress/$1/$2/$3';
$route['checkout/(:num)/(:num)/(:num)'] = 'ecommercepages/Checkout/$1/$2/$3';
$route['checkoutsmt/(:num)/(:num)'] = 'ecommercepages/checkoutsmt/$1/$2';
$route['deletereloadcart/(:num)/(:num)/(:num)/(:any)'] = 'ecommercepages/deleteReloadCart/$1/$2/$3/$4';
$route['thankyou'] = 'ecommercepages/thankYou';


/* Order manage */
$route['claimhere/(:num)'] = 'ordermanage/claim/$1';
$route['orderlist'] = 'ordermanage/orderList';
$route['orderdetail/(:num)'] = 'ordermanage/orderDetail/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
