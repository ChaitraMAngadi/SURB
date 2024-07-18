<?php

function pr($arr) {
    echo "<pre>";
    print_r($arr);
    exit;
    echo "</pre>";
}

function prx($arr) {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

function random_string_generator($number) {

    $digit = "0123456789abcdefghijklmnopqrstuvwxyz";
    $file_name = "";

    for ($i = 0;
            $i < $number;
            $i++) {
        $file_name .= substr($digit, (rand() % (strlen($digit))), 1);
    }
    return $file_name;
}

function make_seo_url($str) {
    $string = preg_replace('/[^a-zA-Z0-9\.]/', "-", strtolower($str)); //Replace spaces & special char.s with hyphens
    $hyphens_str = preg_replace('/-+/', '-', $string); //Double hypens replace with single hypen
    $seo_url = trim(preg_replace("![^a-z0-9]+!i", "-", $hyphens_str), '-'); //will strip leading and trailing dashes
    $random_char = rand(111, 999);
    $final_seo_url = $seo_url . '-' . $random_char;
    return $final_seo_url;
}

function array_diff_assoc_recursive($array1, $array2) {
    foreach ($array1 as $key => $value) {
        if (is_array($value)) {
            if (!isset($array2[$key])) {
                $difference[$key] = $value;
            } elseif (!is_array($array2[$key])) {
                $difference[$key] = $value;
            } else {
                $new_diff = array_diff_assoc_recursive($value, $array2[$key]);
                if ($new_diff != FALSE) {
                    $difference[$key] = $new_diff;
                }
            }
        } elseif (!isset($array2[$key]) || $array2[$key] != $value) {
            $difference[$key] = $value;
        }
    }
    return !isset($difference) ? 0 : $difference;
}

function generate_session_id() {
    $yy = date("y"); //year
    $mm = date("m"); //month
    $dd = date("d"); //date
    $ii = date("i"); //minute
    $ss = date("s"); //second
    $rand = rand(111, 999); // 3 digit random numbers

    $session_id = $yy . $mm . '-' . $dd . $ii . $ss . '-' . $rand;

    return $session_id;
}

?>
