<?php

use yii\db\Schema;
use yii\db\Migration;

class m000101_000021_many_to_many_students extends Migration
{
    public function up()
    {

        $this->createTable('{{%students}}',[
            'id'             => $this->bigPrimaryKey(),
            'name'           => $this->string(),
        ]);

        $this->createTable('{{%auditory}}',[
            'id'             => $this->bigPrimaryKey(),
            'name'           => $this->string(),
        ]);

        $this->createTable('{{%students_auditory}}',[
            'student_id'  => $this->integer()->notNull(),
            'auditory_id' => $this->integer()->notNull(),
        ]);

    }
    public function down()
    {
        $this->dropTable('{{%students}}');
        $this->dropTable('{{%auditory}}');
        $this->dropTable('{{%students_auditory}}');
    }

}
