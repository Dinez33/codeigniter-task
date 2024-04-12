<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once  APPPATH.'/libraries/dompdf/autoload.inc.php';
require_once  APPPATH.'/libraries/PHPWord/src/PhpWord/Autoloader.php';

use PhpOffice\PhpWord\Autoloader as Autoloader;
Autoloader::register();

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Dompdf\Dompdf;

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->helper('url', 'form','string','text');
        $this->load->library('form_validation');
        $this->load->library('session');
		
    } 

	public function index()
	{
		$this->load->view('login');
	}
	public function signin()
	{
		$this->load->view('register');
	}

	public function login_process()
	{
   		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$username=$this->input->post('username');
		    $password=md5($this->input->post('password'));
		   	$userdata = array('username' =>$username ,'password'=>$password);
            $user_list=$this->user_model->get_users($username,$password);
   
            if(count($user_list) == 1)
            {
                $_SESSION['username']=$userdata['username'];
				$data = $this->user_model->get_users_role($username,$password);
				$_SESSION['user_role'] = $data['user_role'];
				$_SESSION['user_id'] = $data['id'];
				// print_r($_SESSION['user_id']);
				// exit();
				if($_SESSION['user_role']==1){
					redirect('admin/Questions','refresh');
				}else{
					redirect('admin/userdash','refresh');
				}
            }
            else
			{
				echo "<script>alert('Something Went Wrong!');window.location.href='" . base_url() . "admin';</script>";
             	redirect('admin','refresh');
            }
		}
		else
		{ 
			echo "<script>alert('Something Went Wrong!');window.location.href='" . base_url() . "admin';</script>";
            redirect('admin','refresh');
    	}
	}

	public function logout()
	{
    	session_unset();
    	session_destroy();
    	redirect('admin','refresh');
    }

	public function dash()
	{
        $this->load->view('inc/header');
        $this->load->view('dash');
        $this->load->view('inc/footer');	
	}

	public function userdash()
	{
		$data['Questions'] = $this->user_model->get_Questions();
        $this->load->view('inc/header');
        $this->load->view('user_dash',$data);
        $this->load->view('inc/footer');	
	}
	function get_question_data()
	{
		$arrData = array();
		$question = $this->input->post('question', TRUE);
		$question_type = $this->input->post('question_type', TRUE);
		$qid = uniqid();

		$count = count($question);
		// var_dump($question_type);
		// exit();

		for($i=0;$i<$count;$i++)
		{
			$arrItemData = array();
			$arrItemData['question'] = $question[$i];
			$arrItemData['question_type'] = $question_type[$i];
			$arrItemData['qid'] = $qid ;

			$arrData[] = $arrItemData;
		}
		// var_dump($arrData);
		// exit();
		return $arrData;
	}
	public function add_question()
	{
		$arrData = $this->get_question_data();
		
		foreach($arrData as $arItemData)
		{
			$this->db->insert('question' , $arItemData);
			// $this->user_model->insert_question('question',$arItemData);
		}
		echo "<script>alert('Question Saved!');window.location.href='" . base_url() . "admin/dash';</script>";
        redirect('admin/dash','refresh');
	}

	public function sign_process()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if($this->input->post('password') === $this->input->post('confirm_password')){
				$name=$this->input->post('username');
				$pass=md5($this->input->post('password'));
				$user_role = 2;

				$userdata = array('username' =>$name,'password'=>$pass,'user_role'=>$user_role );
				
				$this->user_model->insert_user($userdata);
				redirect('admin','refresh');
			}else{
				echo "<script>alert('Please enter same password');window.location.href='" . base_url() . "admin';</script>";
			}
		}
		else{
			echo "<script>alert('Something Went Wrong!');window.location.href='" . base_url() . "admin';</script>";
			redirect('admin','refresh');
		}
	}

	public function Questions()
	{
		$data['Questions'] = $this->user_model->get_Questions();
        $this->load->view('inc/header');
        $this->load->view('question',$data);
        $this->load->view('inc/footer');	   
	}
	public function UserAnswers()
	{
		$data['Answers'] = $this->user_model->get_User_Answers();
        $this->load->view('inc/header');
        $this->load->view('user_ans',$data);
        $this->load->view('inc/footer');	   
	}
	public function delete_questions(){
		$id = $this->input->post('id');
		$this->user_model->delete_question($id);

		echo "<script>alert('You Have Successfully deleted this Record!');window.location.href='" . base_url() . "admin/Questions';</script>";
		redirect('admin/Questions','refresh');
	}
	public function update_questions(){
		$id = $this->input->post('id');
		$this->user_model->update_question($id);

		echo "<script>alert('You Have Successfully updated this Record!');window.location.href='" . base_url() . "admin/Questions';</script>";
		redirect('admin/Questions','refresh');
	}
	
	function upload_file(){
		$ori_filename = $_FILES['files']['name'];
		// $string_version = implode(',', $ori_filename);
		$new_name = time()."".str_replace("","-",$ori_filename);
		$file = $_FILES["files"]["name"];
		$file_ext = pathinfo($file , PATHINFO_EXTENSION);
		// var_dump($file_ext);
		// exit();
		if($file_ext == 'pdf'){
			$config['upload_path'] = './uploads/pdf';
		}else{
			$config['upload_path'] = './uploads/';
		}		
		$config['allowed_types'] = 'docx|pdf|doc';
		$config['file_name'] = $new_name;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if(!$this->upload->do_upload('files'))
		{
		 $error =$this->upload->display_errors();
		 echo "<script>alert($error);window.location.href='" . base_url() . "admin/userdash';</script>";
		 redirect('admin/userdash','refresh');
		}
		else
		{
			if($file_ext == 'pdf'){
				$updated_filename = base_url('uploads/pdf/').$this->upload->data('file_name');
			// 	var_dump($updated_filename);
			// exit();
				return $updated_filename;
			}else{
				$filename = $this->upload->data('file_name');
				Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
				Settings::setPdfRendererPath('./uploads/');
				$phpWord = IOFactory::load('./uploads/'.$filename, 'Word2007');
				//Load temp file
				$phpWord = \PhpOffice\PhpWord\IOFactory::load('./uploads/'.$filename); 
				$name =uniqid(null, true);
				//Save it
				$pdf = $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
				$pdf1 = $xmlWriter->save('./uploads/pdf/'.$name.'.pdf');
				$updated_filename = base_url('uploads/pdf/').$name.'.pdf';
				return $updated_filename;
			}
		 
		}		
	}


	function answer_question()
	{
		$arrData = array();
		$question = $this->input->post('question', TRUE);
		$question_file = $this->input->post('question_file', TRUE);
		$answer_type = $this->input->post('answer_type', TRUE);
		$question_type = $this->input->post('question_type', TRUE);
		$count = count($question);
	
		for($i=0;$i<$count;$i++)
		{
			$arrItemData = array();
			$arrItemData['question'] = $question[$i];
			$arrItemData['answer'] = $answer_type[$i];
			// $arrItemData['answer_type'] = $question_type[$i];
			$arrItemData['user_id'] = $_SESSION['user_id'];
			$arrData[] = $arrItemData;	
		}
		foreach($arrData as $arItemData)
		{
			$this->db->insert('answer' , $arItemData);
		}
		$file_count = count($_FILES['file']['name']);
		// var_dump($file_count);
		// exit();
		if($_FILES['file']['size'] != 0 && $file_count > 0) {
				
			for($i=0;$i<$file_count;$i++){
				$arrfileData = array();
				$_FILES['files']['name'] = $_FILES['file']['name'][$i];
				$_FILES['files']['type'] = $_FILES['file']['type'][$i];
				$_FILES['files']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
				$_FILES['files']['error'] = $_FILES['file']['error'][$i];
				$_FILES['files']['size'] = $_FILES['file']['size'][$i];

				$fileData = $this->upload_file('files');
				$arrfileData['question'] = $question_file[$i];
				$arrfileData['answer_type'] = 'file';
				$arrfileData['answer'] = $fileData;
				$arrfileData['user_id'] = $_SESSION['user_id'];
				$arrfile[] = $arrfileData;
			}	
			foreach($arrfile as $arrfileData)
			{
				$this->db->insert('answer' , $arrfileData);
			}
		}

		
		echo "<script>alert('Answer Saved!');window.location.href='" . base_url() . "admin/UserAnswers';</script>";
        redirect('admin/UserAnswers','refresh');
	}
}
