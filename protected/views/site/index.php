<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<div style="text-align: center; max-width: 800px; margin: 0 auto; padding: 40px 20px;">
    <h1>Bienvenido a <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

    <p style="font-size: 16px; color: #666;">Sistema de gestión de usuarios desarrollado con Yii Framework 1.1.24</p>

    <h2>Características</h2>
    <ul style="list-style-position: inside; padding: 0; line-height: 2;">
        <li>Gestión completa de usuarios (CRUD)</li>
        <li>Sistema de autenticación</li>
        <li>Control de acceso</li>
        <li>Validación de formularios</li>
        <li>Interfaz responsive con Blueprint CSS</li>
    </ul>

    <?php if(Yii::app()->user->isGuest): ?>
    <p style="margin-top: 30px; font-size: 16px;">Por favor, <a href="<?php echo $this->createUrl('site/login'); ?>" style="font-weight: bold; color: #4682b4;">inicia sesión</a> para acceder al sistema.</p>
    <?php else: ?>
    <p style="margin-top: 30px; font-size: 16px;">Ir a <a href="<?php echo $this->createUrl('user/index'); ?>" style="font-weight: bold; color: #4682b4;">Gestión de Usuarios</a></p>
    <?php endif; ?>
</div>
