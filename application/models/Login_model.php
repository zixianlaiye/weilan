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
    public function check_username($name){


            $this->db->select('username');
            $this->db->from('admin');
            $this->db->where('username',$name);
            $data=$this->db->count_all_results();
            if($data==1)
                return true;
        else
            return false;







    }


    //ͨ���û�����ȡ����
    public function get_password($username){

        $data=$this->db->get_where('admin',array('username'=>$username))->result_array();

        return $data;


    }

    //�����û�����
    public function add($data){
        $this->db->insert('admin',$data);


    }


    //�޸��������


}