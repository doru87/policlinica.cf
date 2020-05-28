<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = $_POST["username"];
        $fullname = $_POST["fullname"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $sex = $_POST["sex"];
        $email = $_POST["email"];

        $result = mysqli_query($conexiune,"UPDATE utilizatori SET utilizator='$username',nume_intreg='$fullname',adresa='$address',oras='$city',sex='$sex',email='$email' WHERE id='".$_SESSION['id']."' ");
        if($result > 0){
            $mesaj = "Profilul a fost actualizat cu succes!";
        }

    }
?>
<div class="col-lg-6 define-margin">
    <div class="card">
        <div class="card-header">
            <h4>Profilul tau</h4>
            <?php if(isset($mesaj)) {echo $mesaj; }?>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <?php 
                    if(isset($_SESSION['id'])){
                        $result = mysqli_query($conexiune,"SELECT * FROM utilizatori WHERE id ='".$_SESSION['id']."'");
                        $fetch = mysqli_fetch_array($result);
                        if($fetch>0) {
                            $utilizator = $fetch["utilizator"];
                            $nume_intreg = $fetch["nume_intreg"];
                            $adresa = $fetch["adresa"];
                            $oras = $fetch["oras"];
                            $sex = $fetch["sex"];
                            $email = $fetch["email"];
                    ?>
                   	<form role="form" name="edit" method="post">

                        <div class="form-group row">
                            <label for="username" class="col-4 col-form-label">Utilizator</label> 
                            <div class="col-8">
                                <input id="username" name="username" value="<?php echo htmlentities($utilizator)?>" placeholder="Username" class="form-control here" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fullname" class="col-4 col-form-label">Nume si prenume</label> 
                            <div class="col-8">
                                <input id="fullname" name="fullname" value="<?php echo htmlentities($nume_intreg)?>" placeholder="Full Name" class="form-control here" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-4 col-form-label">Adresa</label> 
                            <div class="col-8">
                                <input id="address" name="address" placeholder="Address" value="<?php echo htmlentities($adresa)?>" class="form-control here" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">Oras</label> 
                            <div class="col-8">
                                <input id="text" name="city" value="<?php echo htmlentities($oras)?>" placeholder="City" class="form-control here" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="select" class="col-4 col-form-label">Sex</label> 
                            <div class="col-8">
                                <select id="select" name="sex" class="custom-select">
                                    <option value="f">Feminin</option>
                                    <option value="m" <?php ($sex == "Masculin") ? "selected" : "" ?> >Masculin</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-4 col-form-label">Email*</label> 
                            <div class="col-8">
                                <input id="email" name="email" value="<?php echo htmlentities($email)?>" placeholder="Email" class="form-control here" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="submit" type="submit" class="btn btn-primary">Actualizeaza</button>
                            </div>
                        </div>
                     
                    </form>
                       
                    <?php }
                        }?>
                </div>
            </div>
        </div>
    </div>
</div>
        