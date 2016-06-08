<?php $this->load->view("Static/HeaderLogin.php") ?>
<header>
</header>
<main>
	<div class="col-md-4"></div>
	<div class="col-md-4 thumbnail" style="margin-top:15%">
		<div>
		<form id="formLogin" method="POST" action="index.php/Home/autenticar">
			<input class="form-control" type="text" id="usuario" name="usuario" placeholder="Usuário">
			<input class="espacamentoTop form-control" type="password" id="senha" name="senha" placeholder="Senha">
			<input class="espacamentoTop btn btn-primary col-md-4" type="submit" id="entrar" name="entrar" value="Entrar">
		</form>
		</div>
		<div>
			<p id="erro" style="margin-top:15%"></p>
		</div>

	</div>

	<div class="col-md-4"></div>
</main>
<script src="<?=base_url("js/lib/jquery.js")?>"></script>
<script src="<?=base_url("js/dist/jquery.validate.min.js")?>"></script>
<script>
	$(document).ready(function(){
		$("#formLogin").validate({
			errorElement: 'span',
			rules:{
				usuario:{ required: true, },
				senha:{ required: true }
			},
			messages:{
				usuario:{ required: "Por favor digite o seu usuário." },
				senha:{ required: "Por favor digite a sua senha" }
			},
			submitHandler: function(){
				var dados = $("#formLogin").serialize();
	                $.ajax({
	                  type: "POST",
	                  url: "index.php/Home/autenticar?ajax=true",
	                  data: dados,
	                  dataType: 'json',
	                  success: function(data)
	                  {
	                    if(data.result == true){
	                        window.location.href = "index.php/Principal";
	                    } else{
	                    	var p = "<?=$this->session->flashdata('danger')?>";
	                    	$("#erro").addClass("alert").addClass("alert-danger").text(p);

	                    }
	                  }
	                  });

	                  return false;
			}
		});
	});
</script>
<?php $this->load->view("Static/Footer.php") ?>