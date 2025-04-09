<?php

use aiur\migrations\AiurMigration;

class m000101_000006_file extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'extra' => $this->string(),
        ], $this->tableOptions);

        $this->insert('{{%file}}', [
            'name' => '28be0719_new-text-document.xlsx',
            'extra' => 'price',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%file}}');
    }
}
