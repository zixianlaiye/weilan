<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/4
 * Time: 23:17
 */

class Get extends CI_Controller{

    //设置构造函数，载入模型
    public function __construct(){
        parent::__construct();

        //载入数据库模型
        $this->load->model('Category_model','cate');

        $this->load->model('Admin_model','admin');
        $this->load->model('Picture_model','pic');
    }


//获取全部项目信息信息，按时间排序，最新的在前面
    public function get_all(){

        $data=$this->admin->get_all();
        if(!empty($data))
            echo json_encode($data);
        else
            echo 'error';


    }

    //在前台首页的正在进行的的项目展示，按时间排序
    public function get_do(){


        $data=$this->admin->get_do();

        if(!empty($data))
            echo json_encode($data);
        else
            echo 'error';
    }

//通过项目cid,页码，进行状态等信息调取项目信息
    public function get_project_type(){

        if(isset($_GET['cid']))
            $cid=$this->input->get('cid');
        else
        {
            echo '-1';
            die;
        }

        if(!$this->cate->check_cid($cid))
        {
            echo '-2';
            die;
        }


        if(isset($_GET['type']))
            $type=$this->input->get('type');
        else
        {
            echo '-1';
            die;
        }




        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
        }
        else
            $page=1;

        //数字式的type转化为数据库中存储的数据进行查询
        switch($type){
            case 1:
                $dostatus='未开始';
                break;
            case 2:
                $dostatus='进行中';
                break;
            case 3:
                $dostatus='已完成';
                break;

            default:
                echo 'error';
                die;

        }

        $data=$this->admin->get_project_dostatus($cid,$dostatus,$page);
        if(!empty($data))
            echo json_encode($data);
        else
            echo 'error';

    }

    //在分类中显示该分类的所有项目信息
    public function get_project_all(){

        //判断cid是否传入
        if(isset($_GET['cid']))
            $cid=$this->input->get('cid');
        else
        {
            echo '-1';
            die;
        }
        //判断cid是否存在
        if(!$this->cate->check_cid($cid))
        {
            echo '-2';
            die;
        }

        if(!isset($_GET['page']))
        {
            $page = 1;
        }
        else
            $page=$_GET['page'];


        if($cid)
        {
            $data=$this->admin->get_project_all_cid($cid,$page);
        }

        //若没有取得数据，则报错
        if(!empty($data))
        {
            echo json_encode($data);
        }
        else echo 'error';


    }

    //通过项目pid获取项目详细信息
    public function get_project_detail()
    {

        if(isset($_GET['pid']))
            $pid=$this->input->get('pid');
        else
        {
            echo '-1';
            die;
        }

       //判断pid是否存在
        if(!$this->admin->check_pid($pid))
        {
            echo '-2';
            die;
        }

        $data=$this->admin->get_project($pid);

        if(!empty($data))
            echo json_encode($data);
        else
            echo 'error';

    }

    //通过cid调取属于这个栏目的所有项目名称，发布时间，信息,有BUG
//    public function get_name(){
//
//        if(isset($_GET['cid']))
//            $cid=$this->input->get('cid');
//        else
//        {
//            echo '0';
//            die;
//        }
//
//        if(!$this->cate->check_cid($cid))
//        {
//            echo '1';
//            die;
//        }
//
//        $data=$this->admin->get_name($cid);
//        if(!empty($data))
//            echo json_encode($data);
//        else
//            echo 'error';
//
//    }

    //显示全部分类，包含分类cid和分类名称
    public function show_category(){

        $data= $this->cate->get_category();
        echo json_encode($data);

    }

    public function get_numbers(){
        if(isset($_GET['cid']))
            $cid=$this->input->get('cid');
        else
        {
            echo '-1';
            die;
        }

        if(!$this->cate->check_cid($cid))
        {
            echo '-2';
            die;
        }

        if(isset($_GET['type']))
            $type=$this->input->get('type');
        else
        {
            $type=0;
        }

        //对传入的type值进行检测
        if($type)
        {
            switch($type){
                case 1:
                    $dostatus='未开始';
                    break;
                case 2:
                    $dostatus='进行中';
                    break;
                case 3:
                    $dostatus='已完成';
                    break;

                default:
                    echo 'error';
                    die;

            }
        }

        //设定默认值为0
        $numbers=0;

        //调用不同类型的函数，查询不同分类的条数
        if($cid&&$type)
            $numbers=$this->admin->get_numbers_1($cid,$dostatus);
        else

            if($cid)
                $numbers=$this->admin->get_numbers_2($cid);
        else
            echo 'error';


        if(!empty($numbers))
            echo $numbers;
        else
            echo 'error';





    }

    //获取轮播图信息
    public function get_picture(){


    }







}