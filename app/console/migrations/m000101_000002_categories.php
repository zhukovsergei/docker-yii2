<?php

use aiur\migrations\AiurMigration;

class m000101_000002_categories extends AiurMigration
{
    public function up()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'name' => $this->string(),
            'image' => $this->string(),
            'root' => $this->boolean(),
        ], $this->tableOptions);

        $this->execute(file_get_contents(\Yii::getAlias('@console/sql/categories.sql')));
    }

    public function down()
    {
        $this->dropTable('{{%categories}}');
    }
}
