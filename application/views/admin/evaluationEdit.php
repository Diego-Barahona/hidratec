<div class="table-responsive tab-pane fade show active " id="evaluacion" >
      <div role="alert" id="alert_evaluation">
          <strong id="title_alert"></strong>
        </div>
      <div id="accordion">
      <div id="evaluation_info" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
    <form>
        <div class="row mb-2">
              <div class="col-md-4 mb-3">
                  <label for="actividad">Número de OT</label>
                  <div class="input-group" id='frm_ot_number'>
                      <input type="text" class="form-control" name="id_ot" id="id_ot" value='<?= $number_ot ?>' readonly>
                      <div class="invalid-feedback"></div>
                  </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="actividad">Fecha de evaluación</label>
                  <div class="input-group" id='frm_date_admission'>
                      <input type="text" class="form-control" name="date_evaluation" id="date_evaluation">
                      <div class="invalid-feedback"></div>
                  </div>
              </div>
          </div>
          <div class="row mb-2">
              <div class="col-md-6 mb-3">
                  <label for="actividad">Descripción</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" rows="2" name="description_ev" id="description_ev" placeholder="" aria-describedby="inputGroupPrepend3" ></textarea>
                        <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una descripción porfavor.
                        </div>
                      </div>
              </div>  
              <div class="col-md-6 mb-3">
                  <label for="actividad">Notas</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" rows="2" name="notes" id="notes" placeholder="" aria-describedby="inputGroupPrepend3" ></textarea>
                        <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una descripción porfavor.
                        </div>
                  </div>
              </div>  
          </div>

          <div class="row mb-2">
               <div class="col-md-4 mb-3">
               <label>Asignar técnico para la evaluación</label>
                <select class="form-select form-control" id="technical" name="technical" >
                <option></option>
              </select>
                <div class="invalid-feedback"></div>
              </div> 
          </div>

          <div class="form-group float-right">
            <button type="button" style="height:40px; width:120px "id="btn_edit" class="btn btn-primary">Edit</button>
         </div>
          </form>
   </div><!-- card body end-->
      
    </div> <!-- card body end-->
    </div><!-- acordion-->
    </div> <!-- End content Evaluation-->

    <script src="<?php echo base_url(); ?>assets/js_admin/evaluation.js"></script>
    <script>
  
  $( function() {
    $( "#date_evaluation" ).datepicker({
       showOn: "button",
      
      buttonText: "Calendario",
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
    });
  } );
  </script>

