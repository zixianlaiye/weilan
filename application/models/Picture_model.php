<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/2
 * Time: 21:53
 */

class Picture_model extends CI_Model{
    public function add_picture($data,$description){
        //插入数据进表并返回相应ID
        $this->db->insert('picture',$data);
        $tid=$this->db->insert_id();
        if($tid)
        {
            $text=array(
            'tid'=>$tid,
            'description'=>$description
        );
            $this->db->insert('picture_text',$text);
            $number=$this->db->affected_rows();
            return $number;

        }
        else  return '-1';







    }

    public function update_picture($tid,$data,$description){

       try{
           $this->db->update('picture',$data,array('tid'=>$tid));
           $this->db->update('picture_text',$description,array('tid'=>$tid));
       }
       catch(Exception $e){
           echo '-1';
           die;

        }

        return 1;

    }


    //通过tid删除项目
    public function delete($tid){
        $this->db->delete('picture',array('tid'=>$tid));

        $this->db->delete('picture_text',array('tid'=>$tid));

        //若都执行成功，返回为真
        return true;

    }

    public function change(){



    }
public function check_tid($tid)
{
    $this->db->select('tid');
    $this->db->from('picture');
    $this->db->where('tid',$tid);
    $number=$this->db->get()->num_rows();
    if($number==1)
        return true;
    else
        return false;

}

//在list页面显示全部信息
    public function get_all(){
        $this->db->select('picture.name,picture.datetime,picture.tid,picture.connecter');
        $this->db->from('picture');
        $data=$this->db->get()->result_array();
        return $data;

    }

    //通过tid查询活动所有信息
    public function get_tid($tid){
        $this->db->select('picture.*,picture_text.description',FAlSE);
        $this->db->from('picture');
        $this->db->join('picture_text','picture_text.tid=picture.tid','inner');
        $this->db->where('picture.tid',$tid);

        $data=$this->db->get()->result_array();
        return $data;


    }

    //通过tid查询对应图片存储位置
    public function  get_picture($tid){
        $this->db->select('picture_address');
        $this->db->from('picture');
        $this->db->where('tid',$tid);
        $data=$this->db->get()->result_array();

        return $data;

    }


}