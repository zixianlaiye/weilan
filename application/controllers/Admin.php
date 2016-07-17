<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/11
 **/

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

    //���ù��캯�������빫��ģ��
    public function __construct(){
        parent::__construct();

        $this->load->model('Admin_model','admin');
    }


    //������Ŀ��Ϣ
    public function add(){

        //�����ύ��Ŀ
        $name=$this->input->post('name','true');
        $cid=$this->input->post('cid','true');
        $needtime=$this->input->post('needtime','true');
        $corefunction=$this->input->post('corefunction','true');
        $money=$this->input->post('money','true');
        $technology=$this->input->post('technology','true');
        $addcontent=$this->input->post('addcontent','true');

        //��Ŀ����ʱ��
        date_default_timezone_set('Asia/Shanghai');
        $datetime = date('F j Y h:i:s A');

        //�Ƿ����ϴ��ļ��ж�

        if(!empty($_FILES['file']['tmp_name']))
        {



            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'bmp|jpg|png';
            $config['encrypt_name'] = TRUE;


            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                echo 2; //�ļ��ϴ�ʧ��
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


                //������Ϣ�����ݿ�
                print_r($data);
                $this->admin->add_project($data);



            }
        }

        //��û���ϴ��ļ������ó���һ��������ʽ�������ݿ�
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

    //������Ŀ��Ϣ������ת
    public function add_project(){

        $this->load->view('admin/add-project.html');
    }

    //��Ŀ�鿴ҳ����ת
    public function check_project(){

    $this->load->view('admin/check-project.html');
}


    //�༭��Ŀ��Ϣ��ת����

    public function edit_project(){
        $this->load->view('admin/edit-project.html');

    }

    //�༭�޸���Ŀ��Ϣ
    public function change(){




    }


    //ɾ����Ŀ��Ϣ
    public function delete(){

        $uid=$_GET['uid'];


        if($this->admini->delete_project($uid))
            echo'0';
        else
            echo'1';


    }

    //��ѯȫ����Ŀ��Ϣ����
    public function get_all(){

        $data=$this->admin->get_all();
        echo json_encode($data);


    }

    //ͨ��uid��ȡ��Ŀȫ����Ϣ
    public function get(){

        $uid=$_GET['uid'];
        echo $uid;
        $data=$this->admin->get($uid);
        echo json_encode($data);

    }




}