<?php $this->load->view("Static/Header.php") ?>
<?php $this->load->view("Static/Menu");?>
<div class="col-md-10">
	<div id="header">
		<strong>
			<em>
				<h3 class="espacamentoLeft">Compra de produto</h3>
				<p id="mensagem"></p>
			</em>
		</strong>
	</div>
	<div id="body" class="container-fluid">
		<form id="formCadFornecedores">
			<div class="espacamentoTop col-md-7">
				<label>Produto</label>
				<input class="form-control" type="text" id="fornecedor" name="fornecedor" placeholder="Digite o nome do fornecedor">
			</div>
			<div class="espacamentoTop col-md-7">
				<label>Fornecedor</label>
				<input class="form-control" type="text" id="telefone" name="telefone" placeholder="Digite o telefone do fornecedor">
			</div>
			<div class="espacamentoTop col-md-7">
				<label>E-mail</label>
				<input class="form-control" type="email" id="email" name="email" placeholder="Digite o e-mail do fornecedor">
			</div>
			<div class="espacamentoTop col-md-7">
				<label>CPF</label>
				<input class="form-control" type="text" id="cpf" name="cpf" placeholder="Digite o CPF do fornecedor">
			</div>
			<div class="espacamentoTopBottom col-md-7">
				<input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar">
				<button type="button" class="btn btn-default" id="limpar">Limpar</button>
			</div>
		</form>
	</div>
</div>
</main>
<footer class="thumbnail">
	<?php $usuario = $this->session->userdata("usuario_logado");?>
	<p>Usuário logado: <strong><em><?=$usuario['nome_usuario']?></em></strong></p>
	<input class="btn btn-danger" type="submit" id="limpar" name="sair" value="Sair">
</footer>
<script src=<?=base_url("js/jquery-2.2.3.min.js")?>></script>
<script src=<?=base_url("js/bootstrap.min.js")?>></script>
<script src=<?=base_url("js/dist/jquery.validate.min.js")?>></script>
<script>
	$().ready(function(){
		$("#formCadFornecedores").validate({
			rules:{
				fornecedor:{
					required: true,
					maxlength: 45
				},
				telefone:{
					required: true,
					maxlength: 9
				},
				email:{
					required: true
				},
				cpf:{
					required: true,
					maxlength: 11,
				}
			},
			messages:{
				fornecedor:{
					required: "Digite o nome do fornecedor por favor.",
					maxlength: "O fornecedor deve ter no máximo 45 caracteres."
				},
				telefone:{
					required: "Digite o telefone do fornecedor por favor.",
					maxlength: "O telefone do fornecedor porde ter nomáximo 9 caracteres."
				},
				email: {
					required: "Digite o email do fornecedor por favor."
				},
				cpf:{
					required: "Digite o CPF do fornecedor por favor",
					maxlength: "O CPF do fornecedor deve ter no máximo 11 caracteres"
				}
			},

			submitHandler: function(){
				var dados = $("#formCadFornecedores").serialize();
				$.ajax({
                  type: "POST",
                  url: "<?=base_url('index.php/Fornecedores/cadastrarFornecedor?ajax=true')?>",
                  data: dados,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                    	var p = '<?=$this->session->flashdata("success");?>';
                    	$("#mensagem").addClass("alert").addClass("alert-success").text(p);
                    } else{
                    	var p = '<?=$this->session->flashdata("danger");?>';
                    	$("#mensagem").addClass("alert").addClass("alert-danger").text(p);
                    }
                  }
                  });
			}
		});
	});

	$("#limpar").click(function(){
		$("#fornecedor").val("");
		$("#telefone").val("");
		$("#email").val("");
		$("#cpf").val("");
		$("#fornecedor").focus();
	});
</script>
<?php $this->load->view("Static/Footer.php") ?>
