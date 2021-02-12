

<div class="conteiner">
    <label> Fecha recepcion comprobante  </label>
    <input type="text" id="calendario" >
</div>


<script>
  
  $( function() {
    $( "#calendario" ).datepicker({
      showOn: "button",
      buttonImageOnly: true,
      buttonText: "Select date",
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>

