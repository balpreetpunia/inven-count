<?php


if (isset($_GET['term'])){
    $return_arr = array();
    try {
        $dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_03a9a5b692a77f1","b81a903bbbb0b7","606b3f2e");
        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $stmt = $dbh->prepare('SELECT model FROM models_ra WHERE model LIKE :term');
        $stmt->execute(array('term' => $_GET['term'].'%'));

        while($row = $stmt->fetch()) {
            $return_arr[] =  $row['model'];
        }
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}
?>