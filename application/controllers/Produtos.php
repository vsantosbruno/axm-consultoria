<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Produtos extends CI_Controller{
	public function index(){
		if(verifica_login($this->session)){
			$this->load->view("Cadastros/Produtos");
		} else{
			redirect("/");
		}
		
	}

	public function cadastrarProduto(){
		$this->form_validation->set_rules("produto","Produto","required|trim|min_length[4]|max_length[25]");
		$ajax = $this->input->get("ajax");

		if($this->form_validation->run() == false){
			if($ajax){
				$json = array('result' => false,"falha" => 'na validacao');
				echo json_encode($json);
				$this->session->set_flashdata("danger","Erro de validação.");
			} else{
				$this->session->set_flashdata("danger","Erro de validação.");
			}
		} else{
			$produto = $this->input->post("produto");

			$this->load->model("cadastros_model");

			if($this->cadastros_model->verificaProduto($produto)){
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = '|jpg|jpeg|png';
				$config['max_size']	= '1000';
				$config['max_width']  = '1024';
				$config['max_height']  = '768';
				
				$this->load->library('upload', $config);


				if($this->upload->do_upload()){
					$dados = array(
						'nome' => $produto,
						'img_path' => $this->upload->data('full_path')
						);
					if($this->cadastros_model->cadastraProduto($dados)){
						if($ajax){
							$json = array('result' => true);
							echo json_encode($json);
							$this->session->set_flashdata("success","Produto cadastrado com sucesso");
						} else{
							$this->session->set_flashdata("success","Produto cadastrado com sucesso");
						}
						$this->load->view("Cadastros/Produtos");
					}else{
						if($ajax){
							$json = array('result' => false);
							echo json_encode($json);
							$this->session->set_flashdata("success","Falha ao cadastrar produto, por favor tente novamente.");
						} else{
							$this->session->set_flashdata("success","Falha ao cadastrar produto, por favor tente novamente.");
						}
					}
				}else{
					if($ajax){
						$json = array('result' => false);
						echo json_encode($json);
						$this->session->set_flashdata("success","Falha ao cadastrar produto, por favor tente novamente.");
					} else{
						$this->session->set_flashdata("success","Falha ao cadastrar produto, por favor tente novamente.");
					}
				}
			} else{
				if($ajax){
					$json = array('result' => false);
					echo json_encode($json);
					$this->session->set_flashdata("danger","Produto já cadastrado no banco de dados");
				} else{
					$this->session->set_flashdata("danger","Produto já cadastrado no banco de dados");
				}

				$this->load->view("Cadastros/Produtos");
			}
		}
	}

}
