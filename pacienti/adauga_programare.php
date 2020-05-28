<?php
if(isset($_POST["submit"])){
    global $conexiune;
    
    $status_pacient = 1;
    $status_doctor = 1;
    
    $result = mysqli_query($conexiune,"INSERT INTO programari(specializare,id_doctor,id_pacient,consultatie,data_programare,ora_programare,status_pacient,status_doctor) 
    VALUES ('".$_POST["specialization"]."','".$_POST["doctor"]."','".$_SESSION['id']."','".$_POST["cost_consultation"]."','".$_POST["appointment_date"]."','".$_POST["appointment_time"]."', '$status_pacient', '$status_doctor')");

    if($result) {
        echo "<script>alert('Programarea dumneavoatra a fost realizata cu succes!')</script>";
    }
    if(!$result) {
        echo("Error description: " . mysqli_error($conexiune));
    }

}
?>

<div class="col-lg-6 define-margin">
    <div class="card">
        <div class="card-header">
            <h4>Adauga programare</h4>
            <?php if(isset($mesaj)) {echo $mesaj; }?>
        </div>
        <div class="card-body">
  
            <div class="row">
                <div class="col-md-12">
          
                   	<form role="form" name="edit" method="post">

                       <div class="form-group row">
                            <label for="select" class="col-4 col-form-label">Specializare doctor</label> 
                            <div class="col-8">
                                <select id="specialization" name="specialization" onChange="getDoctor(this.value);" class="custom-select">
                                    <option value="">Selectare specializare</option>
                                   <?php lista_specializari();?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="select" class="col-4 col-form-label">Doctori</label> 
                            <div class="col-8">
                                <select id="doctor" name="doctor" onChange="getCost(this.value);" class="custom-select">
                                <option selected="selected">Selectare doctor</option>
                                
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="select" class="col-4 col-form-label">Pret consultatie</label> 
                            <div class="col-8">
                                <select id="cost_consultation" name="cost_consultation" class="custom-select">
                               
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">Data programarii</label> 
                            <div class="col-8">
                                <input class="form-control datepicker" name="appointment_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">Ora programarii</label> 
                            <div class="col-8">
                                <input class="form-control datetimepicker" name="appointment_time">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="submit" type="submit" class="btn btn-primary">Trimite cerere</button>
                            </div>
                        </div>
                     
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">

function getDoctor(val) {
	$.ajax({
        type: "POST",
        url: "include/functii.php",
        data:{specializare:val},
        success: function(data){
            $("#doctor").html(data);
        }
	});
}

function getCost(val) {
	$.ajax({
        type: "POST",
        url: "include/functii.php",
        data:{doctor:val},
        success: function(data){
            $("#cost_consultation").html(data);
        }
	});
}
$('.datepicker').datepicker();

$('.datetimepicker').datetimepicker({
    format: 'LT'
});

</script>