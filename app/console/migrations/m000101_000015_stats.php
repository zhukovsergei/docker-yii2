<?php

use aiur\migrations\AiurMigration;

class m000101_000015_stats extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%stats}}', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(),
            'date' => $this->dateTime(),
        ], $this->tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%stats}}');
    }
}
