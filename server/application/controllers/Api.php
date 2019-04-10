<?php

require_once APPPATH . 'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {
	function __construct($config = 'rest'){
		parent::__construct($config);
	}

function cutis_get(){
	$id = $this->get('id');
	if ($id){
		$cuti = $this->db->get_where('cuti',
			array('Id' => $id))->result();
	} else {
		$cuti = $this->db->get('cuti')->result();
	}
	if($cuti){
		$this->response($cuti,200);
	} else {
		$this->response(array('status'=>'not found'),404);
	}
}

function cutis_post(){
	$params = array(
		'Nama' => $this->post('nama'),
		'Nim' => $this->post('nim'),
		'Fakultas' => $this->post('fakultas'),
		'Progdi' => $this->post('progdi'));
	$process = $this->db->insert('cuti', $params);
	if($process){
		$this->response(array('status'=>'success'),201);
	} else {
		return $this->response(array('status'=>'fail'), 502);
	}
}

function cutis_put(){
	$params = array(
		'Nama' => $this->put('nama'),
		'Nim' => $this->put('nim'),
		'Fakultas' => $this->put('fakultas'),
		'Progdi' => $this->put('progdi'));
	$this->db->where('Id', $this->put('id'));
	$execute = $this->db->update('cuti', $params);
	if($execute){
		$this->response(array('status'=>'success'),201);
	} else {
		return $this->response(array('status'=>'fail'), 502);
	}
}

function cutis_delete(){
	$this->db->where('Id', $this->delete('id'));
	$execute = $this->db->delete('cuti');
	if($execute){
		$this->response(array('status'=>'success'),201);
	} else {
		return $this->response(array('status'=>'fail'), 502);
	}
}
}
?>