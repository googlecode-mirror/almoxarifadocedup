<?php

	class TDate{
	
		private $dt;
 
		function conv_data_to_us($date){
			$dia = substr($date,0,2);
			$mes = substr($date,3,2);
			$ano = substr($date,6,4);
			return "{$ano}-{$mes}-{$dia}";
		}
		
		function conv_data_to_br($date){
			$ano = substr($date,0,4);
			$mes = substr($date,5,2);
			$dia = substr($date,8,4);
			return "{$dia}/{$mes}/{$ano}";
		}
	
		function __construct($date,$format){
		
			if ($format == 'br') {	
				
				$this->dt = self::conv_data_to_us($date);
			
			}elseif ($format = 'us'){
			
				$this->dt = self::conv_data_to_br($date);

			}
		}
		
		function getDate(){
			return $this->dt;
		}
		
		
	}