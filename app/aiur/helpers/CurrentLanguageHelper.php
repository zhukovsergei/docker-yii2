<?php
namespace aiur\helpers;

class CurrentLanguageHelper
{
    private static array $config = [
        'de' => [
            'icon' => 'germany.png',
            'codeName' => 'De',
            'label' => 'Deutsch',
        ],
        'fr' => [
            'icon' => 'france.png',
            'codeName' => 'Fr',
            'label' => 'Français',
        ],
        'it' => [
            'icon' => 'italy.png',
            'codeName' => 'It',
            'label' => 'Italiano',
        ],
        'en' => [
            'icon' => 'united-kingdom.png',
            'codeName' => 'En',
            'label' => 'English',
        ]
    ];

    public static function getIconName(): string
    {
        return static::$config[\Yii::$app->language]['icon'];
    }

    public static function getCodeName(): string
    {
        return static::$config[\Yii::$app->language]['codeName'];
    }

    public static function getLabel(): string
    {
        return static::$config[\Yii::$app->language]['label'];
    }

}