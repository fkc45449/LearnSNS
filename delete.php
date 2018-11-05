<?php



    require('../../functions.php');
    require('dbconnect.php');


    $sql = 'DELETE FROM `feeds` WHERE `id`=?';
    $data = array($feed_id);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    header('Location: timeline.php')
    exit();

?>