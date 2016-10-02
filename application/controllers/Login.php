<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/11
 * Time: 19:44
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{


    //加载登录页面
    public function index(){



        $this->load->view('admin/add-category.html');
    }

    //进行密码验证
    public function check(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $c=md5($password);
        $data=array(

            'username'=>$username,
            'password'=>md5($password),
            'a'=>$c
        );


        //用户名验证模型，首先验证用户名是否存在，若存在则在进行密码验证操作



    }



}