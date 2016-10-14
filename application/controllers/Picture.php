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
        //载入添加轮播图添加视图
        $this->load->view('admin/add-picture.html');

    }

    public function picture_list(){
        //从数据库中获取全部轮播图项目的信息
        $data['picture']=$this->pic->get_all();


        //加载轮播图项目列表
        $this->load->view('admin/picture-list.html',$data);

    }
    public function check_view(){
        //轮播图项目具体信息查看



        //检查传入tid是否存在
        if(isset($_GET['tid']))
        {
            $tid=$_GET['tid'];

        }
        else
        {
            error('信息输入有误');
            die;

        }


        //检查tid在数据中是否存在，存在则取出数据
        if($this->pic->check_tid($tid)) {

            $data['list']=$this->pic->get_tid($tid);


            $this->load->view('admin/check-picture.html',$data);

        }



    }

    public function edit_view(){
        //轮播图项目修改项目内容

        //传入轮播图项目tid

        //检查传入tid是否存在
        if(isset($_GET['tid']))
        {
            $tid=$_GET['tid'];

        }
        else
        {
            error('信息输入有误');
            die;

        }



        //检查tid在数据中是否存在，存在则取出数据
        if($this->pic->check_tid($tid)) {

            //在VIEW页面直接用$list就可以了

            $data['list']=$this->pic->get_tid($tid);


            $this->load->view('admin/edit-picture.html',$data);

        }
        else
            error('输入信息有误');





    }


    public function add(){
        //接受文本数据
        $name= $this->input->post('name');
        $phone= $this->input->post('phone');
        $email= $this->input->post('email');
        $connecter= $this->input->post('connecter');
        $description= $this->input->post('description');

        //组装成数组


        //判断是否有上传图片
        if(!empty($_FILES['picture']['tmp_name'])) {


            $config['upload_path'] = './picture/';//存放图片地址
            $config['allowed_types'] = 'jpg|jpeg|png|psd|gif';
            $config['overwrite'] = true;


           //载入上传类，并初始化位置
            $this->load->library('upload', $config);
            if( !$this->upload->do_upload('picture'))
            {
                error('请检查图片格式后重新上传');
            }
            else
            {

            $data=array(
                'name'=>$name,
                'connecter'=>$connecter,
                'phone'=>$phone,
                'email'=>$email,
                'datetime'=>time(),
                'picture_name'=>$this->upload->data('file_name'),
                'picture_address'=>'/picture/' .$this->upload->data('file_name')

            );
                //进行数据库插入操作
                $a=$this->pic->add_picture($data,$description);

                switch($a){
                    case  -1:
                    error('添加失败请重新尝试');
                        break;
                    case 1:
                        success('Login/index','添加成功');
                        break;
                    default:
                        error('添加出错请重新尝试');
                        break;

                }



            }


        }





    }

    public function edit(){
        //判断传输的tid是否正确
        if(isset($_GET['tid']))
        {
            $tid=$_GET['tid'];

        }
        else
        {
            error('信息输入有误');
            die;

        }

        if(!$this->pic->check_tid($tid))
            error('不存在的轮播图');


       //接收传来的信息
        $name= $this->input->post('name');
        $phone= $this->input->post('phone');
        $email= $this->input->post('email');
        $connecter= $this->input->post('connecter');
        $description= $this->input->post('description');

        //将正文也转成数组格式
        $description=array(
            'description'=>$description
        );


        //判断是否有图片文件上传，若有替换原来图片，并将新图片的地址信息存入数据库
        if(!empty($_FILES['picture']['tmp_name'])) {

//             $_FILES['picture']['name'];



            //进行上传类的配置
            $config['upload_path'] = './picture/';//存放图片地址
            $config['allowed_types'] = 'jpg|jpeg|png|psd|gif';
            $config['overwrite'] = false;

            //载入上传类，判断是否
            $this->load->library('upload', $config);
            if( !$this->upload->do_upload('picture'))
            {
                error('请检查图片格式后重新上传');
            }



                //先删除原来的图片

            $address=$this->pic->get_picture($tid);


            if($address['0']['picture_address']!=NULL) {
                //因为保存的时候路径第一位是/，删除的时候不能有，所以调用substr函数去除第一位
                $address['0']['picture_address'] = substr($address['0']['picture_address'], 1);

                if(!unlink($address['0']['picture_address']))
                    error('删除图片出错');

                //再对新上传的图片进行保存处理


                $data=array(
                    'name'=>$name,
                    'connecter'=>$connecter,
                    'phone'=>$phone,
                    'email'=>$email,
                    'picture_name'=>$this->upload->data('file_name'),
                    'picture_address'=>'/picture/' .$this->upload->data('file_name')

                );

                //进行数据库更新操作
                $a=$this->pic->update_picture($tid,$data,$description);

                switch($a){
                    case  -1:
                        error('添加失败请重新尝试');
                        break;
                    case 1:
                        success('Login/index','添加成功');
                        break;
                    default:
                        error('添加出错请重新尝试');
                        break;

                }

            }



        }

        else
        {
            //仅对前面部分进行更改，图片路径不动
            $data=array(
                'name'=>$name,
                'connecter'=>$connecter,
                'phone'=>$phone,
                'email'=>$email

            );
            $a=$this->pic->update_picture($tid,$data,$description);

            switch($a){
                case  -1:
                    error('添加失败请重新尝试');
                    break;
                case 1:
                    success('Login/index','添加成功');
                    break;
                default:
                    error('添加出错请重新尝试');
                    break;

            }

        }





    }

    public function delete(){

        if(isset($_GET['tid']))
        {
            $tid=$_GET['tid'];

        }
        else
        {
            error('信息输入有误');
            die;

        }


        //检查tid是否存在，存在则进行删除
        if($this->pic->check_tid($tid))
        {
            $address=$this->pic->get_picture($tid);


            if($address['0']['picture_address']!=NULL) {
                //因为保存的时候路径第一位是/，删除的时候不能有，所以调用substr函数去除第一位
                $address['0']['picture_address'] = substr($address['0']['picture_address'], 1);

                if(!unlink($address['0']['picture_address']))
                    error('删除出错');
            }





                if($this->pic->delete($tid))
                success('Login/index','删除成功');
            else
                error('删除出现错误');


        }
        else
            error('不存在的项目');


    }





}