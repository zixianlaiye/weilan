<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/9
 * Time: 19:32
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{

    //增添项目信息
    public function add_project($data){
        $this->db->insert('project',$data);

    }

    //修改项目信息
    public function change_project($uid,$data){

        $this->db->update('project',$data,array('uid'=>$uid));

    }

    //删除项目信息
    public function delete_project($uid){
        $this->db->delete('project',array('uid'=>$uid));

    }

    //查看所有项目信息
    public function get_all(){

        $this->db->select('project.uid,project.name,category.cname,project.needtime,project.money',FAlSE);
        $this->db->from('project');
        $this->db->from('category');

        $where='project.cid=category.cid';
        $this->db->where($where);
        $data=$this->db->get()->result_array();
        return $data;

    }

    //根据uid查看项目所有信息
    public function get($uid){
        $this->db->select('project.*,category.cname',FAlSE);
        $this->db->from('project');
        $this->db->from('category');

        $where='project.cid=category.cid';
        $this->db->where($where);
        $this->db->where('project.uid',$uid);
        $data=$this->db->get()->result_array();
        return $data;

    }






}