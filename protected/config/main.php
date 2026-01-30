<?php

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Sistema de Gestión de Usuarios',
    'language'=>'es',

    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),

    'modules'=>array(
        // uncomment the following to enable the Gii tool
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>false,  // Deshabilitado temporalmente para debug
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('*'),  // Permitir desde cualquier IP temporalmente
        ),
    ),

    // application components
    'components'=>array(
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
        ),
        
        // URL Manager temporalmente deshabilitado para que Gii funcione
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>true,
            'rules'=>array(
                // Rutas para posts con slug
                'posts'=>'post/index',
                'post/crear'=>'post/create',
                'post/editar/<id:\d+>'=>'post/update',
                'post/<slug:[a-z0-9\-]+>'=>'post/view',
                
                // Rutas para categorías
                'categorias'=>'category/index',
                'categoria/crear'=>'category/create',
                'categoria/editar/<id:\d+>'=>'category/update',
                'categoria/<id:\d+>'=>'category/view',
                
                // Rutas genéricas
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),

        'db'=>array(
            'connectionString' => 'mysql:host=db;dbname=yii_users',
            'emulatePrepare' => true,
            'username' => 'yii_user',
            'password' => 'yii_password',
            'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
        ),

        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),

        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning, info, trace',
                    'logFile'=>'application.log',
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
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'admin@example.com',
    ),
);
