<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('Catalog_model');
		$data = $this->Catalog_model->showTin();

		$data = array("ShowTin" => $data); 
		$this->load->view('Catalog_view', $data, FALSE);
	}

	public function AddNew()
	{
		$title = $this->input->post('title');
		$description = $this->input->post('description');

		$this->load->model('Catalog_model');
		if($this->Catalog_model->insertTin($title, $description))
		{
			$this->load->view('thanhcong');
		}
	}

	public function DeleteNew($id)
	{
		$this->load->model('Catalog_model');
		if($this->Catalog_model->doDelete($id))
		{
			$this->load->view('thanhcong');
		}
	}

	public function EditNew($id)
	{
		// echo "<pre>";
		// var_dump($id); 
		// echo "</pre>";
		$this->load->model('Catalog_model');
		$data = $this->Catalog_model->EditTinID($id);
		$data = array('EditTin' => $data);
		$this->load->view('EditTin_view',$data,FALSE);
	}

	public function UpdateNewID($id)
	{
		$title = $this->input->post('title');
		$description = $this->input->post('description');

		
		$this->load->model('Catalog_model');

		if($this->Catalog_model->doEdit($id, $title, $description))
		{
			$this->load->view('thanhcong');
		}
	}

	public function UpdateNew_jquery()
	{
		$id = $this->input->post('id_edit');
		$title = $this->input->post('tendmsua');

		//Do day chi co 1 truong tendmsua o phan jquery 
		$description = $this->input->post('tendmsua');
		
		$this->load->model('Catalog_model');

		if($this->Catalog_model->doEdit($id, $title, $description))
		{
			$this->load->view('thanhcong');
		}
	}

	public function AddNew_jquery()
	{
		$title = $this->input->post('tendm');
		$description = $this->input->post('mota');

		$this->load->model('Catalog_model');
		$this->Catalog_model->insertTin($title, $description);
		echo json_encode($this->db->insert_id());

	}





}

/* End of file tintuc.php */
/* Location: ./application/controllers/tintuc.php */