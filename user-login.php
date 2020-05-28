<?php
session_start();
include('pacienti/include/functii.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(isset($_POST["doctor"])){
          $result = mysqli_query($conexiune,"SELECT * FROM doctori WHERE email='".$_POST['utilizator_email']."' AND parola='".$_POST['password']."'");
          $fetch = mysqli_fetch_array($result);
            if($fetch>0) {
        
                $_SESSION['doctor_email']=$_POST['utilizator_email'];
                $_SESSION['doctor_id']=$fetch['id'];
                $_SESSION['doctor_nume']=$fetch['nume'];
   
                $http_host = $_SERVER['HTTP_HOST'];
                $remote_address = $_SERVER['REMOTE_ADDR'];
                $php_self = dirname($_SERVER['PHP_SELF']);
                $dashboard = "dashboard.php?tab=profil";
          
            }

           header("location:http://$http_host$php_self/doctori/$dashboard");
           exit();

        } else if (isset($_POST["administrator"])){
          header("location:http://$http_host$php_self/administrator/$dashboard");
        }else {
          $result = mysqli_query($conexiune,"SELECT * FROM utilizatori WHERE email='".$_POST['utilizator_email']."' OR utilizator='".$_POST['utilizator_email']."' AND parola='".$_POST['password']."'");
          $fetch = mysqli_fetch_array($result);
            if($fetch>0) {
        
                $_SESSION['utilizator_email']=$_POST['utilizator_email'];
                $_SESSION['id']=$fetch['id'];
                $_SESSION['nume_intreg']=$fetch['nume_intreg'];
        
                $http_host = $_SERVER['HTTP_HOST'];
                $remote_address = $_SERVER['REMOTE_ADDR'];
                $php_self = dirname($_SERVER['PHP_SELF']);
                $dashboard = "dashboard.php?tab=profil";
          
            }
          header("location:http://$http_host$php_self/pacienti/$dashboard");
          exit();
        }
 
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        
        <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
    <title>Document</title>
</head>
<body>

<div id="login-container">
    <h3>Account Login</h3>
    <hr>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <form action="" method="post">
            <!-- <h4><?php echo $_SESSION['error']?></h4> -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="email-label">
                  <i class="fa fa-user-circle" aria-hidden="true"></i>
                </span>
              </div>
              <input type="text" class="form-control" name="utilizator_email" placeholder="Email sau nume utilizator" aria-label="Email" aria-describedby="email-label">
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="password-label">
                  <i class="fa fa-key" aria-hidden="true"></i>
                </span>
              </div>
              <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="password-label">
            </div>

            <label class="container-checkbox">Doctor
              <input type="checkbox" name="doctor" class="doctor">
              <span class="checkmark"></span>
            </label>

            <div class="text-center">
              <button type="submit" name="submit" class="btn-customized">Logare cont</button>
            </div>

          </form>
        </div>
      </div>
    </div>
</div>
    
</body>
</html>