<?php


    $dsn = 'mysql:dbname=46_learnsns;host=localhost';
    $user = 'root';
    $password='';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');


?>