<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addressbook extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->user->on_invalid_session('auth');
    }

	public function index($offset=0)
	{
        $this->load->library('pagination');

        $per_page             = $this->config->item('pagination_page_limit');
        $contacts             = $this->contact->getList($offset, $per_page);
        $contact_total        = (int) $this->contact->getTotal();

        $config['base_url']   = site_url('addressbook/index');
        $config['total_rows'] = $contact_total;
        $config['per_page']   = $per_page;

        $this->pagination->initialize($config);

        $data['contacts']     = $contacts;

		$this->load->view('common/header');
		$this->load->view('addressbook/index', $data);
		$this->load->view('common/footer');
	}

    public function add()
    {
        $data['groups'] = json_encode($this->contactgroup->getUserGroup());

		$this->load->view('common/header');
		$this->load->view('addressbook/form-contact', $data);
		$this->load->view('common/footer');
    }

    public function edit($id)
    {
        $data['detail'] = $this->contact->getDetail($id);
        $data['groups'] = json_encode($this->contactgroup->getUserGroup($id));

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
            $data              = array();
            $data['name']      = $this->input->post('name');
            $data['primary']   = $this->input->post('primary');
            $data['alternate'] = $this->input->post('alternate');
            $data['address']   = $this->input->post('address');
            $data['email']     = $this->input->post('email');
            $data['group']     = $this->input->post('group');

            if($id == 'X'){
              $id = $this->contact->add($data);
            } else {
              $this->contact->edit($id, $data);
            }

            $this->session->set_flashdata('notif_type', 'success');
            $this->session->set_flashdata('notif_text', 'Data berhasil disimpan');

            redirect('addressbook/edit/'.$id);
        }
    }

    public function delete($user_id)
    {
        $result = $this->contact->delete($user_id);

        if($result) {
            $this->session->set_flashdata('notif_type', 'info');
            $this->session->set_flashdata('notif_text', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('notif_type', 'error');
            $this->session->set_flashdata('notif_text', 'Data gagal dihapus');
        }

        redirect('addressbook');
    }

    public function import()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('import_file'))
        {
            echo "error";
        }
        else
        {
            $data = $this->upload->data();
            $this->load->library('csvreader');
            $filePath = $data["full_path"];

            $csvData = $this->csvreader->parse_file($filePath, true);

            foreach($csvData as $row)
            {
                $data              = array();
                $data['name']      = $row["Name"];
                $data['primary']   = $row["Number"];
                $data['alternate'] = $row["Alternate"];
                $data['address']   = $row["Address"];
                $data['email']     = $row["Email"];
                $result = $this->contact->importCSV($data);
                // var_dump($result);
                //if(!$result) {
                    //break;
                //}
            }
            // exit;

            $this->session->set_flashdata('notif_type', 'success');
            $this->session->set_flashdata('notif_text', 'Data berhasil diimpor');
        }


        redirect('addressbook');
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
