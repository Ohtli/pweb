<?php
function validar_curp($curp) {
    // Check if the CURP is 18 characters long
    if (strlen($curp) !== 18) {
        return false;
    }
    
    // Check if the CURP matches the pattern
    $pattern = '/^[A-Z]{4}[0-9]{6}[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GR|GT|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TL|TS|VZ|YN|ZS)[A-Z]{3}[0-9A-Z]{1}[0-9]{1}$/';
    if (!preg_match($pattern, $curp)) {
        return false;
    }
    
    $checkDigit = $curp[17];
    $curpWithoutCheckDigit = substr($curp, 0, 17);
    $validCheckDigit = calculateCURPCheckDigit($curpWithoutCheckDigit);
    if (intval($checkDigit) !== $validCheckDigit) {
        return false;
    }
    
    return true;
}

function calculateCURPCheckDigit($curp) {
    $alphabet = '0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ';
    $sum = 0;
    
    for ($i = 0; $i < strlen($curp); $i++) {
        $char = strtoupper($curp[$i]);
        $value = strpos($alphabet, $char);
        
        if ($value >= 26) {
            $value = $value - 1;
        }
        
        $weight = 18 - $i;
        $sum += $value * $weight;
    }
    
    $checkDigitIndex = $sum % 10;
    
    if($checkDigitIndex == 0)
        return 0;
    $checkDigitIndex = 10 - $checkDigitIndex;
    return $checkDigitIndex;
}