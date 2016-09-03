<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/11
 **/

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

    //设置构造函数，载入模型
    public function __construct(){
        parent::__construct();

        //载入数据库模型
        $this->load->model('Category_model','cate');

        $this->load->model('Admin_model','admin');
    }


    //新增项目信息
    public function add(){

        //接收信息
        $name=$this->input->post('name','true');
        $cid=$this->input->post('cid','true');
        $needtime=$this->input->post('needtime','true');
        $money=$this->input->post('money','true');
        $connecter=$this->input->post('connecter','true');
        $description=$this->input->post('description','true');
        $phone=$this->input->post('phone','true');
        $email=$this->input->post('email','true');



        //设置时间
//        date_default_timezone_set('Asia/Shanghai');
//        $datetime = date('F j Y h:i:s A');
        $datetime=time();

        //判断是否有上传文件

        if(!empty($_FILES['file']['tmp_name']))
        {



            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'doc|rar|docx|zip';
            $config['overwrite']=true;



            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                error('文件上传失败，请检查文件格式后重新尝试'); //上传文件失败
            } else {
                $fileaddress = '/uploads/' . $this->upload->data('file_name');

                $data=array(
                    'name'=>$name,
                    'cid'=>$cid,
                    'needtime'=>$needtime,
                    'description'=>$description,
                    'email'=>$email,
                    'phone'=>$phone,
                    'money'=>$money,
                    'connecter'=>$connecter,

                    'datetime'=>$datetime,
                    'filestatus'=>'1',
                    'fileaddress'=>$fileaddress,
                );


                //项目信息入库
                print_r($data);
                $this->admin->add_project($data);
                success('Login/index','发布成功');



            }
        }

        else {

            //若未添加附件，则直接上传
            $data = array(
                'name'=>$name,
                'cid'=>$cid,
                'needtime'=>$needtime,
                'description'=>$description,
                'email'=>$email,
                'phone'=>$phone,
                'money'=>$money,
                'connecter'=>$connecter,

                'datetime'=>$datetime,
            );

            print_r($data);
            $this->admin->add_project($data);

            success('Login/index','发布成功');
        }

    }

    //新增项目信息跳转界面
    public function add_project(){
        //获取项目类型
        $this->load->model('Category_model','cate');
        $data['category']=$this->cate->get_category();


        $this->load->view('admin/add-project.html',$data);
    }

    //分类查询项目信息
    public function check_project(){

        $this->load->model('Category_model','cate');
        $data['category']=$this->cate->get_category();


    $this->load->view('admin/check-project.html',$data);
}

//分类显示项目信息
    public function project_list()
    {
        $cid=$_GET['cid'];
        $this->load->model('Admin_model','admin');
        $data['list']=$this->admin->get($cid);
        $this->load->view('admin/project-list.html',$data);




    }

    //通过pid查看项目信息跳转界面
    public function pid_project()
    {
        $pid=$_GET['pid'];
        $data['list']=$this->admin->get_project($pid);
//        p($data);die;

        $this->load->view('admin/project-detail.html',$data);

    }


    //对项目信息进行编辑

    public function edit_project(){
        $pid=$_GET['pid'];
        $data['list']=$this->admin->get_project($pid);





        $this->load->view('admin/edit-project.html',$data);

    }

    //编辑项目入库操作
    public function change(){




    }


    //通过pid删除项目信息
    public function delete(){

//        $pid=$_GET['pid'];

//

//
//        if($this->admin->delete_project($pid))
//            error('删除失败');
//        else
//           success('Login/index','删除陈功');

        try{
            $pid=$_GET['pid'];
            if($this->admin->delete_project($pid))
            throw new Exception('删除失败');
            else
                success('Login/index','删除陈功');


        }
        catch(Exception $e){
            error($e->getMessage()) ;
            die;



        }

    }

    //获取全部项目信息信息
    public function get_all(){

        $data=$this->admin->get_all();
        echo json_encode($data);


    }

    //通过项目pid获取项目详细信息
    public function get_detail()
    {

        $pid=$_GET['pid'];

        $data=$this->admin->get_project($pid);
        echo json_encode($data);

    }

    //通过cid调取属于这个栏目的所有项目名称信息
    public function get_name(){

        $cid=$_GET['cid'];
        $data=$this->admin->get_name($cid);
        echo json_encode($data);

    }




}