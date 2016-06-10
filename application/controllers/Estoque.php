<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Estoque extends CI_Controller{
	public function index(){
		if(verifica_login($this->session)){
			$this->load->model("estoque_model");
			$infoParaCompra = $this->estoque_model->getInfoParaCompra();
			$dados = array(
				'produtos' => $infoParaCompra['produtos'],
				'fornecedores' => $infoParaCompra['fornecedores'],

			);
			$this->load->view("Estoque/Compras",$dados);
		} else{
			redirect("/");
		}
		
	}

	public function cadastrarCompra(){
		$this->form_validation->set_rules("idProduto","idProduto","required");
		$this->form_validation->set_rules("idFornecedor","idFrnecedor","required");
		$this->form_validation->set_rules("valor","Valor","required");
		$this->form_validation->set_rules("quantidade","Quantidade","required");
		$ajax = $this->input->get("ajax");

		if($this->form_validation->run() == false){
			if($ajax){
				$json = array('result' => false);
				echo json_encode($json);
				$this->session->set_flashdata("danger","Erro de validação.");
			} else{
				$this->session->set_flashdata("danger","Erro de validação.");
			}
		} else{
			$idProduto = $this->input->post("idProduto");
			$idFornecedor = $this->input->post("idFornecedor");
			$valor = $this->input->post("valor");
			$quantidade = $this->input->post("quantidade");
			$data = date("Y-m-d");

			$dados = array(
				'quantidade' => $quantidade,
				'value_product' => $valor,
				'data_criacao' => $data,
				'produto_id' => $idProduto,
				'fornecedor_id' => $idFornecedor,
				);

			$this->load->model("estoque_model");

			if($this->estoque_model->cadastraCompra($dados)){
				if($ajax){
					$json = array('result' => true);
					echo json_encode($json);
					$this->session->set_flashdata("success","Compra cadastrada com sucesso.");
				} else{
					$this->session->set_flashdata("success","Compra cadastrada com sucesso.");
				}
			} else{
				if($ajax){
					$json = array('result' => false,"erro" => 'falha no cadastro da compra');
					echo json_encode($json);
					$this->session->set_flashdata("danger","Erro ao cadatrar conta, por favor tente novamente");
				} else{
					$this->session->set_flashdata("danger","Erro ao cadatrar conta, por favor tente novamente");
				}	
			}
		}
	}

}
