<?php 
/*
BIBLIOTECA PHP "GusToppenKit"
Desenvolvido por: Gustavo Bayeux Franco
Gerido pela: GusToppen
*/



//VALIDAÇÃO DE CORES
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



//TEXTO VARIÁVEL DE ACORDO COM O USUÁRIO
function label($type = false, $string = false, $class = false, $lang = false, $html = true, $pronoun = true, $html2 = true, $lang2 = false)
{
    switch (strtolower($type)) {

        /* TYPE 1 */
        case 1:
        case 'etiqueta':
        case 'genero':
        case 'gender':
        case 'pronoun':

            if ($lang2 == false) {$lang2 = $_SERVER['HTTP_ACCEPT_LANGUAGE'];} //GET LANGUAGE
            $firstName = explode(' ', $class); //GET THE FIRST NAME

            if ($pronoun === 0) {

                //GET GENDER
            } else if ($pronoun === 1) {
                $gender = 1;
            }

            if (substr($firstName[0], -1) == 'o' && !isset($gender)) { //MALE
                $gender = 0;
            } else if (substr($firstName[0], -1) == 'a' && !isset($gender)) { //FEMALE
                $gender = 1;
            }

            switch (substr($lang2, 0, 2)) {
                case 'pt': //PORTUGUESE
                    if ($gender == 0) { //MALE
                        $translations = array(
                            'ela' => 'ele',
                            'esta' => 'este',
                            'essa' => 'esse',
                            'aquela' => 'aquele',
                            'tua' => 'teu',
                            'sua' => 'seu',
                            'nossa' => 'nosso',
                            'vossa' => 'vosso',
                            'elas' => 'eles',
                            'estas' => 'estes',
                            'essas' => 'esses',
                            'aquelas' => 'aqueles',
                            'tuas' => 'teus',
                            'suas' => 'seus',
                            'nossas' => 'nossos',
                            'vossas' => 'vossos',
                            'vinda' => 'vindo',
                            'garota' => 'garoto',
                            'menina' => 'menino',
                            'mulher' => 'homem',
                            'feminino' => 'masculino',
                            'uma ' => 'um ',
                            'dona' => 'dono',
                            ' a ' => ' o ',
                            'a senhora' => 'o senhor',
                            'sortuda' => 'sortudo',
                        );
                    } else if ($gender == 1) { //FEMALE
                        $translations = array(
                            'ele' => 'ela',
                            'este' => 'esta',
                            'esse' => 'essa',
                            'aquele' => 'aquela',
                            'teu' => 'tua',
                            'seu' => 'sua',
                            'nosso' => 'nossa',
                            'vosso' => 'vossa',
                            'eles' => 'elas',
                            'estes' => 'estas',
                            'esses' => 'essas',
                            'aqueles' => 'aquelas',
                            'teus' => 'tuas',
                            'seus' => 'suas',
                            'nossos' => 'nossas',
                            'vossos' => 'vossas',
                            'vindo' => 'vinda',
                            'vindos' => 'vindas',
                            'garoto' => 'garota',
                            'menino' => 'menina',
                            'homem' => 'mulher',
                            'masculino' => 'feminino',
                            'um ' => 'uma ',
                            ' o ' => ' a ',
                            'o senhor' => 'a senhora',
                            'sortudo' => 'sortuda',

                        );
                    } else { //UNISSEX
                        $translations = array(
                            'aquela' => 'tal',
                            'tua' => 'teu',
                            'sua' => 'seu',
                            'nossa' => 'nosso',
                            'vossa' => 'vosso',
                            'elas' => 'tais',
                            'aquelas' => 'aqueles',
                            'tuas' => 'teus',
                            'suas' => 'seus',
                            'nossas' => 'nossos',
                            'vossas' => 'vossos',
                            'bem-vindo' => 'boas-vindas',
                            'bem-vinda' => 'boas-vindas',
                            'bem vinda' => 'boas-vindas',
                            'bem vindo' => 'boas-vindas',
                            'seja bem vindo' => 'boas-vindas',
                            'seja bem vinda' => 'boas-vindas',
                            'seja bem-vindo' => 'boas-vindas',
                            'seja bem-vinda' => 'boas-vindas',
                            'garota' => 'pessoa',
                            'garoto' => 'pessoa',
                            'menina' => 'pessoa',
                            'menino' => 'pessoa',
                            'mulher' => 'pessoa',
                            'homem' => 'pessoa',
                            'um ' => 'uma ',
                            'o senhor' => 'você',
                            'a senhora' => 'você',
                            'sortudo' => 'sortuda',
                        );
                    }

                    break;
                case 'en': //ENGLISH
                    if ($gender == 0) { //MALE
                        $translations = array(
                            'she' => 'he',
                            'girl' => 'boy',
                            'woman' => 'man',
                            'female' => 'male',
                            'him' => 'her',
                            'his' => 'her',
                            'himself' => 'herself',
                        );
                    } else if ($gender == 1) { //FEMALE
                        $translations = array(
                            'he' => 'she',
                            'boy' => 'girl',
                            'man' => 'woman',
                            'male' => 'female',
                            'her' => 'him',
                            'her' => 'his',
                            'herself' => 'himself',
                            'fellow' => 'girl',
                            'youngster' => 'girl',
                            'lad' => 'girl',
                        );
                    } else { //UNISSEX
                        $translations = array(
                            'she' => 'he',
                            'girl' => 'boy',
                            'woman' => 'man',
                            'female' => 'male',
                            'him' => 'her',
                            'his' => 'her',
                            'himself' => 'herself',
                        );
                    }
                    break;
                case 'es': //ESPANISH
                    if ($gender == 0) { //MALE
                        $translations = array(
                            'ella' => 'él',
                            'nosotras' => 'nosotros',
                            'vosotras' => 'vosotros',
                            'ellas' => 'ellos',
                        );
                    } else if ($gender == 1) { //FEMALE
                        $translations = array(
                            'él' => 'ella',
                            'nosotros' => 'nosotras',
                            'vosotros' => 'vosotras',
                            'ellos' => 'ellas',
                        );
                    } else { //UNISSEX
                        $translations = array(
                            'ella' => 'él',
                            'nosotras' => 'nosotros',
                            'vosotras' => 'vosotros',
                            'ellas' => 'ellos',
                        );
                    }
                    break;

                default: //OTHER LANGUAGES
                    if ($gender == 0) { //MALE
                        $translations = array(
                            'she' => 'he',
                            'him' => 'her',
                            'his' => 'her',
                            'himself' => 'herself',
                        );
                    } else if ($gender == 1) { //FEMALE
                        $translations = array(
                            'he' => 'she',
                            'her' => 'him',
                            'her' => 'his',
                            'herself' => 'himself',
                        );
                    } else { //UNISSEX
                        $translations = array(
                            'he' => ' ',
                            'her' => 'him',
                            'her' => 'his',
                            'herself' => 'himself',
                        );
                    }
                    break;

            }

            //RETURN
            if ($html2 == true) { //IF HTML IS PERMITTED

                if (is_bool($html)) { //CLASS ISN'T DEFINED

                    if ($pronoun === false) { //CHECK IF TEXT NEED PRONOUN TRANSLATION
                        return $string . " " . $class . " " . $lang;
                    } else {
                        return ucfirst(strtr(strtolower($string), $translations)) . " " . $class . " " . strtr(strtolower($lang), $translations);
                    }

                } else { //CLASS IS DEFINED

                    if ($pronoun === false) { //CHECK IF TEXT NEED PRONOUN TRANSLATION
                        return $string . "<a class='" . $html . "'> " . $class . " </a>" . $lang;
                    } else {
                        return ucfirst(strtr(strtolower($string), $translations)) . "<a class='$html'> " . $class . " </a>" . strtr(strtolower($lang), $translations);
                    }

                }

            } else { //RAWTEXT
                if ($pronoun === false) {
                    return $string . " " . $class . " " . $lang;
                } else {
                    return ucfirst(strtr(strtolower($string), $translations)) . " " . $class . " " . strtr(strtolower($lang), $translations);
                }
            }
            break;

        /* TYPE 2 */
        default:

            //CONFIG
            if ($type == 'welcome' || $type == 2) {$type = $string;} else { $newClass = $string;}
            $newClass = $class;
            $string = $type;

            //CHECK AND GET CLASS
            if (is_string($class) && str_contains('-', $class)) {$lang = $class;}

            //GET FIRST NAME
            $firstName = explode(' ', $string);

            //GET LANGUAGE
            if ($lang == false) {$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];}

            //GET GENDER
            if ($pronoun === 0) {
                $gender = 0;
            } else if ($pronoun === 1) {
                $gender = 1;
            }

            if (substr($firstName[0], -1) == 'o' && !isset($gender)) { //MALE
                $gender = 0;
            } else if (substr($firstName[0], -1) == 'a' && !isset($gender)) { //FEMALE
                $gender = 1;
            }

            switch (substr($lang, 0, 2)) {

                case 'pt': //PORTUGUESE
                    if ($gender == 0) { //MALE
                        $prefix = 'Bem-vindo';
                    } else if ($gender == 1) { //FEMALE
                        $prefix = 'Bem-vinda';
                    } else { //UNISSEX
                        $prefix = 'Boas-vindas';
                    }

                    break;
                case 'en': //ENGLISH
                    $prefix = 'Welcome';
                    break;
                case 'es': //ESPANISH
                    if ($gender == 0) { //MALE
                        $prefix = 'Bienvenido';
                    } else if ($gender == 1) { //FEMALE
                        $prefix = 'Bienvenida';
                    } else { //UNISSEX
                        $prefix = 'Bienvenido';
                    }

                    break;
                default: //OTHER LANGUAGES
                    $prefix = 'Welcome';
                    break;
            }

            //RETURN
            if ($html == true) {
                if ($newClass == false) {
                    return $prefix . ' ' . $string;
                } else {
                    return $prefix . "<a class='" . $newClass . "'> " . $string . "</a>";
                }
            } else {
                return $prefix . ' ' . $string;
            }
            break;

    }
}
