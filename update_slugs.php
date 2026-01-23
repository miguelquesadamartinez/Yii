<?php
// Script para generar slugs de posts existentes
defined('YII_DEBUG') or define('YII_DEBUG',true);

// Incluir Yii framework
require_once(dirname(__FILE__).'/framework/yii.php');

// Incluir configuración
$config=dirname(__FILE__).'/protected/config/main.php';

// Crear aplicación
Yii::createWebApplication($config);

// Procesar todos los posts sin slug
$posts = Post::model()->findAll('slug IS NULL');

echo "Generando slugs para " . count($posts) . " posts...\n";

foreach($posts as $post)
{
    echo "Post ID {$post->id}: '{$post->title}' -> ";
    $post->slug = $post->generateSlug();
    if($post->save(false))
    {
        echo "'{$post->slug}' ✓\n";
    }
    else
    {
        echo "ERROR\n";
        print_r($post->getErrors());
    }
}

echo "\n¡Slugs generados exitosamente!\n";
