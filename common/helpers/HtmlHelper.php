<?php
namespace common\helpers;

use \yii\bootstrap\Html;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HtmlHelper
 *
 * @author Júnior Pires
 */
class HtmlHelper {
    
    
    
    public static function labelLink($label,$linkParams) {
        
        $linkParams['options'] = ['target'=>'_blank'];
        return  Html::label($label."  ".
                Html::a($linkParams['linkName'],
                $linkParams['url'],
                $linkParams['options']));
    }
}
