
<!-- formulario de vista de evaluación para superadmin -->

<div class="table-responsive tab-pane fade show active " id="evaluacion" >
      <div role="alert" id="alert_evaluation">
          <strong id="title_alert"></strong>
        </div>
      <div id="accordion">
      <div id="evaluation_info" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
        <div class="row mb-2">
              <div class="col-md-4 mb-3">
                  <label for="actividad">Fecha de reporte técnico</label>
                  <div class="input-group" id='frm_date_admission'>
                      <input type="text" class="form-control" name="date_evaluation" id="date_evaluation"  readonly>
                      <div class="invalid-feedback"></div>
                  </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="actividad">Técnico asignado para evaluación</label>
                  <div class="input-group" id='frm_priority'>
                      <input type="text" class="form-control" name="technical" id="technical"  readonly>
                      <div class="invalid-feedback"></div>
                  </div>
              </div> 
              
              <div class="col-md-2 mb-3">
                  <label class="form-check-label" for="check_adm">Aprobación Técnico</label>
                  <div class="input-group" id='frm_check_technical'>
                    <input type="checkbox" class="form-check-input" id="check_technical">
                  </div>
              </div> 
              <div class="col-md-2 mb-3">
                  <label class="form-check-label" for="check_adm">Aprobación Administración</label>
                  <br>
                  <input style='text-align: center;' type="checkbox" class="form-check-input" id="check_adm">
              </div> 
          </div>
          <div class="row mb-2">
              <div class="col-md-6 mb-3">
                  <label for="actividad">Descripción</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" rows="2" name="description_ev" id="description_ev" placeholder="" aria-describedby="inputGroupPrepend3" readonly></textarea>
                        <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una descripción porfavor.
                        </div>
                      </div>
              </div>  
              <div class="col-md-6 mb-3">
                  <label for="actividad">Notas</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" rows="2" name="notes" id="notes" placeholder="" aria-describedby="inputGroupPrepend3" readonly></textarea>
                        <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una descripción porfavor.
                        </div>
                  </div>
              </div>  
          </div>

          <div class="row mb-2">
          <div class="col-md-6 mb-3">
                  <label for="actividad">Conclusiones</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" rows="2" name="conclution" id="conclution" placeholder="" aria-describedby="inputGroupPrepend3" readonly></textarea>
                        <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una descripción porfavor.
                        </div>
                      </div>
              </div>  
              <div class="col-md-6 mb-3">
                  <label for="actividad">Recomendaciones</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" rows="2" name="recommendation" id="recommendation" placeholder="" aria-describedby="inputGroupPrepend3" readonly></textarea>
                        <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una descripción porfavor.
                        </div>
                  </div>
              </div>  
          </div>
   </div>
      
    </div> 
    </div>
    </div> <!-- End content Evaluation-->
    <script src="<?php echo base_url(); ?>assets/js_admin/technicalReport.js"></script>