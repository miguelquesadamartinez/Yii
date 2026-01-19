<?php

// This is the configuration for yiic console application.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Sistema de Gestión de Usuarios',

    // preloading 'log' component
    'preload'=>array('log'),

    // application components
    'components'=>array(
        'db'=>array(
            'connectionString' => 'mysql:host=db;dbname=yii_users',
            'emulatePrepare' => true,
            'username' => 'yii_user',
            'password' => 'yii_password',
            'charset' => 'utf8',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
            ),
        ),
    ),
);
