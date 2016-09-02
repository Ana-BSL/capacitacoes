<?php
namespace common\helpers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TuivaFormatter
 *
 * @author smsti01
 */
class DefaultFormatter extends \yii\i18n\Formatter{
    public function init() {
        parent::init();
    }
    
    public function formatCpf($value) {
        if ($value !== null && strlen($value) > 0) {
            return substr($value, 0, 3) . "." . substr($value, 3, 3) . "." . substr($value, 6, 3) . '-' . substr($value, 9, 2);
        }
        return '';
    }

    public function formatCNPJ($value) {
        if ($value !== null && strlen($value) > 0) {
            return substr($value, 0, 2) . "." . substr($value, 2, 3) . "." . substr($value, 5, 3) . "/" . substr($value, 8, 4) . '-' . substr($value, 12, 2);
        }
        return '';
    }

    public function asCpfCnpj($value) {
        if ($value !== null && strlen($value) > 0) {
            if (strlen($value) > 11) {
                return $this->formatCNPJ($value);
            } else {
                return $this->formatCpf($value);
            }
        }
        return '';
    }

     public function asCep($value){
        if (strlen($value) === 8){
            return substr($value, 0, 5).'-'.substr($value, 5, 3);
        }
    }
}
