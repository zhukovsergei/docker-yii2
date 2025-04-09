<?php

use aiur\migrations\AiurMigration;

class m000101_000014_settings extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(),
            'section' => $this->string(),
            'name' => $this->string(),
            'key' => $this->string(),
            'value' => $this->string(),
            'active' => $this->boolean(),
        ], $this->tableOptions);

        $this->execute(file_get_contents(\Yii::getAlias('@console/sql/setting.sql')));
    }

    public function down()
    {
        $this->dropTable('{{%settings}}');
    }
}
