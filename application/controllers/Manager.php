<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manager extends CI_Controller
{
    public $timestamp;
    public $times;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('Manager')) {
            $this->session->set_flashdata("msg", "Please Login First !");
            $this->session->set_flashdata("res", "error");
            redirect(base_url('Auth/Managerlogin'));
        }
        date_default_timezone_set("Asia/Kolkata");
        $this->timestamp = date("d-m-Y");
        $this->times = date("h:i:sa");
    }

    public function index()
    {
        // Statistics for Dashboard
        $data['total_bookings'] = $this->db->count_all('booking');
        $data['placed_bookings'] = $this->db->where('order_status', 'Placed')->from('booking')->count_all_results();
        $data['assigned_bookings'] = $this->db->where('order_status', 'Confirmed')->from('booking')->count_all_results();
        $data['pending_bookings'] = $this->db->where('order_status !=', 'Delivered')->from('booking')->count_all_results();
        $data['delivered_bookings'] = $this->db->where('order_status', 'Delivered')->from('booking')->count_all_results();
        $data['in_transit_bookings'] = $this->db->where('order_status', 'In Transit')->from('booking')->count_all_results();
        $data['dispatched_bookings'] = $this->db->where('order_status', 'Dispatched')->from('booking')->count_all_results();
        $data['out_for_delivery_bookings'] = $this->db->where('order_status', 'Out for Delivery')->from('booking')->count_all_results();
        $data['total_delivery_boys'] = $this->db->count_all('delivery_boy');

        // Daily Booking Trend (Last 30 Days)
        $trend_labels = [];
        $trend_data = [];
        for ($i = 0; $i < 30; $i++) {
            $day = date('d-m-Y', strtotime("-$i days"));
            $trend_labels[] = date('d M', strtotime("-$i days"));
            $t_query = $this->db->query("SELECT COUNT(*) as count FROM `booking` WHERE date='$day'");
            $trend_data[] = (int) ($t_query->row()->count ?? 0);
        }
        $data['trend_labels'] = array_reverse($trend_labels);
        $data['trend_data'] = array_reverse($trend_data);

        $this->load->view('Manager/index', $data);
    }

    public function ManageBooking()
    {
        if ($this->uri->segment(3) == 'Edit') {
            $id = $this->uri->segment(4);
            $query = $this->db->where('id', $id)->get('booking');
            $data["list"] = $query->result();
            $data["action"] = "AssignDelvieryBoy";
            $this->load->view('Manager/UpdateData', $data);
        } else if ($this->uri->segment(3) == 'Update') {
            if (!empty($this->input->post())) {
                $id = $this->input->post('id');
                $db_id = $this->input->post('delivery_boy');
                if ($id && $db_id) {
                    $this->db->where('id', $id)->update('booking', ['delivery_boy_id' => $db_id]);
                    $dboy = $this->db->where('id', $db_id)->get('delivery_boy')->row();
                    $this->db->insert('track_order', [
                        'booking_id' => $id,
                        'order_status' => "Assigned",
                        'msg' => "Assigned to delivery boy: " . ($dboy ? $dboy->name : 'Unknown'),
                        "date" => $this->timestamp,
                        "time" => $this->times
                    ]);
                    $this->session->set_flashdata("msg", "Delivery Boy Assigned Successfully");
                    $this->session->set_flashdata("res", "success");
                } else {
                    $this->session->set_flashdata("msg", "Failed to assign!");
                    $this->session->set_flashdata("res", "error");
                }
                redirect(base_url('Manager/ManageBooking'));
            }
        } else {
            $query = $this->db->order_by("id", "DESC")->get('booking');
            $data["booking"] = $query->result();
            $this->load->view('Manager/ManageBooking', $data);
        }
    }

    public function ManageDeliveryBoy()
    {
        if ($this->uri->segment(3) == 'Add') {
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
                    $this->session->set_flashdata("msg", "Delivery Boy Added Successfully");
                    $this->session->set_flashdata("res", "success");
                    redirect(base_url('Manager/ManageDeliveryBoy'));
                } else {
                    $this->session->set_flashdata("msg", "Failed to add Delivery Boy!");
                    $this->session->set_flashdata("res", "error");
                    redirect(base_url('Manager/ManageDeliveryBoy'));
                }
            }
        } else if ($this->uri->segment(3) == 'Edit') {
            $id = $this->uri->segment(4);
            $query = $this->db->where('id', $id)->get('delivery_boy');
            $data["list"] = $query->result();
            $data["action"] = "EditDeliveryBoy";
            $this->load->view('Manager/UpdateData', $data);
        } else if ($this->uri->segment(3) == 'Update') {
            if (!empty($this->input->post())) {
                $id = $this->input->post('id');
                $updateData = [
                    'name' => $this->input->post('name'),
                    'mobile' => $this->input->post('mobile'),
                    'password' => $this->input->post('password'),
                    'email' => $this->input->post('email'),
                    'aadharno' => $this->input->post('aadhar'),
                    'address' => $this->input->post('address'),
                    'status' => $this->input->post('status')
                ];
                if ($this->db->where('id', $id)->update('delivery_boy', $updateData)) {
                    $this->session->set_flashdata("msg", "Delivery Boy Updated Successfully");
                    $this->session->set_flashdata("res", "success");
                } else {
                    $this->session->set_flashdata("msg", "Failed to update Delivery Boy!");
                    $this->session->set_flashdata("res", "error");
                }
                redirect(base_url('Manager/ManageDeliveryBoy'));
            }
        } else {
            $query = $this->db->order_by("id", "DESC")->get('delivery_boy');
            $data["list"] = $query->result();
            $this->load->view('Manager/ManageDeliveryBoy', $data);
        }
    }

    public function AssignDeliveryBoy()
    {
        $id = $this->input->post('id');
        $db_id = $this->input->post('delivery_boy');
        if ($id && $db_id) {
            $this->db->where('id', $id)->update('booking', ['delivery_boy_id' => $db_id]);

            // Log Assignment in Tracking
            $dboy = $this->db->where('id', $db_id)->get('delivery_boy')->row();
            $this->db->insert('track_order', [
                'booking_id' => $id,
                'order_status' => "Assigned",
                'msg' => "Assigned to delivery boy: " . ($dboy ? $dboy->name : 'Unknown'),
                "date" => $this->timestamp,
                "time" => $this->times
            ]);

            $this->session->set_flashdata("msg", "Delivery Boy Assigned Successfully");
            $this->session->set_flashdata("res", "success");
        } else {
            $this->session->set_flashdata("msg", "Failed to assign!");
            $this->session->set_flashdata("res", "error");
        }
        redirect(base_url('Manager/ManageBooking'));
    }

    public function SecuritySettings()
    {
        $id = $this->session->userdata('Manager');
        $query = $this->db->where('id', $id)->get('managers');
        $data['manager'] = $query->row();
        $this->load->view('Manager/SecuritySettings', $data);
    }

    public function UpdatePassword()
    {
        $id = $this->session->userdata('Manager');
        $new_password = $this->input->post('password');
        if ($id && $new_password) {
            $this->db->where('id', $id)->update('managers', ['password' => $new_password]);
            $this->session->set_flashdata("msg", "Password Updated Successfully");
            $this->session->set_flashdata("res", "success");
        } else {
            $this->session->set_flashdata("msg", "Failed to update password!");
            $this->session->set_flashdata("res", "error");
        }
        redirect(base_url('Manager/SecuritySettings'));
    }

    public function UpdateStatus()
    {
        if ($this->input->post()) {
            $data = $this->input->post();
            $table = $data['table'];
            $column = $data['column'];
            $value = $data['value'];
            $where_column = $data['where_column'];
            $where_value = $data['where_value'];

            // Normalize boolean from JS
            if ($value === 'true' || $value === true) {
                $value = 'true';
            } else {
                $value = 'false';
            }

            $result = $this->db->where($where_column, $where_value)->update($table, [$column => $value]);
            if ($result) {
                echo true;
            } else {
                echo false;
            }
        }
    }

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
        }
    }

    public function export_bookings()
    {
        $bookings = $this->db->order_by("id", "DESC")->get('booking')->result();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Manager_Bookings_Export_' . date('d-m-Y_H-i') . '.csv');

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

    public function LogOut()
    {
        $this->session->unset_userdata('Manager');
        $this->session->unset_userdata('ManagerEmail');
        $this->session->unset_userdata('ManagerName');
        $this->session->set_flashdata("msg", "Logout Successfully");
        $this->session->set_flashdata("res", "success");
        redirect(base_url('Auth/Managerlogin'));
    }
}
