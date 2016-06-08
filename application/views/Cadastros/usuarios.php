<?php $this->load->view("Static/Header.php") ?>
<?php $this->load->view("Static/Menu");?>
<div class="col-md-10 thumbnail"><p><?=var_dump($this->session->userdata("usuario_logado"));?></div>
</main>
<footer class="footer"></footer>
<script src=<?=base_url("js/jquery-2.2.3.min.js")?>></script>
<script src=<?=base_url("js/bootstrap.min.js")?>></script>
<?php $this->load->view("Static/Footer.php") ?>
