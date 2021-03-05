<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __construct(){
		
        parent::__construct();

		$this->load->model("Customers");
        
	}
	
	public function customerAdd(){
		if(!isset($_SESSION['user_id'])){
			redirect('/login');
		}

		$data = array();
		$data['root_menu'] = 'customers';
		$data['sub_menu'] = 'customer_add';
		$data['view'] = 'admin/pages/customer_add';
		
		$this->load->view('admin/layout', $data);
	}

	public function customerEdit($id){
		if(!isset($_SESSION['user_id'])){
			redirect('/login');
		}

		$data = array();
		$data['root_menu'] = 'customers';
		$data['sub_menu'] = '';
		$data['view'] = 'admin/pages/customer_edit';

		$customers = $this->Customers->getByID($id);
		if(count($customers) > 0){
			$data['customer'] = $customers[0];
		}
				
		$this->load->view('admin/layout', $data);
	}

	public function customerList(){
		if(!isset($_SESSION['user_id'])){
			redirect('/login');
		}
		
		$data = array();
		$data['root_menu'] = 'customers';
		$data['sub_menu'] = 'customer_list';
		$data['view'] = 'admin/pages/customer_list';
		
		$customers = $this->Customers->load();
		$data['customers'] = $customers;

		$this->load->view('admin/layout', $data);
	}

	public function dashboard(){

		if(!isset($_SESSION['user_id'])){
			redirect('/login');
		}

		$data = array();
		$data['root_menu'] = 'sites';
		$data['sub_menu'] = '';
		$data['view'] = 'admin/pages/dashboard';
		
		$this->load->view('admin/layout', $data);	
		
	}

	public function login(){
		unset($_SESSION['user_id']);
		$this->load->view('admin/login');
	}

	public function register(){
		$this->load->view('admin/register');
	}

	public function logs(){
		if(!isset($_SESSION['user_id'])){
			redirect('/login');
		}
		
		$data = array();
		$data['root_menu'] = 'logs';
		$data['sub_menu'] = 'log_list';
		$data['view'] = 'admin/pages/log_list';
		
		$this->load->view('admin/layout', $data);
	}
}
