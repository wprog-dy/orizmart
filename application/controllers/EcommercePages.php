<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EcommercePages extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('comman_model');
		$this->load->library('pagination');
	}
	public function Cart($merchant_type_id,$zipcode,$merchant_id)
	{
		$data['title'] = 'Cart';
		$data['merchant_id'] = $merchant_id;
		$data['merchant_type_id'] = $merchant_type_id;
		$data['zipcode'] = $zipcode;
		$this->load->view('cart',$data);
	}
	public function deliveryAddress($merchant_type_id,$zipcode,$merchant_id)
	{
		$data['title'] = 'Add Address';
			
		$data['merchant_id'] = $merchant_id;
		$data['merchant_type_id'] = $merchant_type_id;
		$data['zipcode'] = $zipcode;
		$this->load->view('deliveryaddress',$data);
	}
	public function Checkout($merchant_type_id,$zipcode,$merchant_id)
	{
		$data['title'] = 'Checkout';
			
		$data['merchant_id'] = $merchant_id;
		$data['merchant_type_id'] = $merchant_type_id;
		$data['zipcode'] = $zipcode;
		$this->load->view('checkout',$data);
	}
	public function checkoutsmt($merchant_type_id,$merchant_id)
	{
		$token = $this->session->userdata('user_token');

		$posted = $this->input->post(); //get all $_POST items

		$this->form_validation->set_rules('usa_geo_address', 'Address', 'trim|required');
		$this->form_validation->set_rules('usa_complete_address', 'Complete Address', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) 
		{
			$data = array(
			    'status'=>'3',
			    'usa_geo_address_error' => form_error('usa_geo_address'),
			    'usa_complete_address_error' => form_error('usa_complete_address')
			);
			echo json_encode($data); die;
		}
		else
		{
			$itemsarr = array();
			$total_discount = 0;
			foreach ($this->cart->contents() as $items) 
            { 	
            	if($items['options']['merchant_type_id'] == $merchant_type_id)
                {
                	$total_discount += $items['options']['item_discount']*$items['qty'];
					$itemsarr[]  = array('rowid' => $items['rowid'],'item_id' => $items['id'],'quantity' => $items['qty'],'amount' => $items['subtotal']);
				}	
			}
			$data = array(
				'orderId' 					=> 'FO'.substr(number_format(time() * rand(),0,'',''),0,17),
				'order_category' 			=> '1',
				'userId' 					=> $this->session->userdata('clientId'),
				'orderDateTime'				=> date('Y-m-d h:m:s'),
				'merchantId' 				=> $merchant_id,
				'orderPrice'  				=> number_format($this->cart->total()),
				'usa_lat'    				=> $posted['usa_lat'],
				'usa_long' 					=> $posted['usa_long'],
				'usa_geo_address' 			=> $posted['usa_geo_address'],
				'usa_complete_address' 		=> $posted['usa_complete_address'],
				'discount_amt' 				=> $total_discount,
				'subscription_from_date'	=> '',
	            'subscription_to_date'		=> '',
	            'subscription_perday_qty'	=> '',
				'wifyee_commission' 		=> '4.00',
				'dist_commission' 			=> '0.00',
				'delivery_distance' 		=> '0.0',
				'gst_amount' 				=> '0.0',
				'sub_total' 				=> number_format($this->cart->total()),
				'order_type' 				=> '1',
				'items' 					=> $itemsarr,
				'token' 					=> 'Bearer ' . $token
			);
			
			$request_url = API_URL.'order';
			$result = $this->comman_model->insertPostData($request_url,$data);

			$res = json_decode($result);

			if($res->status == '1')
			{
				$removecartdata = array();
				foreach ($this->cart->contents() as $items) 
            	{ 	
	            	if($items['options']['merchant_type_id'] == $merchant_type_id)
	                { 
						$removecartdata[] = array(
				            'rowid' => $items['rowid'], 
				            'qty' => 0,
				            'options'=> array('item_discount' => '0')
				        );
				    }    
				}
				$this->cart->update($removecartdata); 
			    $this->session->set_flashdata('success',$res->msg);
			    redirect(base_url('thankyou'));
			}
		}
	}
	public function thankYou()
	{
		$data['title'] = 'Thank You';
		$this->load->view('thankyou',$data);
	}
	public function showItems($merchant_type_id,$zipcode,$merchant_id)
	{
		$data['title'] = 'Show Items';
		$data['merchant_id'] = $merchant_id;
		$data['zipcode'] = $zipcode;
		$data['merchant_type_id'] = $merchant_type_id;
		$countryUrl = API_URL.'get-countries';
		$countryResult = $this->comman_model->insertGETData($countryUrl,$token=0);
		$countryRes = json_decode($countryResult);
		$data['countries'] = $countryRes->data;
		$this->load->view('showitems',$data);
	}
	public function loadRecord($rowno=0)
	{
	    // Row per page
	    $rowperpage = 9;

	    // Row position
	    if($rowno != 0){
	      $rowno = ($rowno-1) * $rowperpage;
	    }
		
		$data = array(
			'merchant_id' => $this->input->get('merchant_id'),
			'zipcode' => $this->input->get('zipcode'),
			'merchant_type_id' => $this->input->get('merchant_type_id'),
			'start' => $rowno,
			'length' => $rowperpage
		);
		
		$request_url = API_URL.'getItemListByParams';
		$result = $this->comman_model->insertPostData($request_url,$data);
		$allitems = json_decode($result);

	    // All records count
	    $allcount = $allitems->recordsTotal;

	    // Get records
	    $users_record = $allitems->data;
	 
	    // Pagination Configuration
	    $config['base_url'] = base_url().'EcommercePages/loadRecord';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $allcount;
	    $config['per_page'] = $rowperpage;

	    // Initialize
	    $this->pagination->initialize($config);

	    // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $users_record;
	    $data['row'] = $rowno;

	    echo json_encode($data);
	 
	}
	public function getMerchantTypeByZipcode($categoryId,$zipcode)
	{
		$data = array(
			'merchant_type' => $categoryId,
			'zipcode' => $zipcode
		);
		$data['title'] = 'Category Detail';
		$request_url = API_URL.'getMerchantListByParams';
		$result = $this->comman_model->insertPostData($request_url,$data);
		$allmerchant = json_decode($result);

		$allmerchantaarr = array();

		foreach ($allmerchant as $value) 
		{
			if($value !='1' )
			{
				foreach ($value as $values) 
				{
					 $allmerchantaarr[] = $values;
				}
			}	
		}

		$data['allmerchant'] = $allmerchantaarr; 

		$this->load->view('merchantshowbycategory',$data);
	}
	public function addToCart()
	{
		$data = array(
            'id' => $this->input->post('id'), 
            'name' => $this->input->post('item_name'), 
            'price' => $this->input->post('item_price'), 
            'qty' => $this->input->post('quantity'), 
            'image' => $this->input->post('item_image'), 
            'options' => array('merchant_type_id' => $this->input->post('merchant_type_id'),'item_discount' => $this->input->post('item_discount'))
        );
        $this->cart->insert($data);
        echo $this->showCart();
	}
	function showCart()
	{ 
		$output = '<div class="cart-sidebar-header">
		            <h5>
		               My Cart <span class="text-success">('.count($this->cart->contents()).' item)</span> <a data-toggle="offcanvas" onclick="closeNav()" class="float-right" href="javascript:void(0);"><i class="mdi mdi-close"></i>
		               </a>
		            </h5>
		        </div>
		        <div class="cart-sidebar-body">';
		$no = 0;

        foreach($this->cart->contents() as $items) 
        {
        	if($items['options']['merchant_type_id'] =='14')
        	{
	            $no++;
	            $output .='<div class="cart-list-product">
				               <a class="float-right remove-cart" delete-id="'.$items['rowid'].'" href="javascript:void(0);"><i class="mdi mdi-close"></i></a>';
				               if($items['image'])
				               {
				               		$output .= '<img class="img-fluid" src="'.$items['image'].'" alt="">';
				               }
				               else
				               {
				               		$output .= '<img class="img-fluid" src="<?= base_url(); ?>assets/img/item/11.jpg" alt="">';
				               }
				               
				               $output .= '<h5><a href="#">'.$items['name'].'</a></h5>
                                       <p class="offer-price mb-0">Qty '.$items['qty'].'</i></p>
				               <p class="offer-price mb-0">Rs'.number_format($items['subtotal']).'</p>
				            </div>';
	        }
	    }    
        $output .= '</div>
         <div class="cart-sidebar-footer">
            <div class="cart-store-details">
               <p class="d-none">Sub Total <strong class="float-right">$900.69</strong></p>
               <p  class="d-none">Delivery Charges <strong class="float-right text-danger">+ $29.69</strong></p>
               <h6>Your total savings <strong class="float-right text-danger">Rs '.number_format($this->cart->total()).'</strong></h6>
            </div>';

        $output .= '<a href="'.base_url('checkout/14/430').'"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>Rs '.number_format($this->cart->total()).'</strong> <span class="mdi mdi-chevron-right"></span></span></button></a>';

        $output .= '</div>';
        return $output;   
	}
	function loadCart()
	{ 
        echo $this->showCart();
    }
    function loadCountCartItems()
	{ 
        echo count($this->cart->contents());
    }
    function deleteCart()
    { 
        $data = array(
            'rowid' => $this->input->post('row_id'), 
            'qty' => 0, 
        );
        
        $this->cart->update($data);
        echo $this->showCart();
    }
    function deleteReloadCart($merchant_type_id,$zipcode,$merchant_id,$rowid)
    { 
        $data = array(
            'rowid' => $rowid, 
            'qty' => 0,
            'options'=> array('item_discount' => '0')
        );
        
        $this->cart->update($data);

  		$this->session->set_flashdata('success','Item delete successfully');
	    redirect(base_url('cart/'.$merchant_type_id.'/'.$zipcode.'/'.$merchant_id));
    }
    public function updateCart($merchant_type_id,$zipcode,$merchant_id)
    { 
    	$rowid = $this->input->post('rowid');
    	$qty = $this->input->post('qty');
    	$item_discount = $this->input->post('item_discount');
    	for ($i=0; $i < count($this->cart->contents()); $i++) 
    	{ 
    		if($item_discount[$i]>0)
    		{
    			$item_discounts = $item_discount[$i];
    		}
    		else
    		{
    			$item_discounts = 0;	
    		}
    		$data[$i] = array(
            	'rowid' => $rowid[$i], 
            	'qty' => $qty[$i], 
            	'options' => array('merchant_type_id' => $merchant_type_id,'item_discount' => $item_discounts)
	        );
	        $this->cart->update($data[$i]);

	        if($i == (count($rowid)-1))
	        {
	        	$this->session->set_flashdata('success','Cart Update successfully');
	        	redirect(base_url('cart/'.$merchant_type_id.'/'.$zipcode.'/'.$merchant_id));
	        }
    	}
    }
}
