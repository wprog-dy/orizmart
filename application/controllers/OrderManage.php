<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderManage extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('comman_model');
	}
	public function showVouchers()
	{
		$data = array(
				'zipcode' => $this->input->post('zipcode'),
				'apiCallFrom' 	=> '1'
			);
		$request_url = API_URL.'getVoucherListByZipcode';
		$result = $this->comman_model->insertPostData($request_url,$data);
		echo $result;
	}
	public function claim()
	{
		if($this->session->userdata('clientId'))
		{
			$data['title'] = 'Discount Claim';
			$token = $this->session->userdata('user_token');
			$request_url = API_URL.'client/'.$this->session->userdata('clientId');
			$userdetail = $this->comman_model->insertGETData($request_url,$token);
			$data['userdata'] = json_decode($userdetail);
			
			$this->load->view('claim',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function orderDetail($orderid)
	{
		if($this->session->userdata('clientId'))
		{
			$data['title'] = 'Order List';
			$data['orderid'] = $orderid;
			$token = $this->session->userdata('user_token');
			$request_url = API_URL.'client/'.$this->session->userdata('clientId');
			$userdetail = $this->comman_model->insertGETData($request_url,$token);
			$data['userdata'] = json_decode($userdetail);

			$order_detail_data = array(
				'order_id' => $orderid,
				'token' 	=> 'Bearer ' . $token
			);
			$order_detail_request_url = API_URL.'order/viewOrderDetails';
			$orderdetail = $this->comman_model->insertPostData($order_detail_request_url,$order_detail_data);
			$data['orderdetails'] = json_decode($orderdetail);

			$this->load->view('orderdetail',$data);
		}
		else
		{
			redirect(base_url());
		}		
	}
	public function orderList()
	{
		$data['title'] = 'Order List';
		$token = $this->session->userdata('user_token');
		$request_url = API_URL.'client/'.$this->session->userdata('clientId');
		$userdetail = $this->comman_model->insertGETData($request_url,$token);
		$data['userdata'] = json_decode($userdetail);

		$this->load->view('orderlist',$data);	
	}
	public function ordertabledata()
	{
		// POST data
	    $postData = $this->input->post();

     	$response = array();

	    ## Read value
	    $draw = $postData['draw'];
	    $start = $postData['start'];
	    $rowperpage = $postData['length']; // Rows display per page
	    $columnIndex = $postData['order'][0]['column']; // Column index
	    $columnName = $postData['columns'][$columnIndex]['data']; // Column name
	    $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
	    $searchValue = $postData['search']['value']; // Search value

	    /*## Search 
	    $searchQuery = "";
	    if($searchValue != ''){
	        $searchQuery = " (emp_name like '%".$searchValue."%' or email like '%".$searchValue."%' or city like'%".$searchValue."%' ) ";
	    }



	    ## Fetch records
	    $this->db->select('*');
	    if($searchQuery != '')
	        $this->db->where($searchQuery);
	    $this->db->order_by($columnName, $columnSortOrder);
	    $this->db->limit($rowperpage, $start);*/
	    $token = $this->session->userdata('user_token');
	    $data = array(
						'client_id' => $this->session->userdata('clientId'),
						'start'		=> 0,
						'lenght' 	=> 10,
						'token' 	=> 'Bearer ' . $token
					);
	    $request_url = API_URL.'order/client-order-list';
		$result = $this->comman_model->insertPostData($request_url,$data);

	    $records = json_decode($result);

	    $recorddata = array();

	    foreach($records->data as $record )
	    {
	        $recorddata[] = array( 
	           "order_no"=>$record->order_no,
	           "order_amount"=>$record->order_amount,
	           "order_on"=>$record->order_on,
	           "order_view"=>'<a data-toggle="tooltip" data-placement="top" title="" href="'.base_url().'orderdetail/'.$record->id.'" data-original-title="View Detail" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i></a>'
	        ); 
	    }

	    ## Response
	    $response = array(
	        "draw" => intval($records->draw),
	        "iTotalRecords" => $records->recordsTotal,
	        "iTotalDisplayRecords" => $records->recordsFiltered,
	        "aaData" => $recorddata
	    );

	    echo json_encode($response); 
	}
}
