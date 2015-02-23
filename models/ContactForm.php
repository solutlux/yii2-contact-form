<?php

namespace app\modules\main\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
	public $phone;
    //public $subject;
    public $body;
    //public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name and body are required
            [['name', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email', 'skipOnEmpty' => false],
			[['name', 'email'], 'string', 'max' => 255],
			['phone', 'string', 'max' => 35],
			['body', 'string', 'max' => 1000],
			// verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'ФИО',
			'phone' => 'Телефон',
			'body'	=> 'Ваше сообщение...',		
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
	 * @param  string  $subject email subject
     * @return boolean whether the model passes validation
     */
    public function contact($email, $subject)
    {
       
		if ($this->validate()) {
            Yii::$app->mailer
				->compose([
					'text' => 'contact', 
				], [
					'body' => $this->body,
					'phone' => $this->phone,
				])
				->setTo($email)
				->setCc([$this->email => $this->name])
                ->setFrom([$this->email => $this->name])
                ->setSubject($subject)
                ->send();

            return true;
        } else {
            return false;
        }
    }
}
