<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" lang="pt_BR">
		<head>
			<title>Cedup - Almoxarifado</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<link type="text/css" href="app.misc/css/menu.css" rel="stylesheet" ></link>
                        <link type="text/css" href="app.misc/css/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
                        <link type="text/css" href="app.misc/css/login.css" rel="stylesheet" ></link>
			<link href="app.misc/css/style.css" rel="stylesheet" type="text/css" ></link>
			<script type="text/javascript" src="app.misc/js/jquery.js"></script>
			<script type="text/javascript" src="app.misc/js/menu.js"></script>
                        <link type="text/css" href="app.misc/css/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" ></link>
                        <script type="text/javascript" src="app.misc/js/jquery-1.6.2.min.js"></script>
                        <script type="text/javascript" src="app.misc/js/jquery-ui-1.8.16.custom.min.js"></script>
                        <script type="text/javascript" src="app.misc/js/script.js"></script>
                        <link href="app.misc/css/estilo.css" type="text/css" rel="stylesheet" title="CSS" principal="" media="all"></link>
			
		</head>
            <body>
                <a href="index.php" class="open-link" title="Abrindo um Janela">Abrir Janela JQUERY</a>
                
                <div id="janela-dialog">
                    <form action="" id="form-dialog" name="form-dialog" method="button">
                        <fieldset>
                            <label>Nome</label>
                            <textarea name="comment" cols="1" rows="1"></textarea>
                        </fieldset>
                    </form>
                    
                </div>
                
                
            <a href="delete.php" id="delete-link" ><img src="app.misc/images/ico_delete.png"/></a>
                
            <div id="delete-dialog" title="Delete this TODO?">
                <p><span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 20px 0;"></span>This TODO will be deleted. Are you sure?</p>
            </div>
            
            
                <
              
           <?php $message = null; ?>     
            
           <?php if ($message){ ?>
            <div id="alert">
                <span class="ui-icon ui-icon-circle-check"></span><span id="msg"> <?php echo $message ?></span>
            </div>    
            <?php } ?>     
            </body>