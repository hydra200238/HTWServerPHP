<?php

class Question_model extends My_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_question($field,$where)
	{		
		$this->db->order_by('question.question_time','DESC');
		$this->db->join('user','question.user_id = user.user_id');
		$this->db->select($field);
		return $this->db->where($where)->get('question');
	}
    
    function get_question_where_in($where_field, $where_in, $field = '*', $limit = 0, $offset = 0)
    {
        $this->db->order_by('question.question_time','DESC');
        $this->db->join('user','question.user_id = user.user_id');
        
        $this->db->select($field);
        if ($limit !=0)
        {
            return $this->db->where_in($where_field, $where_in)->get('question', $limit, $offset);
            
        }
        else
        {
            return $this->db->where_in($where_field, $where_in)->get('question');
            
        }
        
    }
	
	function get_question_with_answer($where)
	{
		$this->db->order_by('question.question_id','ASC');
		$this->db->select('*,question.question_id as question_id');
		$this->db->join('answer' , 'question.question_id = answer.question_id','left');
	
		/*
		$query = $this->db->query('select q.*,
  group_concat(a.answer_id) answer
from question q
left join answer a
  on q.question_id = a.question_id
group by q.question_id');
return $query;
*/
		return $this->db->where($where)->get('question');
	}
	
	function get_question_with_answers($where)
	{
		return $this->db->where($where)->get('question');
	}
	
	function insert_question($data)
	{
        $this->db->insert('question',$data);
		return $this->db->insert_id();
	}
	
	function update_question($where,$data)
	{
		return $this->db->where($where)->update('question',$data);	
	}
	
	function delete_question($where)
	{
		return $this->db->where($where)->update('question');	
	}
}