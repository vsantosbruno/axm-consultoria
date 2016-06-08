$.validator.setDefault({
		subimitHandler: function(){
			alert("Tudo certo!");
		}
	});

$().ready(function(){
	$("form").validate({
		errorElement: 'span',
		rules:{
			usuario:{
				required: true,
				minlength: 3,
				maxlength: 15
			},
			senha:{
				required: true,
				minlength: 4,
			}
		},
		messages:{
			usuario:{
				required: "Por favor digite o seu usuário.",
				minlength: "Seu usuário deve ter no mínimo 3 caracteres.",
				maxlength: "Seu usuário deve ter no máximo 15 caracteres."
			},
			senha:{
				required: "Por favor digite a sua senha",
				minlength: "Seu usuário deve ter no mínimo 4 caracteres."
			}
		}
	});
});