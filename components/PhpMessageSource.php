<?php

namespace app\modules\main\components;

use Yii;

class PhpMessageSource extends \yii\i18n\PhpMessageSource {

    /**
     * Loads the message translation for the specified $language and $category.
     * If translation for specific locale code such as `en-US` isn't found it
     * tries more generic `en`. When both are present, the `en-US` messages will be merged
     * over `en`. See [[loadFallbackMessages]] for details.
     * If the $language is less specific than [[sourceLanguage]], the method will try to
     * load the messages for [[sourceLanguage]]. For example: [[sourceLanguage]] is `en-GB`,
     * $language is `en`. The method will load the messages for `en` and merge them over `en-GB`.
     *
     * @param string $category the message category
     * @param string $language the target language
     * @return array the loaded messages. The keys are original messages, and the values are the translated messages.
     * @see loadFallbackMessages
     * @see sourceLanguage
     */
    public static function getAllMessages($category, $language) {

        $i18nMessages = \Yii::$app->getI18n()->getMessageSource($category);

        $messageFile = $i18nMessages->getMessageFilePath($category, $language);
        
        $messages = $i18nMessages->loadMessagesFromFile($messageFile);

        $fallbackLanguage = substr($language, 0, 2);
        $fallbackSourceLanguage = substr($i18nMessages->sourceLanguage, 0, 2);

        if ($language !== $fallbackLanguage) {
            $messages = $i18nMessages->loadFallbackMessages($category, $fallbackLanguage, $messages, $messageFile);
        } elseif ($language === $fallbackSourceLanguage) {
            $messages = $i18nMessages->loadFallbackMessages($category, $i18nMessages->sourceLanguage, $messages, $messageFile);
        } else {
            if ($messages === null) {
                Yii::error("The message file for category '$category' does not exist: $messageFile", __METHOD__);
            }
        }

        return (array) $messages;
    }

}
