<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/12
 * Time: 22:01
 */


defined('BASEPATH') OR exit('No direct script access allowed');


//项目分类管理页面
class Category extends CI_Controller{


    //将模型载入写进构造函数
    public function Category(){

        parent::__construct();
        $this->load->model('Category_model','cate');
    }

    //新增栏目界面跳转
    public function add_category(){

        $this->load->view('admin/add-category.html');
    }


    //新增栏目
    public function add(){

        $cname=$this->input->post('cname');
        $data=array(
            'cname'=>$cname
        );

        //调用模型进行修改

        if($this->cate->add_category($data))

            echo '0';
        else
            echo '1';


    }

    //查看栏目页面跳转
    public function check_category(){

        $this->load->view('admin/check-category.html');
    }


    //修改栏目跳转
    public function edit_category()
    {
        $this->load->view('admin/edit-category.html');
    }

    //修改栏目
    public function change(){

        $cid=$_GET['cid'];
        $cname=$_GET['cname'];
        $data=array(
            'cname'=>$cname
        );

        if($this->cate->change_category($cid,$data))
            echo '0';
        else
            echo'1';

    }

    //删除栏目

    public function delete(){
        $cid=$_GET['cid'];

        if($this->cate->delete_category($cid))
            echo'0';
        else
            echo'1';


    }

    //查看所有栏目
    public function show(){

       $data= $this->cate->get_category();
        echo json_encode($data);

    }



}