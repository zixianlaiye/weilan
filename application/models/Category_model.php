<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/10
 * Time: 12:08
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Category_model extends CI_Model{


    //添加栏目
    public function add_category($data)
    {
        $this->db->insert('category',$data);
    }

    //修改栏目

    public function change_category($cid,$data)
    {
        $this->db->update('category',$data,array('cid'=>$cid));
    }

    //删除栏目

    public function delete_category($cid)
    {
        $this->db->delete('category',array('cid'=>$cid));
    }

    //获取全部类型信息
    public function get_category()
    {
        $data=$this->db->get('category')->result_array();

        return $data;
    }

    //通过CID取得类型信息
    public function get($cid){

        $data=$this->db->get_where('category',array('cid'=>$cid))->result_array();
        return $data;
    }


}