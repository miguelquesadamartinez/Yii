<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Bienvenido a <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Sistema de gestión de usuarios desarrollado con Yii Framework 1.1.24</p>

<h2>Características</h2>
<ul>
    <li>Gestión completa de usuarios (CRUD)</li>
    <li>Sistema de autenticación</li>
    <li>Control de acceso</li>
    <li>Validación de formularios</li>
    <li>Interfaz responsive con Blueprint CSS</li>
</ul>

<?php if(Yii::app()->user->isGuest): ?>
<p>Por favor, <a href="<?php echo $this->createUrl('site/login'); ?>">inicia sesión</a> para acceder al sistema.</p>
<?php else: ?>
<p>Ir a <a href="<?php echo $this->createUrl('user/index'); ?>">Gestión de Usuarios</a></p>
<?php endif; ?>
