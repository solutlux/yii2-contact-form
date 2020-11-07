<?php

use yii\db\Migration;

/**
 * Class m190523_114216_contact_table
 */
class m190523_114216_contacts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        // `OrderStatistics` table creation
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey()->unsigned(),
            'createDate' => $this->dateTime()->null(),
            'updateDate' => $this->dateTime()->null(),
            'name' => $this->string()->null(),
            'email' => $this->string()->null(),
            'phone' => $this->string()->null(),
            'subject' => $this->string()->null(),
            'body' => $this->string()->null(),
            'tags' => $this->string()->null(),
        ], $tableOptions);
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190523_114216_contacts_table cannot be reverted.\n";
        
        $this->dropTable('{{%contact}}');
        
        return false;
    }
}
