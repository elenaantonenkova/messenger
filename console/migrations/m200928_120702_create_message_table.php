<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m200928_120702_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // add foreign key for table 'user'
        $this->addForeignKey(
            'fk-message-user_id',
            'message',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table 'user'
        $this->dropForeignKey(
            'fk-message-user_id',
            'brand_off'
        );

        $this->dropTable('{{%message}}');
    }
}
