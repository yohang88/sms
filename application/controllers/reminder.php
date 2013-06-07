<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reminder extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->user->on_invalid_session('auth');
    }

	public function index($offset=0)
	{
        $this->load->library('pagination');

        $per_page             = $this->config->item('pagination_page_limit');
        $reminders            = $this->reminders->getList($offset, $per_page);
        $reminder_total       = (int) $this->reminders->getTotal();

        $config['base_url']   = site_url('reminder/index');
        $config['total_rows'] = $reminder_total;
        $config['per_page']   = $per_page;

        $this->pagination->initialize($config);

        $data['reminders']    = $reminders;

		$this->load->view('common/header');
		$this->load->view('reminder/index', $data);
		$this->load->view('common/footer');
	}

    public function search($query="", $offset=0)
    {
        $search = $this->input->post('search');
        if(empty($search)) {
            $search = $query;
        }

        if(empty($search)) {
            redirect('reminder');
        }

        $data['search'] = $search;

        $this->load->library('pagination');

        $per_page              = $this->config->item('pagination_page_limit');
        $reminders             = $this->reminders->getList($offset, $per_page, $search);
        $reminder_total        = (int) $this->reminders->getTotal($search);

        $config['base_url']    = site_url('reminder/search/'.$search);
        $config['uri_segment'] = 4;
        $config['total_rows']  = $reminder_total;
        $config['per_page']    = $per_page;

        $this->pagination->initialize($config);

        $data['reminders']     = $reminders;

        $this->load->view('common/header');
        $this->load->view('reminder/index', $data);
        $this->load->view('common/footer');
    }

    public function add()
    {
		$this->load->view('common/header');
		$this->load->view('reminder/form-reminder');
		$this->load->view('common/footer');
    }

    public function edit($id)
    {
        $data['detail'] = $this->reminders->getDetail($id);

		$this->load->view('common/header');
		$this->load->view('reminder/form-reminder', $data);
		$this->load->view('common/footer');
    }

    public function save()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('name', 'Nama', 'trim|required');
        $this->form_validation->set_rules('receiver', 'Nomor', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="important">', '</div>');

        if ($this->form_validation->run() == FALSE){
            if($id != "X"){
              return $this->edit($id);
            } else {
              return $this->add();
            }
        } else {
            $data             = array();
            $data['name']     = $this->input->post('name');
            $data['receiver'] = $this->input->post('receiver');

            if($id == 'X'){
              $id = $this->reminders->add($data);
            } else {
              $this->reminders->edit($id, $data);
            }

            $this->session->set_flashdata('notif_type', 'success');
            $this->session->set_flashdata('notif_text', 'Data berhasil disimpan');

            redirect('reminder/edit/'.$id);
        }
    }

    public function delete($user_id)
    {
        $result = $this->reminders->delete($user_id);

        if($result) {
            $this->session->set_flashdata('notif_type', 'info');
            $this->session->set_flashdata('notif_text', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('notif_type', 'error');
            $this->session->set_flashdata('notif_text', 'Data gagal dihapus');
        }

        redirect('reminder');
    }

    public function import()
    {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['encrypt_name']  = true;

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

            ini_set('auto_detect_line_endings',TRUE);
            $csvData = $this->csvreader->parse_file($filePath, true);

            foreach($csvData as $row)
            {
                $data             = array();
                $data['name']     = trim($row["Name"]);
                $data['receiver'] = $row["Number"];
                $data['datedue']  = $row["Date"];

                $result = $this->reminders->importCSV($data);
            }

            $this->session->set_flashdata('notif_type', 'success');
            $this->session->set_flashdata('notif_text', 'Data berhasil diimpor');
        }


        redirect('reminder');
    }

}
