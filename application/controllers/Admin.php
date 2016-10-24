<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/11
 **/

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller{

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
            //真实的文件名
            $filename=$_FILES['file']['name'];




            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'doc|rar|docx|zip';
            $config['overwrite']=false;
            $config['file_name']=time().rand(200,300);//存储所用文件名



            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                error('文件上传失败，请检查文件格式后重新尝试'); //上传文件失败
            } else {
                $fileaddress = '/uploads/' .$this->upload->data('file_name');

                $data=array(
                    'name'=>$name,
                    'cid'=>$cid,
                    'needtime'=>$needtime,
                    'description'=>$description,
                    'email'=>$email,
                    'phone'=>$phone,
                    'money'=>$money,
                    'connecter'=>$connecter,
                    'filename'=>$filename,
                    'datetime'=>$datetime,
                    'filestatus'=>'1',
                    'fileaddress'=>$fileaddress,
                );


                //项目信息入库

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



        //进行分页类配置
        $this->load->library('pagination');
        $perPage=2;//控制每页显示多少条数据
        $config['base_url'] = site_url('/Admin/project_list?cid='.$cid);
      $config['total_rows'] = $this->db->where('project.cid',$cid)->count_all_results('project');//统计文章数据个数\
//        $config['total_rows'] =100;//

        $config['per_page'] = $perPage;

        $config['first_link']='第一页';
        $config['last_link']='最后一页';
        $config['prev_link']='上一页';
        $config['next_link']='下一页';
        $config['use_page_numbers']=true;//URL中的数字显示第几页，否则，显示到达第几条
        $config['page_query_string'] = TRUE;

        $this->pagination->initialize($config);

        $data['links']= $this->pagination->create_links();

        //设定默认页码
        if(!empty($_GET['per_page']))
        {
            $per_page=$_GET['per_page'];
        }
        else $per_page=1;


        $this->db->limit($perPage,($per_page-1)*$perPage);











//从数据库中取出数据
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
        //接收项目pid值
        $pid=$_GET['pid'];

        //验证是否存在该项目信息，不存在返回错误提示
        $data=$this->admin->get_project($pid);

        if(empty($data))
        {
            error('您输入的项目不存在');
        }


        //接收表单post来的信息
        $name=$this->input->post('name');
        $needtime=$this->input->post('needtime');
        $money=$this->input->post('money');
        $connecter=$this->input->post('connecter');
        $phone=$this->input->post('phone');
        $description=$this->input->post('description');
        $dostatus=$this->input->post('dostatus');
        $email=$this->input->post('email');




        //若存在，判断是否有上传文件，然后分别进行操作
//
        if(!empty($_FILES['file']['tmp_name'])){


            //上传文件的配置
            $filename=$_FILES['file']['name'];
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'doc|rar|docx|zip';
            $config['overwrite']=false;
            $config['file_name']=time().rand(200,300);




            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                error('文件上传失败，请检查文件格式后重新尝试'); //上传文件失败
            } else {
                //若有文件，则先删除
                if($data['0']['filestatus']=='1'&& file_exists($data['0']['filestatus']))
                {
                    //删除原有的文件
                    unlink($data['0']['fileaddress']);
                }



                $fileaddress = '/uploads/' . $this->upload->data('file_name');

                $change=array(

                    'name'=>$name,
                    'needtime'=>$needtime,
                    'description'=>$description,
                    'email'=>$email,
                    'phone'=>$phone,
                    'money'=>$money,
                    'connecter'=>$connecter,
                    'filename'=>$filename,
                    'filestatus'=>'1',
                    'fileaddress'=>$fileaddress,
                    'dostatus'=>$dostatus
                );


                //项目信息入库

                $this->admin->change_project($pid,$change);
                success('Login/index','发布成功');
            }

        }


        //无上传文件时的操作
        else
        {


            $change=array(

                'name'=>$name,
                'needtime'=>$needtime,
                'description'=>$description,
                'email'=>$email,
                'phone'=>$phone,
                'money'=>$money,
                'connecter'=>$connecter,
                'dostatus'=>$dostatus
            );
            $this->admin->change_project($pid,$change);
            success('Login/index','发布成功');


        }
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
            if(!isset($_GET['pid']))
                throw new Exception('删除信息有误');

            $pid=$_GET['pid'];


            if(!$this->admin->check_pid($pid))
            {
                throw new Exception('删除信息不存在有误');
            }

            //从数据库中调取文件地址信息
            $address=$this->admin->pid_file($pid);




            if($address['0']['fileaddress']!=NULL)
            {
                //因为保存的时候路径第一位是/，删除的时候不能有，所以调用substr函数去除第一位
                $address['0']['fileaddress']=substr($address['0']['fileaddress'],1);

                //删除文件
                unlink($address['0']['fileaddress']);



            }



            if($this->admin->delete_project($pid))
                throw new Exception('删除失败');
            else
                success('Login/index','删除成功');


        }
        catch(Exception $e){
            error($e->getMessage()) ;
            die;



        }

    }














}