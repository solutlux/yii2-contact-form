<?php

namespace solutlux\yii2contactform\controllers;

use yii\web\Controller;

/**
 * render contact form and perform send action
 * @return string
 * @throws \yii\base\InvalidConfigException
 */
class ContactController extends Controller
{
    public function actionContact()
    {
        $model = \Yii::createObject($this->module->contactForm);
        $options = [
            'model' => $model,
            'success' => false,
        ];
    
        if (\Yii::$app->request->getIsPost()) {
            if ($model->load(\Yii::$app->request->post()) && $model->contact($this->module->recipients, $this->module->subject)) {
                $options['success'] = true;
            }
        }
        
        return $this->renderPartial('contact', $options);
    }
}
