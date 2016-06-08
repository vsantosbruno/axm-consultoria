<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Home_model extends CI_Model{
	public function autentica($usuario = "", $senha = ""){
		if($usuario != null && $senha != null){
			$this->db->where("nome_usuario", $usuario);
			$this->db->where("senha", $senha);
			$this->db->limit(1);
			$user = $this->db->get("usuario")->row_array();

			if($user != null){
				return $user;	
			} 

			return false;
		}

		return false;
	}
}