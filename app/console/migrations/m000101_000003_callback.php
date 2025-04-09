<?php

use aiur\migrations\AiurMigration;

class m000101_000003_callback extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%callback}}', [
            'id' => $this->primaryKey(),
            'date_add' => $this->dateTime(),
            'name' => $this->string(),
            'phone' => $this->string(),
        ], $this->tableOptions);


        for($i = 0; $i < 10; $i++)
        {
            $this->insert('{{%callback}}', [
                'date_add' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'name' => $this->faker->firstName,
                'phone' => $this->faker->phoneNumber,
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('{{%callback}}');
    }
}
