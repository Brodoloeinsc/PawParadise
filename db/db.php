<?php

    $host='pg-21badee2-paw-paradise.f.aivencloud.com';
    $port='24763';
    $dbname='PawParadise';
    $user="avnadmin";
    $password="AVNS_19j1tGGwbwMCGD0JKZx";

    $connection = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password")or die("Not Connected");

    return $connection;
?>