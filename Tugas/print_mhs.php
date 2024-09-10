<?php

//Nama : Rosidah Rahmati
//NIM  : 24060122140121
//Lab  : B1

include 'hitung_rata.php';

function print_mhs($array_mhs) {
    echo "<table border='1'>";
    echo "<tr><th>Nama</th><th>Nilai 1</th><th>Nilai 2</th><th>Nilai 3</th><th>Rata-Rata</th></tr>";

    foreach ($array_mhs as $nama => $nilai) {
        echo "<tr>";
        echo "<td>" . $nama . "</td>";
        echo "<td>" . $nilai[0] . "</td>";
        echo "<td>" . $nilai[1] . "</td>";
        echo "<td>" . $nilai[2] . "</td>";
        $rata_rata = hitung_rata($nilai); // Panggil fungsi hitung_rata untuk menghitung rata-rata
        echo "<td>" . $rata_rata . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

$array_mhs = array(
    'Abdul' => array(89, 90, 54),
    'Budi' => array(98, 65, 74),
    'Nina' => array(67, 56, 84)
);

print_mhs($array_mhs);
?>