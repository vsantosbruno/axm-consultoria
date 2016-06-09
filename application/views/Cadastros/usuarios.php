<?php $this->load->view("Static/Header.php") ?>
<?php $this->load->view("Static/Menu");?>
<div class="col-md-10">
	<div id="header">
		<strong>
			<em>
				<h3 class="espacamentoLeft">Cadastro de usuários</h3>
				<p id="mensagem"></p>
			</em>
		</strong>
	</div>
	<div id="body" class="container-fluid">
		<form id="formCadUsuarios" action="index.php/Usuarios/cadastrarUsuario" method="POST">
			<div class='form-group'>
				<div class="col-md-7">
					<label>Nome de usuário</label>
					<input class="form-control" type="text" id="usuario" name="usuario" placeholder="Digite um nome de usuário">
				</div></br>
				<div class="col-md-7">
					<label>Senha</label>
					<input class="form-control" type="password" id="senha" name="senha" placeholder="Digite uma senha para o usuário">
				</div></br>
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
	<input class="btn btn-danger" type="submit" id="limpar" name="sair" value="Sair">
</footer>
<script src=<?=base_url("js/jquery-2.2.3.min.js")?>></script>
<script src=<?=base_url("js/bootstrap.min.js")?>></script>
<script src=<?=base_url("js/dist/jquery.validate.min.js")?>></script>
<script>
	$().ready(function(){
		$("#formCadUsuarios").validate({
			rules:{
				usuario:{
					required:true,
					minlength: 4,
					maxlength: 25
				},
				senha:{
					required:true,
					minlength: 4,
					maxlength: 20
				}
			},
			messages:{
				usuario:{
					required: "Preencha o nome de usuário por favor.",
					minlength: "Nome de usuário deve ter no mínimo 4 caracteres.",
					maxlength: "Nome de usuário deve ter no máximo 25 caracteres."
				},
				senha:{
					required: "Digite uma senha para o usuário por favor.",
					minlength: "Senha deve ter no mínimo 4 caracteres",
					maxlength: "Senha deve ter no máximo 20 caracteres"
				}
			},
			errorElement: 'span',
			
			submitHandler: function(){
				var dados = $("#formCadUsuarios").serialize();
				$.ajax({
                  type: "POST",
                  url: "<?=base_url('index.php/Usuarios/cadastrarUsuario?ajax=true')?>",
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

              return false;
			}
		});
	});

	$("#limpar").click(function(){
		$("#usuario").val("");
		$("#senha").val("");
		$("#usuario").focus();
	});
</script>
<?php $this->load->view("Static/Footer.php") ?>
