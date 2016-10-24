<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/11
 * Time: 19:44
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        //载入模型
        $this->load->model('Login_model','login');
    }


    //加载登录页面
    public function index(){



        $this->load->view('admin/login.html');
    }

    //进行登陆密码验证
    public function check(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');


        //进行用户名验证
        if(!$this->login->check_username($username))
            error('用户名或密码错误');


        //用户名存在则进行密码获取，之后验证
        $data=$this->login->get_password($username);


        if (password_verify($password, $data['0']['password']))
        {

            //将用户信息存入session
            $sessionData=array(

                'username'=>$username,
                'uid'=>$data[0]['uid'],
                'logintime'=>time(),
                'degree'=>$data[0]['degree'],
            );
            $this->session->set_userdata($sessionData);


            //跳转到后台欢迎界面

            $this->load->view('admin/welcome.html');
        }
        else
            error("用户名或密码错误");








    }

    //退出登录
    public function login_out(){
        $this->session->sess_destroy();
        success('Login/index','退出成功');

    }


    public function add_user(){
        $name='adminfan';
        $password='550965989wd++l';
        $password=password_hash($password, PASSWORD_DEFAULT);
        $data=array(
            'username'=>$name,
            'password'=>$password,
            'degree'=>'2'


);
        $this->load->model('Login_model','login');
        $this->login->add($data);



    }



}