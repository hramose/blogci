<?php
/**
 * Login
 *
 * @author		Chaegumi
 * @copyright	Copyright (c) 2016~2099 cxpcms.com
 * @email		chaegumi@qq.com
 * @filesource
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
            $this->load->helper(array('server'));
            $this->load->library(array('Member_current_user'));
            include_once FCPATH.'resource/securimage/securimage.php';
            $securimage = new Securimage();

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($user = Member_Current_User::login($username, $password)) {
                $this->output->set_output(json_encode(array('success' => true, 'msg' => 'Ingreso exitoso')));
            } else {
                json_response(array('success' => false, 'msg' => 'Error al ingresar'));
            }
        } else {
            $this->load->view('login');
        }
    }

    // find password
    public function findpassword()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
            $this->load->helper(array('server'));
            include_once FCPATH.'resource/securimage/securimage.php';
            $securimage = new Securimage();
            if ($securimage->check($this->input->post('captcha_code')) === false) {
                json_response(array('success' => false, 'msg' => 'Error Captcha'));
            } else {
                $this->form_validation->set_rules('username', 'Username Or Email', 'trim|required');
                if ($this->form_validation->run() === false) {
                    json_response(array('success' => false, 'msg' => validation_errors()));
                } else {
                    $username = trim($this->input->post('username'));
                    $this->db->where('username', $username);
                    $this->db->or_where('email', $username);
                    $row = $this->db->get('users')->row();
                    if ($row) {
                        // send change password link email to user
                        json_response(array('success' => true, 'msg' => 'Información enviada correctamente.'));
                    } else {
                        json_response(array('success' => false, 'msg' => 'Usuario invalido'));
                    }
                }
            }
        } else {
            $this->load->view('findpassword');
        }
    }

    public function change_password()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
            $this->load->helper(array('server'));
            $this->form_validation->set_rules('password', 'New Password', 'trim|required');
            $this->form_validation->set_rules('confirmpassword', 'Confirm New Password', 'trim|required');
            if ($this->form_validation->run() === false) {
                json_response(array('success' => false, 'msg' => validation_errors()));
            } else {
                $user_id = intval($this->input->post('user_id'));
                $password = trim($this->input->post('password'));
                if ($user_id) {
                    $this->db->where('id', $user_id);
                    $data = array(
                        'password' => password_hash($password, PASSWORD_BCRYPT)
                    );
                    $this->db->update('users', $data);
                    json_response(array('success' => true, 'msg' => 'Contraseña actualizada correctamente.'));
                } else {
                    json_response(array('success' => false, 'msg' => 'Invalid'));
                }
            }
        } else {
            $user_id = intval($this->input->get('user_id'));
            $token_code = trim($this->input->get('token_code'));
            if ($user_id && $token_code) {
                $this->db->where('user_id', $user_id);
                $this->db->where('random_string', $token_code);
                $row = $this->db->get('forget_pwd')->row();
                if ($row) {
                    // valid link
                    // delete used rendom_string
                    $this->db->where('id', $row->id);
                    $this->db->delete('forget_pwd');
                    $data['success'] = true;
                    $data['message'] = '';
                    $data['user_id'] = $row->user_id;
                } else {
                    //
                    $data['success'] = false;
                    $data['message'] = 'Invalid Link';
                }
            } else {
                // invalid
                $data['success'] = false;
                $data['message'] = 'Invalid Link';
            }
            $this->load->view('changepassword', $data);
        }
    }
}
// end this file
