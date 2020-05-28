<div class="col-sm-8 col-md-8 col-lg-12">
<table class="table table-striped w-auto define-margin">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Doctor</th>
      <th scope="col">Specializare</th>
      <th scope="col">Pret consultatie</th>
      <th scope="col">Data programare</th>
      <th scope="col">Ora programare</th>
      <th scope="col">Data si ora postarii programarii</th>
      <th scope="col">Status programare</th>
      <th scope="col">Actiune</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    istoric_programari();
    ?>
  </tbody>
</table>
</div>

<script type="text/javascript">

function anuleazaProgramarea(val) {
	$.ajax({
    type: "POST",
    url: "include/functii.php",
    data:{id_comanda:val},
    success: function(data){
      window.location.reload();
    }
	});
}
</script>

