<?php

    $host='localhost';
    $port='5432';
    $dbname='PawParadise';
    $user="docker";
    $password="docker";

    $connection = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password")or die("Not Connected");

    return $connection;
?>