<?php 

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	
Class Customers extends CI_Model
{
	public function add($data){
		$query = "INSERT INTO customers(`business_name`, `business_address`, `business_city`, `business_state`, `business_zip`, `business_phone`, `business_email`, `website`, `contact_name`, `contact_email`, `contact_phone`, `logo`, `start_date`, `documents`, `end_date`, `url_tag`, `max_docs_number`) VALUES('".$data['business_name']."', '".$data['business_address']."', '".$data['business_city']."', '".$data['business_state']."', '".$data['business_zip']."', '".$data['business_phone']."', '".$data['business_email']."', '".$data['website']."', '".$data['contact_name']."', '".$data['contact_email']."', '".$data['contact_phone']."', '".$data['logo']."', '".$data['start_date']."', '".$data['documents']."', '".$data['end_date']."', '".$data['url_tag']."', '".$data['max_docs_number']."')";
        $this->db->query($query);
	}

	public function load(){
		$query = "SELECT * FROM customers";
		$query_result = $this->db->query($query)->result_array();
		
		return $query_result;
	}

	public function getByID($id){
		$query = "SELECT * FROM customers WHERE id='".$id."'";
		$query_result = $this->db->query($query)->result_array();
		
		return $query_result;
	}

	public function getByTag($url_tag){
		$query = "SELECT * FROM customers WHERE url_tag='".$url_tag."'";
		$query_result = $this->db->query($query)->result_array();
		
		return $query_result;
	}

	public function update($id, $data){
		
		$logo_set = '';
		if(isset($data['logo'])){
			$logo_set = "logo='".$data['logo']."',";
		}

		$set_statements = "business_name='".$data['business_name']."', business_address='".$data['business_address']."', business_city='".$data['business_city']."', business_state='".$data['business_state']."', business_zip='".$data['business_zip']."', business_phone='".$data['business_phone']."', business_email='".$data['business_email']."', website='".$data['website']."', contact_name='".$data['contact_name']."', contact_email='".$data['contact_email']."', contact_phone='".$data['contact_phone']."', ".$logo_set." start_date='".$data['start_date']."', documents='".$data['documents']."', end_date='".$data['end_date']."', url_tag='".$data['url_tag']."', max_docs_number='".$data['max_docs_number']."'";

		$query = "UPDATE customers SET ".$set_statements." WHERE id='".$id."'";
        $this->db->query($query);
	}

	public function deleteByID($id){
		$query = "DELETE FROM customers WHERE id='".$id."'";
		$this->db->query($query);
	}

	public function checkURLTag($url_tag){
		$query = "SELECT * FROM customers WHERE url_tag='".$url_tag."'";
		$query_result = $this->db->query($query)->result_array();
		
		return $query_result;
	}
}