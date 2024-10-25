<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%requests}}`.
 */
class m241023_110842_add_duplicate_id_column_to_requests_table extends Migration
{
    public function up()
    {
        $this->addColumn('requests', 'duplicate_id', $this->integer()->null());
    }

    public function down()
    {
        $this->dropColumn('requests', 'duplicate_id');
    }
}
