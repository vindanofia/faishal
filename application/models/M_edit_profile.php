<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_edit_profile extends CI_Model
{
	public function login($post)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $post['username']);
		$this->db->where('password', md5($post['password']));
		$query = $this->db->get();
		return $query;
	}

	public function get($id = null)
	{
		$this->db->from('user');
		if ($id != null) {
			$this->db->where('id_user', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function edit($post)
	{
		$params['name'] = $post['fullname'];
		$params['username'] = $post['username'];
		$params['email'] = $post['email'];
		if (!empty($post['password'])) {
			$params['password'] = md5($post['password']);
		}
		$params['id_role'] = $post['level'];
		$this->db->where('id_user', $post['user_id']);
		$this->db->update('user', $params);
	}
}
