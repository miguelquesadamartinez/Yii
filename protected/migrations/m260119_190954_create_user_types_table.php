<?php

class m260119_190954_create_user_types_table extends CDbMigration
{
	public function up()
	{
		// Crear tabla user_types
		$this->createTable('user_types', array(
			'id' => 'pk',
			'name' => 'varchar(50) NOT NULL',
			'description' => 'text',
			'created_at' => 'datetime NOT NULL',
			'updated_at' => 'datetime NOT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		
		$this->insert('user_types', array(
			'name' => 'Administrador',
			'description' => 'Usuario con acceso completo al sistema',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		));
		
		$this->insert('user_types', array(
			'name' => 'Editor',
			'description' => 'Usuario que puede crear y editar contenido',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		));
		
		$this->insert('user_types', array(
			'name' => 'Usuario',
			'description' => 'Usuario estándar con acceso básico',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		));
		
		// Agregar columna user_type_id a la tabla users
		//$this->addColumn('users', 'user_type_id', 'int(11) DEFAULT NULL AFTER status');
		
		// Agregar índice y clave foránea
		$this->createIndex('idx_user_type_id', 'users', 'user_type_id');
		$this->addForeignKey('fk_users_user_type', 'users', 'user_type_id', 'user_types', 'id', 'SET NULL', 'CASCADE');
		
		// Asignar tipo de usuario por defecto a usuarios existentes
		$this->update('users', array('user_type_id' => 1));
	}

	public function down()
	{
		$this->dropForeignKey('fk_users_user_type', 'users');
		$this->dropIndex('idx_user_type_id', 'users');
		$this->dropColumn('users', 'user_type_id');
		$this->dropTable('user_types');
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