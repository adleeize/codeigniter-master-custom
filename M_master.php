<?php

/**
* This is model
* author: adleeize
*/
class M_master extends CI_model
{

	function getDataAll($table, $limit=NULL, $offset=NULL){
		$sql = $this->db->get($table, $limit, $offset);
		if($sql->num_rows() > 0) {
			return $sql->result();
		}
		else return 0;
	}

	function getCountDataAll($table){
		$this->db->select('count(id) count');
		$sql = $this->db->get($table, $limit, $offset);
		if($sql->num_rows() > 0) {
			return $sql->row()->count;
		}
		else return 0;		
	}

	function getDataCustom($table, $select="*", $where="", $limit=NULL, $offset=NULL){
		if(is_array($where)) {
			// get keys of array
			$conds = array();
			foreach(array_keys($where) as $idx) {
				array_push($conds, $idx);
			}
			// inject where condition
			$i = 0;
			foreach ($where as $cond) {
				$this->db->where($conds[$i], $cond);
				$i++;
			}
		}
		else {
			// nothing to do
		}

		$this->db->select($select);
		$this->db->get($table, $limit, $offset);
		if($sql->num_rows() > 0) {
			return $sql->result();
		}
		else return 0;
	}

	function getCountDataCustom($table, $where=""){
		if(is_array($where)) {
			// get keys of array
			$conds = array();
			foreach(array_keys($where) as $idx) {
				array_push($conds, $idx);
			}

			// inject where condition
			$i = 0;
			foreach ($where as $cond) {
				$this->db->where($conds[$i], $cond);
				$i++;
			}
		}
		else {
			// nothing to do
		}
		$this->db->select("count(id) count");
		$this->db->get($table);
		if($sql->num_rows() > 0) {
			return $sql->row()->count;
		}
		else return 0;	
	}

}

