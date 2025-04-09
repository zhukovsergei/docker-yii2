<?php

use aiur\migrations\AiurMigration;

class m000101_000004_directory extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%directory}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ], $this->tableOptions);

        for($i = 0; $i < 10; $i++)
        {
            $this->insert('{{%directory}}', [
                'name' => $this->faker->name,
            ]);
        }

    }

    public function down()
    {
        $this->dropTable('{{%directory}}');
    }
}
