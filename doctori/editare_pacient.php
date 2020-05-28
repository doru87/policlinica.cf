<?php
    global $conexiune;

if(isset($_POST["submit-editare-pacient"])) {
    
    $nume = $_POST["name"];
    $cnp = $_POST["identitycardnumber"];
    $email = $_POST["email"];
    $telefon = $_POST["phone"];
    $sex = $_POST["gender"];
    $adresa = $_POST["address"];
    $varsta = $_POST["age"];

    $result = mysqli_query($conexiune,"UPDATE pacienti SET nume='$nume',card_identitate='$cnp',adresa='$adresa',email='$email',telefon='$telefon',sex='$sex',varsta='$varsta' WHERE id='".$_GET["tab"]."' ");
    if($result > 0){
        $mesaj = "Profilul pacientului a fost actualizat cu succes!";
    }
}

if(isset($_POST["submit-istoric"])) {

    $inaltime = $_POST["height"];
    $tensiune_arteriala = $_POST["bloodpressure"];
    $glicemie = $_POST["bloodsugare"];
    $alergii = $_POST["allergies"];
    $boli_cronice = $_POST["chronic_diseases"];

    $result = mysqli_query($conexiune,"UPDATE istoric_medical SET inaltime='$inaltime',tensiune_arteriala='$tensiune_arteriala',glicemie='$glicemie',alergii='$alergii',boli_cronice='$boli_cronice' WHERE id_pacient='".$_GET["tab"]."' ");
    if($result > 0){
        $mesaj = "Profilul pacientului a fost actualizat cu succes!";
    }
}

if(isset($_GET["tab"])){

    $result = mysqli_query($conexiune,"SELECT * FROM pacienti WHERE id_doctor='".$_SESSION['doctor_id']."' AND id='".$_GET["tab"]."'");
    
    while($row = mysqli_fetch_array($result)){
        $nume = $row["nume"];
        $cnp = $row["card_identitate"];
        $email = $row["email"];
        $telefon = $row["telefon"];
        $sex = $row["sex"];
        $adresa = $row["adresa"];
        $varsta = $row["varsta"];
    }

    $result = mysqli_query($conexiune,"SELECT * FROM istoric_medical WHERE id_pacient='".$_GET["tab"]."'");
    
    if(mysqli_affected_rows($conexiune) > 0){

        while($row = mysqli_fetch_array($result)){
            $inaltime = $row["inaltime"];
            $tensiune_arteriala = $row["tensiune_arteriala"];
            $glicemie = $row["glicemie"];
            $alergii = $row["alergii"];
            $boli_cronice = $row["boli_cronice"];
        }
    }else {
        $inaltime = "";
        $tensiune_arteriala = "";
        $glicemie = "";
        $prescriptie_medicala = "";
    }

}

function setRadioButtonSex($sex,$input) {
    $result = $sex == $input ? "checked" : "";
    return $result;
}

?>
 
<div class="col-md-12 define-margin">
    <div class="card">
        <div class="card-header">
            <h4>Editare pacient</h4>
            <?php if(isset($mesaj)) {echo $mesaj; }?>
        </div>
        <div class="card-body body-color">
 
            <div class="row">
                <div class="col-md-6">

                    <form role="form" name="add" method="post">

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
                        <div class="form-group column">
                            <div class="col-8">
                                <button name="submit-editare-pacient" type="submit" class="btn btn-dark">Editare</button>
                            </div>
                        </div>

                    </form>
                
                    </div>

                    <div class="col-md-6">

                        <form role="form" name="add" method="post">

                            <div class="form-group column">
                                <label for="height" class="col-4 col-form-label">Inaltime</label> 
                                <div class="col-8">
                                    <input id="height" name="height" value="<?php echo htmlentities($inaltime)?>" class="form-control here" required="required" type="text">
                                </div>
                            </div>

                            <div class="form-group column">
                                <label for="bloodpressure" class="col-4 col-form-label">Tensiune arteriala</label> 
                                <div class="col-8">
                                    <input id="bloodpressure" name="bloodpressure" value="<?php echo htmlentities($tensiune_arteriala)?>" class="form-control here" required="required" type="text">
                                </div>
                            </div>

                            <div class="form-group column">
                                <label for="bloodsugare" class="col-4 col-form-label">Glicemie</label> 
                                <div class="col-8">
                                    <input id="bloodsugare" name="bloodsugare" value="<?php echo htmlentities($glicemie)?>" class="form-control here" required="required" type="text">
                                </div>
                            </div>

                            <div class="form-group column">
                                <label for="allergies" class="col-4 col-form-label">Alergii</label> 
                                <div class="col-8">
                                    <input id="allergies" name="allergies" value="<?php echo htmlentities($alergii)?>" class="form-control here" required="required" type="text">
                                </div>
                            </div>
                            
                            <div class="form-group column">
                                <label for="chronic_diseases" class="col-4 col-form-label">Boli Cronice</label> 
                                <div class="col-8">
                                    <input id="chronic_diseases" name="chronic_diseases" value="<?php echo htmlentities($boli_cronice)?>" class="form-control here" required="required" type="text">
                                </div>
                            </div>

                            <div class="form-group column">
                                <div class="col-8">
                                    <button name="submit-istoric" type="submit" class="btn btn-dark">Editare</button>
                                </div>
                            </div>

                        </form>
                    
                    </div>
            </div>
        </div>
    </div>
</div>

