<?php

use aiur\migrations\AiurMigration;

class m000101_000016_times extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%times}}', [
            'time' => $this->time(),
        ], $this->tableOptions);

        $datetime = new DateTime('today', new DateTimeZone('Europe/London'));
        for($i = 0; $i < 24; $i++)
        {
            $this->insert('times', [
                'time' => $datetime->format('H:i:s'),
            ]);
            $datetime->modify('+1 hour');
        }
    }

    public function down()
    {
        $this->dropTable('{{%times}}');
    }
}
