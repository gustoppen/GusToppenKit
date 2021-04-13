<?php
/*
VALIDAÇÃO DE CORES
Desenvolvido por: Gustavo Bayeux Franco
Gerido pela: GusToppen
Útima revisão: 13/03/2020
 */

function checkColor(string $color, bool $return = false)
{
    switch (strtolower(substr($color, 0, 1))) {
        case '#': //HEX
            if (preg_match('/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/', $color)) {
                if (strlen($color) <= 6 && strlen($color) >= 3) {
                    if ($return === true) {
                        return $color;
                    } else {
                        return true;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
            break;
        case 'r':
            if (strtolower(substr($color, 3, 1)) == 'a') { //RGBA
                $colorF1 = str_replace('(', '', substr($color, 5));
                $colorF2 = str_replace(')', '', substr($color, 5));
                $colorVal = explode(',', $colorF2);
                if ($colorVal['0'] > 255 || $colorVal['1'] > 255 || $colorVal['2'] > 255 || floatval($colorVal['3']) > 1) {
                    return false;
                } else if ($colorVal['0'] > 0 && $colorVal['1'] > 0 && $colorVal['2'] > 0 && floatval($colorVal['3']) > 0) {
                    if ($return === true) {
                        $colorReturn = "rgba(" . implode(',', $colorVal) . ")";
                        return $colorReturn;
                    } else {
                        return true;
                    }
                } else {
                    return false;
                }
            } else if (strtolower(substr($color, 3, 1)) == '(') { //RGB
                $colorF1 = str_replace('(', '', substr($color, 4));
                $colorF2 = str_replace(')', '', substr($color, 4));
                $colorVal = explode(',', $colorF2);
                //var_dump($colorVal);
                if ($colorVal['0'] > 255 || $colorVal['1'] > 255 || $colorVal['2'] > 255) {
                    return false;
                } else if ($colorVal['0'] > 0 && $colorVal['1'] > 0 && $colorVal['2'] > 0) {
                    if ($return === true) {
                        $colorReturn = "rgb(" . implode(',', $colorVal) . ")";
                        return $colorReturn;
                    } else {
                        return true;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
            break;
        case 'h': //HSL
            $colorF1 = str_replace('(', '', substr($color, 4));
            $colorF2 = str_replace(')', '', substr($color, 4));
            $colorVal = explode(',', $colorF2);
            if ($colorVal['0'] > 255 || intval(str_replace('%', '', $colorVal['1'])) > 100 || intval(str_replace('%', '', $colorVal['1'])) > 100) {
                return false;
            } else if ($colorVal['0'] > 0 && intval(str_replace('%', '', $colorVal['1'])) > 0 && intval(str_replace('%', '', $colorVal['2'])) > 0) {
                if ($return === true) {
                    $colorReturn = "hsl(" . implode(',', $colorVal) . ")";
                    return $colorReturn;
                } else {
                    return true;
                }
            } else {
                return false;
            }
            break;
        default:
            return false;
            break;
    }
}
