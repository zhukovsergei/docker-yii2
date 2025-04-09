<?php

use aiur\migrations\AiurMigration;
use yii\helpers\FileHelper;

class m000101_000001_article extends AiurMigration
{
    public $filePath = '@uploads/origin/[[model]]/[[attribute_id]]/[[basename]]';

    public function up()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'date_add' => $this->dateTime(),
            'date_pub' => $this->date(),
            'title' => $this->string(),
            'short_text' => $this->longText(),
            'long_text' => $this->longText(),
            'approve' => $this->boolean(),
            'image' => $this->string(),
        ], $this->tableOptions);

        for($i = 1; $i <= 4; $i++)
        {
            $path = \Yii::getAlias('@uploads').'/origin/article/'.$i;
            FileHelper::createDirectory($path, 0775, true);

            $this->insert('{{%article}}', [
                'date_add' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'date_pub' => $this->faker->dateTimeThisMonth()->format('Y-m-d'),
                'title' => $this->faker->sentence(random_int(4,20)),
                'short_text' => $this->faker->realText(),
                'long_text' => $this->faker->realText(600),
                'approve' => 1,
                'image' => $this->faker->image($path, 640, 480, null, null),
            ]);
        }
    }

    public function down()
    {
        FileHelper::removeDirectory(\Yii::getAlias('@uploads/cache/article'));
        FileHelper::removeDirectory(\Yii::getAlias('@uploads/origin/article'));

        $this->dropTable('{{%article}}');
    }
}
