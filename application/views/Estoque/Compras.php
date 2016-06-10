<?php $this->load->view("Static/Header.php"); ?>
<?php $this->load->view("Static/Menu");?>
<?php $this->output->enable_profiler(TRUE); ?>
<div class="col-md-10">
	<div id="header">
		<strong>
			<em>
				<h3 class="espacamentoLeft">Cadastro de Produtos</h3>
				<p id="mensagem"></p>
			</em>
		</strong>
	</div>
	<div id="body" class="col-md-6 container-fluid">
		<form id="formCadCompras" action="<?=base_url('index.php/Estoque/cadastrarCompra')?>" method="POST">
			<div class='form-group'>
				<div class="col-md-12">
					<label for="idProduto">Produto</label>
					<select class="form-control" id="idProduto" name="idProduto">
						<option value="0">Selectione um produto</option>
						<?php foreach ($produtos as $key => $produto) :?>
							<option value=<?=$produto['id']?>><?=$produto['nome']?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="espacamentoTop col-md-12">
					<label for="idFornecedor">Fornecedor</label>
					<select class="form-control" id="idFornecedor" name="idFornecedor">
						<option value="0">Selecione um fornecedor</option>
						<?php foreach ($fornecedores as $key => $fornecedor) :?>
							<option value=<?=$fornecedor['id']?>><?=$fornecedor['nome']?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="espacamentoTop col-md-4">
					<label for="valor">Valor</label>
					<input class="form-control" type="text" id="valor" name="valor" placeholder="0.00" pattern="[0-9].[0-9]">
				</div>
				<div class="espacamentoTop col-md-4">
					<label for="quantidade">Quantidade</label>
					<input class="form-control" type="text" id="quantidade" name="quantidade" placeholder="0">
					<p id="alerta"></p>
				</div>
				<div class="espacamentoTop col-md-4">
					<label for="data">Data</label>
					<input class="form-control" type="text" id="data" name="data" value="<?=date('d/m/Y')?>" disabled>
				</div>
				<div class="espacamentoTopBottom col-md-12">
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
<script src=<?=base_url("js/mask-plugin-master/dist/jquery.mask.min.js")?>></script>

<script>
	$().ready(function(){
		$("#formCadCompras").validate({
			rules:{
				valor:{
					required: true
				},
				quantidade:{
					required: true
				}
			},
			messages:{
				valor:{
					required:"Digite o valor do produto"
				},
				quantidade:{
					required: "Digite a quantidade do produto"
				}
			},
			errorElement: 'span',
			
			submitHandler: function(){
				var dados = $("#formCadCompras").serialize();
				
				$.ajax({
              	type: "POST",
                 url: "<?=base_url('index.php/Estoque/cadastrarCompra?ajax=true')?>",
                 data: dados,
                 dataType: 'json',
                 success: function(data){
                 	if(data.result == false){
                 		alert(data.erro);	
                 	}
                 }
                 });

              	return false;
			}
		});
	});

	$("#quantidade").focusout(function(){
		$("#alerta").text("");
		var qtd = $(this).val();
		if(qtd > 50){
			alert("Limite diário de 50 unidades apenas");
			$(this).val("");
		}
	});

	$("#valor").mask('000000000000000,00', {reverse: true});
	$("#limpar").click(function(){
		$("#idProduto").val("0");
		$("#idFornecedor").val("0");
		$("#valor").val("");
		$("#quantidade").val("");
		$("#idProduto").focus();
	});
</script>
<?php $this->load->view("Static/Footer.php") ?>
