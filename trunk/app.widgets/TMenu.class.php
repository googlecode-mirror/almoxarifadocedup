<?php

class TMenu{
	
	private $itens;
        private $restrict = array();
	
	public function __construct($permissoes,$restrict = array())
	{
		$this->itens = $permissoes;
                $this->restrict = $restrict;
		//TAplication::setStyle('menu');
                
                foreach($this->itens as $modulo=>$scripts)
                {
                    foreach($scripts as $key=>$script)
                    {
                        if(in_array($script,$this->restrict))
                            unset($this->itens[$modulo][$key]);
                    }
                    
                    if(!$this->itens[$modulo])
                        unset($this->itens[$modulo]);
                }
	}
	
	public function show(){?>
            <ul class="menu-definition">
                <li class="menu-item">
                    <a href="index.php">
                        <img src="app.misc/images/menu/principal.png" alt="principal" height="50" width="50" />
                    </a>
                </li>
                
<?php	foreach($this->itens as $modulo=>$scripts){ ?>
		<li class="menu-item">
                    <img src="app.misc/images/menu/<?php echo $modulo; ?>.png" alt="<?php $modulo ?>" height="50" width="50" />
                    <ul id="id-<?php $modulo ?>" class="submenu-definition">
<?php	foreach($scripts as $script){ if($script != 'logout'){?>
                        <li class='menu-subitem'>
                            <a href='index.php?modulo=<?php echo $modulo; ?>&page=<?php echo $script; ?>'>
                                <img src='app.misc/images/menu/<?php echo $script; ?>.png' alt='<?php echo $script; ?>' height='50' width='50' />
                            </a>
                        </li>
<?php		}}?>
                    </ul>
                </li>
<?php      } ?>
                <li class="menu-item">
                    <a href="index.php?modulo=usuarios&page=logout">
                        <img src="app.misc/images/menu/logout.png" alt="logout" height="50" width="50" />
                    </a>
                </li>
            </ul>
                
<?php   }

} ?>