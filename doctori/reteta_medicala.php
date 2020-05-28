<?php
session_start();
include('include/functii.php');

if(isset($_GET["id"])){

    $result = mysqli_query($conexiune,"SELECT * FROM pacienti WHERE id_doctor='".$_SESSION['doctor_id']."' AND id='".$_GET["id"]."'");
    
    while($row = mysqli_fetch_array($result)){
        $nume = $row["nume"];
        $cnp = $row["card_identitate"];
        $email = $row["email"];
        $telefon = $row["telefon"];
        $sex = $row["sex"];
        $adresa = $row["adresa"];
        $varsta = $row["varsta"];
    }
}

function setRadioButtonSex($sex,$input) {
    $result = $sex == $input ? "checked" : "";
    return $result;
}

if(isset($_POST["submit-tratament-diagnostic"])){
    $result = mysqli_query($conexiune,"INSERT INTO diagnostic_tratament(id_pacient,id_doctor,diagnostic,tratament) VALUES('".$_GET["id"]."','".$_SESSION["doctor_id"]."','".$_POST["diagnostic"]."','".$_POST["medicaltreatment"]."')");
        
    if(mysqli_affected_rows($conexiune) > 0){
            $mesaj = "Datele au fost introduse cu succes!";
        }
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- custom stylesheet-->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="doctori.css">
    <!-- font awesome-->
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
                        <div class="card define-margin">
                            <div class="card-header">
                                <h4>Adaugare diagnostic,tratament si generare reteta</h4>
                                <?php if(isset($mesaj)) {echo $mesaj; }?>
                            </div>
                            <div class="card-body body-color">
                
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">

                                        <div class="form-group column">
                                            <label for="name" class="col-4 col-form-label">Numele pacientului</label> 
                                            <div class="col-8">
                                                <input id="name" name="name" value="<?php echo htmlentities($nume)?>" class="form-control here" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group column">
                                            <label for="identitycardnumber" class="col-4 col-form-label">CNP-ul pacientului</label> 
                                            <div class="col-8">
                                                <input id="identitycardnumber" name="identitycardnumber" value="<?php echo htmlentities($cnp)?>" class="form-control here" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group column">
                                            <label for="email" class="col-4 col-form-label">Email-ul pacientului</label> 
                                            <div class="col-8">
                                                <input id="email" name="email" value="<?php echo htmlentities($email)?>" class="form-control here" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group column">
                                            <label for="phone" class="col-4 col-form-label">Telefon-ul pacientului</label> 
                                            <div class="col-8">
                                                <input id="phone" name="phone" value="<?php echo htmlentities($telefon)?>" class="form-control here" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group column">
                                            <label for="form-check-input" class="col-4 col-form-label">Sex</label> 
                                        </div>
                                        <div class="form-group row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="female" value="Feminin" <?php echo setRadioButtonSex($sex,"Feminin")?> >
                                                <label class="form-check-label ml-4" for="female">Feminin</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="male" value="Masculin" <?php echo setRadioButtonSex($sex,"Masculin")?> >
                                                <label class="form-check-label ml-4" for="male">Masculin</label>
                                            </div>
                                        </div>

                                        <div class="form-group column">
                                            <label for="address" class="col-4 col-form-label">Adresa pacientului</label> 
                                            <div class="col-8">
                                                <input id="address" name="address" value="<?php echo htmlentities($adresa)?>" class="form-control here" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group column">
                                            <label for="age" class="col-4 col-form-label">Varsta pacientului</label> 
                                            <div class="col-8">
                                                <input id="age" name="age" value="<?php echo htmlentities($varsta)?>" class="form-control here" required="required" type="text">
                                            </div>
                                        </div>
                                    </div>

                                
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="row">
                                            <form role="form" name="add" class= "form_reteta_medicala"method="post">

                                            <div class="form-group column">
                                                <label for="diagnostic" class="col-4 col-form-label">Diagnostic</label> 
                                                <div class="col-8">
                                                    <input id="diagnostic" name="diagnostic" value="" class="form-control here" required="required" type="text">
                                                </div>
                                            </div>

                                            <div class="form-group column">
                                                <label for="medicaltreatment" class="col-4 col-form-label">Tratament</label>
                                                <div class="col-8">
                                                    <textarea class="form-control" name="medicaltreatment" id="medicaltreatment" rows="4"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group column">
                                                <div class="col-8">
                                                    <button name="submit-tratament-diagnostic" type="submit" class="btn btn-dark">Adauga</button>
                                                </div>
                                            </div>

                                            </form>

                                            <table class="table table-striped" id="tabel_tratamente">
                                                <thead class="thead-dark">
                                                    <tr>
                                                    <th style="width:5%" scope="col">#</th>
                                                    <th style="width:5%" scope="col"></th>
                                                    <th style="width:25%" scope="col">Diagnostic</th>
                                                    <th style="width:45%" scope="col">Tratament</th>
                                                    <th style="width:20%" scope="col">Data</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                        istoric_tratamente();
                                                    ?>
                                                </tbody>
                                            </table>

                                            <button type="button" class="btn btn-success" onclick="genereaza_reteta()">Genereaza reteta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
</div>
    
</body>
<script type="text/javascript">

function genereaza_reteta() {

        var name = document.getElementById("name").value;
        var identitycardnumber = document.getElementById("identitycardnumber").value;
        var age = document.getElementById("age").value;
        var address = document.getElementById("address").value;
        var radios = document.getElementsByName('gender');
        var judetul = "Dolj";
        var localitatea = "Craiova";
        var unitate_sanitara = "Policlinica ProLife"

        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                var sex = radios[i].value;
                break;
            }
        }

        var table = document.getElementById("tabel_tratamente");

        for (var i = 0, row; row = table.rows[i]; i++) {
            if (row.querySelector(".custom-control-input") !== null && row.querySelector(".custom-control-input:checked")) {
                var diagnostic = row.querySelector("#diagnostic").innerHTML;
                var tratament = row.querySelector("#tratament").innerHTML;
                var data_inregistrare = row.querySelector("#data_inregistrare").value;
                var zi = data_inregistrare.substr(0,2);
                var luna = data_inregistrare.substr(3,2);
                var an = data_inregistrare.substr(6,4);
            }
        }
        

        var docDefinition = {
            pageSize: 'A6',
            
            content: [
            
		{
            columns: [
        { width: '*', text: '' },
        {
            width: 'auto',
			style: 'tableExample',
			table: {
				body: [
					[{text:`Judetul: ${judetul}`,border: [true, true, true, true],margin: [0, 0, 0, 0],fontSize: 10}],
					[{text:`Localitatea: ${localitatea}`,border: [true, true, true, true],margin: [0, 0, 0, 0],fontSize: 10}],
					[{text:`Unitatea sanitara: ${unitate_sanitara}`,border: [true, true, true, true],margin: [0, 0, 0, 0],fontSize: 10}],
					[{text:`${an} luna ${luna} ziua ${zi}`,border: [true, true, true, true],margin: [0, 0, 0, 0],fontSize: 10}],

                    [{text:`RETETA MEDICALA`,border: [false, false, false, false],margin: [0, 20, 0, 0],fontSize: 15}],

                    [{text:`Numele si prenumele: ${name}`,border: [true, true, true, true],margin: [0, 20, 0, 0],fontSize: 10}],
					[{text:`C.N.P: ${identitycardnumber}`,border: [true, true, true, true],margin: [0, 0, 0, 0],fontSize: 10}],
                    [{text:`Sex: ${sex},varsta: ${age} ani,cu domiciliul in:`,border: [true, true, true, true],margin: [0, 0, 0, 0],fontSize: 10}],
                    [{text:`${address}`,border: [false, false, false, false],margin: [0, 0, 0, 0],fontSize: 10}],
                    [{text:`Nr. Fisa (reg,cons,foaie obs):`,border: [true, true, true, true],margin: [0, 0, 0, 0],fontSize: 10}],
                    [{text:`Diagnostic: ${diagnostic}`,border: [true, true, true, true],margin: [0, 0, 0, 0],fontSize: 10}],
                    [{text:``,border: [true, true, true, true],margin: [0, 10, 0, 0]}],
                    [{text:``,border: [true, true, true, true],margin: [0, 10, 0, 0]}],
                    [{text:`Tratament: ${tratament}`,border: [true, true, true, true],margin: [0, 0, 0, 0],fontSize: 10}],
                    [{text:``,border: [true, true, true, true],margin: [0, 10, 0, 0]}],
                    [{text:``,border: [true, true, true, true],margin: [0, 10, 0, 0]}],
                    [{text:``,border: [true, true, true, true],margin: [0, 10, 0, 0]}],
				]
				
              
			},
			layout: 'lightHorizontalLines'
        },
        { width: '*', text: '' },
            ] 
		},

    

            ],

        footer: {
            columns: [
            { text: `Data: ${data_inregistrare}`, alignment: 'left',margin: [55, -20, 0, 0],fontSize: 10 },
            { text: 'Semnatura si parafa medicului', alignment: 'right',margin: [0, -20, 55, 0],fontSize: 10 }
            ]
        },

        }


    pdfMake.createPdf(docDefinition).download('Report.pdf');

    }
</script>
</html>