<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m201113_155356_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment('Nomi'),
            'price' => $this->decimal()->comment('Narxi'),
            'quantity' => $this->integer()->comment('Soni'),
            'date' => $this->date()->comment('Kelish sanasi'),
            'batch_number' => $this->string()->comment('Partiya raqami')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
