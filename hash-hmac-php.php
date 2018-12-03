<?php
/**
* Implementación para la generación de la firma de datos Hash HMAC en PHP
*/

function signData($public_key = '', $commerce_id = '', $tx_reference = '', $tx_amount = '', $tx_currency = '') {

    $data = $public_key.'%'.$commerce_id.'%'.$tx_reference.'%'.$tx_amount.'%'.$tx_currency;
    
    //Este dato lo puedes obtener en el Dashboard de tu cuenta, sección de integraciones.
    $private_key = '';

    $hash_available = hash_algos();

    if (in_array('sha512/256', $hash_available)) {
        $h = 'sha512/256';
    } else if (in_array('sha512', $hash_available)) {
        $h = 'sha512';
    } else if (in_array('sha384', $hash_available)) {
        $h = 'sha384';
    } else if (in_array('sha256', $hash_available)) {
        $h = 'sha256';
    } else if (in_array('md5', $hash_available)) {
        $h = 'md5';
    } else {
        return false;
    }

    $hash = hash_hmac($h, $data, $private_key);

    if ((!empty($hash)) && ($hash !== false)) {
        return $hash;
    } else {
        return false;
    }

}
?>
