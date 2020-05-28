<?php 
    global $conexiune;
    $doctor_id = $_SESSION['doctor_id'];
  
  if(isset($_POST['submit_parola'])){

      $parola_veche = mysqli_real_escape_string($conexiune,$_POST['parola_veche']);
      $parola_noua = mysqli_real_escape_string($conexiune,$_POST['parola_noua']);
      $parola_confirmata = mysqli_real_escape_string($conexiune,$_POST['confirma_parola_noua']);
      
      $query = "SELECT * FROM doctori WHERE id='$doctor_id'";
      $result = mysqli_query($conexiune, $query);
      
      $mesaj="";

          while($row = mysqli_fetch_array($result)){
              $parola_doctor = $row['parola'];

              if($parola_noua == $parola_confirmata && $parola_veche==$parola_doctor){
                  $query = "UPDATE doctori SET parola=$parola_noua WHERE id=$doctor_id";
                  $result = mysqli_query($conexiune, $query);
                  
                  if ($result){
                      if (mysqli_affected_rows($conexiune)>0){
                          $mesaj = "Parola a fost schimbata.";
                      }
                  }
              }else if($parola_noua != $parola_confirmata && $parola_veche==$parola_doctor) {
                  $mesaj="Parolele introduse nu sunt identice.";
              }else if($parola_noua == $parola_confirmata && $parola_veche!=$parola_doctor){
                $mesaj="Parola veche introdusa nu este corecta.";
              }else if($parola_noua != $parola_confirmata && $parola_veche!=$parola_doctor){
                $mesaj="Parola veche introdusa nu este corecta iar parola noi nu sunt identice.";
              }
              
          }
      
  }

?>
<div class="change-password define-margin">
        <div class="card-header">
            <h2>Schimba parola</h2>
            <?php if(isset($mesaj)) {echo $mesaj; }?>
        </div>
        <form action="" method="post">
            <div class="card-body body-color">
                <div class="form-group">
                    <label for="parola_veche">Parola curenta</label>
                    <input type="password" id="parola_veche" name="parola_veche" class="form-control">
                </div>
                <div class="form-group">
                    <label for="parola_noua">Parola Noua</label>
                    <input type="password" id="parola_noua" name="parola_noua" class="form-control">
                    <span class="form-text small text-muted">Parola trebuie sa aiba 4-10 caractere, si nu <em>trebuie</em> sa contina spatii goale.
                    </span>
                </div>
                <div class="form-group">
                    <label for="confirma_parola_noua">Introduce din nou parola</label>
                    <input type="password" id="confirma_parola_noua" name="confirma_parola_noua" class="form-control">
                    <span class="form-text small text-muted">Pentru confirmare,introduce din nou parola.
                    </span>
                </div>
                <div class="form-group">
                <button name="submit_parola" type="submit" class="btn btn-dark">Schimba parola</button>
                </div>
            </div>
        </form>
</div>