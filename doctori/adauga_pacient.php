<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        global $conexiune;
        
        $doctor_id = $_SESSION['doctor_id'];
        $nume = mysqli_real_escape_string($conexiune,$_POST["name"]);
        $cnp = mysqli_real_escape_string($conexiune,$_POST["identitycardnumber"]);
        $adresa = mysqli_real_escape_string($conexiune,$_POST["address"]);
        $email = mysqli_real_escape_string($conexiune,$_POST["email"]);
        $telefon = mysqli_real_escape_string($conexiune,$_POST["phone"]);
        $sex = mysqli_real_escape_string($conexiune,$_POST["gender"]);
        $varsta = mysqli_real_escape_string($conexiune,$_POST["age"]);

    $result = mysqli_query($conexiune,"INSERT INTO pacienti(id_doctor,nume,card_identitate,adresa,email,telefon,sex,varsta) VALUES ('$doctor_id','$nume','$cnp','$adresa','$email','$telefon','$sex','$varsta')");
        if($result > 0){
            $mesaj = "Pacientul a fost adaugat cu succes!";
        }
        else {
            echo("Error description: " . mysqli_error($conexiune));
        }

}
?>

<div class="col-lg-6 define-margin">
    <div class="card">
        <div class="card-header">
            <h4>Adauga pacient</h4>
            <?php if(isset($mesaj)) {echo $mesaj; }?>
        </div>
        <div class="card-body body-color">
     
            <div class="row">
                <div class="col-md-12">

                    <form role="form" name="add" method="post">

                    <div class="form-group column">
                        <label for="name" class="col-4 col-form-label">Numele pacientului</label> 
                        <div class="col-8">
                            <input id="name" name="name" class="form-control here" required="required" type="text">
                        </div>
                    </div>

                    <div class="form-group column">
                        <label for="identitycardnumber" class="col-4 col-form-label">CNP-ul pacientului</label> 
                        <div class="col-8">
                            <input id="identitycardnumber" name="identitycardnumber" class="form-control here" required="required" type="text">
                        </div>
                    </div>

                    <div class="form-group column">
                        <label for="email" class="col-4 col-form-label">Email-ul pacientului</label> 
                        <div class="col-8">
                            <input id="email" name="email" class="form-control here" required="required" type="text">
                        </div>
                    </div>

                    <div class="form-group column">
                        <label for="phone" class="col-4 col-form-label">Telefon-ul pacientului</label> 
                        <div class="col-8">
                            <input id="phone" name="phone" class="form-control here" required="required" type="text">
                        </div>
                    </div>

                    <div class="form-group column">
                        <label for="form-check-input" class="col-4 col-form-label">Sex</label> 
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Feminin">
                            <label class="form-check-label ml-4" for="female">Feminin</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Masculin">
                            <label class="form-check-label ml-4" for="male">Masculin</label>
                        </div>
                    </div>

                    <div class="form-group column">
                        <label for="address" class="col-4 col-form-label">Adresa pacientului</label> 
                        <div class="col-8">
                            <input id="address" name="address" class="form-control here" required="required" type="text">
                        </div>
                    </div>

                    <div class="form-group column">
                        <label for="age" class="col-4 col-form-label">Varsta pacientului</label> 
                        <div class="col-8">
                            <input id="age" name="age" class="form-control here" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group column">
                        <div class="col-8">
                            <button name="submit" type="submit" class="btn btn-dark">Adauga</button>
                        </div>
                    </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
