<?php

namespace almeyda\yii2contactform\models;

use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends ActiveRecord
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $body;
    //public $verifyCode;
    
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name and body are required
            [['name', 'email', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email', 'skipOnEmpty' => true],
            [['name', 'email'], 'string', 'max' => 255],
            ['phone', 'string', 'max' => 35],
            ['subject', 'string', 'max' => 200],
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
            'name' => \Yii::t('app', 'Name'),
            'email' => \Yii::t('app', 'Email'),
            'phone' => \Yii::t('app', 'Phone'),
            'subject' => \Yii::t('app', 'Subject'),
            'body'	=> \Yii::t('app', 'Message'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  array $emails list of recipients' email addresses
     * @param  string $subject email subject
     * @param  array $cc list of cc email addresses
     * @return boolean whether the model passes validation
     */
    public function contact($emails, $subject = '', $cc = [])
    {
        $result = false;
        if ((is_array($emails)) and (count($emails) > 0) and ($this->validate())) {
            if (!strlen($this->subject)) {
                $this->subject = $subject;
            }
            $this->save();
            $mailer = \Yii::$app->mailer
                ->compose([
                    'text' => 'contact',
                ], [
                    'body' => $this->body,
                    'phone' => $this->phone,
                ])
                ->setTo($emails)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject);
            
            if ((is_array($cc)) and (count($cc) > 0)) {
                $mailer->setCc($cc);
            }
    
            $result = $mailer->send();
        }
    
        return $result;
    }
}