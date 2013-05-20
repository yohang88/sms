<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {

   public function __construct()
   {
        parent::__construct();
        $this->user->on_invalid_session('auth');
   }

	public function index($offset=0)
	{
        $this->load->library('pagination');

        $per_page             = $this->config->item('pagination_page_limit');
        $groups               = $this->contactgroup->getList($offset, $per_page);
        $group_total          = (int) $this->contactgroup->getGroupCount();

        $config['base_url']   = site_url('group/index');
        $config['total_rows'] = $group_total;
        $config['per_page']   = $per_page;

        $this->pagination->initialize($config);

        $data['groups'] = $groups;

		$this->load->view('common/header');
		$this->load->view('group/index', $data);
		$this->load->view('common/footer');
	}

    public function memberlist($group_id, $offset=0)
    {
        $this->load->library('pagination');

        $per_page              = $this->config->item('pagination_page_limit');
        $members               = $this->contactgroup->getMemberList($group_id, $offset, $per_page);
        $member_total          = (int) $this->contactgroup->getMemberCount($group_id);

        $config['base_url']    = site_url('group/memberlist/'.$group_id);
        $config['uri_segment'] = 4;
        $config['total_rows']  = $member_total;
        $config['per_page']    = $per_page;

        $this->pagination->initialize($config);

        $data['members'] = $members;
        $data['group_id'] = $group_id;

		$this->load->view('common/header');
		$this->load->view('group/memberlist', $data);
		$this->load->view('common/footer');
    }

    public function ajaxListSearch($group)
    {
        $query = $this->input->post('q', TRUE);

        $search = $this->contactgroup->ajaxListSearch($group, $query);
        header('Content-type: application/json');
        echo json_encode($search);
    }

    public function getDetail($id)
    {
        $sql = "
            SELECT *
            FROM sms_groups
            WHERE `id` = '".$id."'
        ";

        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function add()
    {
		$this->load->view('common/header');
		$this->load->view('group/form-group');
		$this->load->view('common/footer');
    }

    public function edit($id)
    {
        $data['detail'] = $this->contactgroup->getDetail($id);

		$this->load->view('common/header');
		$this->load->view('group/form-group', $data);
		$this->load->view('common/footer');
    }

    public function save()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('name', 'Nama', 'trim|required');
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

            if($id == 'X'){
              $id = $this->contactgroup->add($data);
            } else {
              $this->contactgroup->edit($id, $data);
            }

            redirect('group/edit/'.$id);
        }
    }

    public function addmember()
    {
        $group_id = $this->input->post('group_id');
        $user_ids = $this->input->post('numbers');
        $user_ids = explode(',', $user_ids);

        foreach($user_ids as $user_id) {
           $this->contactgroup->addmember($group_id, $user_id);
        }

        redirect('group/memberlist/'.$group_id);
    }
}
