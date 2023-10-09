<?php
function generate_password($length)
{
    // Daftar karakter yang akan digunakan dalam kode acak
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz#@';

    $random_code = '';
    $max = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $random_code .= $characters[mt_rand(0, $max)];
    }
    return $random_code;
}
?>