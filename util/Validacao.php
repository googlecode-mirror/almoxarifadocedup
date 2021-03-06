<?php 
function ValidaFormulario(array $campos){
	//variaveis para armazenamento das mensagens
	$camposVazios = array();
	$camposErrados = array();
	$sucesso = true;
	$erro = '';

	// Faz um foreach em cada campo setado na função
	foreach($campos as $campo => $itens){
		
                // Se o campo estiver vazio, armazena a legenda do campo q esta vazio
		if(empty($_POST[$campo])){

			$camposVazios[] = "<b style='color:red'>".$itens[0]."</b><br/>";
		}
		// se estiver setado o tipo de dado, a função validará de acordo com o q foi pedido na função
		// OBS IMPORTANTE: SE O CAMPO FOR ALFANUMERICO, NÃO COLOQUE TIPO NENHUM, POIS SÓ PRECISARA VALIDAR SE ESTA VAZIO
		if(!empty($_POST[$campo]) && array_key_exists('tipo',$itens)){
			// Se for do tipo string, só aceitará letras
			if($itens['tipo'] == 'string' && !preg_match("/^[a-zA-Z]+$/",$_POST[$campo])){
				$camposErrados[] = "No campo <b style='color:red'>".$itens[0]."</b> voce só pode digitar letras.<br/><br/>";
			}
			
			// Se for do tipo nome, só aceitará nome de 4 a 28 caracteres alfa-numérios
			if($itens['tipo'] == 'nome' && !preg_match("/^[a-z\d_]{4,28}$/i",$_POST[$campo])){
				$camposErrados[] = "O campo <b style='color:red'>".$itens[0]."</b> deve ter de 4 - 28 caracteres.<br/><br/>";
			}
			
			// Se for do tipo data, só aceitará data no formato dd/mm/yyyy
			if($itens['tipo'] == 'data' && !preg_match("/^\d{1,2}\/\d{1,2}\/\d{4}$/",$_POST[$campo])){
				$camposErrados[] = "O campo <b style='color:red'>".$itens[0]."</b> deve possuir o formato DD/MM/YYYY.<br/><br/>";
			}
			
			// Se for do tipo inteiro, só aceitará numeros
			if($itens['tipo'] == 'inteiro' && !preg_match("/^[0-9]+$/",$_POST[$campo])){
				$camposErrados[] = "No campo <b style='color:red'>".$itens[0]."</b> voce só pode digitar números.<br/><br/>";
			}
			// tipo para comparação de dados com outro campo, consta no exemplo duas vezes...
			if($itens['tipo'] == 'igualdade' && strlen($_POST[$campo]) != strlen($_POST[$itens['compara']])){
				$camposErrados[] = "Os campos <b style='color:red'>".$itens[0]."</b> e <b style='color:red'>".$itens['legenda_2']."</b> tem que ser iguais.<br/><br/>";
			}
			// valida o e-mail
			if($itens['tipo'] == 'email' && !preg_match("/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,4}$/i",$_POST[$campo])){
				$camposErrados[] = "Digite um E-mail válido no campo <b style='color:red'>".$itens[0]."</b><br/><br/>";
			}
			// valida o formato do telefone com DDD de 3 digitos
			if($itens['tipo'] == 'ddd_telefone' && !preg_match("/^\(\d{3}\)[\s-]?\d{4}-\d{4}$/",$_POST[$campo])){
				$camposErrados[] = "Digite o formato correto no campo <b style='color:red'>".$itens[0]."</b>, correto: (000)0000-0000.<br/><br/>";
			}
			// valida DD com 3 numeros, pois tem usuario que teima em colocar somente dois digitos, quando nós queremos os 3
			if($itens['tipo'] == 'ddd_3' && !preg_match("/^\d{3}$/",$_POST[$campo])){
				$camposErrados[] = "Digite o formato correto no campo <b style='color:red'>".$itens[0]."</b>, correto: 000.<br/><br/>";
			}
			// valida o numeros do telefone sem o DDD
			if($itens['tipo'] == 'telefone' && !preg_match("/^\d{4}-\d{4}$/",$_POST[$campo])){
				$camposErrados[] = "Digite o formato correto no campo <b style='color:red'>".$itens[0]."</b>, correto: 0000-0000.<br/><br/>";
			}
			// valida o CEP sem o traço
			if($itens['tipo'] == 'cep_num' && !preg_match("/^\d{5}$/",$_POST[$campo])){
				$camposErrados[] = "Digite o formato correto no campo <b style='color:red'>".$itens[0]."</b> correto: 00000000.<br/><br/>";
			}
			// valida o CEP com o traço
			if($itens['tipo'] == 'cep' && !preg_match("/^\d{5}-\d{3}$/",$_POST[$campo])){
				$camposErrados[] = "Digite o formato correto no campo <b style='color:red'>".$itens[0]."</b> correto: 00000-000.<br/><br/>";
			}
			// valida o tamanho do CPF
			if($itens['tipo'] == 'cpf_num' && !preg_match("/^\d{11}$/",$_POST[$campo])){
				$camposErrados[] = "Digite o formato correto no campo <b style='color:red'>".$itens[0]."</b> correto: 00000000000.<br/><br/>";
			}
			// valida o tamanho e o formato do CPF
			if($itens['tipo'] == 'cpf_separators' && !preg_match("/^\d{3}.\d{3}.\d{3}-\d{2}$/",$_POST[$campo])){
				$camposErrados[] = "Digite o formato correto no campo <b style='color:red'>".$itens[0]."</b> correto: 000.000.000-00.<br/><br/>";
			}
			// valida o tamanho do CNPJ, com o novo formato, de 15 digitos
			if($itens['tipo'] == 'cnpj_num' && !preg_match("/^\d{15}$/",$_POST[$campo])){
				$camposErrados[] = "Digite o formato correto no campo <b style='color:red'>".$itens[0]."</b> correto: 000000000000000.<br/><br/>";
			}
			// valida o formato e o tamanho do CNPJ já com o novo formato do CNPJ
			if($itens['tipo'] == 'cnpj_separators' && !preg_match("/^\d{3}.\d{3}.\d{3}/\d{4}-\d{2}$/",$_POST[$campo])){
				$camposErrados[] = "Digite o formato correto no campo <b style='color:red'>".$itens[0]."</b> correto: 000.000.000/0000-00.<br/><br/>";
			}
                        
                        if($itens['tipo'] == 'select' && $_POST[$campo] == 0){
				$camposErrados[] = "No campo <b style='color:red'>".$itens[0]."</b> voce deve selecionar algo.<br/><br/>";
			}
		}
	}
	// verifica se houve algum erro
	if(count($camposVazios) > 0 || count($camposErrados) > 0){

		// se houve, mostra a mensagem com as legendas dos campos e os tipo de erro
		if(count($camposVazios) > 0){
			$erro.= "<b>Os seguintes campos Obrigatórios estăo vazios:</b><br/>".implode("",$camposVazios);
		}
		if(count($camposVazios) > 0 && count($camposErrados) > 0){
			$erro.= '<br/>';
		}
		if(count($camposErrados) > 0){
			$erro.= "<b>Ocorreram os seguintes erros:</b><br/>".implode("",$camposErrados);
		}
		return $erro;
	}else{
		// se não retorna true
		return $sucesso;
	}
}

?>