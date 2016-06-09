<?php $this->load->view("Static/Header.php") ?>
<?php $this->load->view("Static/Menu");?>
<div class="col-md-10"></div>
</main>
<footer class="thumbnail">
	<?php $usuario = $this->session->userdata("usuario_logado");?>
	<p>Usuário logado: <strong><em><?=$usuario['nome_usuario']?></em></strong></p>
</footer>
<script src=<?=base_url("js/jquery-2.2.3.min.js")?>></script>
<script src=<?=base_url("js/bootstrap.min.js")?>></script>
<script>
</script>
<?php $this->load->view("Static/Footer.php") ?>
