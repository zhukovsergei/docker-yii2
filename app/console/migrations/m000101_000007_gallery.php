<?php

use aiur\migrations\AiurMigration;

class m000101_000007_gallery extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%gallery}}', [
            'id' => $this->primaryKey(),
            'date_add' => $this->dateTime(),
            'name' => $this->string(),
        ], $this->tableOptions);

        for($i = 0; $i < 4; $i++)
        {
            $this->insert('{{%gallery}}', [
                'date_add' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'name' => $this->faker->image(\Yii::getAlias('@uploads'), 640, 480, null, null),
            ]);
        }

    }

    public function down()
    {
        $files = $this->getDb()->createCommand('SELECT `name` FROM gallery')->queryColumn();
        foreach($files as $file)
        {
            @unlink(\Yii::getAlias('@uploads/'.$file));
        }

        $this->dropTable('{{%gallery}}');
    }
}
