<?php

namespace almeyda\yii2contactform\controllers;

use yii\web\Controller;

/**
 * render contact form and perform send action
 * @return string
 * @throws \yii\base\InvalidConfigException
 */
class ContactController extends Controller
{
    
    /**
     * Contact action
     *
     * @param string $subject
     * @return string
     */
    public function actionContact($subject = null)
    {
        $model = \Yii::createObject($this->module->contactForm);
        $model->subject = $subject;
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
