<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->user->on_invalid_session('auth');
    }

	public function index($offset=0)
	{
        $this->load->library('pagination');

        $per_page             = $this->config->item('pagination_page_limit');
        $templates            = $this->templates->getList($offset, $per_page);
        $template_total       = (int) $this->templates->getTotal();

        $config['base_url']   = site_url('template/index');
        $config['total_rows'] = $template_total;
        $config['per_page']   = $per_page;

        $this->pagination->initialize($config);

        $data['templates']    = $templates;

		$this->load->view('common/header');
		$this->load->view('template/index', $data);
		$this->load->view('common/footer');
	}

    public function search($query="", $offset=0)
    {
        $search = $this->input->post('search');
        if(empty($search)) {
            $search = $query;
        }

        if(empty($search)) {
            redirect('template');
        }

        $data['search'] = $search;

        $this->load->library('pagination');

        $per_page              = $this->config->item('pagination_page_limit');
        $templates             = $this->templates->getList($offset, $per_page, $search);
        $template_total        = (int) $this->templates->getTotal($search);

        $config['base_url']    = site_url('template/search/'.$search);
        $config['uri_segment'] = 4;
        $config['total_rows']  = $template_total;
        $config['per_page']    = $per_page;

        $this->pagination->initialize($config);

        $data['templates']     = $templates;

        $this->load->view('common/header');
        $this->load->view('template/index', $data);
        $this->load->view('common/footer');
    }

    public function add()
    {
		$this->load->view('common/header');
		$this->load->view('template/form-template');
		$this->load->view('common/footer');
    }

    public function edit($id)
    {
        $data['detail'] = $this->templates->getDetail($id);

		$this->load->view('common/header');
		$this->load->view('template/form-template', $data);
		$this->load->view('common/footer');
    }

    public function save()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('title', 'Nama', 'trim|required');
        $this->form_validation->set_rules('content', 'Nomor Utama', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="important">', '</div>');

        if ($this->form_validation->run() == FALSE){
            if($id != "X"){
              return $this->edit($id);
            } else {
              return $this->add();
            }
        } else {
            $data            = array();
            $data['title']   = $this->input->post('title');
            $data['content'] = $this->input->post('content');

            if($id == 'X'){
              $id = $this->templates->add($data);
            } else {
              $this->templates->edit($id, $data);
            }

            $this->session->set_flashdata('notif_type', 'success');
            $this->session->set_flashdata('notif_text', 'Data berhasil disimpan');

            redirect('template/edit/'.$id);
        }
    }

    public function delete($id)
    {
        $result = $this->templates->delete($id);

        if($result) {
            $this->session->set_flashdata('notif_type', 'info');
            $this->session->set_flashdata('notif_text', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('notif_type', 'error');
            $this->session->set_flashdata('notif_text', 'Data gagal dihapus');
        }

        redirect('template');
    }

}
