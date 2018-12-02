<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	
        <!--ultra admin -->
        <link media="screen" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login-ie.css" /><![endif]-->
        <!-- ultra admin -->
	<link media="screen" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login-blue.css"  />
        <? Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/behaviour.js',CClientScript::POS_HEAD); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/custom.js',CClientScript::POS_HEAD); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <?php echo $content; ?>
</body>
</html>