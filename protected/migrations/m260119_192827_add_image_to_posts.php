<?php

class m260119_192827_add_image_to_posts extends CDbMigration
{
	public function up()
	{
		$this->addColumn('posts', 'image', 'varchar(255) DEFAULT NULL AFTER content');
	}

	public function down()
	{
		$this->dropColumn('posts', 'image');
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