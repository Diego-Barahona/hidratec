<div class="table-responsive tab-pane fade  " id="hidraulicTest" >
      <div role="alert" id="alert_hidraulicTest">
          <strong id="title_alert_h"></strong>
        </div>
      <div id="accordion">
      <div id="hidraulic_info" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
    <form>
        <div class="row mb-2">
              
              <div class="col-md-4 mb-3">
                  <label for="actividad">Fecha de prueba hidraulica</label>
                  <div class="input-group" id='frm_date_admission'>
                      <input type="text" class="form-control" name="date_ht" id="date_ht">
                      <div class="invalid-feedback"></div>
                  </div>
              </div>
          </div>
          <div class="row mb-2">
              <div class="col-md-6 mb-3">
                  <label for="actividad">Descripción</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" rows="2" name="description_ht" id="description_ht" placeholder="" aria-describedby="inputGroupPrepend3" ></textarea>
                        <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una descripción porfavor.
                        </div>
                      </div>
              </div>  
              <div class="col-md-6 mb-3">
                  <label for="actividad">Notas</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" rows="2" name="notes_ht" id="notes_ht" placeholder="" aria-describedby="inputGroupPrepend3" ></textarea>
                        <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una descripción porfavor.
                        </div>
                  </div>
              </div>  
          </div>

          <div class="row mb-2">
               <div class="col-md-4 mb-3">
               <label>Asignar técnico para prueba Hidráulica</label>
                <select class="form-select form-control" id="technical_ht" name="technical_ht" >
                <option></option>
              </select>
                <div class="invalid-feedback"></div>
              </div> 
          </div>

          <div class="form-group float-right">
            <button type="button" style="height:40px; width:120px "id="btn_hidraulic" class="btn btn-primary">Edit</button>
         </div>
          </form>
   </div>
      
    </div> 
    </div>
    </div> <!-- End content Evaluation-->

    
    