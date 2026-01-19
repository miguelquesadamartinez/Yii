<?php

class m260119_174541_create_posts_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('posts', array(
			'id' => 'pk',
			'title' => 'string NOT NULL',
			'content' => 'text NOT NULL',
			'author_id' => 'integer NOT NULL',
			'created_at' => 'datetime NOT NULL',
			'updated_at' => 'datetime NOT NULL',
		));
	}

	public function down()
	{
		echo "m260119_174541_create_posts_table does not support migration down.\n";
		return false;
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