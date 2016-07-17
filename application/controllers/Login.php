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



        $this->load->view('admin/index.html');
    }

    //进行密码验证
    public function check(){



    }



}