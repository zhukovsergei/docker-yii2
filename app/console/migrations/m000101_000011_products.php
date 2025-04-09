<?php

use aiur\migrations\AiurMigration;
use yii\helpers\FileHelper;

class m000101_000011_products extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'date_add' => $this->dateTime(),
            'name' => $this->string(),
            'short_text' => $this->longText(),
            'long_text' => $this->longText(),
            'image' => $this->string(),
            'category_id' => $this->integer(),
            'price' => $this->integer(),
            'qt' => $this->integer(),
            'is_new' => $this->boolean(),
            'is_rec' => $this->boolean(),
            'approve' => $this->boolean(),
        ], $this->tableOptions);

        $this->createTable('{{%products_images}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'thumb' => $this->string(),
            'image' => $this->string(),
        ], $this->tableOptions);

        $this->createIndex('idx-pi-product_id', '{{%products_images}}', 'product_id');
        $this->addForeignKey(
            'fk_pi_product_id', '{{%products_images}}', 'product_id', '{{%products}}', 'id', 'CASCADE', 'CASCADE'
        );

        for($i = 1; $i <= 4; $i++)
        {
            $path = \Yii::getAlias('@uploads').'/origin/products/'.$i;
            FileHelper::createDirectory($path, 0775, true);

            $this->insert('{{%products}}', [
                'date_add' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'name' => $this->faker->sentence(rand(3,8)),
                'short_text' => $this->faker->realText(),
                'long_text' => $this->faker->realText(600),
                'image' => $this->faker->image($path, 640, 480, null, null),
                'category_id' => 2,
                'price' => rand(10,100)*10,
                'qt' => rand(1,7),
                'is_new' => $this->faker->boolean(70),
                'is_rec' => $this->faker->boolean(20),
                'approve' => 1,
            ]);
        }

    }

    public function down()
    {
        FileHelper::removeDirectory(\Yii::getAlias('@uploads/cache/products'));
        FileHelper::removeDirectory(\Yii::getAlias('@uploads/origin/products'));

        $this->dropForeignKey('fk_pi_product_id', '{{%products_images}}');

        $this->dropTable('{{%products}}');
        $this->dropTable('{{%products_images}}');
    }
}
