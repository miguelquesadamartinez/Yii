<?php

class m260119_184037_add_category_to_posts extends CDbMigration
{
	public function up()
	{
		$this->addColumn('posts', 'category_id', 'int(11) DEFAULT 1');
		$this->addForeignKey('fk_posts_category', 'posts', 'category_id', 'categories', 'id', 'SET NULL', 'CASCADE');
	}

	public function down()
	{
		$this->dropForeignKey('fk_posts_category', 'posts');
		$this->dropColumn('posts', 'category_id');
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