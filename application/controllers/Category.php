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


    //��ģ������д�����캯��
    public function Category(){

        parent::__construct();
        $this->load->model('Category_model','cate');
    }

    //������Ŀ������ת
    public function add_category(){

        $this->load->view('admin/add-category.html');
    }


    //������Ŀ
    public function add(){

        $cname=$this->input->post('cname');
        $data=array(
            'cname'=>$cname
        );

        //����ģ�ͽ����޸�

        if($this->cate->add_category($data))

            echo '0';
        else
            echo '1';


    }

    //�鿴��Ŀҳ����ת
    public function check_category(){

        $this->load->view('admin/check-category.html');
    }


    //�޸���Ŀ��ת
    public function edit_category()
    {
        $this->load->view('admin/edit-category.html');
    }

    //�޸���Ŀ
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

    //ɾ����Ŀ

    public function delete(){
        $cid=$_GET['cid'];

        if($this->cate->delete_category($cid))
            echo'0';
        else
            echo'1';


    }

    //�鿴������Ŀ
    public function show(){

       $data= $this->cate->get_category();
        echo json_encode($data);

    }



}