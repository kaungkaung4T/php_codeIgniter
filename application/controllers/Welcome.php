<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Welcome extends CI_Controller
{

	private $notify_url = "http://test.com/payment/notify";
	private $sign_type = "SHA256";
	private $merch_code = "200215";
	private $app_id = "kp50ef8b66031f492796f015994d00af";
	private $trade_type = "PAY_BY_QRCODE";
	private $trans_currency = "MMK";
	private $api_key = "Ssmall@12345";

	/// Method    
	private $create_order_method = "kbz.payment.precreate";
	private $query_order_method = "kbz.payment.queryorder";

	/// Version
	private $create_order_version = "1.0";
	private $query_order_version = "3.0";

	/// API
	private $create_order_api = "http://api.kbzpay.com/payment/gateway/uat/precreate";
	private $query_order_api = "http://api.kbzpay.com/payment/gateway/uat/queryorder";
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function test()
	{
		$this->load->helper("form");
		$this->load->library('session');

		$a = $this->input->post('money');

		$amount = $this->input->post('amount');
		$id = $this->input->post('id');

		if ($a == "kpay") {
			$this->session->set_flashdata('amount', $amount);
			$this->session->set_flashdata('id', $id);
			redirect('work', 'refresh');
			
		}
		else if ($a == "bank") {
			redirect('success', "refresh");
		}



		$this->load->view("test");
	}


	public function success() {
		$this->load->view("success");
	}



	public function work()
	{	$this->load->library('session');
		$data = [
			'title' => 'Example Kpay QR Code',
			'message' => '',
		];

		$this->load->view("work", $data);
	}


	private function getRandomString($n)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';

		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}

		return $randomString;
	}

	public function createOrder()
	{
		$utc_in_second = new DateTime("now");
		$format_utc_in_second =  (int)$utc_in_second->format('U');
		$nonce_string = (string)$this->getRandomString(32);

		//// POST DATA
		$merch_order_id = (string)$_POST['merch_order_id'];
		$total_amount = (string)$_POST['total_amt'];

		$form_data = array(
			"Request" => array(
				"timestamp" => $format_utc_in_second,
				"method" => $this->create_order_method,
				"notify_url" => $this->notify_url,
				"nonce_str" => $nonce_string,
				"sign_type" => $this->sign_type,
				"sign" => "",
				"version" => $this->create_order_version,
				"biz_content" => array(
					"merch_order_id" => $merch_order_id,
					"merch_code" => $this->merch_code,
					"appid" => $this->app_id,
					"trade_type" => $this->trade_type,
					"total_amount" => $total_amount,
					"trans_currency" => $this->trans_currency
				)
			)
		);

		$stringA = "appid=" . $this->app_id . "&merch_code=" . $this->merch_code . "&merch_order_id=" . $merch_order_id . "&method=" . $this->create_order_method . "&nonce_str=" . $nonce_string . "&notify_url=" . $this->notify_url . "&timestamp=" . $format_utc_in_second . "&total_amount=" . $total_amount . "&trade_type=" . $this->trade_type . "&trans_currency=" . $this->trans_currency . "&version=" . $this->create_order_version . "";

		$stringToSign = $stringA . "&key=" . $this->api_key;

		$sign = (string)strtoupper(hash("sha256", $stringToSign));

		$form_data["Request"]["sign"] = $sign; /// push sign to form_data

		// echo json_encode($form_data);

		/* eCurl */
		$curl = curl_init($this->create_order_api);

		/* Set JSON data to POST */
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($form_data));

		/* Define content type */
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

		/* Return json */
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		/* make request */
		$response = curl_exec($curl);

		/* close curl */
		curl_close($curl);

		echo $response;
		//    return view('FormView\form', json_encode($response));
	}

	public function queryOrder()
	{
		$utc_in_second = new DateTime("now");
		$format_utc_in_second =  (int)$utc_in_second->format('U');
		$nonce_string = (string)$this->getRandomString(32);

		//// POST DATA
		$callback_merch_order_id =  (string)$_POST['merch_order_id'];

		$form_data = array(
			"Request" => array(
				"timestamp" => $format_utc_in_second,
				"nonce_str" => $nonce_string,
				"method" => $this->query_order_method,
				"nonce_str" => $nonce_string,
				"sign_type" => $this->sign_type,
				"sign" => "",
				"version" => $this->query_order_version,
				"biz_content" => array(
					"appid" => $this->app_id,
					"merch_code" => $this->merch_code,
					"merch_order_id" => $callback_merch_order_id,
				)
			)
		);

		$stringA = "appid=" . $this->app_id . "&merch_code=" . $this->merch_code . "&merch_order_id=" . $callback_merch_order_id . "&method=" . $this->query_order_method . "&nonce_str=" . $nonce_string . "&timestamp=" . $format_utc_in_second . "&version=" . $this->query_order_version . "";

		$stringToSign = $stringA . "&key=" . $this->api_key;

		$sign = (string)strtoupper(hash("sha256", $stringToSign));

		$form_data["Request"]["sign"] = $sign; /// push sign to form_data

		/* eCurl */
		$curl = curl_init($this->query_order_api);

		/* Set JSON data to POST */
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($form_data));

		/* Define content type */
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

		/* Return json */
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		/* make request */
		$response = curl_exec($curl);

		/* close curl */
		curl_close($curl);

		echo $response;
	}
}
