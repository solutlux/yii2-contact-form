<?php

namespace app\modules\main\behaviors;

class UrlBehavior extends \yii\base\Behavior {

    /**
     * Checks css and js registering into the view and format their calling
     */
    public static function processView(\yii\base\ViewEvent $event) {

        //check css paths
        $cssFiles = $event->sender->cssFiles;
        if (is_array($cssFiles)) {
            foreach ($cssFiles as $url => $link) {
                $event->sender->cssFiles[$url] = self::_processUrl($url, $link);
            }
        }

        //check js paths
        $jsFiles = $event->sender->jsFiles;

        if (is_array($jsFiles)) {
            foreach ($jsFiles as $key => $files) {
                foreach ($files as $url => $link) {
                    $event->sender->jsFiles[$key][$url] = self::_processUrl($url, $link);
                }
            }
        }

        //check images paths
        /*
          echo '<pre>';
          print_r($event);

          if ($event->data) {
          if (preg_match_all('/url\((.+?)\);?/im', $event->data, $matches)) {
          echo '<pre>';
          print_r($matches);
          exit;
          }
          }
         */
    }

    /**
     * Format string by adding datetime parameter to the end of string
     * @param $fileName relative path to the asset
     * @param $str string replace to
     * @return string
     */
    private static function _processUrl($fileName, $str) {

        try {
            $fileTime = '';

            $fileNameArr = explode('/', $fileName);

            $absFilePath = '';

            $levelUp = 0;
            foreach ($fileNameArr as $segment) {
                if ($segment == '..') {
                    $levelUp++;
                } else {
                    $absFilePath .= '/' . $segment;
                }
            }

            $requestUrl = explode('/', $_SERVER['REQUEST_URI']);


            for ($i = count($requestUrl) - 2; $i >= $levelUp + 1; $i--) {
                $absFilePath = '/' . $requestUrl[$i] . $absFilePath;
            }

            if (strpos($absFilePath, '?')) {
                $absFilePath = substr($absFilePath, 0, strpos($absFilePath, '?'));
            }

            $fullFilePath = $_SERVER['DOCUMENT_ROOT'] . $absFilePath;

            if (file_exists($fullFilePath)) {
                $fileTime = ((strpos($fileName, '?')) ? '&' : '?') . 'v=' . filemtime($fullFilePath);
            }

            if (strpos($str, $fileName . $fileTime) == false) {
                $str = str_replace($fileName, $fileName . $fileTime, $str);
            }
        } catch (Exception $exc) {
            
        }

        return $str;
    }

}
