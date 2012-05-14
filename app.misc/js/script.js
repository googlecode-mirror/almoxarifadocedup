
$(document).ready(function() {
    initDatepicker();
    initFlashes();
    initErrorFields();
    initFormDialog();
    initDeleteDialog();
    intAlertMsg();
    initFormDelete();
    initFormDialogMat();
    zerar();
    orderColuna();
});

function orderColuna(){
    
    $('.table th').click(function(){
        var valor = $(this).html();
        $("#test").load('index.php?modulo=usuarios&page=visualizar&ajax=1',{val:valor},ready())
    })
    
    function ready(){
        alert('Ajax terminou com sucesso.');
    }

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
    $('.datepicker')
        .attr('readonly', 'readonly')
        .datepicker({
            dateFormat: 'dd/mm/yy'
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

function initFormDelete() {
    var Dialog = $('#janela-delete');
    var Link = $('.open-link-delete');
    var Form = $('#form-delete');
    Dialog.dialog({
        autoOpen: false,
        modal: true,
        width: 520,
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
        buttons: {
            'OK': function(){
                $(this).dialog('close');
              
            }
            
        }
    })
       
    alert.dialog('open');
     
    
   
    
    
   
    
    
    
}
