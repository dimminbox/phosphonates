<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	
        <!--ultra admin -->
        <link media="screen" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin-ie.css" /><![endif]-->
        <link media="screen" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin-blue.css"  />
        
        <!-- ultra admin -->


	
        <? Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/behaviour.js',CClientScript::POS_HEAD); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/custom.js',CClientScript::POS_HEAD); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div id="header_main_menu">
		
		<span id="header_main_menu_bg"></span>
		<!--[if !IE]>start header<![endif]-->
		<div id="header">
			<div class="inner">
				<h1 id="logo"><a href="#">Optica100 <span>Панель администратора</span></a></h1>
				
				<!--[if !IE]>start user details<![endif]-->
				<div id="user_details">
					<ul id="user_details_menu">
						<li class="welcome">Welcome Administrator!</li>
						
						<li>
							<ul id="user_access">
								<li class="first"><a href="#">My account</a></li>
								<li class="last"><a href="#">Log out</a></li>
							</ul>
						</li>
						
						
					</ul>					
				</div>
				
				<!--[if !IE]>end user details<![endif]-->
			</div>
		</div>
		<!--[if !IE]>end header<![endif]-->
		
		<!--[if !IE]>start main menu<![endif]-->
		<div id="main_menu">
                    <div class="inner">
                        <?php 

                        $this->widget('zii.widgets.CMenu',array(
                                'items'=>array(
                                        array('label'=>'Товары', 'url'=>array('/product/admin')),
                                        array('label'=>'Разделы', 'url'=>array('/category/admin')),
                                        array('label'=>'Аттрибуты', 'url'=>array('/attribute/admin')),
                                        array('label'=>'Новости', 'url'=> array('/news/admin')),
					array('label'=>'Советы', 'url'=> array('/advice/admin')),
					array('label'=>'Контент', 'url'=> array('/event/admin')),
					array('label'=>'Сертификат', 'url'=> array('/certificate/admin')),
                                        array('label'=>'Файлы', 'url'=> array('/file/admin')),
                                        array('label'=>'Пользователи', 'url'=>array('/user/')),
                                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                        array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                                ),
                                'itemTemplate'=>'<span class="l">
                                                    <span></span>
                                                  </span>
                                                  <span class="m">
                                                    {menu}
                                                    <span></span>
                                                  </span>
                                                  <span class="r">
                                                    <span></span>
                                                  </span>',
                        )); ?>
                    </div><!-- mainmenu -->
			
			<span class="sub_bg"></span>
		</div>
		<!--[if !IE]>end main menu<![endif]-->
		
</div>
                
<?php $this->beginContent('//layouts/main'); ?>
<?php echo $content; ?>
<?php $this->endContent(); ?>
</body>
</html>