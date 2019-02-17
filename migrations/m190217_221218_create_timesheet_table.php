<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%timesheet}}`.
 */
class m190217_221218_create_timesheet_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%timesheet}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%timesheet}}');
    }
}
