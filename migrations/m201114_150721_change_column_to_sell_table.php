<?php

use yii\db\Migration;

/**
 * Class m201114_150721_change_column_to_sell_table
 */
class m201114_150721_change_column_to_sell_table extends Migration
{
    public function up()
    {
        $this->alterColumn('sell', 'sell_date', 'datetime');
    }

    public function down()
    {
        return false;
    }
}
