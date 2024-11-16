<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['user_m', 'item_m', 'supplier_m', 'customer_m', 'sale_m']);
	}

	public function index()
	{
		$data = [
			'product' => 0,
			'item' => 0,
			'supplier' => 0,
			'user' => 0,
			'customer' => 0
		];
		try {
			//code...
			$data['product'] = @$this->sale_m->sale_detail()->result() ?? 0;
			$data['item'] = @$this->item_m->get()->result() ?? 0;
			$data['jmlitem'] = @$this->item_m->get()->num_rows();
			$data['supplier'] = @$this->supplier_m->get()->result() ?? 0;
			$data['jmlsupplier'] = @$this->supplier_m->get()->num_rows();
			$data['user'] = @$this->user_m->list()->result() ?? 0;
			$data['jmluser'] = @$this->user_m->get()->num_rows();
			$data['customer'] = @$this->customer_m->get()->result() ?? 0;
			$data['jmlcustomer'] = @$this->customer_m->get()->num_rows();
			// var_dump($data['product']);
			
		} catch (\Throwable $th) {
			//throw $th;
		}
			// var_dump($data); die;

		$this->template->load('template', 'dashboard', $data);
	}
}
