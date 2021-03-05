<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminAPIController extends CI_Controller {

    public function __construct(){
		
        parent::__construct();

        $this->load->model("Users");
        $this->load->model("Customers");
    }
    
    public function login(){
        $response = array(
            'success' => false
        );

        $users = $this->Users->exist($_POST['email'], $_POST['password']);
        if(count($users) > 0){
            $response = array(
                'success' => true
            );

            $_SESSION['user_id'] = $users[0]['id'];
            $_SESSION['email'] = $users[0]['email'];
        }
        echo json_encode($response);
    }

    public function register(){
        $response = array(
            'success' => true
        );

        $user_id = $this->Users->add($_POST['full_name'], $_POST['email'], $_POST['password']);
        if(!$user_id){
            $response = array(
                'success' => false
            );  
        }
        echo json_encode($response);
    }

    public function customerNew(){

        // uploading doc files
        $customer_data = array();
        if(isset($_POST['docs_count'])){
            $docs_count = (int)$_POST['docs_count'];
            $doc_files = array();
            for($doc_index = 0; $doc_index < $docs_count; $doc_index++){
                if(isset($_FILES['doc_file_'.$doc_index]) && $_FILES['doc_file_'.$doc_index]['name'] != ''){
                    //upload identification image
                    $date = new DateTime();
                    $doc_path = 'uploads/documents/' . $date->getTimestamp().".".pathinfo($_FILES['doc_file_'.$doc_index]['name'], PATHINFO_EXTENSION);
                    
                    move_uploaded_file($_FILES['doc_file_'.$doc_index]['tmp_name'], $doc_path);

                    $doc_path = base_url($doc_path);
                    $file_name = $_FILES['doc_file_'.$doc_index]['name'];
                }
                else{
                    $doc_path = '';
                    $file_name = '';
                }

                if(isset($_POST['doc_file_label_'.$doc_index])){
                    $doc_file_label = $_POST['doc_file_label_'.$doc_index];
                }
                else{
                    $doc_file_label = '';
                }

                $doc_files[] = array(
                    'path' => $doc_path,
                    'label' => $doc_file_label,
                    'file_name' => $file_name
                );
            }

            $customer_data['documents'] = json_encode($doc_files);
        }
        else{
            $customer_data['documents'] = '';
        }
        
        // uploading logo file
        if(isset($_FILES['logo_file']) && $_FILES['logo_file']['name'] != ''){
            //upload identification image
            $date = new DateTime();
            $logo_path = 'uploads/logos/' . $date->getTimestamp().".".pathinfo($_FILES['logo_file']['name'], PATHINFO_EXTENSION);
            
            move_uploaded_file($_FILES['logo_file']['tmp_name'], $logo_path);

            $logo_path = base_url($logo_path);

            $customer_data['logo'] = $logo_path;
        }
        else{
            $customer_data['logo'] = '';
        }

        if(isset($_POST['business_name'])){
            $customer_data['business_name'] = $_POST['business_name'];
        }
        else{
            $customer_data['business_name'] = '';
        }

        if(isset($_POST['business_address'])){
            $customer_data['business_address'] = $_POST['business_address'];
        }
        else{
            $customer_data['business_address'] = '';
        }

        if(isset($_POST['business_city'])){
            $customer_data['business_city'] = $_POST['business_city'];
        }
        else{
            $customer_data['business_city'] = '';
        }

        if(isset($_POST['business_state'])){
            $customer_data['business_state'] = $_POST['business_state'];
        }
        else{
            $customer_data['business_state'] = '';
        }

        if(isset($_POST['business_zip'])){
            $customer_data['business_zip'] = $_POST['business_zip'];
        }
        else{
            $customer_data['business_zip'] = '';
        }

        if(isset($_POST['business_phone'])){
            $customer_data['business_phone'] = $_POST['business_phone'];
        }
        else{
            $customer_data['business_phone'] = '';
        }

        if(isset($_POST['business_email'])){
            $customer_data['business_email'] = $_POST['business_email'];
        }
        else{
            $customer_data['business_email'] = '';
        }

        if(isset($_POST['website'])){
            $customer_data['website'] = $_POST['website'];
        }
        else{
            $customer_data['website'] = '';
        }

        if(isset($_POST['contact_name'])){
            $customer_data['contact_name'] = $_POST['contact_name'];
        }
        else{
            $customer_data['contact_name'] = '';
        }

        if(isset($_POST['contact_email'])){
            $customer_data['contact_email'] = $_POST['contact_email'];
        }
        else{
            $customer_data['contact_email'] = '';
        }

        if(isset($_POST['contact_phone'])){
            $customer_data['contact_phone'] = $_POST['contact_phone'];
        }
        else{
            $customer_data['contact_phone'] = '';
        }

        if(isset($_POST['start_date'])){
            $customer_data['start_date'] = $_POST['start_date'];
        }
        else{
            $customer_data['start_date'] = '';
        }

        if(isset($_POST['end_date'])){
            $customer_data['end_date'] = $_POST['end_date'];
        }
        else{
            $customer_data['end_date'] = '';
        }
        
        if(isset($_POST['url_tag'])){
            $customer_data['url_tag'] = $_POST['url_tag'];
        }
        else{
            $customer_data['url_tag'] = '';
        }

        if(isset($_POST['max_documents_count'])){
            $customer_data['max_docs_number'] = $_POST['max_documents_count'];
        }
        else{
            $customer_data['max_docs_number'] = '';
        }

        $this->Customers->add($customer_data);
    }

    public function customerUpdate(){

        // uploading doc files
        $customer_data = array();
        $doc_files = array();
        
        if(isset($_POST['docs_count'])){
            $docs_count = (int)$_POST['docs_count'];
            
            for($doc_index = 0; $doc_index < $docs_count; $doc_index++){
                if(isset($_FILES['doc_file_'.$doc_index]) && $_FILES['doc_file_'.$doc_index]['name'] != ''){
                    //upload identification image
                    $date = new DateTime();
                    $doc_path = 'uploads/documents/' . $date->getTimestamp().".".pathinfo($_FILES['doc_file_'.$doc_index]['name'], PATHINFO_EXTENSION);
                    
                    move_uploaded_file($_FILES['doc_file_'.$doc_index]['tmp_name'], $doc_path);

                    $doc_path = base_url($doc_path);
                    $file_name = $_FILES['doc_file_'.$doc_index]['name'];
                }
                else{
                    $doc_path = '';
                    $file_name = '';
                }

                if(isset($_POST['doc_file_label_'.$doc_index])){
                    $doc_file_label = $_POST['doc_file_label_'.$doc_index];
                }
                else{
                    $doc_file_label = '';
                }

                $doc_files[] = array(
                    'path' => $doc_path,
                    'label' => $doc_file_label,
                    'file_name' => $file_name
                );
            }
            
        }

        if(isset($_POST['saved_docs']) && $_POST['saved_docs']){
            $saved_docs = json_decode($_POST['saved_docs'], true);
            $doc_files = array_merge($saved_docs, $doc_files);
        }

        $customer_data['documents'] = json_encode($doc_files);
        
        // uploading logo file
        if(isset($_POST['logo_file_changed']) && $_POST['logo_file_changed'] == 1){
            if(isset($_FILES['logo_file']) && $_FILES['logo_file']['name'] != ''){
                //upload identification image
                $date = new DateTime();
                $logo_path = 'uploads/logos/' . $date->getTimestamp().".".pathinfo($_FILES['logo_file']['name'], PATHINFO_EXTENSION);
                
                move_uploaded_file($_FILES['logo_file']['tmp_name'], $logo_path);
    
                $logo_path = base_url($logo_path);
    
                $customer_data['logo'] = $logo_path;
            }
            else{
                $customer_data['logo'] = '';
            }
        }

        if(isset($_POST['business_name'])){
            $customer_data['business_name'] = $_POST['business_name'];
        }
        else{
            $customer_data['business_name'] = '';
        }

        if(isset($_POST['business_address'])){
            $customer_data['business_address'] = $_POST['business_address'];
        }
        else{
            $customer_data['business_address'] = '';
        }

        if(isset($_POST['business_city'])){
            $customer_data['business_city'] = $_POST['business_city'];
        }
        else{
            $customer_data['business_city'] = '';
        }

        if(isset($_POST['business_state'])){
            $customer_data['business_state'] = $_POST['business_state'];
        }
        else{
            $customer_data['business_state'] = '';
        }

        if(isset($_POST['business_zip'])){
            $customer_data['business_zip'] = $_POST['business_zip'];
        }
        else{
            $customer_data['business_zip'] = '';
        }

        if(isset($_POST['business_phone'])){
            $customer_data['business_phone'] = $_POST['business_phone'];
        }
        else{
            $customer_data['business_phone'] = '';
        }

        if(isset($_POST['business_email'])){
            $customer_data['business_email'] = $_POST['business_email'];
        }
        else{
            $customer_data['business_email'] = '';
        }

        if(isset($_POST['website'])){
            $customer_data['website'] = $_POST['website'];
        }
        else{
            $customer_data['website'] = '';
        }

        if(isset($_POST['contact_name'])){
            $customer_data['contact_name'] = $_POST['contact_name'];
        }
        else{
            $customer_data['contact_name'] = '';
        }

        if(isset($_POST['contact_email'])){
            $customer_data['contact_email'] = $_POST['contact_email'];
        }
        else{
            $customer_data['contact_email'] = '';
        }

        if(isset($_POST['contact_phone'])){
            $customer_data['contact_phone'] = $_POST['contact_phone'];
        }
        else{
            $customer_data['contact_phone'] = '';
        }

        if(isset($_POST['start_date'])){
            $customer_data['start_date'] = $_POST['start_date'];
        }
        else{
            $customer_data['start_date'] = '';
        }

        if(isset($_POST['end_date'])){
            $customer_data['end_date'] = $_POST['end_date'];
        }
        else{
            $customer_data['end_date'] = '';
        }
        
        if(isset($_POST['url_tag'])){
            $customer_data['url_tag'] = $_POST['url_tag'];
        }
        else{
            $customer_data['url_tag'] = '';
        }

        if(isset($_POST['max_documents_count'])){
            $customer_data['max_docs_number'] = $_POST['max_documents_count'];
        }
        else{
            $customer_data['max_docs_number'] = '';
        }

        if(isset($_POST['customer_id'])){
            $this->Customers->update($_POST['customer_id'], $customer_data);
        }
        
    }

    public function checkURLTag(){
        if(isset($_POST['url_tag'])){
            $results = $this->Customers->checkURLTag($_POST['url_tag']);
            if(count($results) > 0){
                echo json_encode(array(
                    'exist' => true,
                    'success' => true
                ));
            }
            else{
                echo json_encode(array(
                    'exist' => false,
                    'success' => true
                ));
            }
        }
        else{
            echo json_encode(array(
                'exist' => false,
                'success' => false
            ));
        }
    }

    public function customerDelete(){
        if(isset($_POST['customer_id'])){
            $this->Customers->deleteByID($_POST['customer_id']);
        }
    }
}
