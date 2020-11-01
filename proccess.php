<?php

// session Başlatma
session_start();
ob_start();

require_once 'connect.php';

// Varsayılan değerler
$update = false;
$id = 0;
$task = '';
$date_time = '';

/**
 * CREATE
 */

// isset(): Bir değişkenin varlığını kontrol eder.
// Formdan gelen elemanların değişkenlere aktarılması
if(isset($_POST['save'])) {
    $task = $_POST['task'];

    // Formdan gelen elemanları veritabanı ekleme işlemi
    $mysqli->query("INSERT INTO data (task) VALUES('$task')") or die($mysqli->error);

    // Session'ı index.php ye yönlendirme
    header("location: index.php");
}

/**
 * READ
 */

if( isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $update = true;

    // Veritabanına gönderilen Id'ye eşit olan değeri bulup değişkene atama
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

    // Veritabanında aranan değer varsa aşağıdaki atama işlemlerini yap
    if ($result->num_rows){
        $row = $result->fetch_array();
        $task = $row['task'];
    }

}

/**
 * UPDATE
 */

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $task = $_POST['task'];

    $mysqli->query("UPDATE data SET task='$task' WHERE id=$id") or die($mysqli->error());

    // Session'ı index.php ye yönlendirme
    header("location: index.php");
}

/**
 * DELETE
 */

// $_GET metodu ile id numarasını alıp bu id ile veritabanında eşleşen id numarasını siliyoruz.
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    // Session'ı index.php ye yönlendirme
    header("location: index.php");
}
