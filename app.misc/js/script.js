$(document).ready(function() {
    
    efeitomouse();
    initDatepicker();
    initFlashes();
    initErrorFields();
    initFormDialog();
    initDeleteDialog();
    intAlertMsg();
    initFormDelete();
    initFormDialogMat();
    zerar(); 
    populadisciplina();
    populafase();
    efeitomouse();
    SF();
    ValidaCampos();
    
 

});

function SF(){
       $('#frm').StickyForm({
             'debug': 'false', // [true/false] Enable debugging
             'elementTypes'	: 'all', // [text,password,checkbox,radio,textarea,select-one,all] separate element types with comma separated values (default is all)
             'cookieLifetime': '0.1', // [integer] number of days of cookie lifetime
             'disableOnSubmit': 'true', // [true/false] disable submitting the form while the form is processing
             'excludeElementIDs': '', // [ID1,ID2] exclude element IDs with comma separated values
             'scope': 'global', // [single/global] should the values be sticky only on this form (single) or across all forms on site (default is global)
             'disableIfGetSet' : 'elq' // ['',$_GET var] set to the $_GET var.  If this $_GET var is present, it will automatically disable the plugin. (default is '')
       });
}

function efeitomouse(){
    
    
    $("#table tr").hover(
    function(){
        if ($(this).attr('bgcolor') != '#FF7F50') {
            $(this).addClass("hover");
        }
    },
    function(){
        $(this).removeClass("hover");
    });
  
}

function populadisciplina(){
       
       $("#curso").change(function(){
           $.ajax({
               type: "POST",
               url: 'index.php?modulo=solicitacoes&page=gerar&ajax=1',
               data: {val: $("#curso").val()},
               datatype: "json",
               success: function (valores){
                   var options = "";
                   
                   $.each(valores,function(key,valor){
                       options += '<option value="'+ valor[0]+ '">'+ valor[1]+'</option>';
                   })
                   $("#disciplina").html(options);  
               }
           })
       })
  
}


function populafase(){
       
       $("#curso").change(function(){
           $.ajax({
               type: "POST",
               url: 'index.php?modulo=solicitacoes&page=gerar&ajax=1',
               data: {valor: $("#curso").val()},
               datatype: "json",
               success: function (valores){
                   var options = "";
                   $.each(valores,function(key,valor){
                       options += '<option value="'+ valor[0]+ '">'+ valor[1]+'</option>';
                     
                   })
                   $("#fase").html(options);  
               }
           })  
       })
  
}

function initDatepicker() {
    
    $.datepicker.regional['pt-BR'] = {
		closeText: 'Fechar',
		prevText: '&#x3c;Anterior',
		nextText: 'Pr&oacute;ximo&#x3e;',
		currentText: 'Hoje',
		monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
		'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
		'Jul','Ago','Set','Out','Nov','Dez'],
		dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
		dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
                defaultDate: '00/00/00',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
                
    
    $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
    $('#datepicker')
        .attr('readonly', 'readonly')
        .datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            yearRange: "1920:2000",
	    changeYear: true
        });
        
    $('.datepicker')
        .datepicker('disable')
        .attr('readonly', 'readonly')
        .datepicker({
            dateFormat: 'dd/mm/yy',
        });
    
}

function initFlashes() {
    var flashes = $("#flashes");
    if (!flashes.length) {
        return;
    }
    setTimeout(function() {
        flashes.slideUp("slow");
    }, 2000);
}

function initErrorFields() {
    $('.error-field').first().focus();
}

function initDeleteDialog() {
    var deleteDialog = $('#delete-dialog');
    var deleteLink = $('#delete-link');
    deleteDialog.dialog({
        autoOpen: false,
        modal: true,
        width: 476,
        resizable: false,
        buttons: {
            'OK': function() {
                $(this).dialog('close');
                location.href = deleteLink.attr('href');
            },
            'Cancel': function() {
                $(this).dialog('close');
            }
        }
        
    });
    deleteLink.click(function() {
        deleteDialog.dialog('open');
        return false;
    });
}

function initFormDialog() {
    var Dialog = $('#janela-dialog');
    var Link = $('.open-link');
    var Form = $('#form-dialog');
    Dialog.dialog({
        autoOpen: false,
        modal: true,
        width: 520,
        resizable: false,
        buttons: {
            'OK': function() {
                Form.submit();
                $(this).dialog('close');
            },
            'Cancel': function() {
                $(this).dialog('close');
            }
        }
    });
    Link.click(function() {
    Form.attr('action', $(this).attr('href'));
    Dialog.dialog('option', 'title', $(this).attr('title'));
    Dialog.dialog('open');
        return false;
    });
}

function initFormDialogMat() {
    var Dialog = $('#janela-dialogMat');
    var Link = $('.open-linkMat');
    var Form = $('#form-dialogMat');
  
    Dialog.dialog({
        autoOpen: false,
        modal: true,
        width: Dialog.attr('width'),
        resizable: false,
        buttons: {
            'OK': function() {
                Form.submit();
                $(this).dialog('close');
            },
            'Cancel': function() {
                $(this).dialog('close');
                
            }
        }
    });

    Link.click(function() {
    Form.attr('action', $(this).attr('href'));
    Dialog.dialog('option', 'title', $(this).attr('title'));
    Dialog.dialog('option', 'open', getAquisicoes($(this).attr('title')));
    Dialog.dialog('option', 'title', '');
    Dialog.dialog('open');
    $("#date").datepicker( "disable" )
    
    return false;
    });

}

function getAquisicoes(id){
   
            $.ajax({
               type: "POST",
               url: 'index.php?modulo=solicitacoes&page=visualizar&ajax=1',
               data: {val: id},
               datatype: "json",
               success: function (valores){
                   var obj = jQuery.parseJSON(valores);
                   var options = "";
                   $.each(obj,function(key,valor){
                       if (key%2 == 0){ cor = '#ffffff'}else{ cor = '#e0e0e0'}
                       options += '<tr bgcolor='+cor+'><td>'+valor[0]+'</td> \n\
                                   <td align="left" style=padding-left:5px>'+valor[1]+'</td>\n\
                                   <td>'+valor[2]+'</td></tr>';
                       
                   })
                   $("#tableBody").html(options);  
               }
           })
             
 
        
}

function initFormDelete() {
    var Dialog = $('#janela-delete');
    var Link = $('.open-link-delete');
    var Form = $('#form-delete');
    Dialog.dialog({
        autoOpen: false,
        modal: true,
        width: 520,
        resizable: false,
        buttons: {
            'OK': function() {
                Form.submit();
                $(this).dialog('close');
            },
            'Cancel': function() {
                $(this).dialog('close');
                
            }
        }
    });
    Link.click(function() {
    Form.attr('action', $(this).attr('href'));
    Dialog.dialog('option', 'title', $(this).attr('title'));
    Dialog.dialog('open');
        return false;
    });
}

function intAlertMsg(){
    
    var alert = $('#alert');
    
    alert.dialog({
        autoOpen: false,
        modal:true,
        resizable: false,
        buttons: {
            'OK': function(){
                $(this).dialog('close');
              
            }
            
        }
    })
       
    alert.dialog('open');
}    

