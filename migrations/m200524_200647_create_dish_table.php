<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dish}}`.
 */
class m200524_200647_create_dish_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dish}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'active' => $this->tinyInteger()->notNull()->defaultValue(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dish}}');
    }
}
