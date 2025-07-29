<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Affiliate extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		$data = array();
		$data['page_title'] = "Affiliate Settings";
		$data['page'] = "Affiliate";
		$data['main_content'] = $this->load->view('backend/affiliate/admin_home', $data, TRUE);
		$this->load->view('backend/index', $data);
	}

	public function payout_request()
	{
		$data = array();
		$data['page_title'] = "Payout Request";
		$data['page'] = "Affiliate";
		$data['main_content'] = $this->load->view('backend/affiliate/payout_request', $data, TRUE);
		$this->load->view('backend/index', $data);
	}

	public function user()
	{
		$data = array();
		$data['page_title'] = "Payout Request";
		$data['page'] = "Affiliate";
		$data['main_content'] = $this->load->view('backend/affiliate/user_home', $data, TRUE);
		$this->load->view('backend/index', $data);
	}

	public function add_affiliate_config(){
		is_test();
		$this->form_validation->set_rules('commision_rate', lang('commision_rate'), 'trim|xss_clean|required');
		$this->form_validation->set_rules('commision_type', lang('commision_type'), 'trim|xss_clean|required');
		$this->form_validation->set_rules('minimum_payout', lang('minimum_payout'), 'trim|xss_clean|required');
		$this->form_validation->set_rules('payment_method', lang('payment_method'), 'trim|xss_clean|required');
		$this->form_validation->set_rules('referal_guidelines', lang('referal_guidelines'), 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('admin/affiliate/'));
			}else{	
				$checkData = array(
					'commision_rate' => $this->input->post('commision_rate',TRUE),
					'commision_type' => $this->input->post('commision_type',TRUE),
					'minimum_payout' => $this->input->post('minimum_payout',TRUE),
					'payment_method' => $this->input->post('payment_method',TRUE),
					'referal_guidelines' => $this->input->post('referal_guidelines'),
					'is_affiliate' => isset($_POST['is_affiliate'])?1:0,
				);
	
				$insert = __check($checkData); 

				if($insert){
					$this->session->set_flashdata('success', !empty(lang('success_text'))?lang('success_text'):'Save Change Successful');
					redirect(base_url('admin/affiliate'));
				}else{
					$this->session->set_flashdata('error', !empty(lang('error_text'))?lang('error_text'):'Somethings Were Wrong!!');
					redirect(base_url('admin/affiliate'));
				}	
		}
	}

}