<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nume = $_POST["username"];
        $specializare = $_POST["specialization"];
        $consultatie = $_POST["price"];
        $telefon = $_POST["phone"];
        $email = $_POST["email"];

        $result = mysqli_query($conexiune,"UPDATE doctori SET nume='$nume',specializare='$specializare',consultatie='$consultatie',telefon='$telefon',email='$email' WHERE id='".$_SESSION['doctor_id']."' ");
        if($result > 0){
            $mesaj = "Profilul a fost actualizat cu succes!";
        }
    }
?>
<div class="col-md-6 define-margin">
    <div class="card">
        <div class="card-header">
            <h4>Profilul tau</h4>
            <?php if(isset($mesaj)) {echo $mesaj; }?>
        </div>
        <div class="card-body body-color">
          
            <div class="row">
                <div class="col-md-12">
                    <?php 
                    if(isset($_SESSION['doctor_id'])){
                        $result = mysqli_query($conexiune,"SELECT * FROM doctori WHERE id ='".$_SESSION['doctor_id']."'");
                        $fetch = mysqli_fetch_array($result);

                        if($fetch>0) {

                            $nume = $fetch["nume"];
                            $specializare = $fetch["specializare"];
                            $consultatie = $fetch["consultatie"];
                            $telefon = $fetch["telefon"];
                            $email = $fetch["email"];
                    ?>
                   	<form role="form" name="edit" method="post">

                        <div class="form-group row">
                            <label for="username" class="col-4 col-form-label">Numele doctorului</label> 
                            <div class="col-8">
                                <input id="username" name="username" value="<?php echo htmlentities($nume)?>" class="form-control here" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="specialization" class="col-4 col-form-label">Specializare</label> 
                            <div class="col-8">
                                <input id="specialization" name="specialization" value="<?php echo htmlentities($specializare)?>" class="form-control here" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-4 col-form-label">Consultatie</label> 
                            <div class="col-8">
                                <input id="price" name="price"  value="<?php echo htmlentities($consultatie)?>" class="form-control here" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-4 col-form-label">Telefon</label> 
                            <div class="col-8">
                                <input id="phone" name="phone" value="<?php echo htmlentities($telefon)?>" class="form-control here" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-4 col-form-label">Email</label> 
                            <div class="col-8">
                                <input id="email" name="email" value="<?php echo htmlentities($email)?>" class="form-control here" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="submit" type="submit" class="btn btn-dark">Actualizeaza</button>
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
        