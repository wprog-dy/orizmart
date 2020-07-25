<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('comman_model');
	}
	public function index()
	{

		$data['title'] = 'Groci - Organic Food & Grocery Market Template';
		$countryUrl = API_URL.'get-countries';
		$countryResult = file_get_contents($countryUrl);
		$countryRes = json_decode($countryResult);

		$data['countries'] = $countryRes->data;

		$this->load->view('home',$data);
	}
	public function checkZipcode()
	{
		$posted = $this->input->post(); //get all $_POST items

		$this->form_validation->set_rules('zipcode','Zipcode', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) 
		{
			$data = array(
			    'status'=>'3',
			    'zipcode_error' => form_error('zipcode')
			);
			echo json_encode($data); die;
		}
		else
		{
			$data = array(
				'zipcode' => $posted['zipcode']
			);
			$request_url = API_URL.'getMerchantTypeByZipcode';
			$result = $this->comman_model->insertPostData($request_url,$data);
			echo $result; die;
		}	
	}
	public function showAllVoucher()
	{
		$data['title'] = 'Buy Voucher';

		$countryUrl = API_URL.'get-countries';
		$countryResult = $this->comman_model->insertGETData($countryUrl,$token=0);
		$countryRes = json_decode($countryResult);

		$data['countries'] = $countryRes->data;

		$this->load->view('showallvoucher',$data);
	}
	public function singleVoucher($vocherid,$zipcode)
	{
		$data['zipcode'] = $zipcode;
		$countryUrl = API_URL.'get-countries';
		$countryResult = $this->comman_model->insertGETData($countryUrl,$token=0);
		$countryRes = json_decode($countryResult);
		$data['countries'] = $countryRes->data;

		$voucherdata = array(
				'zipcode' => $zipcode,
				'apiCallFrom' 	=> '1'
			);
		$request_url = API_URL.'getVoucherListByZipcode';
		$result = $this->comman_model->insertPostData($request_url,$voucherdata);
		
		foreach (json_decode($result) as $key => $values) 
		{
			if($key == 'data')
			{
				foreach ($values as $val) 
				{
					if($val->id == $vocherid)
					{
						$data['title'] = $val->merchant_company;
						$data['vocherdetail'] = $val;
					}	
				}
			}
		}
		$this->load->view('singlevoucher',$data);
	}
}
