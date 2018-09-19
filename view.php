<?php

require 'shared/connect.php';

$sql = "select model, counted, qty_in_hand, last_updated from inventory where counted > 0 order by last_updated desc";
$sth = $dbh->prepare($sql);
$sth->execute();
$available = $sth->fetchAll();
$count = $sth->rowCount();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Count</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script></head>
<body>
<div class="container">
    <div class="jumbotron pb-4">
        <h1><a href="/" >Count Inventory</a></h1>
        <p>View Counted Inventory</p>
        <p><a href="/">&lt;&lt;Back</a></p>
    </div>
    <hr class="pb-3">
    <div class="input-group mb-3" id="stickForm">
        <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search By Model..." title="Type in a model">
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
    </div>
    <div class="table-responsive">
        <table id="myTable" class="table table-bordered table-stripped table-hover">
            <thead>
            <tr>
                <td>Model</td>
                <td>Counted</td>
                <td>In Hand</td>
                <td>Time Counted</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($available as $avail ): ?>
                <tr>
                    <td><?= $avail['model']?></td>
                    <td><?= $avail['counted']?></td>
                    <td><?= $avail['qty_in_hand']?></td>
                    <td><?php $date = date_create($avail['last_updated']); echo date_format($date, 'g:i:s A');?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, index;

        index = 0;
        input = document.getElementById("myInput");

        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");


        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[index];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
</body>
</html>