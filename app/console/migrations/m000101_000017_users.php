<?php

use aiur\migrations\AiurMigration;

class m000101_000017_users extends AiurMigration
{

    public function up()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'date_add' => $this->dateTime(),
            'username' => $this->string(),
            'auth_key' => $this->string(),
            'email_confirm_token' => $this->string(),
            'password_hash' => $this->string(),
            'password_reset_token' => $this->string(),
            'email' => $this->string(191)->notNull()->unique(),
            'root' => $this->boolean(),
            'banned' => $this->boolean(),
        ], $this->tableOptions);

        $this->createTable('{{%users_online}}', [
            'user_ip' => $this->string()->notNull(),
            'user_time' => $this->integer()->notNull(),
        ], $this->tableOptions);

        $this->createTable('{{%users_stats}}', [
            'save_name' => $this->string()->notNull(),
            'save_value' => $this->integer()->notNull(),
        ], $this->tableOptions);

        foreach(['counter', 'day_time', 'max_count', 'max_time', 'yesterday'] as $item)
        {
            $this->insert('users_stats', [
                'save_name' => $item,
                'save_value' => 0,
            ]);
        }

        $this->execute(file_get_contents(\Yii::getAlias('@console/sql/users.sql')));
    }

    public function down()
    {
        $this->dropTable('{{%users}}');
        $this->dropTable('{{%users_online}}');
        $this->dropTable('{{%users_stats}}');
    }
}
