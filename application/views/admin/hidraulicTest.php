<div class="table-responsive tab-pane fade  " id="hidraulicTest" >
      <div role="alert" id="alert_hydraulicTest">
          <strong id="title_alert_ht"></strong>
        </div>
      <div id="accordion">
      <div id="hydraulic_info" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-header" data-toggle="collapse" data-target="#c1">
              <i class="fas fa-table"></i>
                Información 
         </div>
        <div class="card-body collapse in " id= "c1">
        
        <div class="row mb-2 ">
                <div class="col-md-3 mb-3 ">
                 
                      <div class="form-check">
                                <input class="form-check-input"  type="checkbox" value="" id="approve_admin_ht" disabled>
                                <label class="form-check-label"  for="approve_admin_ht">
                                 Aprobado por administración
                               </label>
                             </div>
                          </div>
                <div class="col-md-3 mb-3 ">
                 
                      <div class="form-check">
                           <input class="form-check-input"  type="checkbox" value="" id="approve_technical_ht" disabled>
                           <label class="form-check-label"  for="approve_technical_ht">
                            Aprobado por técnico master
                          </label>
                        </div>
                     </div>
          </div>
   
    <div class="row mb-2">
              
              <div class="col-md-6 mb-3">
                  <label for="actividad">Cliente</label>
                  <div class="input-group" id='frm_date_admission'>
                      <input type="text" class="form-control" style="background:white" name="enterprise_ht" id="enterprise_ht" value='<?= $enterprise ?>' disabled >
                      <div class="invalid-feedback"></div>
                  </div>
              </div>

              <div class="col-md-6 mb-3">
                  <label for="actividad">Componente</label>
                  <div class="input-group" id='frm_date_admission'>
                      <input type="text" class="form-control" style="background:white" name="component_ht" id="component_ht" value='<?= $component ?>' disabled>
                      <div class="invalid-feedback"></div>
                  </div>
              </div> 
          </div>

        <div class="row mb-2">
              
              <div class="col-md-6 mb-3">
                  <label for="actividad">Fecha de prueba hidráulica</label>
                  <div class="input-group" id='frm_date_admission'>
                      <input type="text" class="form-control"style="background:white" name="date_ht" id="date_ht" disabled>
                      <div class="invalid-feedback"></div>
                  </div>
              </div>
             
              <div class="col-md-6 mb-3">
               <label>Asignar técnico para prueba hidráulica</label>
                <select class="form-select form-control" style="background:white" id="technical_ht" name="technical_ht" disabled>
                <option></option>
              </select>
                <div class="invalid-feedback"></div>
              </div>  
          </div>
          <div class="row mb-2">
              
              <div class="col-md-6 mb-3">
                  <label for="actividad">Notas</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" rows="2" style="background:white" name="notes_ht" id="notes_ht" placeholder="" aria-describedby="inputGroupPrepend3" disabled></textarea>
                        <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una descripción porfavor.
                        </div>
                  </div>
              </div>  
              <div class="col-md-6 mb-3">
                  <label for="actividad">Conclusiones</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" rows="2"style="background:white" name="conclusion_ht" id="conclusion_ht" placeholder="" aria-describedby="inputGroupPrepend3" disabled></textarea>
                        <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una descripción porfavor.
                        </div>
                      </div>
              </div> 
          </div>

          <div class="row mb-2 mr-2 mb-5 justify-content-end">
                      <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="hab_edit">
                                <label class="form-check-label" for="approve_ht">
                                 Activar edición 
                               </label>
                             </div>
          </div>
   
          <div class="row mb-2 mr-2 justify-content-end">
                <button type="button" style="height:40px; width:100px; "id="btn_hidraulic" class="btn btn-primary  ">Guardar</button>
          </div>
          </div>  <!-- End card body information-->
           <!-- Table medidas-->
           <div class="card-header" data-toggle="collapse" data-target="#c2">
              <i class="fas fa-table"></i>
                Mediciones 
         </div>
        
         <div class="card-body collapse in " id= "c2">


          <div class="row mb-2  justify-content-end">
                <div class="col-md-2 mb-2 ">
                <button class="btn btn-success offset-6 " type='button' data-toggle="modal"  id="btn_information"><i class="fas fa-plus"></i> Agregar</button>
               </div>
          </div>
         
          <table class="table table-bordered" id="table-ht" width="100%" cellspacing="0">
          <thead>
              <tr>
                <th>Dato</th>
                <th>Velocidad</th>
                <th>Presión</th>
                <th>Caudal</th>
                <th>Tiempo</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </tr>
            </thead>
           
          </table>
          <!-- Table medidas END -->
         
         
         </div> <!-- End card body medidas-->
  
   
   <div class="card-header" data-toggle="collapse" data-target="#c3">
              <i class="fas fa-table"></i>
                Archivos (PDF)
   </div>
   
   <div class="card-body collapse in " id= "c3">
           <div class="row mb-2 " id ="input_pdf">
                <div class="col-md-3 mb-3 ">
                 
                <form id="pdfs">
                <input type="file"  name="pdf" id="pdf" data-preview-file-type="any" accept="application/pdf" aria-describedby="inputGroupPrepend3">
                </form>
                 </div>
                <div class="col-md-3 mb-3 offset-2">
                 
                        <button class="btn btn-success " type='button' data-toggle="modal"  id="upload_pdf"><i class="fas fa-file-upload"></i> Subir</button>
               </div>
          </div>

   <div id="actions">
      
          <label for="actividad">¿Qué acciones desea realizar sobre el archivo? </label> 
          <div class="row mb-4 ">
                 
                <div class="col-md-2 mb-3 ">
                      <button class="btn btn-primary " type='button' data-toggle="modal"  id="show_pdf"><i class="fas fa-file-upload"></i> Ver</button>
                </div>
                <div class="col-md-2 mb-3  mr-5 ">
                      <button class="btn btn-danger " type='button' data-toggle="modal"  id="delete_pdf"><i class="fas fa-file-upload"></i> Eliminar</button>
               </div>
          </div>
          </div>
          </div>
     <div>

    </div> <!-- End card body archivos-->
    </div> 
    </div>
    </div> <!-- End content Evaluation-->
    </div>
   


  <div class="modal fade bd-example-modal-lg" id="medidas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-gradient-primary " >
               <h5 class="modal-title text-white " id="title_modal" >Agregar datos de medida</h5>
                <button type="button" class="close text-white"  data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
          </div>
          
          <div class="modal-body">
              <div id="accordion">
              <div id="hidraulic_info" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                 <div class="card-body">
                  
                    <div class="row mb-2">
              
                        <div class="col-md-4 mb-3">
                          <label for="actividad">Dato</label>
                           <div class="input-group" id='frm_date_admission'>
                             <input type="text" class="form-control" name="dato" id="dato">
                             <div class="invalid-feedback"></div>
                          </div>
                       </div>

                       <div class="col-md-4 mb-3">
                          <label for="actividad">Velocidad</label>
                           <div class="input-group" id='frm_date_admission'>
                             <input type="text" class="form-control" name="speed" id="speed">
                             <div class="invalid-feedback"></div>
                          </div>
                       </div>

                       <div class="col-md-4 mb-3">
                          <label for="actividad">Presión</label>
                           <div class="input-group" id='frm_date_admission'>
                             <input type="text" class="form-control" name="presion" id="presion">
                             <div class="invalid-feedback"></div>
                          </div>
                       </div>
                    </div>
                     
                   <div class="row mb-2">
              
                        <div class="col-md-4 mb-3">
                          <label for="actividad">Caudal</label>
                           <div class="input-group" id='frm_date_admission'>
                             <input type="text" class="form-control" name="caudal" id="caudal">
                             <div class="invalid-feedback"></div>
                          </div>
                       </div>
                  
                  
                         <div class="col-md-4 mb-3">
                          <label for="actividad">Temperatura</label>
                           <div class="input-group" id='frm_date_admission'>
                             <input type="text" class="form-control" name="time" id="time">
                             <div class="invalid-feedback"></div>
                          </div>
                       </div>
                  </div>
          </div>
          </div>
      
     
           <!-- Table medidas-->
          
          <!-- Table medidas END -->
          <div class="form-group float-right">
            <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" name ="edit_information" id="edit_information" class="btn btn-primary">Guardar</button>
            </div>
      
    </div>
       <!-- END modal -->     
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/js_admin/hidraulicTest.js"></script>
<script src="<?php echo base_url(); ?>assets/js_admin/file.js"></script>
<script>
  $( function() {
    $( "#date_ht").datepicker({
        showOn: "button",
        buttonText: "Calendario",
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        buttonImage: host_url + 'assets/img/about/calendario2.png',
    });
  } );
</script>