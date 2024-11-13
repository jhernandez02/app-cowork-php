<?php

namespace App\Helpers;

class Util {

    public static function formatStatus($value){
        $result = '-';
        if($value=='P'){
            $result = 'Pendiente';
        }else if($value=='A'){
            $result = 'Aceptada';
        }else if($value=='R'){
            $result = 'Rechazada';
        }
        return $result;
    }

    public static function badgeStatus($value){
        $status = '';
        $message = '';
        if($value=='P'){
            $status = 'warning';
            $message = 'Pendiente';
        }else if($value=='A'){
            $status = 'success';
            $message = 'Aceptada';
        }else if($value=='R'){
            $status = 'danger';
            $message = 'Rechazada';
        }
        return '<span class="badge text-bg-'.$status.'">'.$message.'</span>';
    }

    public static function formatDate($value){
        $result  = \DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y');
        return $result;
    }

}
