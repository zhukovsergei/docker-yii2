<?php

namespace aiur\migrations;

use yii\db\Migration;

abstract class AiurMigration extends Migration
{
  use \aiur\traits\TextTypesTrait;

  protected $tableOptions;
  protected $faker;

  public function init()
  {
    parent::init();
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $this->tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
    }
    $this->faker = \Faker\Factory::create('de_CH');
  }

}