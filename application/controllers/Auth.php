<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('comman_model');
	}
	public function myProfile()
	{
		if($this->session->userdata('clientId'))
		{
			$data['title'] = 'My Profile';
			$token = $this->session->userdata('user_token');

			if($this->input->post('submit') == 'Save Changes') 
			{
				$posted = $this->input->post();

				$this->form_validation->set_rules('client_firstname','First Name','trim|required|min_length[3]');
				$this->form_validation->set_rules('client_lastname','Last Name','trim|required|min_length[3]');
				$this->form_validation->set_rules('client_gender','Gender', 'trim|required');
				$this->form_validation->set_rules('client_aadhaar_number', 'Addaar Card', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('client_pan_number', 'Pan Card', 'trim|required|regex_match[/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/]');
				
				if ($this->form_validation->run() == FALSE) 
				{
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('fail', $data['errors']);
					redirect(base_url('myprofile'),'refresh');
				}
				else
				{
					$data = array(
						'_method' 					=> 'PUT',
						'client_id' 				=> $this->session->userdata('clientId'),
						'old_client_profile_image'	=> $posted['client_profile_image'],
						'client_firstname' 			=> $posted['client_firstname'],
						'client_lastname'  			=> $posted['client_lastname'],
						'client_gender'    			=> $posted['client_gender'],
						'client_aadhaar_number' 	=> $posted['client_aadhaar_number'],
						'client_pan_number' 		=> $posted['client_pan_number'],
						'token' 					=> 'Bearer ' . $token
					);
					$request_url = API_URL.'client-profile/personal-update/'.$this->session->userdata('clientId');
					$result = $this->comman_model->insertPostData($request_url,$data);
					$res = json_decode($result);
					if($res->last_insert_id == $this->session->userdata('clientId'))
					{
						$this->session->set_flashdata('success',$res->msg);
						redirect(base_url('myprofile'));
					}
				}
			}
			else
			{
				$request_url = API_URL.'client/'.$this->session->userdata('clientId');
				$userdetail = $this->comman_model->insertGETData($request_url,$token);
				$data['userdata'] = json_decode($userdetail);
				$this->load->view('myprofile',$data);
			}
		}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}
	public function myAddress()
	{
		$data['title'] = 'My Address';

		$countryUrl = API_URL.'get-countries';
		$countryResult = $this->comman_model->insertGETData($countryUrl,$token=0);
		$countryRes = json_decode($countryResult);
		$data['countries'] = $countryRes->data;
		$token = $this->session->userdata('user_token');
		if($this->session->userdata('clientId'))
		{ 
			if($this->input->post('submit') == 'Save Changes') 
			{
				$posted = $this->input->post();

				$this->form_validation->set_rules('client_address','Address','trim|required|min_length[5]|max_length[250]');
				$this->form_validation->set_rules('client_zipcode','Zipcode','trim|required|min_length[3]');
				$this->form_validation->set_rules('country_id','Country', 'trim|required');
				
				if ($this->form_validation->run() == FALSE) 
				{
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('fail', $data['errors']);
					redirect(base_url('myaddress'),'refresh');
				}
				else
				{
					$data = array(
						'_method' 		=> 'PUT',
						'client_id' 	=> $this->session->userdata('clientId'),
						'client_address'=> $posted['client_address'],
						'client_zipcode'=> $posted['client_zipcode'],
						'country_id'  	=> $posted['country_id'],
						'state_id'    	=> $posted['state_id'],
						'city_id' 		=> $posted['city_id'],
						'token' 		=> 'Bearer ' . $token
					);
					$request_url = API_URL.'client-profile/address-update/'.$this->session->userdata('clientId');
					$result = $this->comman_model->insertPostData($request_url,$data);
					$res = json_decode($result);
					if($res->last_insert_id == $this->session->userdata('clientId'))
					{
						$this->session->set_flashdata('success',$res->msg);
						redirect(base_url('myaddress'));
					}
				}
			}
			else
			{
				$request_url = API_URL.'client/'.$this->session->userdata('clientId');
				$userdetail = $this->comman_model->insertGETData($request_url,$token);
				$data['userdata'] = json_decode($userdetail);
				$this->load->view('myaddress',$data);
			}
		}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}
	public function getState()
	{
		$data = array('country_id'=> $this->input->post('country'));
		$request_url = API_URL.'get-states';
		$result = $this->comman_model->insertPostData($request_url,$data);
		echo $result; die;
	}
	public function getCity()
	{
		$data = array('state_id'=> $this->input->post('region_id'));
		$request_url = API_URL.'get-city';
		$result = $this->comman_model->insertPostData($request_url,$data);
		echo $result; die;
	}
	public function changePassword()
	{
		if($this->session->userdata('clientId'))
		{
			$data['title'] = 'Change Password'; 
			$token = $this->session->userdata('user_token');

			if($this->input->post('submit') == 'Save Changes') 
			{
				$posted = $this->input->post();
				
				$this->form_validation->set_rules('current_password','Existing Password','trim|required|min_length[3]');
				$this->form_validation->set_rules('new_password','New Password','trim|required|matches[new_password_confirmation]');
				$this->form_validation->set_rules('new_password_confirmation','Re-Enter Password','trim|required');
				
				if ($this->form_validation->run() == FALSE) 
				{
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('fail', $data['errors']);
					redirect(base_url('changepassword'),'refresh');
				}
				else
				{
					$data = array(
						'user_type' 				=> 'oriz_client',
						'user_type_id' 				=> $this->session->userdata('clientId'),
						'current_password'			=> $posted['current_password'],
						'new_password' 				=> $posted['new_password'],
						'new_password_confirmation' => $posted['new_password_confirmation'],
						'token' 					=> 'Bearer ' . $token
					);
					$request_url = API_URL.'change-password';
					$result = $this->comman_model->insertPostData($request_url,$data);
					$res = json_decode($result);
					if($res->status == '1')
					{
						$this->session->set_flashdata('success',$res->msg);
						redirect(base_url('changepassword'));
					}
					else
					{
						$this->session->set_flashdata('fail',$res->msg);
						redirect(base_url('changepassword'));
					}
				}
			}
			else
			{
				$request_url = API_URL.'client/'.$this->session->userdata('clientId');
				$userdetail = $this->comman_model->insertGETData($request_url,$token);
				$data['userdata'] = json_decode($userdetail);
				$this->load->view('changepassword',$data);
			}
		}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}
	public function Setting()
	{
		if($this->session->userdata('clientId'))
		{
			$data['title'] = 'Setting';
			$token = $this->session->userdata('user_token');

			if($this->input->post('submit') == 'Save Changes') 
			{
				$posted = $this->input->post();

				$data = array(
					'_method' 			=> 'PUT',
					'client_id' 		=> $this->session->userdata('clientId'),
					'opt_in_mail'		=> $posted['opt_in_mail'],
					'opt_in_sms' 		=> $posted['opt_in_sms'],
					'opt_in_whatsapp' 	=> $posted['opt_in_whatsapp'],
					'token' 			=> 'Bearer ' . $token
				);
				$request_url = API_URL.'client-profile/setting-update/'.$this->session->userdata('clientId');
				$result = $this->comman_model->insertPostData($request_url,$data);
				$res = json_decode($result);
				if($res->last_insert_id == $this->session->userdata('clientId'))
				{
					$this->session->set_flashdata('success',$res->msg);
					redirect(base_url('setting'));
				}			}
			else
			{
				$request_url = API_URL.'client/'.$this->session->userdata('clientId');
				$userdetail = $this->comman_model->insertGETData($request_url,$token);
				$data['userdata'] = json_decode($userdetail);
				$this->load->view('setting',$data);
			}	
		}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}
	public function userRegistration()
	{	
		$posted = $this->input->post(); //get all $_POST items

		$this->form_validation->set_rules('countryId', 'Country', 'trim|required');
		$this->form_validation->set_rules('firstname','First Name','trim|required|min_length[3]');
		$this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[3]');
		$this->form_validation->set_rules('userEmail','Email','trim|required|valid_email');
		$this->form_validation->set_rules('clientmobile', 'Mobile No.', 'trim|required|regex_match[/^[0-9]{10}$/]'); //{10} for 10 digits number
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) 
		{
			$data = array(
			    'status'=>'3',
			    'countryId_error' => form_error('countryId'),
			    'firstname_error' => form_error('firstname'),
			    'lastname_error' => form_error('lastname'),
			    'userEmail_error' => form_error('userEmail'),
			    'clientmobile_error' => form_error('clientmobile'),
			    'password_error' => form_error('password'),
			    'zipcode_error' => form_error('zipcode'),
			    'gender_error' => form_error('gender')
			);
			echo json_encode($data); die;
		}
		else
		{
			$data = array(
				'countryId' => $posted['countryId'],
				'firstname' => $posted['firstname'],
				'lastname' => $posted['lastname'],
				'userEmail' => $posted['userEmail'],
				'clientmobile' => $posted['clientmobile'],
				'password' => $posted['password'],
				'zipcode' => $posted['zipcode'],
				'gender' => $posted['gender'],
				'MAC'=>'abcd123',
	    		'registered_from'=>'web'
			);
			$request_url = API_URL.'client-signup';
			$result = $this->comman_model->insertPostData($request_url,$data);
			echo $result; die;
		}
	}
	public function resendUserOtp()
	{
		$posted = $this->input->post(); //get all $_POST items

		$data = array(
			'userType' => 'oriz_client',
			'mobile' => $posted['mobile'],
			'userDataType' => 'mobile',
			'missedOtpVerify' => true
		);
		$request_url = API_URL.'generate-otp';
		$result = $this->comman_model->insertPostData($request_url,$data);
		echo $result; die;
			
	}
	public function verifyUserOtp()
	{
		$posted = $this->input->post(); //get all $_POST items

		$this->form_validation->set_rules('code','Otp','trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE) 
		{
			$data = array(
			    'status'=>'3',
			    'code_error' => form_error('code')
			);
			echo json_encode($data); die;
		}
		else
		{
			$data = array(
				'userName' => $posted['userName'],
				'code' => $posted['code'],
				'timeFrom' => $posted['timeFrom'],
				'userId' => $posted['userId'],
				'userType' => 'client'
			);
			$request_url = API_URL.'authenticate-otp';
			$result = $this->comman_model->insertPostData($request_url,$data);
			echo $result; die;
		}	
	}
	public function userLogin()
	{
		$posted = $this->input->post(); //get all $_POST items

		$this->form_validation->set_rules('userName','Enter Email/Mobile number','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE) 
		{
			$data = array(
			    'status'=>'3',
			    'userName_error' => form_error('userName'),
			    'password_error' => form_error('password')
			);
			echo json_encode($data); die;
		}
		else
		{
			$data = array(
				'userName' => $posted['userName'],
				'password' => $posted['password'],
				'MAC' => 'abcd123'
			);
			$request_url = API_URL.'client-login';
			$result = $this->comman_model->insertPostData($request_url,$data);
			
			$someObject = json_decode($result);
			
			if($someObject->status == '1')
			{
				$dataarr = array(
				  	'user_token' => $someObject->user_token, 
				  	'clientId' => $someObject->clientId, 
				  	'clientUsersId' => $someObject->clientUsersId, 
				  	'clientMobNo' => $someObject->clientMobNo, 
				  	'clientEmail' => $someObject->clientEmail, 
				  	'clientName' => $someObject->clientName, 
				);

				$this->session->set_userdata($dataarr);
			}
			echo $result; die;
		}	
	}
	public function forgotPass()
	{
		$posted = $this->input->post(); //get all $_POST items

		$this->form_validation->set_rules('userData','Mobile No.', 'trim|required|regex_match[/^[0-9]{10}$/]');
		
		if ($this->form_validation->run() == FALSE) 
		{
			$data = array(
			    'status'=>'3',
			    'userData_error' => form_error('userData')
			);
			echo json_encode($data); die;
		}
		else
		{
			$data = array(
				'userType' => 'oriz_client',
				'userDataType' => 'mobile',
				'userData' => $posted['userData']
			);
			$request_url = API_URL.'forgot-password/create-request';
			$result = $this->comman_model->insertPostData($request_url,$data);
			echo $result; die;
		}	
	}
	public function newPwd()
	{
		$posted = $this->input->post(); //get all $_POST items

		$this->form_validation->set_rules('newPassword','Password.', 'trim|required');
		$this->form_validation->set_rules('newPassword_confirmation','Conform Password', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) 
		{
			$data = array(
			    'status'=>'3',
			    'newPassword_error' => form_error('newPassword'),
			    'newPassword_confirmation_error' => form_error('newPassword_confirmation')
			);
			echo json_encode($data); die;
		}
		else
		{
			$data = array(
				'userType' => 'oriz_client',
				'userDataType' => $posted['userDataType'],
				'userData' => $posted['userData'],
				'otp' => $posted['otp'],
				'timeFrom' => $posted['timeFrom'],
				'userId' => $posted['userId'],
				'usersUId' => $posted['usersUId'],
				'newPassword' => $posted['newPassword'],
				'newPassword_confirmation' => $posted['newPassword_confirmation']
			);
			$request_url = API_URL.'forgot-password';
			$result = $this->comman_model->insertPostData($request_url,$data);
			echo $result; die;
		}	
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}
}
