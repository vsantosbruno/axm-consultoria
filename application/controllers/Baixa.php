<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Baixa extends CI_Controller{
	public function index(){
		if(verifica_login($this->session)){
			$this->load->model("estoque_model");
			$produtos_estoque = $this->estoque_model->getInfoParaBaixa();
			$dados = array('produtos_estoque' => $produtos_estoque);
			$this->load->view("Estoque/Baixa",$dados);
		} else{
			redirect("/");
		}
		
	}

	public function cadastrarBaixa(){
		$this->form_validation->set_rules("idProduto","idProduto","required");
		$this->form_validation->set_rules("quantidade","Quantidade","required");
		$ajax = $this->input->get("ajax");

		if($this->form_validation->run() == false){
			if($ajax){
				$json = array('result' => false,'erro'=>'falha na validação');
				echo json_encode($json);
				$this->session->set_flashdata("danger","Erro de validação.");
			} else{
				$this->session->set_flashdata("danger","Erro de validação.");
			}
		} else{
			$idProduto = $this->input->post("idProduto");
			$quantidade = $this->input->post("quantidade");
			$idUsuario = $this->input->post("idUsuario");

			$dados = array(
				'quantidade' => $quantidade,
				'produto_id' => $idProduto,
				'usuario_id' => $idUsuario
				);

			$this->load->model("estoque_model");

			if($this->estoque_model->cadastraBaixa($dados)){
				if($ajax){
					$json = array('result' => true);
					echo json_encode($json);
					$this->session->set_flashdata("success","Baixa efetuada com sucesso.");
				} else{
					$this->session->set_flashdata("success","Baixa efetuadacom sucesso.");
				}
			} else{
				if($ajax){
					$json = array('result' => false,"erro" => 'falha no cadastro da baixa');
					echo json_encode($json);
					$this->session->set_flashdata("danger","Erro ao dar baixa, por favor tente novamente");
				} else{
					$this->session->set_flashdata("danger","Erro ao dar baixa, por favor tente novamente");
				}	
			}
		}
	}
}
