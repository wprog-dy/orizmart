<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comman_model extends CI_Model
{ 
	public function insertPostData($request_url,$data) 
	{

		if(!empty($data['token']))
		{
			$ft_headers = array(
		    	"Content-type: application/json",
		    	'Authorization: '.$data['token']
			);
		}
		else
		{	
	    	$ft_headers = array(
	    		"Content-type: application/json",
			);
		}	

		$ftch = curl_init(); 
		curl_setopt($ftch, CURLOPT_URL,$request_url);
		curl_setopt($ftch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ftch, CURLOPT_TIMEOUT, 50);
		curl_setopt($ftch, CURLOPT_POST, true);
		curl_setopt($ftch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ftch, CURLOPT_HTTPHEADER, $ft_headers);

		$result = curl_exec($ftch);

		return $result;
	}
	public function insertGETData($request_url,$token) 
	{
		$ch = curl_init($request_url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		   'Content-Type: application/json',
		   'Authorization: Bearer ' . $token
		   ));
		
		$data = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		return $data;
	}
}
?>