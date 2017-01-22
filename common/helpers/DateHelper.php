<?php
namespace common\helpers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DateHelper
 *
 * @author Pires
 */
class DateHelper {
    
    const DATE_EN = 'date_en';
    const DATETIME_EN = 'datetime_en';
    
    
    const DATE_FORMAT = 'php:d/m/Y';
    const DATE_FORMAT_EN = 'php:Y-m-d';
    const DATETIME_FORMAT = 'php:d-m-Y H:i:s';
    const DATETIME_FORMAT_EN = 'php:Y-m-d H:i:s';
    const TIME_FORMAT = 'php:H:i:s';
 
    public static function convert($dateStr, $type='date', $format = null) {
        if ($type === 'datetime') {
              $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
        }
        elseif ($type === 'time') {
              $fmt = ($format == null) ? self::TIME_FORMAT : $format;
        }
        elseif ($type === 'datetime_en') {
              $fmt = ($format == null) ? self::DATETIME_FORMAT_EN : $format;
        }
        elseif ($type === 'date_en') {
              $fmt = ($format == null) ? self::DATE_FORMAT_EN : $format;
        }
        else {
              $fmt = ($format == null) ? self::DATE_FORMAT : $format;
        }
        return \Yii::$app->formatter->asDate($dateStr, $fmt);
    }
}
