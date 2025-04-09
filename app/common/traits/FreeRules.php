<?php

namespace common\traits;

use omgdef\multilingual\MultilingualBehavior;
use yii\helpers\ArrayHelper;

trait FreeRules
{
    public function rules() :array
    {
        $rules = [];
        $attributes = $this->attributes();

        try {
            $behaviours_array = $this->behaviors();
            $flat_array = ArrayHelper::getColumn($behaviours_array, 'class');
            $key = array_search(MultilingualBehavior::class, $flat_array, true);
            $mlBehaviour = $this->behaviors()[$key];
            $mlAttributes = $mlBehaviour['attributes'];

            if(is_array($mlAttributes)) {
                array_merge($attributes, $mlAttributes);
            }
        } catch (\Exception $exception) {}

        $rules[] = [ $attributes, 'safe' ];
        $rules[] = [ $attributes, 'trim' ];

        return $rules;
    }
}