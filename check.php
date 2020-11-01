<?php

require_once 'connect.php';
require_once 'proccess.php';

if ( isset($_GET['switch']) ) {
    $id = $_GET['switch'];


    // Veritabanına gönderilen Id'ye eşit olan değeri bulup değişkene atama
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

    // Veritabanında aranan değer varsa aşağıdaki atama işlemlerini yap
    if ( $result->num_rows ) {
        $row = $result->fetch_array();
        $done = $row['done'];
    }

    $done ? $done = 0 : $done = 1;

    $mysqli->query("UPDATE data SET done='$done' WHERE id=$id") or die($mysqli->error());

    header("location: index.php");

}
