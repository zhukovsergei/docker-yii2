<?php

use aiur\migrations\AiurMigration;
use yii\helpers\FileHelper;

class m000101_000009_news extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'date_add' => $this->dateTime(),
            'date_pub' => $this->date(),
            'name' => $this->string(),
            'short_text' => $this->longText(),
            'long_text' => $this->longText(),
            'approve' => $this->boolean(),
            'image' => $this->string(),
        ], $this->tableOptions);

        for($i = 1; $i <= 4; $i++)
        {
            $path = \Yii::getAlias('@uploads').'/origin/news/'.$i;
            FileHelper::createDirectory($path, 0775, true);

            $this->insert('{{%news}}', [
                'date_add' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'date_pub' => $this->faker->dateTimeThisMonth()->format('Y-m-d'),
                'name' => $this->faker->sentence(rand(4,20)),
                'short_text' => $this->faker->realText(),
                'long_text' => $this->faker->realText(600),
                'approve' => 1,
                'image' => $this->faker->image($path, 640, 480, null, null),
            ]);
        }

        //    $this->execute(file_get_contents(\Yii::getAlias('@console/sql/article.sql')));
    }

    public function down()
    {
        FileHelper::removeDirectory(\Yii::getAlias('@uploads/cache/news'));
        FileHelper::removeDirectory(\Yii::getAlias('@uploads/origin/news'));

        $this->dropTable('{{%news}}');
    }
}
