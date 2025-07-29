<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Xendit\Xendit;
use Xendit\Invoice;
class Test extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function date(){
		$this->load->helper('date');

		// Set the locale to Arabic (Saudi Arabia)
		setlocale(LC_TIME, 'ar_AR');

		// Get the current datetime
		$datetime = now();

		// Format the datetime as per your requirements
		$formatted_datetime = strftime("%A, %d %B %Y %H:%M:%S", $datetime);

		// Display the formatted datetime
		echo $formatted_datetime;
	}

	public function changeDigitsEtoB( $digits ) {
		$bangla = numfmt_format(numfmt_create( 'bn_BD', NumberFormatter::TYPE_DEFAULT ),$digits); //Bangla locale
		return $bangla;
	}

	public function export() {
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');

        $query = $this->db->query("SELECT * FROM your_table"); // Replace 'your_table' with your table name
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);

        $filename = "export.csv";
        force_download($filename, $data);
    }



	public function ln()
	{

	$fmt = datefmt_create(
	    'en_US',
	    IntlDateFormatter::FULL,
	    IntlDateFormatter::FULL,
	    'America/Los_Angeles',
	    IntlDateFormatter::GREGORIAN
	);
	$arr = datefmt_localtime($fmt, 'Wednesday, December 31, 1969 4:00:00 PM PT', 0);
	echo 'First parsed output is ';
	if ($arr) {
	    foreach ($arr as $key => $value) {
	        echo "$key : $value , ";
	    }
	}

exit();

		echo $this->changeDigitsEtoB('sunday');
		exit();
		$i = $this->admin_m->get_top_ln();
		echo "<pre>";print_r($i);exit();
		
	}

	public function index()
	{
		Xendit::setApiKey('xnd_development_P4qDfOss0OCpl8RtKrROHjaQYNCk9dN5lSfk+R1l9Wbe+rSiCwZ3jw==');
		
		$params = [
			'external_id' => uid(),
		    'amount' => 100000,  // Amount in your currency's smallest unit (e.g., cents)
		    'payer_email' => 'payer@example.com',
		    'description' => 'Payment for Order #123',
		    'slug' => 'phplime',
		    'account_slug' => 'trial',
		    'callback_url' => base_url('phplime'),
		];

		$invoice = Invoice::create($params);
		if(!empty($invoice['invoice_url'])){
			redirect($invoice['invoice_url']);

			$callbackUrlParams = [
				'url' => base_url('phplime'),
			];
			$callbackType = 'invoice';
			$setCallbackUrl = \Xendit\Platform::setCallbackUrl($callbackType, $callbackUrlParams);
			var_dump($setCallbackUrl); exit();


		}else{
			echo "Sorry Somethings is wrong!!";
		}


		

		
	}

}

/* End of file Test.php */
/* Location: ./application/controllers/Test.php */