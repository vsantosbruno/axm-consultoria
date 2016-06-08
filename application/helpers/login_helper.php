<?php 
function verifica_login($session = ""){
	if($session->userdata("usuario_logado")){
		return true;
	} else{
		return false;
	}
}