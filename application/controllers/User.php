<?php

defined("BASEPATH") or exit("No Direct Scripts Allowed");

class User extends CI_Controller
{
	public $timestamp;
	public $times;

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Kolkata");
		$this->timestamp = date("d-m-Y");
		$this->times = date("h:i:sa");


		$Delivery_Boy_ID = $this->session->userdata("Delivery_Boy");
		if (empty($Delivery_Boy_ID)) {
			$this->session->set_flashdata("res", "error");
			$this->session->set_flashdata("msg", "Please login first !");
			redirect(base_url("Auth/DeliveryBoylogin"));
		}
	}

	public function index()
	{

		$this->load->view("User/index");
	}

	public function receive_booking()
	{
		$Delivery_BoyID = $this->session->userdata("Delivery_Boy");

		// $query = $this->db->order_by("id", "DESC")->where('delivery_boy_id', $Delivery_BoyID)->get('booking');
		$query = $this->db->query("SELECT * FROM `booking` WHERE delivery_boy_id='$Delivery_BoyID' AND order_status!='Delivered' ORDER BY id DESC");
		$data["booking"] = $query->result();
		$this->load->view("User/receive_booking", $data);
	}

	public function change_password()
	{
		$this->load->view("User/change-password");
	}

	public function ChangePasswordAction()
	{
		$opass = $this->input->post('opass');
		$npass = $this->input->post('npass');
		$cpass = $this->input->post('cpass');

		$Delivery_BoyID = $this->session->userdata("Delivery_Boy");
		$result = $this->db->where('id', $Delivery_BoyID)->get('delivery_boy');
		$values = $result->row();
		if ($values->password == $opass) {
			if ($npass == $cpass) {
				$result = $this->db->where('id', $Delivery_BoyID)->update('delivery_boy', ['password' => $npass]);
				if ($result) {
					$this->session->set_flashdata("msg", "Password Changed Successfully");
					$this->session->set_flashdata("res", "success");
					redirect(base_url("User/change_password"));
				} else {
					$this->session->set_flashdata("msg", "Failed !");
					$this->session->set_flashdata("res", "error");
					redirect(base_url("User/change_password"));
				}
			} else {

				$this->session->set_flashdata("msg", "New And Confirm Password Not Matched !");
				$this->session->set_flashdata("res", "error");
				redirect(base_url("User/change_password"));
			}
		} else {
			$this->session->set_flashdata("msg", "Invalid Old Password !");
			$this->session->set_flashdata("res", "error");
			redirect(base_url("User/change_password"));
		}
	}


	public function booking_history()
	{
		$Delivery_BoyID = $this->session->userdata("Delivery_Boy");

		$query = $this->db->order_by("id", "DESC")->where('order_status', 'Delivered')->where('delivery_boy_id', $Delivery_BoyID)->get('booking');
		$data["booking"] = $query->result();
		$this->load->view("User/booking_history", $data);
	}


	public function ChangeOrderStatus()
	{
		$id = $this->input->post('id');
		$value = $this->input->post('value');
		$delivery_proof = NULL;

		if ($value == 'Delivered') {
			if (!empty($_FILES['proof_image']['name'])) {
				$config['upload_path'] = './assets/admin_assets/images/proof/';
				$config['allowed_types'] = 'jpg|jpeg|png|webp';
				$config['max_size'] = 2048; // 2MB
				$config['file_name'] = 'proof_' . $id . '_' . time();

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('proof_image')) {
					$uploadData = $this->upload->data();
					$delivery_proof = $uploadData['file_name'];
				} else {
					echo stripslashes($this->upload->display_errors('', ''));
					return;
				}
			} else {
				echo "Delivery proof image is required.";
				return;
			}
		}

		$updateData = ['order_status' => $value];
		if ($delivery_proof) {
			$updateData['delivery_proof'] = $delivery_proof;
		}

		$result = $this->db->where('id', $id)->update('booking', $updateData);
		if ($result) {
			$msg = "Order status updated to: " . $value;
			$insertData = [
				'booking_id' => $id,
				'order_status' => $value,
				'msg' => $msg,
				"date" => date("d-m-Y"),
				"time" => date("h:i:sa")
			];

			$this->db->insert('track_order', $insertData);
			echo true;
		} else {
			echo false;
		}
	}


	public function LogOut()
	{
		$Delivery_BoyID = $this->session->userdata("Delivery_Boy");
		$this->session->sess_destroy();

		$this->session->set_flashdata("msg", "Log Out Successfully");
		$this->session->set_flashdata("res", "success");
		redirect(base_url("Auth/DeliveryBoylogin"));
	}
}