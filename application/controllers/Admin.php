<?php

defined("BASEPATH") or exit("No Direct Scripts Allowed");

class Admin extends CI_Controller
{
	public $timestamp;
	public $times;

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Kolkata");
		$this->timestamp = date("d-m-Y");
		$this->times = date("h:i:sa");

		$AdminEmail = $this->session->userdata("Admin");
		if (empty($AdminEmail)) {
			$this->session->set_flashdata("res", "error");
			$this->session->set_flashdata("msg", "Please login first !");
			redirect(base_url("Auth/Adminlogin"));
		}
	}

	public function index()
	{
		$code = $this->session->userdata("Admin");
		$this->load->view("Admin/index");
	}

	public function LogOut()
	{
		$email = $this->session->userdata("Admin");
		$updateData = [
			'LastLogoutDate' => $this->timestamp,
			'LastLogoutTime' => $this->times,
			'CurrentStatus ' => 'false'
		];

		$result = $this->db->where('AdminEmail', $email)->update('adminlogin', $updateData);

		$this->session->sess_destroy();

		$this->session->set_flashdata("msg", "Log Out Successfully");
		$this->session->set_flashdata("res", "success");
		redirect(base_url("Auth/Adminlogin"));
	}

	public function export_bookings()
	{
		$bookings = $this->db->order_by("id", "DESC")->get('booking')->result();

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=Admin_Bookings_Export_' . date('d-m-Y_H-i') . '.csv');

		$output = fopen('php://output', 'w');

		// CSV Headers
		fputcsv($output, [
			'S.No',
			'Booking ID',
			'Delivery Boy',
			'Status',
			'Amount',
			'Sender Name',
			'Sender Address',
			'Sender Pincode',
			'Sender Mobile',
			'Receiver Name',
			'Receiver Address',
			'Receiver Pincode',
			'Receiver Mobile',
			'Date',
			'Weight',
			'Dimensions (LxWxH)',
			'Contents'
		]);

		$sr = 1;
		foreach ($bookings as $item) {
			$delivery_boy_name = 'N/A';
			if (!empty($item->delivery_boy_id)) {
				$dboy = $this->db->where('id', $item->delivery_boy_id)->get('delivery_boy')->row();
				$delivery_boy_name = $dboy ? $dboy->name : 'Unknown';
			}

			fputcsv($output, [
				$sr++,
				$item->id,
				$delivery_boy_name,
				$item->order_status,
				$item->amount,
				$item->sender,
				$item->sender_address,
				$item->sender_pincode,
				$item->sender_mobile,
				$item->receiver,
				$item->receiver_address,
				$item->receiver_pincode,
				$item->receiver_mobile,
				$item->date,
				$item->weight,
				$item->length . 'x' . $item->width . 'x' . $item->height,
				$item->package_contents
			]);
		}
		fclose($output);
		exit;
	}

	public function ManageUser()
	{
		if ($this->uri->segment(3) == TRUE) {
			$action = $this->uri->segment(3);
			if ($this->uri->segment(4) == TRUE) {
				$id = $this->uri->segment(4);
				$query = $this->db->where('id', $id)->get('registration');
				if ($query->num_rows()) {
					$data["list"] = $query->result();
					if ($action == 'Edit') {

						$data["action"] = "EditUser";
						$this->load->view('Admin/UpdateData', $data);
					} else {
						redirect(base_url('Admin/ManageUser'));
					}
				} else {
					redirect(base_url('Admin/ManageUser'));
				}
			} else {
				if ($action == 'Add') {
				} else if ($action == 'Update') {
					if (!empty($this->input->post())) {
						if (empty($this->input->post("id"))) {
							$this->session->set_flashdata("msg", "ID is required !");
							$this->session->set_flashdata("res", "error");
							redirect(base_url('Admin/ManageUser'));
						} else {
							$query = $this->db->where('id', $this->input->post("id"))->get('registration');
							if ($query->num_rows()) {
								$data['list'] = $query->result();

								$updateData = [
									'name' => $this->input->post('name'),
									'email' => $this->input->post('email'),
									'mobile' => $this->input->post('mobile'),
									'password' => $this->input->post('password'),
									'wallet' => $this->input->post('wallet')
								];
								$result = $this->db->where('id', $data['list'][0]->id)->update('registration', $updateData);
								if ($result) {
									$this->session->set_flashdata("msg", "User Data Updated Successfully");
									$this->session->set_flashdata("res", "success");
									redirect(base_url('Admin/ManageUser'));
								} else {
									$this->session->set_flashdata("msg", "Failed to update user!");
									$this->session->set_flashdata("res", "error");
									redirect(base_url('Admin/ManageUser'));
								}
							}
						}
					}
				} else {
					redirect(base_url('Admin/ManageUser'));
				}
			}
		} else {
			$this->db->select('registration.*, (SELECT MAX(STR_TO_DATE(date, "%d-%m-%Y")) FROM booking WHERE booking.user_id = registration.id) as last_booking_date');
			$this->db->from('registration');
			$this->db->order_by("registration.id", "DESC");
			$query = $this->db->get();
			$data["User"] = $query->result();
			$this->load->view("Admin/manage-user", $data);
		}
	}


	///////////////////// setdelivery///////////////////////


	public function setdelivery()
	{
		$this->load->view('Admin/setdelivery'); // sirf view load hoga
	}

	public function insertDelivery()
	{
		$data = [
			'standard_price' => $this->input->post('standard_price'),
			'express_price' => $this->input->post('express_price'),
			'overnight_price' => $this->input->post('overnight_price')
		];

		$this->db->insert('tbl_delivery_options', $data);

		$this->session->set_flashdata('success', 'Delivery prices inserted successfully!');
		redirect('Admin/setdelivery');
	}

	public function ManageBooking()
	{
		if ($this->uri->segment(3) == TRUE) {
			$action = $this->uri->segment(3);
			if ($this->uri->segment(4) == TRUE) {
				$id = $this->uri->segment(4);
				$query = $this->db->where('id', $id)->get('booking');
				if ($query->num_rows()) {
					$data["list"] = $query->result();
					if ($action == 'Edit') {
						$data["action"] = "AssignDelvieryBoy";
						$this->load->view('Admin/UpdateData', $data);
					} else {
						redirect(base_url('Admin/ManageBooking'));
					}
				} else {
					redirect(base_url('Admin/ManageBooking'));
				}
			} else {
				if ($action == 'Add') {
				} else if ($action == 'Update') {
					if (!empty($this->input->post())) {
						if (empty($this->input->post("id"))) {
							$this->session->set_flashdata("msg", "ID is required !");
							$this->session->set_flashdata("res", "error");
							redirect(base_url('Admin/ManageBooking'));
						} else {
							$query = $this->db->where('id', $this->input->post("id"))->get('booking');
							if ($query->num_rows()) {
								$data['list'] = $query->result();

								$updateData = [
									'delivery_boy_id' => $this->input->post('delivery_boy')
								];
								$result = $this->db->where('id', $data['list'][0]->id)->update('booking', $updateData);
								if ($result) {
									// Log Assignment in Tracking
									$dboy = $this->db->where('id', $this->input->post('delivery_boy'))->get('delivery_boy')->row();
									$this->db->insert('track_order', [
										'booking_id' => $data['list'][0]->id,
										'order_status' => "Assigned",
										'msg' => "Shipment assigned to delivery boy: " . ($dboy ? $dboy->name : 'Unknown'),
										"date" => date("d-m-Y"),
										"time" => date("h:i:sa")
									]);

									$this->session->set_flashdata("msg", "Delviery Boy Assigned Successfully");
									$this->session->set_flashdata("res", "success");
									redirect(base_url('Admin/ManageBooking'));
								} else {

									$this->session->set_flashdata("msg", "Something went wrong in Data Shaving !");
									$this->session->set_flashdata("res", "error");
									redirect(base_url('Admin/ManageBooking'));
								}
							}
						}
					}
				} else {
					redirect(base_url('Admin/ManageBooking'));
				}
			}
		} else {
			$query = $this->db->order_by("id", "DESC")->get('booking');
			$data["booking"] = $query->result();
			$this->load->view("Admin/all_booking", $data);
		}
	}

	public function ManageDeliveryBoy()
	{

		if ($this->uri->segment(3) == TRUE) {
			$action = $this->uri->segment(3);
			if ($this->uri->segment(4) == TRUE) {
				$id = $this->uri->segment(4);
				$query = $this->db->where('id', $id)->get('delivery_boy');
				if ($query->num_rows()) {
					$data["list"] = $query->result();
					if ($action == 'Edit') {
						$data["action"] = "EditDeliveryBoy";
						$this->load->view('Admin/UpdateData', $data);
					} else {
						redirect(base_url('Admin/ManageDeliveryBoy'));
					}
				} else {
					redirect(base_url('Admin/ManageDeliveryBoy'));
				}
			} else {
				if ($action == 'Add') {
					if (!empty($this->input->post())) {
						$insertData = [
							'name' => $this->input->post('name'),
							'mobile' => $this->input->post('mobile'),
							'password' => $this->input->post('password'),
							'email' => $this->input->post('email'),
							'aadharno' => $this->input->post('aadhar'),
							'address' => $this->input->post('address'),
							'status' => 'true',
							"date" => $this->timestamp,
							"time" => $this->times
						];

						if ($this->db->insert('delivery_boy', $insertData)) {
							$this->session->set_flashdata("msg", "Data Added Successfully");
							$this->session->set_flashdata("res", "success");
							redirect(base_url('Admin/ManageDeliveryBoy'));
						} else {
							$this->session->set_flashdata("msg", "Something went wrong in Data Shaving !");
							$this->session->set_flashdata("res", "error");
							redirect(base_url('Admin/ManageDeliveryBoy'));
						}
					}
				} else if ($action == 'Update') {
					if (!empty($this->input->post())) {
						if (empty($this->input->post("id"))) {
							$this->session->set_flashdata("msg", "ID is required !");
							$this->session->set_flashdata("res", "error");
							redirect(base_url('Admin/ManageDeliveryBoy'));
						} else {
							$query = $this->db->where('id', $this->input->post("id"))->get('delivery_boy');
							if ($query->num_rows()) {
								$data['list'] = $query->result();

								$updateData = [
									'name' => $this->input->post('name'),
									'mobile' => $this->input->post('mobile'),
									'password' => $this->input->post('password'),
									'email' => $this->input->post('email'),
									'aadharno' => $this->input->post('aadhar'),
									'address' => $this->input->post('address'),
									"date" => $this->timestamp,
									"time" => $this->times
								];
								$result = $this->db->where('id', $data['list'][0]->id)->update('delivery_boy', $updateData);
								if ($result) {
									$this->session->set_flashdata("msg", "Data Updated Successfully");
									$this->session->set_flashdata("res", "success");
									redirect(base_url('Admin/ManageDeliveryBoy'));
								} else {

									$this->session->set_flashdata("msg", "Something went wrong in Data Shaving !");
									$this->session->set_flashdata("res", "error");
									redirect(base_url('Admin/ManageDeliveryBoy'));
								}
							}
						}
					}
				} else {
					redirect(base_url('Admin/ManageDeliveryBoy'));
				}
			}
		} else {
			$query = $this->db->order_by("id", "DESC")->get('delivery_boy');
			$data["list"] = $query->result();
			$this->load->view('Admin/ManageDeliveryBoy', $data);
		}
	}

	public function change_password()
	{
		$this->load->view("Admin/change-password");
	}

	public function ChangePasswordAction()
	{
		$opass = $this->input->post('opass');
		$npass = $this->input->post('npass');
		$cpass = $this->input->post('cpass');

		$AdminEmail = $this->session->userdata("Admin");
		$result = $this->db->where('AdminEmail', $AdminEmail)->get('adminlogin');
		$values = $result->row();
		if ($values->AdminPassword == $opass) {
			if ($npass == $cpass) {
				$result = $this->db->where('AdminEmail', $AdminEmail)->update('adminlogin', ['AdminPassword' => $npass]);
				if ($result) {
					$this->session->set_flashdata("msg", "Password Changed Successfully");
					$this->session->set_flashdata("res", "success");
					redirect(base_url("Admin/change_password"));
				} else {
					$this->session->set_flashdata("msg", "Failed !");
					$this->session->set_flashdata("res", "error");
					redirect(base_url("Admin/change_password"));
				}
			} else {

				$this->session->set_flashdata("msg", "New And Confirm Password Not Matched !");
				$this->session->set_flashdata("res", "error");
				redirect(base_url("Admin/change_password"));
			}
		} else {
			$this->session->set_flashdata("msg", "Invalid Old Password !");
			$this->session->set_flashdata("res", "error");
			redirect(base_url("Admin/change_password"));
		}
	}


	public function AddPincode()
	{
		$opass = $this->input->post('opass');
		$npass = $this->input->post('npass');
		$cpass = $this->input->post('cpass');

		$AdminEmail = $this->session->userdata("Admin");
		$result = $this->db->where('AdminEmail', $AdminEmail)->get('adminlogin');
		$values = $result->row();
		if ($values->AdminPassword == $opass) {
			if ($npass == $cpass) {
				$result = $this->db->where('AdminEmail', $AdminEmail)->update('adminlogin', ['AdminPassword' => $npass]);
				if ($result) {
					$this->session->set_flashdata("msg", "Password Changed Successfully");
					$this->session->set_flashdata("res", "success");
					redirect(base_url("Admin/change_password"));
				} else {
					$this->session->set_flashdata("msg", "Failed !");
					$this->session->set_flashdata("res", "error");
					redirect(base_url("Admin/change_password"));
				}
			} else {

				$this->session->set_flashdata("msg", "New And Confirm Password Not Matched !");
				$this->session->set_flashdata("res", "error");
				redirect(base_url("Admin/change_password"));
			}
		} else {
			$this->session->set_flashdata("msg", "Invalid Old Password !");
			$this->session->set_flashdata("res", "error");
			redirect(base_url("Admin/change_password"));
		}
	}


	# User Topup Request    
	public function Accepttopuprequest()
	{
		if ($this->input->post()) {
			$data = $this->input->post();
			$id = $data['id'];
			$value = $data['value'];
			if ($value == 'Accept') {
				$update = $this->db->where('id', $id)->update('transaction', ['status' => 'Accept']);
				$select = $this->db->query("SELECT * FROM `transaction` WHERE id='$id'")->row();
				$user_id = $select->user_id;
				$amount = $select->amount;

				$fetchuser = $this->db->query("SELECT * FROM `registration` WHERE id='$user_id'")->row();
				$wallet = $fetchuser->wallet;

				$totalamount = $wallet + $amount;
				$update = $this->db->where('id', $user_id)->update('registration', ['wallet' => $totalamount]);

				echo true;
			} elseif ($value == 'Reject') {
				$update = $this->db->where('id', $id)->update('transaction', ['status' => 'Reject']);
				echo true;
			}
		} else {
			echo false;
		}
	}


	# Delete   
	public function Deletedata()
	{
		if ($this->input->post()) {
			$data = $this->input->post();
			$table = $data['table'];
			$id = $data['id'];
			$result = $this->db->where('id', $id)->delete($table);
			if ($result) {
				echo true;
			} else {
				echo false;
			}
		} else {
			echo false;
		}
	}

	# Update Status
	public function UpdateStatus()
	{
		if ($this->input->post()) {
			$data = $this->input->post();
			$result = $this->db->where('id', $data['where_value'])->update($data['table'], [$data['column'] => $data['value']]);
			if ($result) {
				if ($data['table'] == 'booking') {
					$this->db->insert('track_order', [
						'booking_id' => $data['where_value'],
						'order_status' => $data['value'],
						'msg' => "Order " . $data['value'] . " by Administrator",
						"date" => date("d-m-Y"),
						"time" => date("h:i:sa")
					]);
				}
				echo true;
			} else {
				echo false;
			}
		} else {
			echo false;
		}
	}

	public function assign_booking()
	{
		$this->load->view("Admin/assign_booking");
	}


	public function ManageWalletTransactions()
	{
		$data["pendingtxndata"] = $this->db->order_by("id", "DESC")->where('status', 'Pending')->get('transaction')->result();
		$data["accepttxndata"] = $this->db->order_by("id", "DESC")->where('status', 'Accept')->get('transaction')->result();
		$data["rejecttxndata"] = $this->db->order_by("id", "DESC")->where('status', 'Reject')->get('transaction')->result();
		$this->load->view("Admin/ManageWalletTransactions", $data);
	}

	public function ManageUserWallets()
	{
		$data["users"] = $this->db->order_by("wallet", "DESC")->get('registration')->result();
		$this->load->view("Admin/ManageUserWallets", $data);
	}


	// Manage Pricing Here
	public function ManagePricing()
	{
		if ($this->uri->segment(3) == TRUE) {
			$action = $this->uri->segment(3);
			if ($this->uri->segment(4) == TRUE && $this->uri->segment(5) == TRUE) {
				$from = $this->uri->segment(4);
				$to = $this->uri->segment(5);
				$query = $this->db->where('from_pin', $from)->where('to_pin', $to)->get('price');
				if ($query->num_rows()) {
					$data["list"] = $query->result();
					$data['from_pin'] = $from;
					$data['to_pin'] = $to;
					if ($action == 'Edit') {
						$data["action"] = "EditPrice";
						$this->load->view('Admin/UpdateData', $data);
					} else {
						redirect(base_url('Admin/ManagePricing'));
					}
				} else {
					redirect(base_url('Admin/ManagePricing'));
				}
			} else {
				if ($action == 'Add') {
					if (!empty($this->input->post())) {
						$from = $this->input->post('from');
						$to = $this->input->post('to');
						$prices = $this->input->post('prices'); // Array of [slot_id => price]

						$success_count = 0;
						if (!empty($prices)) {
							foreach ($prices as $slot_id => $price) {
								if ($price !== "" && $price !== null) {
									$this->db->where('from_pin', $from)->where('to_pin', $to)->where('weight_slot_id', $slot_id)->delete('price');
									$insertData = [
										'price_per_kg' => $price,
										'from_pin' => $from,
										'to_pin' => $to,
										'weight_slot_id' => $slot_id,
										'status' => 'true',
										"date" => $this->timestamp,
										"time" => $this->times
									];
									if ($this->db->insert('price', $insertData)) {
										$success_count++;
									}
								}
							}
						}

						if ($success_count > 0) {
							$this->session->set_flashdata("msg", "$success_count Pricing Routes Added Successfully");
							$this->session->set_flashdata("res", "success");
						} else {
							$this->session->set_flashdata("msg", "No prices were entered!");
							$this->session->set_flashdata("res", "error");
						}
						redirect(base_url('Admin/ManagePricing'));
					}
				} else if ($action == 'Update') {
					if (!empty($this->input->post())) {
						$from = $this->input->post('from');
						$to = $this->input->post('to');
						$old_from = $this->input->post('old_from');
						$old_to = $this->input->post('old_to');
						$prices = $this->input->post('prices');

						if (empty($from) || empty($to)) {
							$this->session->set_flashdata("msg", "Route details are required !");
							$this->session->set_flashdata("res", "error");
							redirect(base_url('Admin/ManagePricing'));
						} else {
							foreach ($prices as $slot_id => $price) {
								$delete_from = $old_from ? $old_from : $from;
								$delete_to = $old_to ? $old_to : $to;
								$this->db->where('from_pin', $delete_from)->where('to_pin', $delete_to)->where('weight_slot_id', $slot_id)->delete('price');
								if ($price !== "" && $price !== null) {
									$updateData = [
										'price_per_kg' => $price,
										'from_pin' => $from,
										'to_pin' => $to,
										'weight_slot_id' => $slot_id,
										'status' => 'true',
										"date" => $this->timestamp,
										"time" => $this->times
									];
									$this->db->insert('price', $updateData);
								}
							}
							$this->session->set_flashdata("msg", "Prices Updated Successfully");
							$this->session->set_flashdata("res", "success");
							redirect(base_url('Admin/ManagePricing'));
						}
					}
				} else {
					redirect(base_url('Admin/ManagePricing'));
				}
			}
		} else {
			$raw_list = $this->db->query("SELECT p.*, w.slot_name, w.min_weight, w.max_weight FROM price p LEFT JOIN weight_slots w ON p.weight_slot_id = w.id ORDER BY p.from_pin ASC")->result();
			$grouped = [];
			foreach ($raw_list as $row) {
				$key = $row->from_pin . '_' . $row->to_pin;
				if (!isset($grouped[$key])) {
					$grouped[$key] = (object) [
						'from_pin' => $row->from_pin,
						'to_pin' => $row->to_pin,
						'slots' => []
					];
				}
				$grouped[$key]->slots[] = $row;
			}
			$data['list'] = $grouped;
			$data['slots'] = $this->db->get('weight_slots')->result();
			$this->load->view('Admin/ManagePricing', $data);
		}
	}


	// Manage Weight Slots Range Here
	public function ManageWeightSlots()
	{
		if ($this->uri->segment(3) == TRUE) {
			$action = $this->uri->segment(3);
			if ($this->uri->segment(4) == TRUE) {
				$id = $this->uri->segment(4);
				$query = $this->db->where('id', $id)->get('weight_slots');
				if ($query->num_rows()) {
					$data["list"] = $query->result();
					if ($action == 'Edit') {
						$data["action"] = "EditWeightSlot";
						$this->load->view('Admin/UpdateData', $data);
					} else {
						redirect(base_url('Admin/ManageWeightSlots'));
					}
				} else {
					redirect(base_url('Admin/ManageWeightSlots'));
				}
			} else {
				if ($action == 'Add') {
					if (!empty($this->input->post())) {
						$insertData = [
							'slot_name' => $this->input->post('slot_name'),
							'min_weight' => $this->input->post('min_weight'),
							'max_weight' => $this->input->post('max_weight'),
						];

						if ($this->db->insert('weight_slots', $insertData)) {
							$this->session->set_flashdata("msg", "Weight Slot Added Successfully");
							$this->session->set_flashdata("res", "success");
							redirect(base_url('Admin/ManageWeightSlots'));
						} else {
							$this->session->set_flashdata("msg", "Something went wrong!");
							$this->session->set_flashdata("res", "error");
							redirect(base_url('Admin/ManageWeightSlots'));
						}
					}
				} else if ($action == 'Update') {
					if (!empty($this->input->post())) {
						if (empty($this->input->post("id"))) {
							$this->session->set_flashdata("msg", "ID is required !");
							$this->session->set_flashdata("res", "error");
							redirect(base_url('Admin/ManageWeightSlots'));
						} else {
							$query = $this->db->where('id', $this->input->post("id"))->get('weight_slots');
							if ($query->num_rows()) {
								$data['list'] = $query->result();

								$updateData = [
									'slot_name' => $this->input->post('slot_name'),
									'min_weight' => $this->input->post('min_weight'),
									'max_weight' => $this->input->post('max_weight'),
								];
								$result = $this->db->where('id', $data['list'][0]->id)->update('weight_slots', $updateData);
								if ($result) {
									$this->session->set_flashdata("msg", "Weight Slot Updated Successfully");
									$this->session->set_flashdata("res", "success");
									redirect(base_url('Admin/ManageWeightSlots'));
								} else {
									$this->session->set_flashdata("msg", "Failed to update!");
									$this->session->set_flashdata("res", "error");
									redirect(base_url('Admin/ManageWeightSlots'));
								}
							}
						}
					}
				} else {
					redirect(base_url('Admin/ManageWeightSlots'));
				}
			}
		} else {
			$data['list'] = $this->db->order_by('id', 'DESC')->get('weight_slots')->result();
			$this->load->view('Admin/ManageWeightSlots', $data);
		}
	}



	// Manage Distance And Price Here
	public function ManageDistance()
	{
		redirect(base_url('Admin/ManagePricing'));
	}

	public function inquiries()
	{
		$data["inquiries"] = $this->db->order_by("id", "DESC")->get('contact_inquiry')->result();
		$this->load->view("Admin/inquiries", $data);
	}

	public function ManageDisputes()
	{
		$data['disputes'] = $this->db->query("SELECT d.*, r.name as user_name, r.email as user_email FROM disputes d JOIN registration r ON d.user_id = r.id ORDER BY d.id DESC")->result();
		$this->load->view("Admin/disputes", $data);
	}

	public function UpdateDisputeStatus()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$admin_remark = $this->input->post('admin_remark');

		$updateData = [
			'status' => $status,
			'admin_remark' => $admin_remark
		];

		$result = $this->db->where('id', $id)->update('disputes', $updateData);
		if ($result) {
			$this->session->set_flashdata("msg", "Dispute " . $status . " successfully");
			$this->session->set_flashdata("res", "success");
		} else {
			$this->session->set_flashdata("msg", "Failed to update dispute!");
			$this->session->set_flashdata("res", "error");
		}
		redirect(base_url('Admin/ManageDisputes'));
	}

	public function UpdateUserWallet()
	{
		$user_id = $this->input->post('user_id');
		$type = $this->input->post('type'); // Credit or Debit
		$amount = (float) $this->input->post('amount');
		$reason = $this->input->post('reason');

		$user = $this->db->where('id', $user_id)->get('registration')->row();
		if (!$user) {
			$this->session->set_flashdata("msg", "User not found!");
			$this->session->set_flashdata("res", "error");
			redirect(base_url('Admin/ManageUser'));
		}

		$new_balance = ($type == 'Credit') ? ($user->wallet + $amount) : ($user->wallet - $amount);

		$this->db->trans_start();

		// Update user wallet
		$this->db->where('id', $user_id)->update('registration', ['wallet' => $new_balance]);

		// Log transaction
		$this->db->insert('wallet_notifications', [
			'user_id' => $user_id,
			'type' => $type,
			'amount' => $amount,
			'reason' => $reason,
			'created_at' => date('Y-m-d H:i:s')
		]);

		$this->db->trans_complete();

		if ($this->db->trans_status() === TRUE) {
			$this->session->set_flashdata("msg", "Wallet " . $type . "ed successfully. New Balance: ₹" . $new_balance);
			$this->session->set_flashdata("res", "success");
		} else {
			$this->session->set_flashdata("msg", "Failed to update wallet!");
			$this->session->set_flashdata("res", "error");
		}
		redirect(base_url('Admin/ManageUser'));
	}

	public function DeleteRoutePricing()
	{
		$from = $this->input->post('from_pin');
		$to = $this->input->post('to_pin');
		if ($from && $to) {
			$this->db->where('from_pin', $from)->where('to_pin', $to)->delete('price');
			echo "success";
		}
	}

	public function ManageManager()
	{
		if ($this->uri->segment(3) == TRUE) {
			$action = $this->uri->segment(3);
			if ($this->uri->segment(4) == TRUE) {
				$id = $this->uri->segment(4);
				$query = $this->db->where('id', $id)->get('managers');
				if ($query->num_rows()) {
					$data["list"] = $query->result();
					if ($action == 'Edit') {
						$data["action"] = "EditManager";
						$this->load->view('Admin/UpdateData', $data);
					} else {
						redirect(base_url('Admin/ManageManager'));
					}
				} else {
					redirect(base_url('Admin/ManageManager'));
				}
			} else {
				if ($action == 'Add') {
					if (!empty($this->input->post())) {
						$insertData = [
							'name' => $this->input->post('name'),
							'email' => $this->input->post('email'),
							'password' => $this->input->post('password'),
							'mobile' => $this->input->post('mobile'),
							'address' => $this->input->post('address'),
							'aadhar_number' => $this->input->post('aadhar_number'),
							'status' => 'true'
						];

						if ($this->db->insert('managers', $insertData)) {
							$this->session->set_flashdata("msg", "Manager Added Successfully");
							$this->session->set_flashdata("res", "success");
							redirect(base_url('Admin/ManageManager'));
						} else {
							$this->session->set_flashdata("msg", "Failed to add Manager!");
							$this->session->set_flashdata("res", "error");
							redirect(base_url('Admin/ManageManager'));
						}
					}
				} else if ($action == 'Update') {
					if (!empty($this->input->post())) {
						if (empty($this->input->post("id"))) {
							$this->session->set_flashdata("msg", "ID is required !");
							$this->session->set_flashdata("res", "error");
							redirect(base_url('Admin/ManageManager'));
						} else {
							$query = $this->db->where('id', $this->input->post("id"))->get('managers');
							if ($query->num_rows()) {
								$data['list'] = $query->result();
								$updateData = [
									'name' => $this->input->post('name'),
									'email' => $this->input->post('email'),
									'password' => $this->input->post('password'),
									'mobile' => $this->input->post('mobile'),
									'address' => $this->input->post('address'),
									'aadhar_number' => $this->input->post('aadhar_number'),
									'status' => $this->input->post('status')
								];
								$result = $this->db->where('id', $data['list'][0]->id)->update('managers', $updateData);
								if ($result) {
									$this->session->set_flashdata("msg", "Manager Updated Successfully");
									$this->session->set_flashdata("res", "success");
									redirect(base_url('Admin/ManageManager'));
								} else {
									$this->session->set_flashdata("msg", "Failed to update Manager!");
									$this->session->set_flashdata("res", "error");
									redirect(base_url('Admin/ManageManager'));
								}
							}
						}
					}
				} else if ($action == 'Delete') {
					if ($this->db->where('id', $id)->delete('managers')) {
						$this->session->set_flashdata("msg", "Manager Deleted Successfully");
						$this->session->set_flashdata("res", "success");
						redirect(base_url('Admin/ManageManager'));
					} else {
						$this->session->set_flashdata("msg", "Failed to delete Manager!");
						$this->session->set_flashdata("res", "error");
						redirect(base_url('Admin/ManageManager'));
					}
				} else {
					redirect(base_url('Admin/ManageManager'));
				}
			}
		} else {
			$query = $this->db->order_by("id", "DESC")->get('managers');
			$data["list"] = $query->result();
			$this->load->view("Admin/ManageManager", $data);
		}
	}
}
