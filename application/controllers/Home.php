<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Home extends CI_Controller{
	public function index(){
		if(verifica_login($this->session)){
			redirect("Principal");
		} else{
			$this->load->view("Home/Login");
		}
	
	}

	public function autenticar(){
		$this->load->library("form_validation");

		$this->form_validation->set_rules("usuario","Usuario","required|trim|min_length[3]|max_length[25]");
		$this->form_validation->set_rules("senha","Senha","required|trim|min_length[4]|max_length[20]");

		$ajax = $this->input->get("ajax");

		if($this->form_validation->run() == false){
			if($ajax){
				$json = array('result' => false);
				echo json_encode($json);	
			} else{
				$this->session->set_flashdata("danger","Dados incorretos");
			}
			
		} else{
			$usuario = $this->input->post("usuario");
			$senha = md5($this->input->post("senha"));

			$this->load->model("home_model");

			$usuarioAutenticado = $this->home_model->autentica($usuario,$senha);

			if($usuarioAutenticado){
				$this->session->set_userdata("usuario_logado",$usuarioAutenticado);

				if($ajax){
					$json = array('result' => true);
					echo json_encode($json);
				} else{
					redirect("Principal");
				}
			} else{
				if($ajax){
					$json = array('result' => false);
					$this->session->set_flashdata("danger","Dados não encontrados");
					echo json_encode($json);
				} else{
					$this->session->set_flashdata("danger","Dados não encontrados");
				}
			}
		}
	}
}