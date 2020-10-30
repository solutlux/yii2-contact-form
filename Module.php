<?php

namespace solutlux\yii2contactform;

/**
 * Main functionality module of the site
 */
class Module extends \yii\base\Module
{
    /**
     * @var string contactForm class
     */
    public $contactForm = 'solutlux\yii2mainmodule\models\ContactForm';
    
    /**
     * @var array list of email recipents
     */
    public $recipients = [];
    
    /**
     * @var string email subject
     */
    public $subject = '';
}
