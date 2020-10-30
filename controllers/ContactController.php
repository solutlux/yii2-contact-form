<?php

namespace solutlux\yii2contactform\controllers;
 
use almeyda\yii2mainmodule\models\ContactForm;
use yii\web\Controller;
use Yii;
 
class ContactController extends Controller
{
	public function actionContact()
    {
        $model = new ContactForm();
		$options = [
			'model' => $model,
			'success' => false,
		];
		
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'], Yii::$app->params['contactEmailSubject'])) {
			$options['success'] = true;
		}
		
		return $this->renderPartial('contact', $options);
    }
	
}



