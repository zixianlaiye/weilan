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

    //��ȡȫ����Ŀ��Ϣ
    public function get_category()
    {
        $data=$this->db->get('category')->result_array();

        return $data;
    }

    //ͨ��CIDȡ����Ŀ��Ϣ
    public function get($cid){

        $data=$this->db->get_where('category',array('cid'=>$cid))->result_array();
        return $data;
    }

    //���cid�Ƿ���Ч
    public function check_cid($cid){

        $this->db->select('cid');
        $this->db->from('category');
        $this->db->where('cid',$cid);
        $data=$this->db->count_all_results();//�����ж���������
        return $data;

    }


}