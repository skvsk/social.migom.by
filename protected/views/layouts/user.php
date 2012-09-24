<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="ru" />
	
		<title><?php echo $this->title; ?></title>
                <?php Yii::app()->getClientScript()->registerCssFile('/css/default.css');?>
                <!--
                    FOR EXAMPLE
                
                    Yii::app()->clientScript->registerCoreScript('jquery');
                    Yii::app()->clientScript->registerCoreScript('jquery.ui');
                    Yii::app()->clientScript->registerScriptFile('/js/yourscript.js');
                    Yii::app()->getClientScript()->registerCssFile('/css/default.css');
                
                -->
                
                
                <link rel="SHORTCUT ICON" href="/favicon.ico">

                <link rel="stylesheet" type="text/css" media="all" href="css/chosen.css" />
                <script type="text/javascript" src="js/chosen.jquery.min.js"></script>
	</head>

	<body>		
                <!--HEAD-->		
                <?= $content ?>				
	</body>
</html>