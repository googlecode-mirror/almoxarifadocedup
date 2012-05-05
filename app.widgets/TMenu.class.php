<?php

class TMenu{
	
	private $itens;
	
	public function __construct($permissoes)
	{
		$this->itens = $permissoes;
		//TAplication::setStyle('menu');
	}
	
	public function show()
	{
		echo '<ul class="menu-definition">',"\n";
		foreach($this->itens as $modulo=>$scripts)
		{
			echo '  <li class="menu-item">',"\n",
'   <img src="app.misc/images/menu/'.$modulo.'.png" alt="'.$modulo.'" height="50" width="50" />',"\n",
'       <ul id="id-'.$modulo.'" class="submenu-definition">',"\n";
			
			foreach($scripts as $script)
			{
				echo "          <li class='menu-subitem'><a href='index.php?modulo={$modulo}&page={$script}'><img src='app.misc/images/menu/{$script}.png' alt='{$script}' height='50' width='50' /></a></li>\n";
			}
			
			echo '      </ul>',"\n",'   </li>',"\n";
		}
                echo '</ul>',"\n";
                
        }

}

?>