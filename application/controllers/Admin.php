<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/11
 **/

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

    //设置构造函数，载入公共模型
    public function __construct(){
        parent::__construct();

        $this->load->model('Admin_model','admin');
    }


    //新增项目信息
    public function add(){

        //常规提交项目
        $name=$this->input->post('name','true');
        $cid=$this->input->post('cid','true');
        $needtime=$this->input->post('needtime','true');
        $corefunction=$this->input->post('corefunction','true');
        $money=$this->input->post('money','true');
        $technology=$this->input->post('technology','true');
        $addcontent=$this->input->post('addcontent','true');

        //项目发布时间
        date_default_timezone_set('Asia/Shanghai');
        $datetime = date('F j Y h:i:s A');

        //是否有上传文件判断

        if(!empty($_FILES['file']['tmp_name']))
        {



            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'bmp|jpg|png';
            $config['encrypt_name'] = TRUE;


            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                echo 2; //文件上传失败
            } else {
                $fileaddress = '/uploads/' . $this->upload->data('file_name');

                $data=array(
                    'name'=>$name,
                    'cid'=>$cid,
                    'needtime'=>$needtime,
                    'corefunction'=>$corefunction,
                    'money'=>$money,
                    'technology'=>$technology,
                    'addcontent'=>$addcontent,
                    'datetime'=>$datetime,
                    'filestatus'=>'1',
                    'fileaddress'=>$fileaddress,
                );


                //新增信息到数据库
                print_r($data);
                $this->admin->add_project($data);



            }
        }

        //若没有上传文件，设置成另一种数组形式插入数据库
        $data=array(
            'name'=>$name,
            'cid'=>$cid,
            'needtime'=>$needtime,
            'corefunction'=>$corefunction,
            'money'=>$money,
            'technology'=>$technology,
            'addcontent'=>$addcontent,
            'datetime'=>$datetime,
        );

        print_r($data);
        $this->admin->add_project($data);

    }

    //增加项目信息界面跳转
    public function add_project(){

        $this->load->view('admin/add-project.html');
    }

    //项目查看页面跳转
    public function check_project(){

    $this->load->view('admin/check-project.html');
}


    //编辑项目信息跳转界面

    public function edit_project(){
        $this->load->view('admin/edit-project.html');

    }

    //编辑修改项目信息
    public function change(){




    }


    //删除项目信息
    public function delete(){

        $uid=$_GET['uid'];


        if($this->admini->delete_project($uid))
            echo'0';
        else
            echo'1';


    }

    //查询全部项目信息内容
    public function get_all(){

        $data=$this->admin->get_all();
        echo json_encode($data);


    }

    //通过uid调取项目全部信息
    public function get(){

        $uid=$_GET['uid'];
        echo $uid;
        $data=$this->admin->get($uid);
        echo json_encode($data);

    }




}