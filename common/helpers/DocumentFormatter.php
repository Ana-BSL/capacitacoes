<?php

/**
 * Description of CPFFormatter
 *
 * @author Welsiton Ferreira
 */
class DocumentFormatter extends CFormatter {

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

    public function formatCPFCNPJ($value) {
        if ($value !== null && strlen($value) > 0) {
            if (strlen($value) > 11) {
                return $this->formatCNPJ($value);
            } else {
                return $this->formatCpf($value);
            }
        }
        return '';
    }

    public function formatTelefone($value) {
        if ($value !== null && strlen($value) > 0) {
            return '(' . substr($value, 0, 2) . ')' . substr($value, 2, 4) . '-' . substr($value, 6, 4);
        }
        return '';
    }

    public function formatLicencaCodigo($value) {
        if ($value !== null && strlen($value) > 0) {
            $str = substr($value, 0, 1) . '.';
            $str.=substr($value, 1, 1) . '.';
            $str.=substr($value, 2, 2) . '.';
            $str.=substr($value, 4, 3) . '.';
            $str.=substr($value, 7, 4) . '/';
            return $str.=substr($value, 11, 2);
        }
        return '';
    }
    
    public function formatCnae($value) {
        if ($value !== null && strlen($value) > 0) {
            $str = substr($value, 0, 4) . '-';
            $str.=substr($value, 4, 1) . '/';
            return $str.=substr($value, 5, 2);
        }
        return '';
    }
    public function formatNaturezaCodigo($value){
        if ($value !== null && strlen($value) > 0) {
            $str = substr($value, 0, 1) . '.';
            return $str .= substr($value, 1);
        }
        return '';
    }
    public function formatGrupoCodigo($value){
            return $this->formatNaturezaCodigo($value) ;
        
    }

    public function formatCep($value){
        if (strlen($value) === 8){
            return substr($value, 0, 5).'-'.substr($value, 5, 3);
        }
    }
    
    public function formatOpcional($value){
        if (!empty($value)){
            return $value;
        }
        return '';
    }
    
    public function formatProtocolo($value){
        if (strlen($value) === 11){
            
            return substr($value, 0, 5).'-'.substr($value, 5, 2).'/'.substr($value, 7);
        }
        return $value;
    }
    
    public function formatPlaca($value){
        if (strlen($value) === 7){
            
            return substr($value, 0, 3).'-'.substr($value, 3, 7);
        }
        return $value;
    }
}

?>
