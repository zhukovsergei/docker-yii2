<?php

use aiur\migrations\AiurMigration;

class m000101_000005_faq extends AiurMigration
{
    public function up()
    {

        $this->createTable('{{%faq}}', [
            'id' => $this->primaryKey(),
            'date_add' => $this->dateTime(),
            'name' => $this->string(),
            'email' => $this->string(),
            'text' => $this->longText(),
            'answer' => $this->longText(),
            'approve' => $this->boolean(),
        ], $this->tableOptions);

        for($i = 0; $i < 10; $i++)
        {
            $this->insert('{{%faq}}', [
                'name' => $this->faker->name,
                'date_add' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'email' => $this->faker->email,
                'text' => $this->faker->realText(),
                'answer' => $this->faker->realText(100),
                'approve' => 1,
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('{{%faq}}');
    }
}
