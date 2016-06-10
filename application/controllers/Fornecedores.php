<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Fornecedores extends CI_Controller{
	public function index(){
		if(verifica_login($this->session)){
			$this->load->view("Cadastros/Fornecedores");
		} else{
			redirect("/");
		}
		
	}

	public function cadastrarFornecedor(){
		$this->form_validation->set_rules("fornecedor","Fornecedor","required|trim|max_length[45]");
		$this->form_validation->set_rules("telefone","Telefone","required|trim|max_length[9]");
		$this->form_validation->set_rules("email","Email","required|trim");
		$this->form_validation->set_rules("cpf","Telefone","required|trim|max_length[11]");
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
			$fornecedor = $this->input->post("fornecedor");
			$telefone = $this->input->post("telefone");
			$email = $this->input->post("email");
			$cpf = $this->input->post("cpf");

			$dados = array(
				'nome' => $fornecedor,
				'fone' => $telefone,
				'email' => $email,
				'cpf' => $cpf
				);

			$this->load->model("cadastros_model");

			if($this->cadastros_model->verificaCpfFornecedor($cpf)){
				if($this->cadastros_model->cadastraFornecedor($dados)){
					if($ajax){
						$json = array('result' => true);
						echo json_encode($json);
						$this->session->set_flashdata("success","Fornecedor cadastrado com sucesso.");
					} else{
						$this->session->set_flashdata("success","Fornecedor cadastrado com sucesso.");
					}
				}
			} else{
				if($ajax){
					$json = array('result' => false);
					echo json_encode($json);
					$this->session->set_flashdata("danger","CPF já existe no banco de dados");
				} else{
					$this->session->set_flashdata("danger","CPF já existe no banco de dados");
				}	
			}
		}
	}

}
