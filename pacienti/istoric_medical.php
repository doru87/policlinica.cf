<?php 
    global $conexiune;
    $query = mysqli_query($conexiune,"SELECT * FROM istoric_medical WHERE id_pacient='".$_SESSION["id"]."'");
      
    if(mysqli_affected_rows($conexiune) > 0){
        while($row = mysqli_fetch_array($query)){
            $inaltime = $row["inaltime"];
            $tensiune_arteriala = $row["tensiune_arteriala"];
            $glicemie = $row["glicemie"];
        }   
    }
?>

<div class="col-lg-6 define-margin">
    <div class="card">
        <div class="card-header">
            <h4>Istoric medical</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="istoric_medical">
                        <div class="container">
                            <div class="row">
                                <form role="form" class="form_istoric_medical" name="add" method="post">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label for="height" class="col-4 col-form-label">Inaltime</label> 
                                            <input id="height" name="height" class="form-control here" value="<?php echo htmlentities($inaltime)?>" required="required" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label for="bloodpressure" class="col-4 col-form-label">Tensiune arteriala</label> 
                                            <input id="bloodpressure" name="bloodpressure" class="form-control here" value="<?php echo htmlentities($tensiune_arteriala)?>" required="required" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label for="bloodsugare" class="col-4 col-form-label">Glicemie</label> 
                                            <input id="bloodsugare" name="bloodsugare" class="form-control here" value="<?php echo htmlentities($glicemie)?>" required="required" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="select" class="col-4 col-form-label">Diagnostic</label> 
                                        <div class="col-lg-12">
                                            <select id="diagnostic" name="diagnostic" onChange="getDiagnostic(this.value);" class="custom-select">
                                                <option value="">Selectare diagnostic</option>
                                                <?php 
                                                lista_diagnostice();
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group column">
                                        <label for="tratament" class="col-4 col-form-label">Tratament</label>
                                        <div class="col-8">
                                            <textarea class="form-control" name="tratament" id="tratament" rows="4"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function getDiagnostic(val) {
	$.ajax({
        type: "POST",
        url: "include/functii.php",
        data:{diagnostic:val},
        success: function(data){
            $('#tratament').html(data)
        }
	});
}

</script>