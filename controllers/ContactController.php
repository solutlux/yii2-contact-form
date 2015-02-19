<?php

namespace app\modules\main\controllers;
 
use app\modules\main\models\ContactForm;
use yii\web\Controller;
use Yii;
 
class ContactController extends Controller
{
	public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
 
            return $this->refresh();
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
	
}



