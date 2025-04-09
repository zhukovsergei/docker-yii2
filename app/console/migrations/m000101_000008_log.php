<?php

use aiur\migrations\AiurMigration;

class m000101_000008_log extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'date_add' => $this->dateTime(),
            'username' => $this->string(),
            'ip' => $this->string(),
            'controller' => $this->string(),
            'action' => $this->string(),
        ], $this->tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%log}}');
    }
}
