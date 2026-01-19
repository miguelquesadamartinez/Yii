<?php
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
$app = Yii::createWebApplication($config);

echo "Módulos cargados:\n";
print_r(array_keys($app->getModules()));

echo "\n\nVerificando Gii:\n";
if(isset($app->getModules()['gii'])) {
    echo "Gii está configurado\n";
    try {
        $gii = $app->getModule('gii');
        echo "Gii cargado exitosamente: " . get_class($gii) . "\n";
    } catch(Exception $e) {
        echo "Error al cargar Gii: " . $e->getMessage() . "\n";
    }
} else {
    echo "Gii NO está configurado\n";
}
