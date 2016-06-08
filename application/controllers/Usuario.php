<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Usuario extends CI_Controller{
	public function index(){
		$this->load->view("Cadastros/Usuarios");
	}
}