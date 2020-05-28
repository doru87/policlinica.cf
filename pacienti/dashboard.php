<?php
session_start();
include('include/functii.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        
        <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/vfs_fonts.js"></script>


    <title>Document</title>
</head>
<body>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<div id="wrapper">
    <?php include('include/sidebar.php');?>
        <div class="container">
            <div class="row" id="main" >
                <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center" id="content">
                    <?php
                    $tb = isset($_GET['tab']) ? $_GET['tab'] : '';
                    switch($tb) {
                        case 'profil':
                            include('edit_profile.php');
                        break; 
                        case 'programare':
                            include('adauga_programare.php'); 
                        break; 
                        case 'istoric-programari':
                            include('istoric_programari.php');
                        break;
                        case 'istoric-medical':
                            include('istoric_medical.php');
                        break;
                        case 'schimba_parola':
                            include('schimba_parola.php');
                        break;
                    } 
                    ?>
                </div>
            </div>
        </div>
</div>
    
</body>
</html>