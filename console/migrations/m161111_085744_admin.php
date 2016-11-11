<?php

use yii\db\Migration;

class m161111_085744_admin extends Migration
{
    public function up()
    {
        $hash = '$2y$13$Nk.1yZ2Ut59k5jQe7uI.nel8oVXytdC0aNt8FURD5EtAcVqoMKX7K';
        $this->execute("INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'zeN8XpMEQcPG2VpRN7qAMCWYRt2vBWXX', '$hash', NULL, 'admin@admin.ru', 10, 1478854608, 1478854608);");
    }

    public function down()
    {
        echo "m161111_085744_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
