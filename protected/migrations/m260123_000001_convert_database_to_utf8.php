<?php

class m260123_000001_convert_database_to_utf8 extends CDbMigration
{
    public function up()
    {
        // Cambiar charset de la base de datos
        $this->execute("ALTER DATABASE `yii_users` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        
        // Tabla users
        $this->execute("ALTER TABLE `users` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        
        // Tabla user_types
        $this->execute("ALTER TABLE `user_types` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        
        // Tabla categories
        $this->execute("ALTER TABLE `categories` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        
        // Tabla posts
        $this->execute("ALTER TABLE `posts` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    public function down()
    {
        // Revertir a latin1
        $this->execute("ALTER DATABASE `yii_users` CHARACTER SET latin1 COLLATE latin1_swedish_ci");
        
        $this->execute("ALTER TABLE `users` CONVERT TO CHARACTER SET latin1 COLLATE latin1_swedish_ci");
        $this->execute("ALTER TABLE `user_types` CONVERT TO CHARACTER SET latin1 COLLATE latin1_swedish_ci");
        $this->execute("ALTER TABLE `categories` CONVERT TO CHARACTER SET latin1 COLLATE latin1_swedish_ci");
        $this->execute("ALTER TABLE `posts` CONVERT TO CHARACTER SET latin1 COLLATE latin1_swedish_ci");
    }
}
