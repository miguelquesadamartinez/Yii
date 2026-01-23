<?php

class m260123_000000_add_slug_to_posts extends CDbMigration
{
	public function up()
	{
		// Agregar columna slug
		$this->addColumn('posts', 'slug', 'varchar(255) DEFAULT NULL AFTER title');
		
		// Crear índice único
		$this->createIndex('unique_slug', 'posts', 'slug', true);
	}

	public function down()
	{
		// Eliminar índice único
		$this->dropIndex('unique_slug', 'posts');
		
		// Eliminar columna slug
		$this->dropColumn('posts', 'slug');
	}
}
