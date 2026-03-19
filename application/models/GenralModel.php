<?php

class GenralModel extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }
	
	public function CheckCertificateStatus($courseid, $userid)
	{
		$lectures = $this->db->get_where('tbl_lectures', array('CourseID'=>$courseid))->result();
		
		$arr= [];
		
		$status = false;
		foreach($lectures as $each)
		{
			if($this->CheckCompleteStatus($each->id, $userid))
			{
				$status = true;
			
			}
			else
			{
				$status = false;
			}
			
			array_push($arr, $status);
		}
		
		if(in_array(false, $arr))
		{
			return false;
		}
		else
		{
			return true;
		}
		
	}
	
	public function CheckPassStatus($quiz_id, $userid)
	{
		if($this->db->get_where('tbl_scorecard', array('userid'=>$userid, "examid"=>$quiz_id))->num_rows()>0)
		{
			return true;
		}
		else			
		{
			return false;
		}
	}
	
	public function CheckCertificateStatusQuiz($exam_id, $userid)
	{
		$query = $this->db->get_where('tbl_certificate', ['certificate_for'=>'quiz', "quiz_id"=>$exam_id, "userid"=>$userid, "appr_status"=>"approved"]);
		if($query->num_rows()>0)
		{
			return true;
		}
		else{
			return false;
		}
	}
	

    public function CourseBuyCount($course_id)
    {
        $count = $this->db->get_where('tbl_course_txn', array('CourseID' => $course_id, 'TxnStatus' => 'SUCCESS'))->num_rows();
        return $count;
    }
	
	public function CheckCompleteStatus($lid, $userid)
	{
		if($this->db->get_where('tbl_completed', array('lecture_id'=>$lid, "userid"=>$userid))->num_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

    public function CountReview($userid)
    {
        $count = $this->db->get_where('tbl_reviews', array('userid' => $userid))->num_rows();
        return $count;
    }

    public function Earning($userid)
    {
        $userdata = $this->db->get_where('tbl_users', array('id' => $userid))->row();
        $directusers = $this->db->get_where('tbl_users', array('ReferCode' => $userdata->MyCode))->result();
        $sum = 0;
        foreach ($directusers as $each)
        {
            $sum = $sum + $this->GenralModel->SumOfColumn('benfit_amout', 'tbl_commision', array('userid' => $userid, 'from_userid' => $each->id, 'trf_status' => 'true'));
        }

        $data = [];
        $data['direct'] = $sum;
        $data['in_direct'] = $this->GenralModel->SumOfColumn('benfit_amout', 'tbl_commision', array('userid' => $userid, 'trf_status' => 'true')) - $sum;
        return $data;
    }

    public function CountIndirectRefferals($userid)
    {
        // Those who are directly connected with user
        $userdata = $this->db->get_where('tbl_users', array('id' => $userid))->row();
        $data['userdata'] = $this->db->get_where('tbl_users', array('ReferCode' => $userdata->MyCode))->result();


        $userdatalv2 = [];

        foreach ($data['userdata'] as $each)
        {
            $referCode = $each->MyCode;

            $userlist = $this->db->get_where('tbl_users', array('ReferCode' => $referCode))->result();

            foreach ($userlist as $each1)
            {
                $each1->CreatedBy = $this->db->get_where('tbl_users', array('MyCode' => $each1->ReferCode))->row();
                array_push($userdatalv2, $each1);
            }
        }

        $data['userdatalv2'] = $userdatalv2;

        $userdatalv3 = [];

        foreach ($userdatalv2 as $each)
        {
            $referCode = $each->MyCode;

            $userlist = $this->db->get_where('tbl_users', array('ReferCode' => $referCode))->result();

            foreach ($userlist as $each1)
            {
                $each1->CreatedBy = $this->db->get_where('tbl_users', array('MyCode' => $each1->ReferCode))->row();
                array_push($userdatalv3, $each1);
            }
        }

        $data['userdatalv3'] = $userdatalv3;

        $userdatalv4 = [];

        foreach ($userdatalv3 as $each)
        {
            $referCode = $each->MyCode;

            $userlist = $this->db->get_where('tbl_users', array('ReferCode' => $referCode))->result();

            foreach ($userlist as $each1)
            {
                $each1->CreatedBy = $this->db->get_where('tbl_users', array('MyCode' => $each1->ReferCode))->row();
                array_push($userdatalv4, $each1);
            }
        }


        foreach ($userdatalv4 as $each)
        {
            $referCode = $each->MyCode;

            $userlist = $this->db->get_where('tbl_users', array('ReferCode' => $referCode))->result();

            foreach ($userlist as $each1)
            {
                $each1->CreatedBy = $this->db->get_where('tbl_users', array('MyCode' => $each1->ReferCode))->row();
                array_push($userdatalv4, $each1);
            }
        }
		

        $finalCounting  = count($userdatalv2) + count($userdatalv3) + count($userdatalv4);

        return $finalCounting;
    }

    public function CourseBoughtByUser($userid)
    {
        $count = $this->db->get_where('tbl_course_txn', array('UserID' => $userid, 'TxnStatus' => 'SUCCESS'))->num_rows();
        return $count;
    }

    public function Upload($name, $path, $allowed_type)
    {
        $res = [];
        $ext = pathinfo($_FILES[$name]["name"], PATHINFO_EXTENSION);
        $filename = time() . "_" . $name . "." . $ext;
        $config['upload_path'] = $path;
        $config['allowed_types'] = $allowed_type;
        $config['max_size'] = 10000; // In KB
        $config['file_name'] = $filename;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($name))
        {
            $res['res'] = "error";
            $error = explode('</p>', $this->upload->display_errors());
            $error = str_ireplace('<p>', '', $error[0]);
            $res['msg'] = $error;
        }
        else
        {
            $res['res'] = "success";
            $res['msg'] = "File upload success";
            $res['filename'] = $filename;
        }


        return $res;
    }

    public function KYC($id)
    {
        $userdata = $this->db->get_where('tbl_users', array('id' => $id))->row();

        $kyc_percent = 0;

        if ($userdata->MobileStatus == "true")
        {
            $kyc_percent = $kyc_percent + 25;
        }
        if ($userdata->EmailStatus == "true")
        {
            $kyc_percent = $kyc_percent + 25;
        }
        if ($userdata->KYCDoc_Status == "true")
        {
            $kyc_percent = $kyc_percent + 25;
        }
        if ($userdata->BankDoc_Status == "true")
        {
            $kyc_percent = $kyc_percent + 25;
        }

        return $kyc_percent;
    }

    public function CountRedeemedCount($code)
    {
        $query = $this->db->get_where('tbl_coupons', array('coupon_code' => $code));
        if ($query->num_rows() > 0)
        {
            $coupondata = $query->row();

            //check count
            $check = $this->db->get_where('tbl_course_txn', array('Code' => $code))->num_rows();

            if ($check >= $coupondata->people_count)
            {
                return true;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    public function ApplyCouponCode($code, $courseid, $userid)
    {
        $arr = [];
        if (!empty($code))
        {
            $code = strtoupper($code);

            $query = $this->db->get_where('tbl_coupons', array('coupon_code' => $code));

            $courseid = $courseid;
            $userid = $userid;

            if ($query->num_rows() > 0)
            {
                if (!empty($courseid) && !empty($userid))
                {
                    $userdata = $this->db->get_where('tbl_users', array('id' => $userid));
                    $coursedata = $this->db->get_where('tbl_courses', array('id' => $courseid, 'Status'=>'true'));

                    if ($userdata->num_rows() && $coursedata->num_rows())
                    {
                        $userdata = $userdata->row();
                        $orderdata = $coursedata->row();
                        $coupondata = $query->row();

                        $currentdate = strtotime($this->date);
                        $validtill = strtotime($coupondata->valid_till_date);

                        //check has reached limit
                        if ($this->CountRedeemedCount($code))
                        {
                            // check validity
                            if ($currentdate <= $validtill)
                            {


                                // check minimum puchase value
                                if ($orderdata->OfferPrice >= $coupondata->minimum_purchase)
                                {
                                    $percentage = ($coupondata->discount_percent * $orderdata->OfferPrice) / 100;
                                    $percentage = round($percentage);
                                    $discount = $percentage;


                                    if ($discount > $coupondata->max_discount)
                                    {
                                        $discount = $coupondata->max_discount;
                                    }


                                    $final = $orderdata->OfferPrice - $discount;

                                    $arr['res'] = "success";
                                    $arr['code'] = $coupondata->coupon_code;
                                    $arr['discount'] = $discount;
                                    $arr['finalprice'] = $final;
                                    $arr['per_discount'] = $coupondata->discount_percent;
                                }
                                else
                                {
                                    $arr['res'] = "error";
                                    $arr['msg'] = "Cart value should be at least $coupondata->minimum_purchase ₹.";
                                }
                            }
                            else
                            {
                                $arr['res'] = "error";
                                $arr['msg'] = "This coupon is expired!";
                            }
                        }
                        else
                        {
                            $arr['res'] = "error";
                            $arr['msg'] = "First $coupondata->people_count have redeemed this code!";
                        }
                    }
                    else
                    {
                        $arr['res'] = "error";
                        $arr['msg'] = "Either User or Course is invalid!";
                    }
                }
                else
                {
                    $arr['res'] = "error";
                    $arr['msg'] = "Something went wrong!";
                }
            }
            else
            {
                $arr['res'] = "error";
                $arr['msg'] = "No such coupon code exist!";
            }
        }
        else
        {
            $arr['res'] = "error";
            $arr['msg'] = "Something went wrong";
        }

        return $arr;
    }

    public function CourseRating($course_id)
    {
        $rating = [];

        $coursedata = $this->db->get_where('tbl_courses', array('id' => $course_id, 'Status'=>'true'))->row();
        $review = $this->db->get_where('tbl_reviews', array('course_id' => $course_id));

        if ($review->num_rows() > 0)
        {
            $reviewCount = $review->num_rows();
            //sum of rating
            $where = [
                "course_id" => $course_id
            ];
            $this->Star = $this->SumOfColumn('star', 'tbl_reviews', $where);

            $stars = $this->Star / $reviewCount;

            $rating['stars'] = $stars;

            $rating_arr = explode('.', $stars);

            if (!empty($rating_arr[1]))
            {
                if ($rating_arr[1] > 0)
                {
                    $rating['halfstar'] = true;
                }
                else
                {
                    $rating['halfstar'] = false;
                }
            }
            else
            {
                $rating['stars'] = $stars . ".0";
                $rating['halfstar'] = false;
            }

            $totalreview = $reviewCount;

            $fivestar = $this->db->get_where('tbl_reviews', array('course_id' => $course_id, 'star' => '5'))->num_rows();
            $fourstar = $this->db->get_where('tbl_reviews', array('course_id' => $course_id, 'star' => '4'))->num_rows();
            $threestar = $this->db->get_where('tbl_reviews', array('course_id' => $course_id, 'star' => '3'))->num_rows();
            $twostar = $this->db->get_where('tbl_reviews', array('course_id' => $course_id, 'star' => '2'))->num_rows();
            $onestar = $this->db->get_where('tbl_reviews', array('course_id' => $course_id, 'star' => '1'))->num_rows();

            $rating['five_star_user'] = ($fivestar / $totalreview) * 100;
            $rating['four_star_user'] = ($fourstar / $totalreview) * 100;
            $rating['three_star_user'] = ($threestar / $totalreview) * 100;
            $rating['two_star_user'] = ($twostar / $totalreview) * 100;
            $rating['one_star_user'] = ($onestar / $totalreview) * 100;

            return $rating;
        }
        else
        {

            $stars = $coursedata->Rating;

            $rating['stars'] = $stars;

            $rating_arr = explode('.', $stars);

            if (!empty($rating_arr[1]))
            {
                if ($rating_arr[1] > 0)
                {
                    $rating['halfstar'] = true;
                }
                else
                {
                    $rating['halfstar'] = false;
                }
            }
            else
            {
                $rating['stars'] = $stars . ".0";
                $rating['halfstar'] = false;
            }

            $rating['five_star_user'] = "100";
            $rating['four_star_user'] = "0";
            $rating['three_star_user'] = "0";
            $rating['two_star_user'] = "0";
            $rating['one_star_user'] = "0";
            return $rating;
        }
    }



    public function Rating($course_id)
    {
        $rating = [];

        $coursedata = $this->db->get_where('tbl_courses', array('id' => $course_id, 'Status'=>'true'))->row();
        $review = $this->db->get_where('tbl_reviews', array('course_id' => $course_id));

        if ($review->num_rows() > 0)
        {

            $reviewCount = $review->num_rows();
            //sum of rating
            $where = [
                "course_id" => $course_id
            ];
            $Star = $this->SumOfColumn('star', 'tbl_reviews', $where);

            $stars = $Star / $reviewCount;

            $rating = $stars;


            $rating_arr = explode('.', $stars);

            if (empty($rating_arr[1]))
            {
                $rating = $rating . ".0";
            }

            return $rating;
        }
        else
        {

            $rating = $coursedata->Rating;


            $rating_arr = explode('.', $rating);

            if (empty($rating_arr[1]))
            {
                $rating = $rating . ".0";
            }

            return $rating;
        }
    }



    public function InstructorRating($id)
    {
        $course = $this->db->get_where('tbl_courses', array('InstructorID' => $id, 'Status'=>'true'));
        $userdata = $this->db->get_where('tbl_instructor', array('id' => $id))->row();
        $rcount = 0;
        $review = 0;
        if ($course->num_rows() > 0)
        {
            foreach ($course->result() as $each)
            {
                $userreview = $this->db->get_where('tbl_reviews', array('course_id' => $each->id));
                $rcount = $rcount + $userreview->num_rows();

                $where = [
                    "course_id" => $each->id
                ];
                $Star = $this->SumOfColumn('star', 'tbl_reviews', $where);
                if (!empty($Star))
                {
                    $review = $Star + $review;
                }
            }


            if ($rcount == 0)
            {
                $rating = "5.0";
                return $rating;
            }
            else
            {
                $rating  = $review / $rcount;


                $rating_arr = explode('.', $rating);

                if (empty($rating_arr[1]))
                {
                    $rating = $rating . ".0";
                }

                return $rating;
            }
        }
        else
        {
            $rating = "5.0";
            return $rating;
        }
    }

    public function CountManager($id, $table, $column)
    {
        $userdata = $this->db->get_where($table, array('id' => $id))->row();

        if (!empty($userdata))
        {
            $count = $userdata->$column;
            $count++;

            $data_arr = [$column => $count];

            if ($this->db->where('id', $id)->update($table, $data_arr))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function SumOfColumn($columnname, $table, $where)
    {

        $this->db->select_sum($columnname);
        $this->db->from($table);

        $this->db->where($where);

        $query = $this->db->get();
        $value = $query->row()->$columnname;

        $val_arr = explode('.', $value);

        if (isset($val_arr['1']))
        {
            $val_arr['1'] = substr($val_arr['1'], 0, 2);

            $value = $val_arr['0'] . "." . $val_arr['1'];
        }
        else
        {
            $value = $val_arr[0];
        }
        if (empty($value))
        {
            $value = 0;
        }
        return $value;
    }

   

    public function SendCommisions($txndata, $userdata, $orderAmount)
    {
        $TotalSent = 0;
        $TotalSentPercent = 0;

        $commision_arr = $this->commision_rate;
        $refercode = $userdata->ReferCode;
        $from_userid = $userdata->id;
        // update root user affiliate status 
        $this->db->where('id', $from_userid)->update('tbl_users', array('AffiliateStatus' => 'true'));

        for ($i = 0; $i < count($commision_arr); $i++)
        {
            if (!empty($refercode))
            {
                $userdata = $this->db->get_where('tbl_users', array('MyCode' => $refercode))->row();
                $to_userid = $userdata->id;
                $benfit = ($orderAmount * $commision_arr[$i]) / 100;

                $wallet = $userdata->Wallet + $benfit;

                if ($userdata->AffiliateStatus == "true")
                {
                    // 1. update wallet 
                    $this->db->where('id', $userdata->id)->update('tbl_users', array('Wallet' => $wallet));

                    $trfStatus = "true";
                }
                else
                {
                    $trfStatus = "false";
                }


                // 2. Create Record
                $data_arr = [
                    "userid" => $to_userid,
                    "from_userid" => $from_userid,
                    "txn_amount" => $orderAmount,
                    "benfit_amout" => $benfit,
                    "percentage" => $commision_arr[$i],
                    "course_id" => $txndata->CourseID,
                    "date" => $this->date,
                    "time" => $this->time,
                    "trf_status" => $trfStatus
                ];

                if ($userdata->AffiliateStatus == "true")
                {
                    $TotalSent = $TotalSent + $benfit;
                    $TotalSentPercent = $commision_arr[$i] + $TotalSentPercent;
                }


                $this->db->insert('tbl_commision', $data_arr);
                $commisonid = $this->db->insert_id();

                if ($userdata->AffiliateStatus == "true")
                {
                    // 3. Insert into wallet txn also
                    $fromuserdata = $this->db->get_where('tbl_users', array('id' => $from_userid))->row();
                    $txn_data = [
                        "userid" => $to_userid,
                        "txn_amount" => $benfit,
                        "txn_commision_id" => $commisonid,
                        "txn_remark" => "Commision from " . $fromuserdata->Name,
                        "date" => $this->date,
                        "time" => $this->time,
                    ];

                    $this->db->insert('tbl_wallet_txn', $txn_data);
                }


                $refercode = $userdata->ReferCode;
            }
            else
            {
                break;
            }
        }


        $AdminIncome = $orderAmount - $TotalSent;

        $data_arr = [
            "userid" => '0',
            "from_userid" => $txndata->UserID,
            "txn_amount" => $orderAmount,
            "benfit_amout" => $AdminIncome,
            "percentage" => 100 - $TotalSentPercent,
            "course_id" => $txndata->CourseID,
            "date" => $this->date,
            "time" => $this->time,
        ];

        $this->db->insert('tbl_commision', $data_arr);
    }

    public function GetEmbedLinkYT($string)
    {
        $url = $string;
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches))
        {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches))
        {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id;
    }

    function GetMasekedEmail($email)
    {
        $em   = explode("@", $email);
        $name = implode('@', array_slice($em, 0, count($em) - 1));
        $len  = floor(strlen($name) / 2);

        return substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);
    }

    public function GetData($table, $column,  $data)
    {
        return $this->db->get_where($table, array($column => $data))->row();
    }

    public function GetMaskedNumber($data)
    {
        $masked = "******" . substr($data, -4);
        return $masked;
    }


    public function UpdateData($table, $column,  $id, $data)
    {
        return $this->db->where($column, $id)->update($table, $data);
    }


    public function CourseBuyStatus($userid, $courseid)
    {
        $data_where = array(
            "UserID" => $userid,
            "CourseID" => $courseid,
            "TxnStatus" => "SUCCESS"
        );

        $count = $this->db->get_where('tbl_course_txn', $data_where)->num_rows();

        if ($count > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function FilterPayment($userid, $constraint)
    {

        if ($constraint == "ALL")
        {
            $data_where = array(
                "UserID" => $userid
            );
        }
        else if ($constraint == "FAILED")
        {
            $data_where = array(
                "UserID" => $userid,
                "TxnStatus !=" => 'SUCCESS'
            );
        }
        else
        {
            $data_where = array(
                "UserID" => $userid,
                "TxnStatus" => $constraint
            );
        }

        if ($userid == "0")
        {
            unset($data_where['UserID']);
        }


        $res = $this->db->order_by('id', 'desc')->get_where('tbl_course_txn', $data_where);

        if ($res->num_rows() > 0)
        {
            return $res->result();
        }
        else
        {
            return false;
        }
    }
	
	
	public function GetQuiz($id)
	{
		$userdata = $this->db->get_where('tbl_users', array('id'=>$id))->row();
		
		$course = $this->db->get_where('tbl_course_txn', array('UserID' => $id, 'TxnStatus' => 'SUCCESS'))->result();
		
		$ids = [];
		foreach($course as $each)
		{
			array_push($ids, $each->CourseID);
		}

		$quiz = [];
		foreach($ids as $each)
		{	
			
			$quizincourse = $this->db->get_where('tbl_live', array('course'=>$each))->result();
			
			foreach($quizincourse as $eachquiz)
			{
				if(!in_array($eachquiz->exam_id, $quiz))
				{
					array_push($quiz,$eachquiz->exam_id);
				}
			}
		}
		
		//Push all free quix
		$free = $this->db->get_where('tbl_live', array('course'=>''))->result();
		foreach($free as $each)
		{
			array_push($quiz, $each->exam_id);
		}
		return $quiz;
	}

	public function AutoSubmitExam()
	{
		$response = $this->session->userdata('user_response');
		
		$resid = [];
	
		foreach($response as $each)
		{
			array_push($resid,$each['question_id']);
		}
		
		$exam_id = $this->session->userdata('exam_id');
		$examdata = $this->db->get_where('tbl_exam', array('id'=>$exam_id))->row();
		$questions = $this->db->get_where('tbl_mapping', array('exam_id'=>$examdata->id))->result();
		
		$arr = [];
		foreach($questions as $each)
		{
			array_push($arr, $each->question_id);
		}
		
		foreach($arr as $each)
		{
			if(!in_array($each, $resid))
			{
				$temp = [
					"question_id"=>$each,
					"answer"=>'NA'
				];
				
				array_push($response, $temp);
			}
		}
		
		$this->session->set_userdata('user_response', $response);
		
		return true;
	}

	public function PublishResult()
	{
		$response = $this->session->userdata('user_response');
		$exam_id = $this->session->userdata('exam_id');
		
		$examdata = $this->db->get_where('tbl_exam', array('id'=>$exam_id))->row();
		$mark = $examdata->mark_per;
		$correct = 0;
		$in_correct = 0;
		$score = 0;
		foreach($response as $each)
		{
			$qid = $each['question_id'];
			$question = $this->db->get_where('tbl_question', array('id'=>$qid))->row();
			if($question->correct == $each['answer'])
			{
				$score = $score + $mark;
				$correct++;
			}else{
				$in_correct++;
			}
		}
		
		$total = count($response);
		$totalscore = (int)$total * (int)$mark;
		$percent = ($score / $totalscore) * 100;
		
		if($percent>=$examdata->passing_percent)
		{
			$status =  "Pass";
		}
		else
		{
			$status =  "Fail";
		}

		$data_arr = [
			"userid"=>$this->userid,
			"examid"=>$examdata->id,
			"score"=>$score,
			"total_score"=>$totalscore,
			"correct"=>$correct,
			"incorrect"=>$in_correct,
			"status"=>$status,
			"percent"=>$percent,
			"token"=>md5($this->userid."-".$examdata->id)
		];
		
		if($status=="Pass")
		{
			$query = $this->db->get_where('tbl_scorecard', array('userid'=>$this->userid, "examid"=>$examdata->id));
			
			if($query->num_rows()==0)
			{
				$this->db->insert('tbl_scorecard', $data_arr);
			}
			
		}
		
		return $data_arr;
	}

	public function GetQuestion()
	{
		$response = $this->session->userdata('user_response');
		$exam_id = $this->session->userdata('exam_id');
		
		$list = $this->db->get_where('tbl_mapping', array('exam_id'=>$exam_id))->result();
		$responded = [];
		foreach($response as $each)
		{
			array_push($responded, $each['question_id']);
		}
		
		$ids = [];
		foreach($list as $each)
		{
			array_push($ids, $each->question_id);
		}
		
		$question = "";
		foreach($ids as $each)
		{
			if(!in_array($each, $responded))
			{
				$question = $each;
				break;
			}
		}
		
		return $question;
	}
}
