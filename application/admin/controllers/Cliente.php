<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->load->view('cliente/clientes.php');
  }

  function data_cliente(){

    //instanciamos la clase stdClass
    $response = new stdClass;
    $response->draw = $this->input->post('draw');

    // $search = $this->input->post('search');
    // $this->session->set_userdata('search', $search);
    // $perpage = 10;

    $this->db->select('count(A.id_cliente) as ccount', FALSE);
    $this->db->from('clientes A');
    $q = $this->db->get()->row();
    $response->recordsTotal = $q->ccount;

    // $offset = $response->draw * $perpage;

    $this->db->select('A.*');
    $this->db->from('clientes A');
    // if($search['value']){
    // }
    $this->db->order_by('A.id_cliente', 'desc');
    $this->db->limit($this->input->post('length'), $this->input->post('start'));
    $results = $this->db->get()->result();

    $response->recordsFiltered = $response->recordsTotal;

    $response->data = array();
    foreach($results as $row){
      $data = array();
      $data['id_cliente'] = $row->id_cliente;
      $data['nombre_cliente'] = $row->nombre_cliente;
      $data['dni_cliente'] = $row->dni_cliente;
      $data['telefono_cliente'] = $row->telefono_cliente;
      $data['direccion_cliente'] = $row->direccion_cliente;
      $data['observaciones_cliente'] = $row->observaciones_cliente;

      $response->data[] = $data;
    }

    $this->output->set_output(json_encode($response));
  }

  function cliente_edit()
  {
    //tomamos ID del input ID
    $id = intval($this->input->get('id'));

    //especificamos el campo a relacionar(id_cliente) y la tabla(clientes)
    $this->db->where('id_cliente', $id);
    $info = $this->db->get('clientes')->row();

    //creamos un array con todos los datos obtenidos
    $this->template_data['info'] = $info;
    // $this->load->library('Member_acl');
    // $my_acl=new Member_acl();
    // $my_acl->getAllPerms();
    // $rPerms = $my_acl->getRolePerms($id);

    // $this->template_data['rPerms'] = $rPerms;

    $this->load->view('cliente/cliente_edit', $this->template_data);
  }

  public function save_cliente()
  {
    // tomamos ID del input ID
    $id = intval($this->input->post('id'));

    // establecemos paramentros de validaciones
    $this->form_validation->set_rules('nombre_cliente', 'nombre_cliente', 'trim|required');
    $this->form_validation->set_rules('dni_cliente', 'dni_cliente', 'trim|required');
    $this->form_validation->set_rules('telefono_cliente', 'telefono_cliente', 'trim|required');
    $this->form_validation->set_rules('direccion_cliente', 'direccion_cliente', 'trim|required');

    // iniciamos validacion
    if($this->form_validation->run() === FALSE){
      // si hay algo mal explica por qué
      json_response(array('success' => FALSE, 'msg' => validation_errors()));
    }else{
      // si esta todo bien comienza la inserción

      //si es un ID nuevo ingresaremos los datos
      if($id === 0){
        //check de permiso

        //check_permission('admin-add-permission');

        //comienza la consulta
        $this->db->trans_begin();

        //declaramos los datos a insertar
        $data = array(
          'id_cliente' => intval($this->input->post('id')),
          'nombre_cliente' => trim($this->input->post('nombre_cliente')),
          'dni_cliente' => trim($this->input->post('dni_cliente')),
          'telefono_cliente' => trim($this->input->post('telefono_cliente')),
          'direccion_cliente' => trim($this->input->post('direccion_cliente')),
          'observaciones_cliente' => trim($this->input->post('observaciones_cliente'))
        );

        //especificamos a que tabla insertaremos los datos
        $this->db->insert('clientes', $data);

        //actualizamos caché
        cxp_update_cache();

        //transaccion completada
        $this->db->trans_complete();

        //Damos el mensaje de que salio todo bien.
        json_response(array('success' => TRUE, 'msg' => 'Cliente añadido correctamente'));

        //Si es un id existente actualizamos los datos
      }else{

        //check de permisos
        //check_permission('admin-edit-permission');

        //comienza la consulta
        $this->db->trans_begin();

        //declaramos los datos a insertar
        $data = array(
          'id_cliente' => intval($this->input->post('id')),
          'nombre_cliente' => trim($this->input->post('nombre_cliente')),
          'dni_cliente' => trim($this->input->post('dni_cliente')),
          'telefono_cliente' => trim($this->input->post('telefono_cliente')),
          'direccion_cliente' => trim($this->input->post('direccion_cliente')),
          'observaciones_cliente' => trim($this->input->post('observaciones_cliente'))
        );

        //especificamos id a actualizar y tabla
        $this->db->where('id_cliente', $id);
        $this->db->update('clientes', $data);


        //actualizamos cache y damos por terminada la actualizacion
        cxp_update_cache();
        $this->db->trans_complete();

        //mensaje de que esta todo bien.
        json_response(array('success' => TRUE, 'msg' => 'Cliente editado correctamente.'));
      }

    }
  }

  public function delete_cliente(){
    //tomamos ID del input ID
    $id = intval($this->input->get('id'));

    //comienza la consulta
    $this->db->trans_begin();

    //especificamos el campo a relacionar(id_category) y la tabla(categories)
    $this->db->where('id_cliente', $id);
    $this->db->delete('clientes');

    //consulta terminada, actualizamos cache y damos el mensaje de que esta todo ok.
    $this->db->trans_complete();
    cxp_update_cache();
    json_response(array('success' => TRUE, 'msg' => 'Cliente eliminado correctamente.'));
    
  }
}
