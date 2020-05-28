<?php
include('configurare.php');

function lista_specializari(){
    global $conexiune;
    $result = mysqli_query($conexiune,"SELECT * FROM cabinete");
    while($row = mysqli_fetch_array($result)){
        $specializari = <<<EOT
        <option value="{$row["specializare"]}">{$row["specializare"]}</option> 
EOT;

        echo $specializari;
    }
}

if(isset($_POST["specializare"])){
    global $conexiune;
    $result = mysqli_query($conexiune,"SELECT id,nume FROM doctori WHERE specializare='".$_POST["specializare"]."'");
    
    while($row = mysqli_fetch_array($result)){
        $doctori = <<<EOT
        <option selected="selected">Selectare doctor</option>
        <option value="{$row["id"]}">{$row["nume"]}</option> 
EOT;
        echo $doctori;

    }

    if(!$result) {
        echo("Error description: " . mysqli_error($conexiune));
    }
} 

if(isset($_POST["doctor"])){
    global $conexiune;
    $result = mysqli_query($conexiune,"SELECT consultatie FROM doctori WHERE id='".$_POST["doctor"]."'");
    
    while($row = mysqli_fetch_array($result)){
        $pret_consultatie = <<<EOT
        <option value="{$row["consultatie"]}">{$row["consultatie"]}</option> 
EOT;
        echo $pret_consultatie;

    }

    if(!$result) {
        echo("Error description: " . mysqli_error($conexiune));
    }
}

class Status {

    function getStatus($result){
        $status = $result["status_pacient"] == 1 && $result["status_doctor"] == 1  ? "Activ": ($result["status_pacient"] == 0 && $result["status_doctor"] == 1  ? "Anulat de tine":($result["status_pacient"] == 1 && $result["status_doctor"] == 0  ? "Anulat de doctor":"")); 
        return $status;
    }
}

function istoric_programari(){
    global $conexiune;

    $result = mysqli_query($conexiune,"SELECT * FROM programari WHERE id_pacient='".$_SESSION["id"]."'");
    while($res = mysqli_fetch_array($result)){
        $query = mysqli_query($conexiune,"SELECT * FROM doctori WHERE id='".$res["id_doctor"]."'");
            while($row = mysqli_fetch_array($query)){
                $nume_doctor = $row["nume"];
            }

            $status = new Status();
            $istoric = "
            <tr>
                <th scope='row'>{$res["id"]}</th>
                <td>{$nume_doctor}</td>
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
        echo("Error description: " . mysqli_error($conexiune));
    }
}

if(isset($_POST["id_comanda"])){
    $result = mysqli_query($conexiune,"UPDATE programari SET status_pacient=0 WHERE id='".$_POST["id_comanda"]."'");
}

function lista_diagnostice(){
    global $conexiune;
    $result = mysqli_query($conexiune,"SELECT * FROM diagnostic_tratament WHERE id_pacient='".$_SESSION["id"]."'");
    while($row = mysqli_fetch_array($result)){
        $specializari = <<<EOT
        <option value="{$row["diagnostic"]}">{$row["diagnostic"]}</option> 
EOT;

        echo $specializari;
    }
}

if(isset($_POST["diagnostic"])){
    global $conexiune;
    $result = mysqli_query($conexiune,"SELECT * FROM diagnostic_tratament WHERE diagnostic='".$_POST["diagnostic"]."'");
    
    while($row = mysqli_fetch_array($result)){
        $tratament = $row["tratament"];
        echo $tratament;
    }

    if(!$result) {
        echo("Error description: " . mysqli_error($conexiune));
    }
}
?>