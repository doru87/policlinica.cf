<?php
include('configurare.php');

function afisare_pacienti(){
    global $conexiune;

    $result = mysqli_query($conexiune,"SELECT * FROM pacienti WHERE id_doctor='".$_SESSION['doctor_id']."'");
    
    while($row = mysqli_fetch_array($result)){
        $id = $row["id"];
        $nume = $row["nume"];
        $telefon = $row["telefon"];
        $sex = $row["sex"];
        $data_inregistrare = $row["data_inregistrare"];
        $data_actualizare = $row["data_actualizare"];
        $card_identitate = $row["card_identitate"];
    
        $afisare = "
        <tr>
            <th scope='row'>$id</th>
            <td>$nume</td>
            <td>$telefon</td>
            <td>$sex</td>
            <td>$data_inregistrare</td>
            <td>$data_actualizare</td>
            <td><a href='?tab=$id'><i class='fas fa-user-edit'></i></a> | <a href='' onClick='stergePacient($id)'><i class='fas fa-trash'></i></a>| <a href='reteta_medicala.php?id=$id'><i class='fas fa-file-medical'></i></a></td>
        </tr>";
    

    echo $afisare;
    }
    
}

             
class Status {
    function getStatus($result){
        $status = $result["status_pacient"] == 1 && $result["status_doctor"] == 1  ? "Activ": ($result["status_pacient"] == 0 && $result["status_doctor"] == 1  ? "Anulata de pacient":($result["status_pacient"] == 1 && $result["status_doctor"] == 0  ? "Anulata de tine":"")); 
        return $status;
    }
}

function istoric_programari() {
    global $conexiune;

    $result = mysqli_query($conexiune,"SELECT * FROM programari WHERE id_doctor='".$_SESSION['doctor_id']."'");
    while($res = mysqli_fetch_array($result)){
        $query = mysqli_query($conexiune,"SELECT * FROM pacienti WHERE id='".$res["id_pacient"]."'");
            while($row = mysqli_fetch_array($query)){
                $nume_pacient = $row["nume"];
            }

            $status = new Status();
            $istoric = "
            <tr>
                <th scope='row'>{$res["id"]}</th>
                <td>{$nume_pacient}</td>
                <td>{$res["specializare"]}</td>
                <td>{$res["consultatie"]}</td>
                <td>{$res["data_programare"]}</td>
                <td>{$res["ora_programare"]}</td>
                <td>{$res["data_postare"]}</td>
                <td>{$status->getStatus($res)}</td>
                <td><button class='btn btn-danger' onClick='anuleazaProgramarea({$res["id"]})'>Anuleaza</button></td>
            </tr>
        ";
      
        echo $istoric;
   
    }
    if(!$result) {
        print("Error description: " . mysqli_error($conexiune));
    }
}

if(isset($_POST["id_programare"])){
    $result = mysqli_query($conexiune,"UPDATE programari SET status_doctor=0 WHERE id='".$_POST["id_programare"]."'");
}

if(isset($_POST['cnp'])){
    global $conexiune;
    $query = mysqli_query($conexiune,"SELECT * FROM pacienti WHERE card_identitate LIKE '%".$_POST['cnp']."%'");
    while($row = mysqli_fetch_array($query)){
        $pacient_informatii = '
        <div class="istoric_medical">
            <div class="container body-color">
                <div class="row">

                    <div class="form-group">
                        <div class="col-12">
                            <label for="name">Nume:</label>
                            <input type="text" class="form-control" id="name" value="'.$row["nume"].'">
                        </div>
                    </div>
            
                    <div class="form-group">
                        <div class="col-12">
                            <label for="identitycardnumber">Card identitate:</label>
                            <input type="text" class="form-control" id="identitycardnumber" value="'.$row["card_identitate"].'">
                        </div>
                    </div>
            
                    <div class="form-group">
                        <div class="col-12">
                            <label for="address">Adresa:</label>
                            <input type="text" class="form-control" id="address" value="'.$row["adresa"].'">
                        </div>
                    </div>
            
                    <div class="form-group">
                        <div class="col-12">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" value="'.$row["email"].'">
                        </div>
                    </div>
            
                    <div class="form-group">
                        <div class="col-12">
                            <label for="phone">Telefon:</label>
                            <input type="text" class="form-control" id="phone" value="'.$row["telefon"].'">
                        </div>
                    </div>
            
                    <div class="form-group">
                        <div class="col-12">
                            <div class="checkbox">
                                <label><input type="checkbox" onClick="adauga_istoric(this.value)" value="'.$row["id"].'"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        echo $pacient_informatii;
    }

}

class dezactiveaza {
    function dezactiveazaButton($row){
        $button = empty($row["inaltime"]) && empty($row["tensiune_arteriala"]) && empty($row["glicemie"]) && empty($row["alergii"]) && empty($row["boli_cronice"]) ? "" : "disabled";
          return $button;
      }
}

if(isset($_POST["id"])){

    global $conexiune;
    $query = mysqli_query($conexiune,"SELECT * FROM istoric_medical WHERE id_pacient='".$_POST["id"]."' ");
    if(mysqli_affected_rows($conexiune) > 0){
            
        while($row = mysqli_fetch_array($query)){
            $inaltime = $row["inaltime"];
            $tensiune_arteriala = $row["tensiune_arteriala"];
            $glicemie = $row["glicemie"];
            $alergii = $row["alergii"]; 
            $boli_cronice = $row["boli_cronice"]; 

            $dezactiveaza = new dezactiveaza();

    echo '
    <div class="istoric_medical">
        <div class="container">
            <div class="row">
                <form role="form" class="form_istoric_medical" name="add" method="post">
                
                    <div class="form-group">
                        <div class="col-12">
                            <label for="height" class="col-4 col-form-label">Inaltime</label> 
                            <input id="height" name="height" class="form-control here" value="'.htmlentities($inaltime).'" required="required" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label for="bloodpressure" class="col-4 col-form-label">Tensiune arteriala</label> 
                            <input id="bloodpressure" name="bloodpressure" class="form-control here" value="'.htmlentities($tensiune_arteriala).'" required="required" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label for="bloodsugare" class="col-4 col-form-label">Glicemie</label> 
                            <input id="bloodsugare" name="bloodsugare" class="form-control here" value="'.htmlentities($glicemie).'" required="required" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                    <div class="col-12">
                        <label for="allergies" class="col-4 col-form-label">Alergii</label> 
                        <input id="allergies" name="allergies" value="'.htmlentities($alergii).'" class="form-control here" required="required" type="text">
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-12">
                            <label for="chronic_diseases" class="col-4 col-form-label">Boli Cronice</label>     
                            <input id="chronic_diseases" name="chronic_diseases" value="'.htmlentities($boli_cronice).'" class="form-control here" required="required" type="text">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-12">
                            <button name="submit" type="submit" id="istoricmedical" class="btn btn-primary" '.$dezactiveaza->dezactiveazaButton($row).'>Adaugare</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    ';
}
}else {
    echo '
    <div class="istoric_medical">
        <div class="container">
            <div class="row">
                <form role="form" class="form_istoric_medical" name="add" method="post">
                
                    <div class="form-group">
                        <div class="col-12">
                            <label for="height" class="col-4 col-form-label">Inaltime</label> 
                            <input id="height" name="height" class="form-control here" value="" required="required" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label for="bloodpressure" class="col-4 col-form-label">Tensiune arteriala</label> 
                            <input id="bloodpressure" name="bloodpressure" class="form-control here" value="" required="required" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label for="bloodsugare" class="col-4 col-form-label">Glicemie</label> 
                            <input id="bloodsugare" name="bloodsugare" class="form-control here" value="" required="required" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                    <div class="col-12">
                        <label for="allergies" class="col-4 col-form-label">Alergii</label> 
                        <input id="allergies" name="allergies" value="" class="form-control here" required="required" type="text">
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-12">
                            <label for="chronic_diseases" class="col-4 col-form-label">Boli Cronice</label>     
                            <input id="chronic_diseases" name="chronic_diseases" value="" class="form-control here" required="required" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <button name="submit" type="submit" id="istoricmedical" class="btn btn-primary">Adaugare</button>
                            <input type="hidden" name="pacient_id" value="'.$_POST["id"].'" />
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    ';
}

}

if(isset($_POST["id_pacient"])){
    global $conexiune;
    $query = mysqli_query($conexiune,"DELETE FROM pacienti WHERE id='".$_POST["id_pacient"]."'");
}

function istoric_tratamente() {
    global $conexiune;

    $result = mysqli_query($conexiune,"SELECT * FROM diagnostic_tratament WHERE id_pacient='".$_GET["id"]."' AND id_doctor='".$_SESSION['doctor_id']."'");
    while($res = mysqli_fetch_array($result)){
        $time=strtotime($res["data_inregistrare"]);
        $timp = date("d-m-Y",$time);
        
            $istoric = "
            <tr>
                <th scope='row'>{$res["id"]}</th>
                <td>
                    <div class='custom-control custom-checkbox'>
                        <input type='checkbox' class='custom-control-input' id='tratament_selectat".$res['id']."'>
                        <label class='custom-control-label' for='tratament_selectat".$res['id']."'></label>
                    </div>
                </td>
                <td id='diagnostic'>{$res["diagnostic"]}</td>
                <td id='tratament'>{$res["tratament"]}</td>
                <td>{$res["data_inregistrare"]}</td>
                <input type='hidden' name='data' id='data_inregistrare' value={$timp} />
            </tr>
        ";
      
        echo $istoric;
        
    }
    if(!$result) {
        print("Error description: " . mysqli_error($conexiune));
    }
}


if(isset($_POST['nume'])){
    global $conexiune;
    $query = mysqli_query($conexiune,"SELECT * FROM pacienti WHERE nume LIKE '%".$_POST['nume']."%'");
    while($row = mysqli_fetch_array($query)){
        $pacient_informatii = '
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="well well-sm">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <a href="dashboard.php?tab='.$row["id"].'">
                                        <img src="'.$row["poza"].'" alt="" class="img-rounded img-responsive" />
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4>'.$row["nume"].'</h4>
                                    <small><cite><i class="fas fa-map-marker-alt fa-lg"></i> '.$row["adresa"].'</cite></small>
                                    <p>
                                        <i class="fas fa-at fa-lg"></i> '.$row["email"].'
                                        <br />
                                        <i class="fas fa-user-circle fa-lg"></i> <a href="dashboard.php?tab='.$row["id"].'">Editare detalii</a>
                                        <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

        echo $pacient_informatii;
    }

}

?>
