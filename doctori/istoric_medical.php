<?php 
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $conexiune;
    
    $height = mysqli_real_escape_string($conexiune,$_POST["height"]);
    $bloodpressure = mysqli_real_escape_string($conexiune,$_POST["bloodpressure"]);
    $bloodsugare = mysqli_real_escape_string($conexiune,$_POST["bloodsugare"]);
    $allergies = mysqli_real_escape_string($conexiune,$_POST["allergies"]);
    $chronic_diseases = mysqli_real_escape_string($conexiune,$_POST["chronic_diseases"]);

    $result = mysqli_query($conexiune,"INSERT INTO istoric_medical(id_pacient,inaltime,tensiune_arteriala,glicemie,alergii,boli_cronice) VALUES('".$_POST["pacient_id"]."','$height','$bloodpressure','$bloodsugare','$allergies','$chronic_diseases')");
    if($result > 0){
        $mesaj = "Istoricul medical a fost adaugat cu succes!";
    }
    }
?>

<div class="container define-margin">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-8">
            <h2 style="text-align: center;">Cauta pacient in baza de date dupa cnp</h2>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Cauta</span>
                    <input type="text" name="search_text" id="search_text" class="form-control" />
                </div>
                <?php if(isset($mesaj)) {echo $mesaj; }?>
            </div>
        </div>
    </div>
   
   <div id="cauta_pacient">
    </div>

    <div id="adauga_istoric">
    </div>
</div>

<script>
$(document).ready(function(){

    function cauta_pacient(cnp) {
        $.ajax({
            url:"include/functii.php",
            method:"POST",
            data:{cnp:cnp},
            success:function(data) {
            $('#cauta_pacient').html(data);
        }
        });
    }
    $('#search_text').keyup(function(){
        var text_cautat = $(this).val();
            if(text_cautat != ''){
                cauta_pacient(text_cautat);
            }else {
                window.location.reload();
            }

    });
    
    });

    function adauga_istoric(id) {
        $.ajax({
            url:"include/functii.php",
            method:"POST",
            data:{id:id},
            success:function(data){
            $('#adauga_istoric').html(data);
            if(document.getElementById("istoricmedical").disabled){
                document.getElementById("istoricmedical").innerHTML = "";
                document.getElementById("istoricmedical").innerHTML = "Istoric medical existent";
                document.getElementById("istoricmedical").classList.remove("btn-primary");
                document.getElementById("istoricmedical").classList.add("btn-danger");
                
                
            }
            document.getElementById("wrapper").style.height="auto";

        }
        });

        
    }
</script>