<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/9
 * Time: 19:24
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//��̨��¼��֤

class Login_model extends CI_Model{



    //��֤�û����Ƿ����
    public function check_username(){



    }


    //ͨ���û�����ȡ����
    public function check($username){

        $data=$this->db->get_where('admin',array('username'=>$username))->result_array();

        return $data;

    }


    //�޸��������


}