<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ingredient_dish}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%ingredient}}`
 * - `{{%dish}}`
 */
class m200524_211107_create_junction_table_for_ingredient_and_dish_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ingredient_dish}}', [
            'ingredient_id' => $this->integer(),
            'dish_id' => $this->integer(),
            'PRIMARY KEY(ingredient_id, dish_id)',
        ]);

        // creates index for column `ingredient_id`
        $this->createIndex(
            '{{%idx-ingredient_dish-ingredient_id}}',
            '{{%ingredient_dish}}',
            'ingredient_id'
        );

        // add foreign key for table `{{%ingredient}}`
        $this->addForeignKey(
            '{{%fk-ingredient_dish-ingredient_id}}',
            '{{%ingredient_dish}}',
            'ingredient_id',
            '{{%ingredient}}',
            'id',
            'CASCADE'
        );

        // creates index for column `dish_id`
        $this->createIndex(
            '{{%idx-ingredient_dish-dish_id}}',
            '{{%ingredient_dish}}',
            'dish_id'
        );

        // add foreign key for table `{{%dish}}`
        $this->addForeignKey(
            '{{%fk-ingredient_dish-dish_id}}',
            '{{%ingredient_dish}}',
            'dish_id',
            '{{%dish}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%ingredient}}`
        $this->dropForeignKey(
            '{{%fk-ingredient_dish-ingredient_id}}',
            '{{%ingredient_dish}}'
        );

        // drops index for column `ingredient_id`
        $this->dropIndex(
            '{{%idx-ingredient_dish-ingredient_id}}',
            '{{%ingredient_dish}}'
        );

        // drops foreign key for table `{{%dish}}`
        $this->dropForeignKey(
            '{{%fk-ingredient_dish-dish_id}}',
            '{{%ingredient_dish}}'
        );

        // drops index for column `dish_id`
        $this->dropIndex(
            '{{%idx-ingredient_dish-dish_id}}',
            '{{%ingredient_dish}}'
        );

        $this->dropTable('{{%ingredient_dish}}');
    }
}
