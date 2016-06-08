<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Principal extends CI_Controller{
	public function index(){
		$this->load->view("Index/Principal.php");
	}
}