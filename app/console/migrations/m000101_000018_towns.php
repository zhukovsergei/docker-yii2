<?php

use aiur\migrations\AiurMigration;

class m000101_000018_towns extends AiurMigration
{
    public function up()
    {
        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ], $this->tableOptions);

        $this->createTable('{{%town}}', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer(),
            'name' => $this->string(),
        ], $this->tableOptions);

        $this->createIndex('ind-t-region_id', '{{%town}}', 'region_id');
        $this->addForeignKey(
            'fk-t-region_id', '{{%town}}', 'region_id', '{{%region}}', 'id', 'CASCADE', 'CASCADE'
        );

        $this->execute(file_get_contents(\Yii::getAlias('@console/sql/towns/regions.sql')));
        $this->execute(file_get_contents(\Yii::getAlias('@console/sql/towns/towns.sql')));
    }

    public function down()
    {
        $this->dropForeignKey('fk-t-region_id', '{{%town}}');

        $this->dropTable('{{%region}}');
        $this->dropTable('{{%town}}');
    }
}
