<?php

defined("BASEPATH") or exit("No Direct Scripts Allowed");

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Kolkata");
		$this->timestamp = date("d-m-Y");
		$this->times = date("h:i:sa");
	}

	public function Test()
	{

		// $query=$this->db->query("SELECT * FROM `adminlogin` ORDER BY id DESC")->result();
		// $query=$this->db->query("SELECT * FROM `transaction` ORDER BY id DESC")->result();
		// $query=$this->db->query("SELECT * FROM `booking` ORDER BY id DESC")->result();
		// $query=$this->db->query("SELECT * FROM `delivery_boy` ORDER BY id DESC")->result();
		// $query=$this->db->query("SELECT * FROM `logindetails` ORDER BY id DESC")->result();
		// $query=$this->db->query("SELECT * FROM `price` ORDER BY id DESC")->result();
		$query = $this->db->query("SELECT * FROM `registration` ORDER BY id DESC")->result();
		//$query=$this->db->query("SELECT * FROM `track_order` ORDER BY id DESC")->result();

		// $query=$this->db->query("ALTER TABLE `transaction` ADD `reciept` VARCHAR(100) NOT NULL AFTER `payment_utr`;");

		// var_dump($query);
		// die();

		echo "<pre>";
		print_r($query);
		echo "<pre>";
	}



	public function Adminlogin()
	{
		$this->load->view("Auth/AdminLogin");
	}

	public function AdminAuthentication()
	{
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$query2 = $this->db->where('AdminEmail', $email)->get('adminlogin');

		if ($query2->num_rows()) {
			$value = $query2->row();
			$password1 = $value->AdminPassword;
			$CurrentStatus = $value->CurrentStatus;

			if ($password == $password1) {
				// if($CurrentStatus=='false')
				// {

				// Admin Session Hold Here
				$this->session->set_userdata('Admin', $email);

				// Here Create Login History Code Start
				$this->load->library('Activities');
				$activitiesData = [
					'LoginID' => $value->AdminLoginID,
					'IP' => $this->activities->get_ip(),
					'MAC' => $this->activities->get_mac(),
					'UserName' => $this->activities->get_username(),
					'BrowserName' => $this->activities->get_useragent(),
					'OSName' => $this->activities->get_os(),
					'Date' => $this->timestamp,
					'Time' => $this->times
				];

				$this->db->insert('logindetails', $activitiesData);

				$updateData = [
					'LastLoginDate' => $this->timestamp,
					'LastLoginTime' => $this->times,
					'CurrentStatus ' => 'true'
				];

				$result = $this->db->where('AdminEmail', $email)->update('adminlogin', $updateData);

				$this->session->set_flashdata("msg", "Login Successfully");
				$this->session->set_flashdata("res", "success");
				redirect(base_url("Admin"));

				// }
				// else
				// {
				// $this->session->set_flashdata("msg","Account Blocked !");
				// $this->session->set_flashdata("res","error");
				// redirect(base_url("Auth/Adminlogin"));
				// }
			} else {
				$this->session->set_flashdata("msg", "Invalid Password !");
				$this->session->set_flashdata("res", "error");
				redirect(base_url("Auth/Adminlogin"));
			}
		} else {
			$this->session->set_flashdata("msg", "Invalid Email ID !");
			$this->session->set_flashdata("res", "error");
			redirect(base_url("Auth/Adminlogin"));
		}
	}


	public function DeliveryBoylogin()
	{
		$this->load->view("Auth/DeliveryBoylogin");
	}


	public function DeliveryBoyAuthentication()
	{
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$query2 = $this->db->where('email', $email)->get('delivery_boy');

		if ($query2->num_rows()) {
			$value = $query2->row();
			$Delivery_Boy = $value->id;
			$password1 = $value->password;
			$CurrentStatus = $value->status;

			if ($password == $password1) {
				if ($CurrentStatus == 'true') {
					// Delivery Boy Session Hold Here
					$this->session->set_userdata('Delivery_Boy', $Delivery_Boy);

					$this->session->set_flashdata("msg", "Login Successfully");
					$this->session->set_flashdata("res", "success");
					redirect(base_url("User"));
				} else {
					$this->session->set_flashdata("msg", "Account Blocked !");
					$this->session->set_flashdata("res", "error");
					redirect(base_url("Auth/DeliveryBoylogin"));
				}
			} else {
				$this->session->set_flashdata("msg", "Invalid Password !");
				$this->session->set_flashdata("res", "error");
				redirect(base_url("Auth/DeliveryBoylogin"));
			}
		} else {
			$this->session->set_flashdata("msg", "Invalid Email ID !");
			$this->session->set_flashdata("res", "error");
			redirect(base_url("Auth/DeliveryBoylogin"));
		}
	}

	public function Managerlogin()
	{
		$this->load->view("Auth/ManagerLogin");
	}

	public function ManagerAuthentication()
	{
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$query2 = $this->db->where('email', $email)->get('managers');

		if ($query2->num_rows()) {
			$value = $query2->row();
			$ManagerID = $value->id;
			$password1 = $value->password;
			$CurrentStatus = $value->status;

			if ($password == $password1) {
				if ($CurrentStatus == 'true') {
					// Manager Session Hold Here
					$this->session->set_userdata('Manager', $ManagerID);
					$this->session->set_userdata('ManagerEmail', $value->email);
					$this->session->set_userdata('ManagerName', $value->name);

					$this->session->set_flashdata("msg", "Login Successfully");
					$this->session->set_flashdata("res", "success");
					redirect(base_url("Manager"));
				} else {
					$this->session->set_flashdata("msg", "Account Blocked !");
					$this->session->set_flashdata("res", "error");
					redirect(base_url("Auth/Managerlogin"));
				}
			} else {
				$this->session->set_flashdata("msg", "Invalid Password !");
				$this->session->set_flashdata("res", "error");
				redirect(base_url("Auth/Managerlogin"));
			}
		} else {
			$this->session->set_flashdata("msg", "Invalid Email ID !");
			$this->session->set_flashdata("res", "error");
			redirect(base_url("Auth/Managerlogin"));
		}
	}
}