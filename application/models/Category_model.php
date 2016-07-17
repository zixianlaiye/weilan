<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/10
 * Time: 12:08
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Category_model extends CI_Model{


    //�����Ŀ
    public function add_category($data)
    {
        $this->db->insert('category',$data);
    }

    //�޸���Ŀ

    public function change_category($cid,$data)
    {
        $this->db->update('category',$data,array('cid'=>$cid));
    }

    //ɾ����Ŀ

    public function delete_category($cid)
    {
        $this->db->delete('category',array('cid'=>$cid));
    }

    //��ȡȫ��������Ϣ
    public function get_category()
    {
        $data=$this->db->get('category')->result_array();

        return $data;
    }

    //ͨ��CIDȡ��������Ϣ
    public function get($cid){

        $data=$this->db->get_where('category',array('cid'=>$cid))->result_array();
        return $data;
    }


}