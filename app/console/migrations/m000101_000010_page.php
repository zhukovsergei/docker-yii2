<?php

use aiur\migrations\AiurMigration;

class m000101_000010_page extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'text' => $this->longText(),
            'extra' => $this->string(),
        ], $this->tableOptions);

        $extras = ['about', 'contacts'];

        for($i = 0; $i <= count($extras); $i++)
        {
            $this->insert('{{%page}}', [
                'name' => $this->faker->sentence(rand(4,10)),
                'text' => $this->faker->realText(),
                'extra' => array_pop($extras),
            ]);
        }

    }

    public function down()
    {
        $this->dropTable('{{%page}}');
    }
}
