<?php

namespace common\models;

use backend\components\NotifyBehavior;
use common\traits\AssociateLabels;
use common\traits\FreeRules;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveRecord;
use common\components\DateUpdater;

class Students extends ActiveRecord
{
    use FreeRules;
    use AssociateLabels;

    public function behaviors() :array
    {
        return [
            'saveRelations' => [
                'class'     => SaveRelationsBehavior::class,
                'relations' => [
                    'auditories',
                ],
            ],
        ];
    }
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function getAuditories()
    {
        return $this->hasMany(Auditory::class, ['id' => 'auditory_id'])->viaTable('students_auditory', ['student_id' => 'id']);
    }

}