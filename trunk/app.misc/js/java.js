$(document).ready(function() {
    initDatepicker();
    initFlashes();
    initErrorFields();
    initDeleteDialog();
    zerar();
    
});
	
function gE(ID){
	return document.getElementById(ID);
}

function gEs(tag){
	return dcocument.getElementByTagName(tag);
}

function ValidaForm(frm) {

	if (frm.senha_usuario.value == frm.senha2_usuario.value){
	return true;
	}else{
	alert('Senha diferentes!');
	return false;
	}
}


function ValidaCampos(){
    
            $("#numeroLab").blur(function(){
                if ($("#numeroLab").val() != ""){
                    $.ajax({
                    type: "POST",
                    url: 'index.php?modulo=chaves&page=gerenciar&ajax=1&lab=1',
                    data: {val: $("#numeroLab").val()},
                    success: function(valor){
                        if (valor == 'true'){
                            $("#numeroLab").css('background','red');
                            flag = false;
                        }else{
                            $("#numeroLab").css('background','#fff');
                            flag = true;
                        }
                    }
                    })
                }
            })
            
        return flag;

}

function habilita(e){
    
    select = $(".select");
    date = $("#date");
 
    if ($("#habilitar").attr("checked") == "checked"){
        select.removeAttr("disabled");
        date.datepicker( "enable" );
    }else{
        select.attr("disabled","disabled");
        date.datepicker( "disable" );
        
    }
  
    
    
}

function clique(e){
	
	
	$(e).attr('class','linha');
	
	var key = $(".linha td").html();
	
	$("tr").each(function(i){
		
	if ($(this).attr('bgcolor') != '#FF7F50') {
		
		if (i%2 == 0){
			$(this).css('background', '#e0e0e0');
		}else{
			$(this).css('background', '#ffffff');
		}
		
	}	
			$(this).removeClass('linha');

	});
	
	$('#menu').css("visibility","visible" );
	
	$("#a1").attr('href', 'index.php?modulo=usuarios&page=gerenciar&key='+key);
	$("#a2").attr('href', 'index.php?modulo=permissoes&page=gerenciar&key='+key);	
	$("#a3").attr('href', 'index.php?modulo=chaves&page=gerenciar&key='+key);	
	$("#a4").attr('href', 'index.php?modulo=emprestimos&page=gerar&key='+key);
        $("#a5").attr('href', 'index.php?modulo=usuarios&page=visualizar&key='+key);	
        $("#a5").attr('id','delete-link');

	$(e).css('background','#E9967A');
	

}

function zerar(){

    $('#content').click(function(e){

        if (e.target == this){

            $('#menu').css("visibility","hidden" );
           
            $("#tableUsers tr").each(function(i){
		
        if (i%2 == 0){
			$(this).attr('bgcolor', '#e0e0e0');
		}else{
			$(this).attr('bgcolor', '#ffffff');
		}
			$(this).removeClass('linha');

            });
        }
    })


}


