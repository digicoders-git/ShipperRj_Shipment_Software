<?php

defined("BASEPATH") or exit("No Direct Scripts Allowed");

class Home extends CI_Controller
{
	public $timestamp;
	public $times;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('Cashfree');

		date_default_timezone_set("Asia/Kolkata");
		$this->timestamp = date("d-m-Y");
		$this->times = date("h:i:sa");
	}

	public function index()
	{
		$this->load->view("website/index");
	}

	public function login()
	{
		$this->load->view("website/login");
	}

	public function LogOut()
	{
		$user_id = $this->session->userdata("User");
		$this->session->sess_destroy();

		$this->session->set_flashdata("msg", "Log Out Successfully");
		$this->session->set_flashdata("res", "success");
		redirect(base_url("Home"));
	}

	public function register()
	{
		$this->load->view("website/register");
	}

	public function services()
	{
		$this->load->view("website/services");
	}

	public function contact()
	{
		$this->load->view("website/contact");
	}

	public function disputeraise($booking_id = null)
	{
		$data['booking_id'] = $booking_id;
		$this->load->view("website/disputeraise", $data);
	}

	public function book_now()
	{
		$data['sender_pincodes'] = $this->db->query("SELECT DISTINCT pin FROM (SELECT from_pin AS pin FROM price WHERE status='true' UNION SELECT to_pin AS pin FROM price WHERE status='true') as all_pins")->result();
		$this->load->view("website/book_now", $data);
	}

	public function GetReceiverPins()
	{
		$from = $this->input->post('from_pin');
		$query = $this->db->query("SELECT DISTINCT pin FROM (
			SELECT to_pin AS pin FROM price WHERE from_pin = '$from' AND status='true'
			UNION 
			SELECT from_pin AS pin FROM price WHERE to_pin = '$from' AND status='true'
		) as connected_pins");
		echo json_encode($query->result());
	}

	public function SearchPincodes()
	{
		$query_str = $this->input->post('query');
		$from_pin = $this->input->post('from_pin'); # Optional: for receiver search

		if (empty($from_pin)) {
			// Sender search: all pins from price table
			$results = $this->db->query("SELECT DISTINCT pin FROM (
				SELECT from_pin AS pin FROM price WHERE from_pin LIKE '$query_str%' AND status='true'
				UNION 
				SELECT to_pin AS pin FROM price WHERE to_pin LIKE '$query_str%' AND status='true'
			) as all_pins LIMIT 10")->result();
		} else {
			// Receiver search: only pins connected to sender
			$results = $this->db->query("SELECT DISTINCT pin FROM (
				SELECT to_pin AS pin FROM price WHERE from_pin = '$from_pin' AND to_pin LIKE '$query_str%' AND status='true'
				UNION 
				SELECT from_pin AS pin FROM price WHERE to_pin = '$from_pin' AND from_pin LIKE '$query_str%' AND status='true'
			) as connected_pins LIMIT 10")->result();
		}

		echo json_encode($results);
	}

	public function GetPincodePrice()
	{
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		$weight = (float) $this->input->post('weight');

		if ($weight <= 0) {
			echo json_encode(['status' => false, 'msg' => 'Weight must be greater than 0']);
			return;
		}

		// Find suitable weight slot
		$weight_slot = $this->db->query("SELECT id FROM weight_slots WHERE $weight >= min_weight AND $weight <= max_weight AND status='true' LIMIT 1")->row();
		if (!$weight_slot) {
			echo json_encode(['status' => false, 'msg' => "Weight limit exceeded! We don't ship $weight kg on this route."]);
			return;
		}
		$weight_slot_id = $weight_slot->id;

		$pricing = $this->db->query("SELECT * FROM price WHERE ((from_pin = '$from' AND to_pin = '$to') OR (from_pin = '$to' AND to_pin = '$from')) AND weight_slot_id = '$weight_slot_id' AND status='true' LIMIT 1")->row();

		if ($pricing) {
			echo json_encode([
				'status' => true,
				'price' => $pricing->price_per_kg,
				'is_flat_rate' => ($pricing->weight_slot_id > 0) ? true : false
			]);
		} else {
			echo json_encode(['status' => false, 'msg' => 'Service not available for this route and weight slot']);
		}
	}

	public function wallet()
	{
		$user_id = $this->session->userdata("User");
		if (empty($user_id)) {
			redirect(base_url("Home/login"));
		}
		$data["userdata"] = $this->db->query("SELECT * FROM `registration` WHERE id='$user_id'")->row();

		// Unified Transaction History (Cashfree topups, Booking deductions, and Manual Adjustments)
		$txns = $this->db->query("
			(SELECT 'Top-up/Deduction' as source, txn_id as id, payment_utr as description, amount, status as type, date, time FROM transaction WHERE user_id = '$user_id')
			UNION
			(SELECT 'Admin Adjustment' as source, id, reason as description, amount, type, DATE_FORMAT(created_at, '%d-%m-%Y') as date, DATE_FORMAT(created_at, '%h:%i:%sa') as time FROM wallet_notifications WHERE user_id = '$user_id')
			ORDER BY date DESC, time DESC
		")->result();

		$data["txndata"] = $txns;
		$this->load->view("website/wallet", $data);
	}

	public function AddMoneyToWallet()
	{
		$user_id = $this->session->userdata("User");
		$amount = (float) $this->input->post("amount");

		if ($amount < 10) {
			$this->session->set_flashdata("msg", "Minimum amount is ₹10");
			$this->session->set_flashdata("res", "error");
			redirect(base_url("Home/wallet"));
		}

		$userdata = $this->db->query("SELECT * FROM `registration` WHERE id='$user_id'")->row();
		$txn_id = 'WAL' . strtoupper(substr(md5(time() . rand()), 0, 8));

		$cfdata = $this->cashfree->createOrder($amount, $user_id, $userdata->name, $userdata->email, $userdata->mobile);
		$responseData = json_decode($cfdata, true);

		if (!isset($responseData['payment_session_id'])) {
			$this->session->set_flashdata("msg", "Payment Initiation Failed");
			$this->session->set_flashdata("res", "error");
			redirect(base_url("Home/wallet"));
		}

		$paymentSessionId = $responseData['payment_session_id'];

		$insert_data = array(
			"user_id" => $user_id,
			"amount" => $amount,
			"status" => "Pending",
			"txn_id" => $txn_id,
			"payment_utr" => $responseData['order_id'], // Store order_id in payment_utr for callback
			"reciept" => "CashfreeTopup",
			"date" => $this->timestamp,
			"time" => $this->times
		);

		$this->db->insert("transaction", $insert_data);

		$data['paymentSessionId'] = $paymentSessionId;
		$data['cforder_id'] = $responseData['order_id'];
		$data['redirect_to'] = base_url('Home/wallet');
		$data['callback_url'] = base_url('Home/UpdateWalletTopupStatus');
		$this->load->view('website/Cashfree_view', $data);
	}

	#After Payment From Cashfree Update Wallet Transaction Here
	public function UpdateWalletTopupStatus()
	{
		$cforder_id = $this->input->post('cforder_id');
		$payment_status = $this->input->post('payment_status');
		$paymentSessionId = $this->input->post('paymentSessionId');

		$response = $this->cashfree->CheckOrderStatus($cforder_id);

		$txn = $this->db->where('payment_utr', $cforder_id)->get('transaction')->row();
		if (!$txn || $txn->status != 'Pending')
			return;

		if ($response->order_status == "PAID") {
			// Update Transaction
			$this->db->where('id', $txn->id)->update('transaction', ['status' => 'Accept']);

			// Update User Wallet
			$user = $this->db->where('id', $txn->user_id)->get('registration')->row();
			$new_balance = $user->wallet + $txn->amount;
			$this->db->where('id', $txn->user_id)->update('registration', ['wallet' => $new_balance]);

			echo json_encode(['status' => 'success']);
		} else {
			$this->db->where('id', $txn->id)->update('transaction', ['status' => 'Reject']);
			echo json_encode(['status' => 'failed']);
		}
	}



	public function book_histroy()
	{

		if ($this->uri->segment(3) == TRUE) {
			$action = $this->uri->segment(3);
			if ($this->uri->segment(4) == TRUE) {
				$id = $this->uri->segment(4);
				$query = $this->db->where('id', $id)->get('booking');
				if ($query->num_rows()) {
					$data["list"] = $query->result();
					if ($action == 'Edit') {

						$data["action"] = "TrackOrder";
						$this->load->view('website/UpdateData', $data);
					} else {
						redirect(base_url('Home/book_histroy'));
					}
				} else {
					redirect(base_url('Home/book_histroy'));
				}
			} else {
				redirect(base_url('Home/book_histroy'));
			}
		} else {

			$user_id = $this->session->userdata("User");
			$query = $this->db->order_by("id", "DESC")->where('user_id', $user_id)->get('booking');
			$data["booking"] = $query->result();
			$this->load->view("website/book_histroy", $data);
		}
	}

	public function booking_details($id)
	{
		$user_id = $this->session->userdata("User");
		if (empty($user_id)) {
			redirect(base_url("Home/login"));
		}

		$booking = $this->db->where('id', $id)->where('user_id', $user_id)->get('booking')->row();
		if (!$booking) {
			redirect(base_url('Home/book_histroy'));
		}

		$data['booking'] = $booking;

		// Fetch Delivery Boy details if assigned
		if (!empty($booking->delivery_boy_id)) {
			$data['delivery_boy'] = $this->db->where('id', $booking->delivery_boy_id)->get('delivery_boy')->row();
		} else {
			$data['delivery_boy'] = null;
		}

		// Fetch Tracking History
		$data['tracking'] = $this->db->order_by("id", "DESC")->where('booking_id', $id)->get('track_order')->result();

		$this->load->view("website/book_details", $data);
	}


	public function registeraction()
	{

		$name = $this->input->post("name");
		$mobile = $this->input->post("mobile");
		$email = $this->input->post("email");
		$password = $this->input->post("password");

		$query = $this->db->where('mobile', $mobile)->get('registration');
		if ($query->num_rows()) {
			$this->session->set_flashdata("msg", "Mobile Allready Registered !");
			$this->session->set_flashdata("res", "error");
			redirect(base_url("Home/register"));
		} else {
			$insert_data = array(
				"name" => $name,
				"email" => $email,
				"mobile" => $mobile,
				"password" => $password,
				"otp" => "1234",
				"status" => "true",
				"date" => $this->timestamp,
				"time" => $this->times
			);

			$res = $this->db->insert("registration", $insert_data);

			if ($res) {
				$this->session->set_flashdata("msg", "Registration Successfull");
				$this->session->set_flashdata("res", "success");
				redirect(base_url("Home/register"));
			} else {
				$this->session->set_flashdata("msg", "Something Went Wrong");
				$this->session->set_flashdata("res", "error");
				redirect(base_url("Home/register"));
			}
		}
	}

	public function BookingPayment()
	{
		$user_id = $this->session->userdata("User");
		$userdata = $this->db->where('id', $user_id)->get('registration')->row();

		$senderName = $this->input->post("senderName");
		$senderAddress = $this->input->post("senderAddress");
		$senderCity = $this->input->post("senderCity");
		$senderState = $this->input->post("senderState");
		$senderPhone = $this->input->post("senderPhone");
		$senderPincode = $this->input->post("senderPincode");

		$receiverName = $this->input->post("receiverName");
		$receiverAddress = $this->input->post("receiverAddress");
		$receiverCity = $this->input->post("receiverCity");
		$receiverState = $this->input->post("receiverState");
		$receiverPhone = $this->input->post("receiverPhone");
		$reciverPincode = $this->input->post("reciverPincode");

		$packageWeight = $this->input->post("packageWeight");
		$length = $this->input->post("length");
		$width = $this->input->post("width");
		$height = $this->input->post("height");
		$packageContents = $this->input->post("packageContents");
		$deliveryMethod = $this->input->post("deliveryMethod");

		$fullSenderAddress = $senderAddress . ", " . $senderCity . ", " . $senderState;
		$fullReceiverAddress = $receiverAddress . ", " . $receiverCity . ", " . $receiverState;

		// Dynamic Price Calculation
		$volumetric_weight = ($length * $width * $height) / 5000;
		$actual_weight = (float) $packageWeight;
		$chargable_weight = max($volumetric_weight, $actual_weight);

		// Find suitable weight slot
		$weight_slot = $this->db->query("SELECT id FROM weight_slots WHERE $chargable_weight >= min_weight AND $chargable_weight <= max_weight AND status='true' LIMIT 1")->row();
		$weight_slot_id = $weight_slot ? $weight_slot->id : 0;

		$pricing = $this->db->query("SELECT * FROM price WHERE ((from_pin = '$senderPincode' AND to_pin = '$reciverPincode') OR (from_pin = '$reciverPincode' AND to_pin = '$senderPincode')) AND weight_slot_id = '$weight_slot_id' AND status='true' LIMIT 1")->row();

		if ($pricing) {
			$total_amount = ceil($chargable_weight * $pricing->price_per_kg);
		} else {
			// Fallback to route-only pricing if slot-specific pricing isn't set (optional, based on requirement)
			$pricing_fallback = $this->db->query("SELECT * FROM price WHERE ((from_pin = '$senderPincode' AND to_pin = '$reciverPincode') OR (from_pin = '$reciverPincode' AND to_pin = '$senderPincode')) AND status='true' LIMIT 1")->row();
			if ($pricing_fallback) {
				$total_amount = ceil($chargable_weight * $pricing_fallback->price_per_kg);
			} else {
				$total_amount = 500; // Default fallback
			}
		}

		// WALLET VALIDATION
		if ($userdata->wallet < $total_amount) {
			$this->session->set_flashdata("msg", "Insufficient Balance! Wallet: ₹" . number_format($userdata->wallet, 2) . ", Required: ₹" . number_format($total_amount, 2) . ". Please add money to your wallet.");
			$this->session->set_flashdata("res", "error");
			redirect(base_url("Home/wallet"));
		}

		// DEDUCT FROM WALLET
		$new_wallet_balance = $userdata->wallet - $total_amount;
		$this->db->where('id', $user_id)->update('registration', ['wallet' => $new_wallet_balance]);

		// RECORD TRANSACTION
		$txn_id = 'BOK' . strtoupper(substr(md5(time() . rand()), 0, 8));
		$txn_data = [
			"user_id" => $user_id,
			"amount" => $total_amount,
			"status" => "Deduct",
			"txn_id" => $txn_id,
			"payment_utr" => "Booking Payment",
			"reciept" => "",
			"date" => $this->timestamp,
			"time" => $this->times
		];
		$this->db->insert("transaction", $txn_data);

		$insert_data = array(
			"sender" => $senderName,
			"receiver" => $receiverName,
			"weight" => $packageWeight,
			"sender_address" => $fullSenderAddress,
			"receiver_address" => $fullReceiverAddress,
			"length" => $length,
			"width" => $width,
			"height" => $height,
			"sender_pincode" => $senderPincode,
			"receiver_pincode" => $reciverPincode,
			"package_contents" => $packageContents,
			"sender_mobile" => $senderPhone,
			"receiver_mobile" => $receiverPhone,
			"order_status" => "Placed",
			"user_id" => $user_id,
			"delivery_boy_id" => "",
			"payment_session_id" => $txn_id, // Use txn_id as session id since wallet payment is instant
			"payment_status" => "success",
			"payment_res" => "Paid from Wallet",
			"amount" => $total_amount,
			"date" => $this->timestamp,
			"time" => $this->times
		);

		$res = $this->db->insert("booking", $insert_data);
		if ($res) {
			$last_id = $this->db->insert_id();
			$msg = "Order Placed Successfully. Amount ₹$total_amount deducted from wallet.";

			$this->db->insert('track_order', [
				'booking_id' => $last_id,
				'order_status' => "Placed",
				'msg' => $msg,
				"date" => $this->timestamp,
				"time" => $this->times
			]);

			$this->session->set_flashdata("msg", $msg);
			$this->session->set_flashdata("res", "success");
			redirect(base_url("Home/book_histroy"));
		} else {
			// Rollback wallet if insertion fails (rare)
			$this->db->where('id', $user_id)->update('registration', ['wallet' => $userdata->wallet]);
			$this->session->set_flashdata("msg", "Something Went Wrong");
			$this->session->set_flashdata("res", "error");
			redirect(base_url("Home/book_now"));
		}
	}

	#After Payment From Cashfree Update Payment Response Here
	public function UpdateCashfreePaymentStatus()
	{
		$cforder_id = $this->input->post('cforder_id');
		$payment_status = $this->input->post('payment_status');
		$paymentSessionId = $this->input->post('paymentSessionId');

		$response = $this->cashfree->CheckOrderStatus($cforder_id);
		if ($response->order_status == "PAID") {
			$response->order_status = "success";
		} else {
			$response->order_status = "failed";
		}

		$payRes = [
			"cforder_id" => $cforder_id,
			"order_amount" => $response->order_amount,
			"referenceId" => $response->cf_order_id,
			"txtStatus" => $response->order_status,
		];


		$update_data = array(
			"payment_status" => $response->order_status,
			"payment_res" => json_encode($payRes)
		);

		$where_data = array(
			"payment_session_id" => $paymentSessionId
		);

		$res = $this->db->where($where_data)->update("booking", $update_data);
	}


	public function UserAuthentication()
	{
		$mobile = $this->input->post("mobile");
		$password = $this->input->post("password");
		$query2 = $this->db->where('mobile', $mobile)->get('registration');

		if ($query2->num_rows()) {
			$value = $query2->row();
			$User_ID = $value->id;
			$password1 = $value->password;
			$CurrentStatus = $value->status;

			if ($password == $password1) {
				if ($CurrentStatus == 'true') {
					// User Session Hold Here
					$this->session->set_userdata('User', $User_ID);

					$this->session->set_flashdata("msg", "Login Successfully");
					$this->session->set_flashdata("res", "success");
					redirect(base_url("Home/index"));
				} else {
					$this->session->set_flashdata("msg", "Account Blocked !");
					$this->session->set_flashdata("res", "error");
					redirect(base_url("Home/login"));
				}
			} else {
				$this->session->set_flashdata("msg", "Invalid Password !");
				$this->session->set_flashdata("res", "error");
				redirect(base_url("Home/login"));
			}
		} else {
			$this->session->set_flashdata("msg", "Invalid Mobile Number !");
			$this->session->set_flashdata("res", "error");
			redirect(base_url("Home/login"));
		}
	}


	public function ChangeOrderStatus()
	{

		$id = $this->input->post('id');
		$value = $this->input->post('value');

		$result = $this->db->where('id', $id)->update('booking', ['order_status' => $value]);
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

	public function AddContactInquiry()
	{
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		$mobile = $this->input->post("mobile");
		$subject = $this->input->post("subject");
		$message = $this->input->post("message");

		$insert_data = array(
			"name" => $name,
			"email" => $email,
			"mobile" => $mobile,
			"subject" => $subject,
			"message" => $message,
			"created_at" => date("Y-m-d H:i:s")
		);

		$res = $this->db->insert("contact_inquiry", $insert_data);

		if ($res) {
			$this->session->set_flashdata("msg", "Inquiry Sent Successfully! We will contact you soon.");
			$this->session->set_flashdata("res", "success");
		} else {
			$this->session->set_flashdata("msg", "Something went wrong! Please try again.");
			$this->session->set_flashdata("res", "error");
		}
		redirect(base_url("Home/contact"));
	}

	public function submit_dispute()
	{
		$user_id = $this->session->userdata("User");
		if (empty($user_id)) {
			echo json_encode(['status' => false, 'msg' => 'Please login first']);
			return;
		}

		$booking_id = $this->input->post('booking_id');
		$dispute_type = $this->input->post('dispute_type');
		$description = $this->input->post('description');

		$evidence_files = [];
		if (!empty($_FILES['evidence']['name'][0])) {
			$filesCount = count($_FILES['evidence']['name']);
			for ($i = 0; $i < $filesCount; $i++) {
				$_FILES['file']['name'] = $_FILES['evidence']['name'][$i];
				$_FILES['file']['type'] = $_FILES['evidence']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['evidence']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['evidence']['error'][$i];
				$_FILES['file']['size'] = $_FILES['evidence']['size'][$i];

				$config['upload_path'] = './assets/admin_assets/images/dispute/';
				if (!is_dir($config['upload_path'])) {
					mkdir($config['upload_path'], 0777, true);
				}
				$config['allowed_types'] = 'jpg|jpeg|png|webp|mp4|webm';
				$config['max_size'] = 5120; // 5MB
				$config['file_name'] = 'dispute_' . time() . '_' . $i;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('file')) {
					$fileData = $this->upload->data();
					$evidence_files[] = $fileData['file_name'];
				}
			}
		}

		$insert_data = [
			'user_id' => $user_id,
			'booking_id' => $booking_id,
			'dispute_type' => $dispute_type,
			'description' => $description,
			'evidence' => json_encode($evidence_files),
			'status' => 'Pending',
			'created_at' => date('Y-m-d H:i:s')
		];

		if ($this->db->insert('disputes', $insert_data)) {
			echo json_encode(['status' => true, 'msg' => 'Dispute raised successfully. Status will be updated soon.']);
		} else {
			echo json_encode(['status' => false, 'msg' => 'Failed to raise dispute.']);
		}
	}

	public function dispute_history()
	{
		$user_id = $this->session->userdata("User");
		if (empty($user_id)) {
			redirect(base_url("Home/login"));
		}

		$data['disputes'] = $this->db->order_by('id', 'DESC')->where('user_id', $user_id)->get('disputes')->result();
		$this->load->view("website/dispute_history", $data);
	}
}