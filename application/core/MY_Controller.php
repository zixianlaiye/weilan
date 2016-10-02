<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/24
 * Time: 16:40
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//自定义类，用来判断权限等问题
class MY_Controller extends CI_Controller{
    public function __construct(){
        parent::__construct();

        //检查是否有用户名和密码
        $username=$this->session->userdata('username');
        $uid=$this->session->userdata('uid');

        //若不存在用户名和密码，则踢出
        if(!$username||!$uid)
        {
            redirect('Login/index');
        }

    }

}

