<?php

namespace app\modules\main\components;

use Yii;

class UrlHelper
{

    /**
     * Format file path by adding datetime and language code segment if necessary
     * @param string $filePath path from to the assets folder (without first slash)
     * @return string
     */
    public static function getCachedUrl($filePath)
    {

        try {
            $fileTime = '';

            //define file path with language code
            $filePathArr = explode('/', $filePath);
            $filePathArr[count($filePathArr)] = $filePathArr[count($filePathArr) - 1];
            $filePathArr[count($filePathArr) - 2] = Yii::$app->language;
            $filePathWithLang = implode('/', $filePathArr);

            //define absolute and relative file path
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . @Yii::$app->params['assetsPath'] . $filePathWithLang)) {
                $fileAbsPath = $_SERVER['DOCUMENT_ROOT'] . @Yii::$app->params['assetsPath'] . $filePathWithLang;
                $filePathToSetup = $filePathWithLang;
            } else {
                $fileAbsPath = $_SERVER['DOCUMENT_ROOT'] . @Yii::$app->params['assetsPath'] . $filePath;
                $filePathToSetup = $filePath;
            }

            //add datetime parameter 
            if (file_exists($fileAbsPath)) {
                $fileTime = ((strpos($filePath, '?')) ? '&' : '?') . 'v=' . filemtime($fileAbsPath);

                $filePath = @\Yii::$app->params['assetsPath'] . $filePathToSetup . $fileTime;

            }
        } catch (Exception $exc) {

        }

        return $filePath;
    }

}
