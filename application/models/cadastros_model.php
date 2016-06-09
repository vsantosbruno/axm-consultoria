<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Cadastros_model extends CI_Model{
	public function verificaUsuario($usuario = ""){
		if($usuario != null){
			$this->db->where("nome_usuario", $usuario);
			$user = $this->db->get("usuario")->row_array();

			if($user == null){
				return true;
			}

			return false;
		}
		return false;
	}

	public function cadastraUsuario($usuario = ""){
		if($usuario != null){
			$this->db->insert("usuario",$usuario);

			if($this->db->affected_rows() == 1){
				return true;
			}
		}

		return false;
	}

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