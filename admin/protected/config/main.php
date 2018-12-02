<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Phosphonates.ru',
        //'theme'=>'modern',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.modules.user.models.*',
                'application.modules.user.components.*',
                'application.extensions.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'plevren-cublen',
                        'ipFilters'=>array('176.96.254.14'),
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
                ),
		'yiiadmin'=>array(
                'password'=>'111',
                'registerModels'=>array(
                    //'application.models.Contests',
                    //'application.models.BlogPosts',
                    //'application.models.*',
                ),
                //'excludeModels'=>array(),
            ),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
            
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
                      

		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=phosphon_yii',
			'emulatePrepare' => true,
			'username' => 'phosphon_yii',
			'password' => 'csttxR~*dc6&',
			'charset' => 'utf8',
                        'enableProfiling'=>true,
                        'enableParamLogging' => true,

		),
		
		/*'errorHandler'=>array(
                        'errorAction'=>'site/error',
                ),*/
		/*'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CProfileLogRoute',
					'levels'=>'profile',
				),
				// uncomment the following to show log messages on web pages
				
				array(
                                    
					'class'=>'CWebLogRoute',
                                  
                                            'showInFireBug' => true,

                                        
				),
				
			),
		),*/
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/param.php'),
        'language'=>'ru',
        'sourceLanguage'=>'en_us',
);