<table class="table table-striped define-margin">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nume</th>
      <th scope="col">Telefon</th>
      <th scope="col">Sex</th>
      <th scope="col">Data si ora crearii</th>
      <th scope="col">Data actualizarii</th>
      <th scope="col">Actiune</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    afisare_pacienti();
    ?>
  </tbody>
</table>

<script type="text/javascript">

function stergePacient(val) {
	$.ajax({
    type: "POST",
    url: "include/functii.php",
    data:{id_pacient:val},
    success: function(data){
      window.location.reload();
    }
	});
}
</script>