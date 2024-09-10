<?php

//Nama : Rosidah Rahmati
//NIM  : 24060122140121
//Lab  : B1

function hitung_rata($array) {
    $total = 0;
    $jumlah_nilai = count($array);
    
    foreach ($array as $nilai) {
        $total += $nilai;
    }
    
    return $total / $jumlah_nilai;
}
?>