<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Produtos extends CI_Controller{
	public function index(){
		if(verifica_login($this->session)){
			$this->load->view("Cadastros/Usuarios");
		} else{
			redirect("/");
		}
		
	}

	public function cadastrarUsuario(){
		$this->form_validation->set_rules("usuario","Usuario","required|trim|min_length[4]|max_length[25]");
		$this->form_validation->set_rules("senha","Senha","required|trim|min_length[4]|max_length[20]");
		$ajax = $this->input->get("ajax");

		if($this->form_validation->run() == false){
			if($ajax){
				$json = array('result' => false,'falha' => 'falhou na validação');
				echo json_encode($json);
				$this->session->set_flashdata("danger","Erro de validação.");
			} else{
				$this->session->set_flashdata("danger","Erro de validação.");
			}
		} else{
			$usuario = $this->input->post("usuario");
			$senha = md5($this->input->post("senha"));

			$dados = array(
				'nome_usuario' => $usuario,
				'senha' => $senha,
				'data_criacao' => date('Y-m-d')
				);

			$this->load->model("cadastros_model");

			if($this->cadastros_model->verificaUsuario($usuario)){
				if($this->cadastros_model->cadastraUsuario($dados)){
					if($ajax){
						$json = array('result' => true,'falha' => 'deu certo');
						echo json_encode($json);
						$this->session->set_flashdata("success","Usuário cadastrado com sucesso.");
					} else{
						$this->session->set_flashdata("success","Usuário cadastrado com sucesso.");
					}
				}
			} else{
				if($ajax){
					$json = array('result' => false,'falha' => 'já tem cadastrado');
					echo json_encode($json);
					$this->session->set_flashdata("danger","Usuário já está cadastrado no banco de dados");
				} else{
					$this->session->set_flashdata("danger",	"Usuário já está cadastrado no banco de dados");
				}	
			}
		}
	}

}
