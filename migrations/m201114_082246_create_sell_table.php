<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sell}}`.
 */
class m201114_082246_create_sell_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sell}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull()->comment('Mahsulot'),
            'sell_price' => $this->decimal()->comment('Narxi'),
            'sell_quantity' => $this->integer()->comment('Soni'),
            'sell_date' => $this->date()->comment('Sotish sanasi, default bugun'),
            'sell_batch_number' => $this->string()->comment('Sotish Partiya raqami')
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-sell-product_id',
            'sell',
            'product_id'
        );

        // add foreign key for table `sell`
        $this->addForeignKey(
            'fk-product-product_id',
            'sell',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `product_id`
        $this->dropIndex(
            'idx-sell-product_id',
            'sell'
        );

        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-product-product_id',
            'sell'
        );

        $this->dropTable('{{%sell}}');
    }
}
