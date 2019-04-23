<?php
echo "Welcome Robby Tan" . '<br  />';
$var = 25;
$nama = "Jon";
$lolos = true;
$namaDepan = "John";
$nama_depan = "John";
echo $nama . " " . $var . '<br />';

if ($var > 30) {
    echo "Nilai var di atas 30" . '<br />';
} elseif ($var == 30) {
    echo "Nilai var sama dengan 30" . '<br />';
} else {
    echo "Nilai var di bawah 30" . '<br />';
}

// $i++ ==> $i = $i + 1
// $i+=n ==> $i = $i + n
for ($i = 0; $i < 10; $i+=3) {
    echo $i . '<br />';
}

$a = 1;
while ($a <= 10) {
    echo $a . '<br />';
    $a*=3;
}
