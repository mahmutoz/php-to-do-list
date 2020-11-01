<?php

// Veritabanı bağlantısı
$mysqli = new mysqli('localhost', 'root', '', 'to-do-list') or die(mysqli_error($mysqli));
