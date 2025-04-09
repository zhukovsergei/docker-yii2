<?php

use aiur\migrations\AiurMigration;

class m000101_000013_review extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'date_add' => $this->dateTime(),
            'name' => $this->string(),
            'text' => $this->longText(),
            'approve' => $this->boolean(),
        ], $this->tableOptions);

        for($i = 0; $i < 10; $i++)
        {
            $this->insert('{{%review}}', [
                'date_add' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'name' => $this->faker->name,
                'text' => $this->faker->realText(),
                'approve' => 1,
            ]);
        }

    }

    public function down()
    {
        $this->dropTable('{{%review}}');
    }
}
