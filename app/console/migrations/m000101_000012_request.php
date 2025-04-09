<?php

use aiur\migrations\AiurMigration;

class m000101_000012_request extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'date_add' => $this->dateTime(),
            'name' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'text' => $this->longText(),
            'accept' => $this->boolean(),
        ], $this->tableOptions);


        for($i = 0; $i < 10; $i++)
        {
            $this->insert('{{%request}}', [
                'date_add' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'phone' => $this->faker->phoneNumber,
                'text' => $this->faker->realText(),
                'accept' => 1,
            ]);
        }

    }

    public function down()
    {
        $this->dropTable('{{%request}}');
    }
}
