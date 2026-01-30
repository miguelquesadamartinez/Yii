<?php

class m260119_183948_create_users_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('users', array(
			'id' => 'pk',
			'username' => 'varchar(128) NOT NULL',
			'password' => 'varchar(128) NOT NULL',
			'email' => 'varchar(128) NOT NULL',
			'first_name' => 'varchar(128)',
			'last_name' => 'varchar(128)',
			'status' => 'tinyint(1) NOT NULL DEFAULT 1',
			'user_type_id' => 'int(11)',
			'created_at' => 'datetime NOT NULL',
			'updated_at' => 'datetime NOT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		
		// Añadir índices únicos
		$this->createIndex('username_unique', 'users', 'username', true);
		$this->createIndex('email_unique', 'users', 'email', true);
		
		// Añadir foreign key a user_types
		$this->addForeignKey('fk_users_user_type', 'users', 'user_type_id', 'user_types', 'id', 'SET NULL', 'CASCADE');
		
		// Insertar usuarios por defecto
		// Password: admin123 (MD5: 0192023a7bbd73250516f069df18b500)
		$this->insert('users', array(
			'username' => 'admin',
			'password' => '0192023a7bbd73250516f069df18b500',
			'email' => 'admin@example.com',
			'first_name' => 'Admin',
			'last_name' => 'User',
			'status' => 1,
			'user_type_id' => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		));
		
		// Password: demo123 (MD5: fe01ce2a7fbac8fafaed7c982a04e229)
		$this->insert('users', array(
			'username' => 'demo',
			'password' => 'fe01ce2a7fbac8fafaed7c982a04e229',
			'email' => 'demo@example.com',
			'first_name' => 'Demo',
			'last_name' => 'User',
			'status' => 1,
			'user_type_id' => 2,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		));
	}

	public function down()
	{
		$this->dropForeignKey('fk_users_user_type', 'users');
		$this->dropTable('users');
	}
}
