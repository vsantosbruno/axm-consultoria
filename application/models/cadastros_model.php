<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Cadastros_model extends CI_Model{
	public function verificaUsuario($usuario = ""){
		if($usuario != null){
			$this->db->where("nome_usuario", $usuario);
			$usuariosBanco = $this->db->get("usuario")->result_array();

			if($usuariosBanco == null){
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

	public function verificaProduto($produto = ""){
		if($produto != null){
			$this->db->where("nome",$produto);
			$produtosBanco = $this->db->get("produto")->result_array();
			if($produtosBanco == null){
				return true;
			} 
			return false;
		}
		return false;
	}

	public function cadastraProduto($produto = ""){
		if($produto != null){
			$this->db->insert("produto",$produto);

			if($this->db->affected_rows() == 1){
				return true;
			}
		}

		return false;
	}
}