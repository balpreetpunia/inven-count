<?php
    try{


        $dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_03a9a5b692a77f1","b81a903bbbb0b7","606b3f2e");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
    echo 'Database Connection failed: ' . $e->getMessage();
    }