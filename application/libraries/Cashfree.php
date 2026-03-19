<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	#[\AllowDynamicProperties]
	class Cashfree 
	{
		
		// public $actionUrl, $appId, $secretKey;
		
		public function __construct()
		{
			#For Test Mode Keys
			$this->app_id = "TEST10328756cb080e4f54692b9c5d5265782301";
			$this->app_secret = "cfsk_ma_test_c21cc01c5baa9f95af4e8df0ee83b56a_05e4776c";
			$this->payment_api_url = "https://sandbox.cashfree.com";
			
			#For Live Mode Keys		
			// $this->app_id="119766b27ab44b3a40a135d587667911";
			// $this->app_secret="fa5caf4b81d22d024273f53d5f6a74f98cb98f65";
			// $this->payment_api_url="https://api.cashfree.com";
		}
		
		public function createOrder($order_amount, $customer_id, $customer_name, $customer_email, $customer_phone)
		{
			$curl = curl_init();
			
			$orderData = [
			"order_amount" => $order_amount,
			"order_currency" => "INR",
			"customer_details" => [
            "customer_id" => $customer_id,
            "customer_name" => $customer_name,
            "customer_email" => $customer_email,
            "customer_phone" => $customer_phone
			],
			"order_meta" => [ 
            "return_url" => "http://localhost/shipper_rj/"
			]
			];
			
			curl_setopt_array($curl, [
			CURLOPT_URL => $this->payment_api_url . '/pg/orders',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode($orderData), // Convert the order data to JSON format
			CURLOPT_HTTPHEADER => [
			'x-client-id: ' . $this->app_id,
			'x-client-secret: ' . $this->app_secret,
            'x-api-version: 2023-08-01',
            'Content-Type: application/json',
            'Accept: application/json'
			],
			]);
			
			$response = curl_exec($curl);
			
			if (curl_errno($curl)) {
				echo 'Error:' . curl_error($curl); // Error handling
			}
			
			curl_close($curl);
			return $response;
		}
		
		public function CheckOrderStatus($order_id)
		{
			
			$curl = curl_init();
			
			curl_setopt_array($curl, array(
			CURLOPT_URL => $this->payment_api_url . '/pg/orders/' . $order_id,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
			'accept: application/json',
			'x-api-version: 2023-08-01',
			'x-client-id: ' . $this->app_id,
			'x-client-secret: ' . $this->app_secret
			),
			));
			
			$response = curl_exec($curl);
			
			curl_close($curl);
			
			$newresponse = json_decode($response);
			
			return $newresponse;
			
		}
		
		
		
		#For Calculating Distance Between 2 Pincodes
		function getCoordinatesNominatim($pincode) 
		{
			// URL for OpenStreetMap's Nominatim API with pincode and country (adjust country if needed)
			$url = "https://nominatim.openstreetmap.org/search?postalcode=$pincode&country=IN&format=json&limit=1";
			
			// Initialize cURL session
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			// Adding a user agent as required by Nominatim's policy
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MyUserAgent/1.0; +http://mywebsite.com/)");
			$response = curl_exec($ch);
			curl_close($ch);
			
			$data = json_decode($response, true);
			if (isset($data[0])) {
				return [
				'lat' => $data[0]['lat'],
				'lng' => $data[0]['lon']
				];
				} else {
				return null;
			}
		}
		
		function haversineDistance($coord1, $coord2) 
		{
			$earthRadius = 6371; // Earth's radius in kilometers
			
			$latFrom = deg2rad($coord1['lat']);
			$lonFrom = deg2rad($coord1['lng']);
			$latTo = deg2rad($coord2['lat']);
			$lonTo = deg2rad($coord2['lng']);
			
			$latDelta = $latTo - $latFrom;
			$lonDelta = $lonTo - $lonFrom;
			
			$a = sin($latDelta / 2) * sin($latDelta / 2) +
			cos($latFrom) * cos($latTo) *
			sin($lonDelta / 2) * sin($lonDelta / 2);
			
			$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
			
			return $earthRadius * $c; // returns distance in kilometers
		}
		
	}
