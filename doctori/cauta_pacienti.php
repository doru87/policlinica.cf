<div class="container define-margin">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-8">
            <h2 style="text-align: center;">Cauta pacient dupa nume</h2>
            <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon">Cauta</span>
                <input type="text" name="search_text" id="search_text" class="form-control" />
                </div>
            </div>
        </div>
    </div>
   
   <div id="cauta_pacient" class="define-margin">

   </div>

</div>
<script>
$(document).ready(function(){

    function cauta_pacient(nume) {
        $.ajax({
            url:"include/functii.php",
            method:"POST",
            data:{nume:nume},
            success:function(data) {
            $('#cauta_pacient').html(data);
        }
        });
    }
    $('#search_text').keyup(function(){
        var text_cautat = $(this).val();
            if(text_cautat != ''){
                cauta_pacient(text_cautat);
            }else {
                window.location.reload();
            }

    });
    
    });

</script>
