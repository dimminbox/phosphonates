<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />


        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/admin.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/admin-blue.css'); ?>
        <? Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom.js', CClientScript::POS_HEAD); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/behaviour.js', CClientScript::POS_HEAD); ?>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <div id="wrapper">
            <!--[if !IE]>start header main menu<![endif]-->
            <div id="header_main_menu">
                <span id="header_main_menu_bg"></span>
                <!--[if !IE]>start header<![endif]-->
                <div id="header">
                    <div class="inner">
                        <h1 id="logo"><a href="#">websitename1 <span>Administration Panel1111</span></a></h1>

                        <!--[if !IE]>start user details<![endif]-->
                        <div id="user_details">
                            <ul id="user_details_menu">
                                <li class="welcome">Welcome <strong>Administrator (<a href="#" class="new_messages">1 new message</a>)</strong></li>

                                <li>
                                    <ul id="user_access">
                                        <li class="first"><a href="#">My account</a></li>
                                        <li class="last"><a href="#">Log out</a></li>
                                    </ul>
                                </li>


                            </ul>

                            <div id="server_details">
                                <dl>
                                    <dt>Server time :</dt>
                                    <dd>9:22 AM | 03/04/2009</dd>
                                </dl>
                                <dl>
                                    <dt>Last login ip :</dt>
                                    <dd>192.168.0.25</dd>
                                </dl>
                            </div>

                        </div>

                    </div>
                </div>
                <div id="main_menu">
                    <div class="inner">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
                                array('label' => '<span class="l"><span></span></span><span class="m"><em>Home</em><span></span></span><span class="r"><span></span></span>',
                                    'url' => array('/site/index'), 'linkOptions' => array('class' => 'selected_lk'),
                                    'items' => array(
                                        array('label' => '<span class="l"><span></span></span><span class="m"><em>Films</em><span></span></span><span class="r"><span></span></span>',
                                            'url' => array('/film/index'),'linkOptions' => array('class' => 'selected_lk')),
                                        array('label' => '<span class="l"><span></span></span><span class="m"><em>Films</em><span></span></span><span class="r"><span></span></span>',
                                            'url' => array('/film/index'),),
                                    ),
                                ),
                                array('label' => '<span class="l"><span></span></span><span class="m"><em>Films</em><span></span></span><span class="r"><span></span></span>',
                                    'url' => array('/film/index')),
                                array('label' => '<span class="l"><span></span></span><span class="m"><em>Styles</em><span></span></span><span class="r"><span></span></span>',
                                    'url' => array('/style/index')),
                                array('label' => '<span class="l"><span></span></span><span class="m"><em>Users</em><span></span></span><span class="r"><span></span></span>',
                                    'url' => array('/user')),
                                array('label' => '<span class="l"><span></span></span><span class="m"><em>Login</em><span></span></span><span class="r"><span></span></span>',
                                    'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => '<span class="l"><span></span></span><span class="m"><em>Logout (' . Yii::app()->user->name . ') </em><span></span></span><span class="r"><span></span></span>',
                                    'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                            ),
                            'itemTemplate' => '{menu}',
                            'encodeLabel' => false,
                        ));
                        ?>
                    </div>
                    <span class="sub_bg"></span>
                </div>
                <!--[if !IE]>end main menu<![endif]-->

            </div>

            <!--[if !IE]>end header main menu<![endif]-->


            <!--[if !IE]>start content<![endif]-->
            <div id="content">

            </div>
            <!--[if !IE]>end content<![endif]-->


        </div>
        <div class="container" id="page">

            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->


            <?php
            $this->widget('zii.widgets.CBreadcrumbs', array(
                'links' => $this->breadcrumbs,
            ));
            ?><!-- breadcrumbs -->

            <?php echo $content; ?>

            <div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
                <?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>