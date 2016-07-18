<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/9
 * Time: 19:24
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//后台登录验证

class Login_model extends CI_Model{



    //验证用户名是否存在
    public function check_username(){



    }


    //通过用户名获取密码
    public function check($username){

        $data=$this->db->get_where('admin',array('username'=>$username))->result_array();

        return $data;

    }


    //修改密码操作


}