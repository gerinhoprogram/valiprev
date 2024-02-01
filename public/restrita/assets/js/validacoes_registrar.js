var nome = $('#nome').val();
	var email = $('#email').val();
    if(nome && email){
        $('.proximo').css('pointer-events', 'auto');
    }else{
        $('.proximo').css('pointer-events', 'none');
    }

    $("#nome").keyup(function() {
        var nome = $(this).val();
		var email = $('#email').val();
		$('#erro_nome').html('');
	
		if(email){
			var re = /\S+@\S+\.\S+/;
			if(re.test(email) == false){
				$('#erro_email').html("<p class='text-danger'>E-mail inválido.</p>");
				$('.proximo').css('pointer-events', 'none');
			}else{
				if(nome){
					$('.proximo').css('pointer-events', 'auto');
					$('#erro_nome').html('');
					$('#erro_email').html('');
					$('#collapseTwo').addClass('show');
				}else{
					$('.proximo').css('pointer-events', 'none');
					$('#collapseTwo').removeClass('show');
				}
			}
		}
        
    });
	
	$("#email").keyup(function() {
        var email = $(this).val();
		var nome = $('#nome').val();
		$('#erro_email').html('');
			var re = /\S+@\S+\.\S+/;
			if(re.test(email) == false){
				$('#erro_email').html("<p class='text-danger'>E-mail inválido.</p>");
				$('.proximo').css('pointer-events', 'none');
				$('#collapseTwo').removeClass('show');
			}else{
				if(nome){
					$('.proximo').css('pointer-events', 'auto');
					$('#erro_nome').html('');
					$('#erro_email').html('');
					$('#collapseTwo').addClass('show');
				}else{
					$('.proximo').css('pointer-events', 'none');
					$('#collapseTwo').removeClass('show');
				}
			}
        
    });

    function proximo() {
        var nome = $('#nome').val();
		var email = $('#email').val();
        if(nome && email){
			var re = /\S+@\S+\.\S+/;
			if(re.test(email) == false){
				$('#erro_email').html("<p class='text-danger'>E-mail inválido.</p>");
				$('.proximo').css('pointer-events', 'none');
				$('#collapseTwo').removeClass('show');
			}else{
				$('#erro_nome').html('');
				$('#erro_email').html('');
			}
            
        }else{
			if(!email){
				$('#erro_email').html("<p class='text-danger'>Campo e-mail é obrigatório.</p>");
			}
			if(!nome){
				$('#erro_nome').html("<p class='text-danger'>Campo nome é obrigatório.</p>");
			}
            
        }
    }


//_+_+_+_+_+_+++_+_+_+_+_++
	
var senha = $('#senha').val();
    var conf = $('#confirma_senha').val();
    if(conf && senha){
        $('.salvar_dados').css('pointer-events', 'auto');
    }else{
        $('.salvar_dados').css('pointer-events', 'none');
    }

    $("#senha").keyup(function() {
        var conf = $('#confirma_senha').val();
        var senha = $(this).val();
        $('#erro_senha').html("");
        if(senha && conf){
            
            if(senha == conf){
                $('.salvar_dados').css('pointer-events', 'auto');
                $('#erro_conf').html('');
            }else{
                $('#erro_conf').html('<p class="text-danger">A confirmação precisa ser igual ao campo senha.</p>');
                $('.salvar_dados').css('pointer-events', 'none');
            }
            
        }else{
            $('.salvar_dados').css('pointer-events', 'none');
            $('#erro_senha').html('');
        }
    });

    $("#confirma_senha").keyup(function() {
        var conf = $(this).val();
        var senha = $('#senha').val();
        $('#erro_conf').html("");
        if(senha && conf){

            if(senha == conf){
                $('.salvar_dados').css('pointer-events', 'auto');
                $('#erro_conf').html('');
            }else{
                $('#erro_conf').html('<p class="text-danger">A confirmação precisa ser igual ao campo senha.</p>');
                $('.salvar_dados').css('pointer-events', 'none');
            }
            
        }else{
            $('.salvar_dados').css('pointer-events', 'none');
            $('#erro_conf').html('');
        }
    });

    function verificar_senha() {
        var senha = $('#senha').val();
        var conf = $('#confirma_senha').val();
        if(senha && conf){
            
            if(senha == conf){
                $('#erro_senha').html('');
                $('#erro_conf').html('');
            }else{
                $('#erro_senha').html('');
                $('#erro_conf').html('<p class="text-danger">A confirmação precisa ser igual ao campo senha.</p>');
            }
        }else{
            if(!senha && !conf){
                $('#erro_senha').html("<p class='text-danger'>Campo senha é obrigatório.</p>");
                $('#erro_conf').html("<p class='text-danger'>Campo confirmação é obrigatório.</p>");
            }
            if(!senha){
                $('#erro_senha').html("<p class='text-danger'>Campo senha é obrigatório.</p>");
            }
            if(!conf){
                $('#erro_conf').html("<p class='text-danger'>Campo confirmação é obrigatório.</p>");
            }
        }
    }