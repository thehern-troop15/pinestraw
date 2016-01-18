<?php

use yii\db\Schema;
use yii\db\Migration;

class m160114_015457_load_admin_account extends Migration
{
    public function up()
    {
        $this->insert('user', array(
            'username' => 'admin',
            'email' => 'admin',
            'password_hash' => '$2y$10$/zulgtktQcUI2h7UnvQmJOpj2m4WOK.kRLSyFJnrRtaGCu8fwa7hm',
            'confirmed_at' => '1',
            'flags' => '0',
        ));

        $this->insert('auth_assignment', array(
            'item_name' => 'admin',
            'user_id' => '1',
        ));

    }

    public function down()
    {
        echo "m160114_015457_load_admin_account cannot be reverted.\n";

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
