<?php

namespace almeyda\yii2mainmodule;

use Yii;

/**
 * Main functionality module of the site
 */
class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }
    
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/main/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => __DIR__ . '/messages',
            'fileMap' => [
                'modules/main/main' => 'main.php',
            ],
        ];
    }
    
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/main/' . $category, $message, $params, $language);
    }
}
