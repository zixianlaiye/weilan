<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/9
 * Time: 19:32
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{

    //新增项目信息
    public function add_project($data){
        $this->db->insert('project',$data);

    }

    //修改项目信息
    public function change_project($pid,$data){

        $this->db->update('project',$data,array('pid'=>$pid));

    }

    //删除项目信息
    public function delete_project($pid){

         $this->db->delete('project',array('pid'=>$pid));


    }

    //获取全部项目信息
    public function get_all(){

        $this->db->select('project.pid,project.datetime,project.name,category.cname,project.needtime,project.connecter',FAlSE);
        $this->db->from('project');
        $this->db->from('category');

        $where='project.cid=category.cid';
        $this->db->where($where);
        $this->db->order_by('project.datetime','desc');
        $data=$this->db->get()->result_array();
        return $data;

    }

    public function get_do(){
        $this->db->select('project.pid,project.datetime,project.name,category.cname,project.needtime,project.connecter',FAlSE);
        $this->db->from('project');
        $this->db->from('category');

        $where='project.cid=category.cid';
        $this->db->where($where);
        $this->db->where('project.dostatus','进行中');
        $this->db->order_by('project.datetime','desc');
        $data=$this->db->get()->result_array();
        return $data;


    }

    //通过cid获取该类项目全部信息
    public function get($cid){
        $this->db->select('project.*,category.cname',FAlSE);
        $this->db->from('project');
        $this->db->from('category');

        $where='project.cid=category.cid';
        $this->db->where($where);
        $this->db->where('project.cid',$cid);
        $data=$this->db->get()->result_array();
        return $data;

    }

    //通过pid获取某一项目具体信息
    public function get_project($pid)
    {
        $this->db->select('project.*,category.cname',FAlSE);
        $this->db->from('project');
        $this->db->from('category');

        $where='project.cid=category.cid';
        $this->db->where($where);
        $this->db->where('project.pid',$pid);
        $data=$this->db->get()->result_array();
        return $data;

    }

    //通过cid获取获取属于该项目的全部项目名称

    public function get_project_all_cid($cid,$page){
        $this->db->select('project.name,project.pid,project.datetime,category.cname',FAlSE);
        $this->db->from('project');
        $this->db->from('category');

        $where='project.cid=category.cid';
        $this->db->where($where);
        $this->db->where('project.cid',$cid);
        $this->db->limit(10,($page-1)*10);
        $this->db->order_by('project.datetime','desc');
        $data=$this->db->get()->result_array();
        return $data;

    }

    //通过cid,pid,type等查询指定页面的信息

    public function get_project_dostatus($cid,$dostatus,$page){
        $this->db->select('project.name,project.pid,project.datetime',FAlSE);
        $this->db->from('project');
        $this->db->where('project.cid',$cid);
        $this->db->where('project.dostatus',$dostatus);
        $this->db->limit(10,($page-1)*10);
        $this->db->order_by('project.datetime','desc');
        $data=$this->db->get()->result_array();
        return $data;




    }
//检查pid值是否存在
    public function check_pid($pid){

        $this->db->select('pid');
        $this->db->from('project');
        $this->db->where('pid',$pid);
        $data=$this->db->count_all_results();
        return $data;

    }


    public function get_numbers_1($cid,$dostatus){

        $this->db->select('pid');
        $this->db->from('project');
        $this->db->where('cid',$cid);
        $this->db->where('dostatus',$dostatus);
        $data=$this->db->count_all_results();
        return $data;


    }

    public function get_numbers_2($cid){
        $this->db->select('pid');
        $this->db->from('project');
        $this->db->where('cid',$cid);
        $data=$this->db->count_all_results();
        return $data;


    }

    public function pid_file($pid){

        $this->db->select('fileaddress');
        $this->db->from('project');
        $this->db->where('pid',$pid);
        $data=$this->db->get()->result_array();
        return $data;

    }








}