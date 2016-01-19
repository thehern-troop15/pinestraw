<?php

use yii\db\Schema;
use yii\db\Migration;

class m160111_210211_create_initial_tables extends Migration
{
    public function up()
    {
          $tableOptions = null;
          if ($this->db->driverName === 'mysql') {
              $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
          }
 
          $this->createTable('{{%scoutparent}}', [
              'id' => Schema::TYPE_PK,
              'name' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'phone' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'userid' => Schema::TYPE_INTEGER. ' NOT NULL',
              'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
              'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
              'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
              'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
          ], $tableOptions);


          $this->createTable('{{%patrol}}', [
              'id' => Schema::TYPE_PK,
              'name' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
              'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
              'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
              'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
          ], $tableOptions);

          $this->createTable('{{%scout}}', [
              'id' => Schema::TYPE_PK,
              'userid' => Schema::TYPE_INTEGER. ' NOT NULL',
              'patrolid' => Schema::TYPE_INTEGER. ' NOT NULL',
              'name' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'phone' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
              'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
              'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
              'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
          ], $tableOptions);

          $this->createTable('{{%scoutrelation}}', [
              'id' => Schema::TYPE_PK,
              'parentid' => Schema::TYPE_INTEGER. ' NOT NULL',
              'scoutid' => Schema::TYPE_INTEGER. ' NOT NULL',
              'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
              'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
              'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
              'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
          ], $tableOptions);

          $this->createTable('{{%order}}', [
              'id' => Schema::TYPE_PK,
              'name' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'scoutid' => Schema::TYPE_INTEGER. ' NOT NULL',
              'subdivision' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'house_number' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'street_name' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'city' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'zip' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'phone' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'drop_location' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'payment_type' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'check_number' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'number_bales' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'order_amount' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
              'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
              'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
              'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
              'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
          ], $tableOptions);

          $this->addForeignKey('fk-parent-user_id', 'scoutparent', 'userid', 'user', 'id', 'CASCADE');
          $this->addForeignKey('fk-scout-user_id', 'scout', 'userid', 'user', 'id', 'CASCADE');
          $this->addForeignKey('fk-scout-patrol_id', 'scout', 'patrolid', 'patrol', 'id', 'CASCADE');
          $this->addForeignKey('fk-scoutrelation-parent_id', 'scoutrelation', 'parentid', 'scoutparent', 'id', 'CASCADE');
          $this->addForeignKey('fk-scoutrelation-scout_id', 'scoutrelation', 'scoutid', 'scout', 'id', 'CASCADE');
          $this->addForeignKey('fk-order-scout_id', 'order', 'scoutid', 'scout', 'id', 'NO ACTION');

    }

    public function down()
    {
      $this->dropForeignKey('fk-parent-user_id', 'scoutparent');
      $this->dropForeignKey('fk-scout-user_id', 'scout');
      $this->dropForeignKey('fk-scoutrelation-parent_id', 'scoutrelation');
      $this->dropForeignKey('fk-scoutrelation-scout_id', 'scoutrelation');
      $this->dropForeignKey('fk-order-scout_id', 'order');
      $this->dropTable('{{%scoutparent}}');
      $this->dropTable('{{%patrol}}');
      $this->dropTable('{{%scout}}');
      $this->dropTable('{{%scoutrelation}}');
      $this->dropTable('{{%order}}');
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
