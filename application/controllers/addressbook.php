<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addressbook extends CI_Controller {

   public function __construct()
   {
        parent::__construct();
        $this->user->on_invalid_session('auth');
   }

	public function index()
	{
        $data['contacts'] = $this->contact->getList();

		$this->load->view('common/header');
		$this->load->view('addressbook/index', $data);
		$this->load->view('common/footer');
	}

    public function add()
    {
		$this->load->view('common/header');
		$this->load->view('addressbook/form-contact');
		$this->load->view('common/footer');
    }

    public function edit($id)
    {
        $data['detail'] = $this->contact->getDetail($id);

		$this->load->view('common/header');
		$this->load->view('addressbook/form-contact', $data);
		$this->load->view('common/footer');
    }

    public function save()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('name', 'Nama', 'trim|required');
        $this->form_validation->set_rules('primary', 'Nomor Utama', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="important">', '</div>');

        if ($this->form_validation->run() == FALSE){
            if($id != "X"){
              return $this->edit($id);
            } else {
              return $this->add();
            }
        } else {
            $data = array();
            $data['name'] = $this->input->post('name');
            $data['primary'] = $this->input->post('primary');
            $data['alternate'] = $this->input->post('alternate');
            $data['address'] = $this->input->post('address');
            $data['email'] = $this->input->post('email');

            if($id == 'X'){
              $id = $this->contact->add($data);
            } else {
              $this->contact->edit($id, $data);
            }

            redirect('addressbook/edit/'.$id);
        }
    }

    public function ajaxListSearch()
    {
        $query = $this->input->post('q', TRUE);

        $search = $this->contact->ajaxListSearch($query);
        header('Content-type: application/json');
        echo json_encode($search);
    }

	public function ajaxListSearch2()
	{
        $query = $this->input->post('q', TRUE);

        $search_contacts = $this->contact->ajaxListSearch($query);
		$search_groups = $this->contact->ajaxListGroupSearch($query);

		$search_merged = array_merge($search_contacts, $search_groups);

        header('Content-type: application/json');
        echo json_encode($search_merged);
	}
}
