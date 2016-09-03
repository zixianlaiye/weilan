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
    public function change_project($uid,$data){

        $this->db->update('project',$data,array('uid'=>$uid));

    }

    //删除项目信息
    public function delete_project($pid){

         $this->db->delete('project',array('pid'=>$pid));


    }

    //获取全部项目信息
    public function get_all(){

        $this->db->select('project.uid,project.name,category.cname,project.needtime,project.money',FAlSE);
        $this->db->from('project');
        $this->db->from('category');

        $where='project.cid=category.cid';
        $this->db->where($where);
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

    public function get_name($cid){
        $this->db->select('project.name,category.cname',FAlSE);
        $this->db->from('project');
        $this->db->from('category');

        $where='project.cid=category.cid';
        $this->db->where($where);
        $this->db->where('project.cid',$cid);
        $data=$this->db->get()->result_array();
        return $data;

    }






}