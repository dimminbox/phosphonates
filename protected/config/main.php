<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Cilita',
        'charset'=>'utf-8',
	// preloading 'log' component
	'preload'=>array('log'),
        'theme'=>'origin',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.modules.user.models.*',
                'application.modules.user.components.*',
                'application.components.shoppingCart.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'u9yIITHNQ',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
                 'user'=>array(
                    'sendActivationMail'=>false,
                    'returnLogoutUrl'=>'/',
                    'returnUrl'=>'/',
                    'loginNotActiv'=>true,
                    'activeAfterRegister'=>true,
                    'tableUsers' => 'tbl_users',
                    'tableProfiles' => 'tbl_profiles',
                    'tableProfileFields' => 'tbl_profiles_fields',
                      'profileRelations'=>array(
                        'type_user'=>array(CActiveRecord::BELONGS_TO, 'TblTypeUser', 'Type_id'),
                    ),
                    )
	),

	// application components
	'components'=>array(
		 'geoip' => array(
		    'class' => 'application.extensions.geoip.CGeoIP',
		    // specify filename location for the corresponding database
		    'filename' => $_SERVER['DOCUMENT_ROOT'].'/protected/extensions/geoip/GeoLiteCity.dat',
		    // Choose MEMORY_CACHE or STANDARD mode
		    'mode' => 'STANDARD',
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
                
                'shoppingCart' => array(
                        'class' => 'application.components.shoppingCart.EShoppingCart',
                ),
		
		'urlManager'=>array(
                        'showScriptName'=>false,
			'urlFormat'=>'path',
			'rules'=>array(
				'/category/search' => 'category/search',
				'/contact' => 'site/contact',
				'/files' => 'file/index',
				'/advice' => 'advice/index',
				'/advice/view/<id>' => 'advice/view/<id:\d+>',
				'/phosphonate/search'=>'product/search',
                                '/category/<url>'=>'category/index/<url:\w+>',
                                '/phosphonate/<url>'=>'product/view/<url:\w+>',
				'/event/view/<id>' => 'event/view/<id:\d+>'
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'class'=>'application.extensions.PHPPDO.CPdoDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=phosphon_yii',
			'emulatePrepare' => true,
			'username' => 'phosphon_yii',
			'password' => 'csttxR~*dc6&',
			'charset' => 'utf8',
		),
		
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/param.php'),
        'language'=>'ru',
        'sourceLanguage'=>'en_us',
);