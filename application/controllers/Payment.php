<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('comman_model'); 
	}
	public function addMoneyWallet()
	{
		if($this->session->userdata('clientId'))
		{
			$data['title'] = 'Add Money';
			$token = $this->session->userdata('user_token');
			$request_url = API_URL.'client/'.$this->session->userdata('clientId');
			$userdetail = $this->comman_model->insertGETData($request_url,$token);
			$data['userdata'] = json_decode($userdetail);
			$this->load->view('addmoneywallet',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function payumoneysubmit()
	{
		$token = $this->session->userdata('user_token');
		
		$amount = $this->input->post('amount') * 0.023; 

		$formdata['txnid'] = $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$formdata['email'] = $email = $this->session->userdata('clientEmail');
		$formdata['mobile'] = $mobile = $this->session->userdata('clientMobNo');
		$name = explode(" ", $this->session->userdata('clientName'));
		$formdata['firstName'] = $firstName = $name[0];
		$formdata['lastName'] = $lastName =  $name[1];
		$formdata['totalCost'] = $totalCost = $this->input->post('amount') + $amount + 3;
		$formdata['productinfo'] = $productinfo = 'Order Payment';
		$formdata['action'] = PAYU_BASE_URL.'/_payment'; 
		$formdata['success_url'] = $success_url = base_url('resultpayumoney'); 
		$formdata['fail_url'] = $fail_url = base_url('resultpayumoney'); 

		$data = array(
				'key' 	=> MERCHANT_KEY,
				'txnid' => $txnid,
				'amount' => $totalCost,
				'productinfo' => $productinfo,
				'firstname' => $firstName,
				'email' => $email,
				'phone' => $mobile,
				'users_id' => $this->session->userdata('clientUsersId'),
				'user_type' => 'client',
				'order_id' => substr(number_format(time() * rand(),0,'',''),0,10),
				'token' => 'Bearer ' . $token
			);
		$request_url = API_URL.'create-payu-pay-request';
		$result = $this->comman_model->insertPostData($request_url,$data);
	 	$res = json_decode($result);

	 	if($res->status == '1')
	 	{
	 		$formdata['hash'] = $res->hash;
	 		$this->load->view('payumoneyform',$formdata);
	 	}
	 	else
	 	{
	 		$this->session->set_flashdata('fail',$res->msg);
			redirect(base_url('addmoney'));
	 	}
	}
	public function resultpayumoney()
	{
		$token = $this->session->userdata('user_token');
		$data = array(
				'key' 	=> MERCHANT_KEY,
				'txnid' => $_POST['txnid'],
				'amount' => $_POST['amount'],
				'productinfo' => $_POST['productinfo'],
				'firstname' => $_POST['firstname'],
				'email' => $_POST['email'],
				'status' => $_POST['status'],
				'hash' => $_POST['hash'],
				'transaction_type' => $_POST['mode'],
				'payment_id' => $_POST['payuMoneyId'],
				'transaction_response' => json_encode($_POST),
				'error_id' => $_POST['error'],
				'error_msg' => $_POST['error_Message'],
				'users_id' => $this->session->userdata('clientUsersId'),
				'token' => 'Bearer ' . $token
			);
		$request_url = API_URL.'update-payu-pay-request';
		$result = $this->comman_model->insertPostData($request_url,$data);
	 	$res = json_decode($result);
	 	
	 	if($res->status == '1')
	 	{
	 		$msg = 'Payment '.$res->paymentStatus;
	 		$this->session->set_flashdata('success',$msg);
			redirect(base_url('log'),'refresh');
	 	}
	 	else
	 	{
	 		if(($res->status == '0')&&($res->responseCode == '11'))
	 		{
	 			$msg = 'Payment '.$res->msg;
		 		$this->session->set_flashdata('fail',$msg);
				redirect(base_url('addmoney'),'refresh');
	 		}
	 		else
	 		{
	 			$msg = 'Payment '.$res->paymentStatus;
		 		$this->session->set_flashdata('fail',$msg);
				redirect(base_url('addmoney'),'refresh');
	 		}
	 	}
	}
	public function log()
	{
		if($this->session->userdata('clientId'))
		{
			$data['title'] = 'Discount Claim';
			$token = $this->session->userdata('user_token');
			$request_url = API_URL.'client/'.$this->session->userdata('clientId');
			$userdetail = $this->comman_model->insertGETData($request_url,$token);
			$data['userdata'] = json_decode($userdetail);
			
			$this->load->view('logdetail',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
}
