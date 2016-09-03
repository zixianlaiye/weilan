<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/12
 * Time: 22:01
 */


defined('BASEPATH') OR exit('No direct script access allowed');


//��Ŀ�������ҳ��
class Category extends CI_Controller{


    //构造函数，载入模型
    public function Category(){

        parent::__construct();
        $this->load->model('Category_model','cate');
    }

    //添加项目跳转页面
    public function add_category(){

        $this->load->view('admin/add-category.html');
    }


    //新增栏目动作
    public function add(){

        $cname=$this->input->post('cname');
        $data=array(
            'cname'=>$cname
        );

        //返回提示

        if($this->cate->add_category($data))

              error('添加失败');
        else
             show('添加成功');


    }

    //进入项目修改界面
    public function check_category(){
        $data['category']=$this->cate->get_category();


        $this->load->view('admin/change-category.html',$data);
    }


    //跳转到修改界面
    public function edit_category()
    {
        $cid=$_GET['cid'];
        $data['category']=$this->cate->get($cid);
        $this->load->view('admin/edit-category.html',$data);
    }

    //修改项目操作
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

    //通过项目cid删除项目

    public function delete(){
        $cid=$_GET['cid'];

        if($this->cate->delete_category($cid))
            error('删除失败');
        else
            success('login/index','删除成功');


    }

    //显示全部栏目
    public function show(){

       $data= $this->cate->get_category();
        echo json_encode($data);

    }
    //通过cid显示某一栏目
    public function cid_category()
    {
        $cid=$_GET['cid'];
        $data=$this->cate->get($cid);
        if(empty($data))
            echo 'error';
        else
        echo json_encode($data);
    }



}