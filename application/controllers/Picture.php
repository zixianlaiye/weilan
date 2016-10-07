<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/2
 * Time: 21:51
 */
defined('BASEPATH') OR exit('No direct script access allowed');

//关于轮播图项目的各种操作
class  Picture extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        //载入model层，简写为pic
        $this->load->model('Picture_model','pic');

    }

    public function add_view(){
        //载入添加轮播图视图
        $this->load->view('admin/add-picture.html');

    }

    public function picture_list(){
        //加载轮播图项目列表
        $this->load->view('admin/picture-list.html');

    }
    public function check_view(){
        //轮播图项目具体信息查看

        $this->load->view('admin/check-picture.html');
    }

    public function edit_view(){
        //轮播图项目修改项目内容
        $this->load->view('admin/picture-list.html');
    }


    public function add(){
        $name= $this->input->post('name');
        $phone= $this->input->post('phone');
        $email= $this->input->post('email');
        $connecter= $this->input->post('connecter');
        $description= $this->input->post('description');
        $name= $this->input->post('name');





    }

    public function edit(){

    }

    public function delete(){


    }





}