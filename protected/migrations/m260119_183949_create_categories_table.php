<?php

class m260119_183949_create_categories_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('categories', array(
			'id' => 'pk',
			'name' => 'varchar(100) NOT NULL',
			'description' => 'text',
			'created_at' => 'datetime NOT NULL',
			'updated_at' => 'datetime NOT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		
		// Insertar categorías por defecto
		$this->insert('categories', array(
			'name' => 'Tecnología',
			'description' => 'Posts sobre tecnología',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		));
		
		$this->insert('categories', array(
			'name' => 'Noticias',
			'description' => 'Posts de noticias',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		));
		
		$this->insert('categories', array(
			'name' => 'General',
			'description' => 'Posts generales',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		));
	}

	public function down()
	{
		$this->dropTable('categories');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}