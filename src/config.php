<?php 
    const SERVER = "localhost";
    const DB = "homework-5";
    const LOGIN ="root";
    const PASS = "";
    $connect = mysqli_connect(SERVER, LOGIN, PASS, DB) or die ("Ошибка соединения с базой")
?>