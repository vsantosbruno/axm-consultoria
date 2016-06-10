<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Estoque_model extends CI_Model{
	public function getInfoParaCompra(){
		$this->db->select("produto.id,produto.nome");
		$produtos = $this->db->get("produto")->result_array();
		
		$this->db->select("fornecedor.id,fornecedor.nome");
		$fornecedores = $this->db->get("fornecedor")->result_array();


		if($produtos != null && $fornecedores != null){
			$produtosEFornecedores = array('produtos' => $produtos, 'fornecedores' => $fornecedores);	
			return $produtosEFornecedores;
		}

		return false;
	}

	public function cadastraCompra($compra = ""){
		if($compra != null){
			$this->db->insert("compra",$compra);
			
			$this->db->where("produto_id",$compra['produto_id']);
			$produto_estoque = $this->db->get('produto_estoque')->row_array();
			
			if($produto_estoque != null){
				$quantidade = $produto_estoque['quantidade']+$compra['quantidade'];

				$this->db->query("update produto_estoque set quantidade=".$quantidade." where id=".$produto_estoque['id']);
				
				return true;
			}else{
				$produto = array(
					'quantidade' => $compra['quantidade'],
					'produto_id' => $compra['produto_id']
				);	
				
				$this->db->insert("produto_estoque", $produto);
				
				if($this->db->affected_rows() == 1){
					return true;
				}
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

	public function verificaCpfFornecedor($cpf = ""){
		if($cpf != null){
			$this->db->where("cpf",$cpf);
			$cpfBanco = $this->db->get("fornecedor")->result_array();
			if($cpfBanco == null){
				return true;
			} 
			return false;
		}
		return false;
	}

	public function cadastraFornecedor($fornecedor = ""){
		if($fornecedor != null){
			$this->db->insert("fornecedor",$fornecedor);

			if($this->db->affected_rows() == 1){
				return true;
			}
		}

		return false;
	}
}