<?php

use yii\db\Schema;
use yii\db\Migration;

class m160114_013643_load_authtypes extends Migration
{
    public function up()
    {

        $this->insert('auth_item', array(
            'name' => 'admin',
            'type' => '2',
            'description' => 'Adminstrator',
            'rule_name' => NULL,
            'data' => 'N;',
        ));
        $this->insert('auth_item', array(
            'name' => 'leader',
            'type' => '2',
            'description' => 'Leader',
            'rule_name' => NULL,
            'data' => 'N;',
        ));
        $this->insert('auth_item', array(
            'name' => 'parent',
            'type' => '2',
            'description' => 'Parent',
            'rule_name' => NULL,
            'data' => 'N;',
        ));
        $this->insert('auth_item', array(
            'name' => 'scout',
            'type' => '2',
            'description' => 'Scout',
            'rule_name' => NULL,
            'data' => 'N;',
        ));

    }

    public function down()
    {
        $this->delete('AuthItem','1=1');
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
