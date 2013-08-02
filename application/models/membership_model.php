<?php

class Membership_model extends CI_Model {

	 function __construct()
    {
        parent::__construct();
    }

    /**
	 * 初始化函数
	 *
	 * 在已经创建数据库的情况下，初始化数据库表信息
	 * 之后接受输入管理员邮箱密码，保存到数据库
	 */
	function init()
	{
		$this->load->dbutil();
		$this->load->dbforge();

		$data['text'] = '';

		$fields_user = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),
			'username' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		    ),
		     'email' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
		     'password' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '64',
		  )
		);

		$this->dbforge->add_field($fields_user);
		$this->dbforge->add_key('id');

		if(!$this->db->get('user')->num_rows())
		{
			//创建表user，如果不存在
		   if($this->dbforge->create_table('user', TRUE))
		   {
			   $data['text'] .=  '<p>表user创建成功!</p>';
		   }
		}
		else 
		{
			$data['text'] .=  '<p>表user已经存在!</p>';
		} 

		return $data;

	}

	function validate()
	{
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password',md5($this->input->post('password')));
		$query = $this->db->get('user');

		if($query->num_rows = 1)
		{
			return true;
		}
	}

	function create_member()
	{
		$new_member_insert_data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password'))
		);

		$insert = $this->db->insert('user',$new_member_insert_data);
		return $insert;
	}

}
