<?php $this->load->view("Static/Header.php") ?>
<?php $this->load->view("Static/Menu");?>
<div class="col-md-10">
	<div id="header">
		<strong>
			<em>
				<h3 class="espacamentoLeft">Cadastro de Produtos</h3>
				<p id="mensagem"></p>
			</em>
		</strong>
	</div>
	<div id="body" class="container-fluid">
		<!-- <form id="formCadProdutos" action="<-?=base_url('index.php/Produtos/cadastrarProduto')?>" method="POST" enctype="multipart/form-data"> -->
		<?php echo form_open_multipart("Produtos/cadastrarProduto"); ?>
			<div class='form-group'>
				<div class="col-md-7">
					<label for="produto">Nome do produto</label>
					<input class="form-control" type="text" id="produto" name="produto" placeholder="Digite o nome do produto" required="">
				</div>
				<div class="espacamentoTop col-md-7">
					<label for="userfile">Imagem do produto</label>
					<input type="file" id="userfile" name="userfile" required="">
				</div>
				<div class="espacamentoTopBottom col-md-7">
					<input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar">
					<button class="btn btn-default" id="limpar" name="limpar">Limpar</button>
				</div>
			</div>
		</form>
	</div>
</div>
</main>
<footer class="thumbnail">
	<?php $usuario = $this->session->userdata("usuario_logado");?>
	<p>Usuário logado: <strong><em><?=$usuario['nome_usuario']?></em></strong></p>
</footer>
<script src=<?=base_url("js/jquery-2.2.3.min.js")?>></script>
<script src=<?=base_url("js/bootstrap.min.js")?>></script>
<script src=<?=base_url("js/dist/jquery.validate.min.js")?>></script>
<script>
	$().ready(function(){
		$("form").validate({
			rules:{
				produto:{
					required:true,
					minlength: 4,
					maxlength: 25
				},
				userfile:{
					accept: "image/jpg, imagen/jpeg, image/png"
				}
			},
			messages:{
				produto:{
					required: "Digite o nome do produto por favor.",
					minlength: "O nome d produto deve ter no mínimo 4 caracteres.",
					maxlength: "O nome do produto deve ter no máximo 25 caracteres."
				}
			},
			errorElement: 'span',
			
			submitHandler: function(){
				var dados = $("form").serialize();
				
				$.ajax({
              	type: "POST",
                 url: "<?=base_url('index.php/Produtos/cadastrarProdutos?ajax=true')?>",
                 data: dados,
                 dataType: 'json',
                 success: function(data){
                 	if(data.result==true){
                 		var p = '<?=$this->session->flashdata('success')?>';
                 		$("#mensagem").addClass("alert").addClass("alert-success").text(p);	
                 	} else{
						var p = '<?=$this->session->flashdata('danger')?>';
		             	$("#mensagem").addClass("alert").addClass("alert-danger").text(p);
                 	}
                 	
                 	// window.location.href("<?=base_url('index.php/Produtos')?>");
                 }
                 });

              	return false;
			}
		});
	});

	$("#limpar").click(function(){
		$("#produto").val("");
		$("#imagemProduto").val("");
		$("#usuario").focus();
	});
</script>
<?php $this->load->view("Static/Footer.php") ?>
