<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Blog extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('blog/create_post', $this->template_data);
    }

    public function categories()
    {
        $this->load->view('blog/categories', $this->template_data);
    }

    function data_categories(){
  		$response = new stdClass;
  		$response->draw = $this->input->post('draw');

  		// $search = $this->input->post('search');
  		// $this->session->set_userdata('search', $search);
  		// $perpage = 10;
  		$this->db->select('count(A.id_category) as ccount', FALSE);
  		$this->db->from('categories A');
  		$q = $this->db->get()->row();
  		$response->recordsTotal = $q->ccount;

  		// $offset = $response->draw * $perpage;

  		$this->db->select('A.*');
  		$this->db->from('categories A');
  		// if($search['value']){
  		// }
  		$this->db->order_by('A.id_category', 'desc');
  		$this->db->limit($this->input->post('length'), $this->input->post('start'));
  		$results = $this->db->get()->result();

  		$response->recordsFiltered = $response->recordsTotal;

  		$response->data = array();
  		foreach($results as $row){
  			$data = array();
  			$data['id_category'] = $row->id_category;
  			$data['name_category'] = $row->name_category;

  			$response->data[] = $data;
  		}

  		$this->output->set_output(json_encode($response));
  	}

    public function create_category()
    {
        $this->load->view('blog/category_edit', $this->template_data);
    }

    public function save_category()
    {
  		$id = intval($this->input->post('id'));
  		$this->form_validation->set_rules('name_category', 'name_category', 'trim|required');
  		if($this->form_validation->run() === FALSE){
  			json_response(array('success' => FALSE, 'msg' => validation_errors()));
  		}else{
  			if($id === 0){
  				//check_permission('admin-add-permission');
  				$this->db->trans_begin();
  				$data = array(
  					'id_category' => intval($this->input->post('id')),
  					'name_category' => trim($this->input->post('name_category'))
  				);
  				$this->db->insert('categories', $data);

  				cxp_update_cache();
  				$this->db->trans_complete();

  				json_response(array('success' => TRUE, 'msg' => 'Categoria añadida correctamente'));
  			}else{
  				//check_permission('admin-edit-permission');
  				$this->db->trans_begin();
          $data = array(
  					'id_category' => intval($this->input->post('id')),
  					'name_category' => trim($this->input->post('name_category'))
  				);
  				$this->db->where('id_category', $id);
  				$this->db->update('categories', $data);

  				cxp_update_cache();
  				$this->db->trans_complete();

  				json_response(array('success' => TRUE, 'msg' => 'Categoria editada correctamente.'));
  			}

  		}
  	}

    public function edit_category(){
  		$id = intval($this->input->get('id'));
  		$this->db->where('id_category', $id);
  		$info = $this->db->get('categories')->row();
  		$this->template_data['info'] = $info;
  		// $this->load->library('Member_acl');
  		// $my_acl=new Member_acl();
  		// $my_acl->getAllPerms();
  		// $rPerms = $my_acl->getRolePerms($id);

  		// $this->template_data['rPerms'] = $rPerms;
  		$this->load->view('blog/category_edit', $this->template_data);
  	}

    public function delete_category(){
  		$id = intval($this->input->get('id'));
  		$this->db->trans_begin();

  		$this->db->where('id_category', $id);
  		$this->db->delete('categories');

  		$this->db->trans_complete();
  		cxp_update_cache();
  		json_response(array('success' => TRUE, 'msg' => 'Categoria eliminada correctamente.'));
  	}
}
