<?php

use aiur\migrations\AiurMigration;

/**
 * Class m190801_224400_add_article_lang
 */
class m190801_000023_add_article_lang extends AiurMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->string()->notNull(),
            'short_text' => $this->longText()->notNull(),
            'long_text' => $this->longText(),
            'file' => $this->string(),
        ], $this->tableOptions);

        $this->createIndex('idx-pi-owner_id', '{{%article_lang}}', 'owner_id');
        $this->createIndex('idx-pi-language', '{{%article_lang}}', 'language');
        $this->addForeignKey(
            'articlelang_ibfk_1', '{{%article_lang}}', 'owner_id', '{{%article}}', 'id', 'CASCADE', 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
