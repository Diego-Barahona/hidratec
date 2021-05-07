<div class="table-responsive tab-pane fade  " id="aprobation" >
      <div role="alert" id="alert_aprobation">
          <strong id="title_alert_ap"></strong>
        </div>
      <div id="accordion">
      <div id="aprobation_info" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-header" >
      <button class="btn btn-link" data-toggle="collapse" data-target="#ap1" aria-expanded="true" aria-controls="technicalReportGeneral">
                <i class="fas fa-table"></i>
                Aprobacion de cotización
                </button>
              
         </div>
        <div class="card-body collapse in " id= "ap1">

        
        <input type="hidden" class="form-control" id="user_modify_ap" name="id" >
        <input type="hidden" class="form-control" id="date_modify_ap" name="id" >
        <input type="hidden" class="form-control" id="user_approve_ap" name="id" >
        <input type="hidden" class="form-control" id="date_approve_ap" name="id" >
        <input type="hidden" class="form-control" id="date_send_email" name="id" >

        <div class="row mb-2 mr-2 justify-content-end">
        <a  id="ap_popover" data-toggle="popover" data-placement="left"><i class=" fas fa-info-circle fa-lg"></i></a>  

        </div>
        
        <div class="row mb-2 ">

                 
                 <div class="col-md-3 mb-3">
                  <label for="actividad">Fecha de Aprobación de cotización</label>
                  <div class="input-group" id='frm_date_admission'>
                      <input type="text" class="form-control"style="background:white" name="date_ap" id="date_ap" disabled>
                      <div class="invalid-feedback"></div>
                  </div>
                 </div>
                 <div class="col-md-3 mb-3 ml-5">
                      <div class="form-check">
                                <input class="form-check-input"  type="checkbox" value="" id="approve_client" disabled>
                                <label class="form-check-label"  for="approve_client">
                                 Aprobación cliente
                               </label>
                             </div>
                     </div>
          </div>

          <div class="row mb-2 mr-2 mb-5 justify-content-end">
                      <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="hab_edit_ap">
                                <label class="form-check-label" for="hab_edit_ap">
                                 Activar edición 
                               </label>
                             </div>
          </div>
   
          <div class="row mb-2 mr-2 justify-content-end">
                <button type="button" style="height:40px; width:100px; "id="btn_aprobation" class="btn btn-primary  ">Guardar</button>
          </div>
          </div>  <!-- End card body information-->
           <!-- Table medidas-->
        
           
   
   <div class="card-header">
   <button class="btn btn-link" data-toggle="collapse" data-target="#ap2" aria-expanded="true" aria-controls="technicalReportGeneral">
                <i class="fas fa-table"></i>
                 Orden de compra 
                </button>
   </div>
   
   <div class="card-body collapse in " id= "ap2">
           <div class="row mb-2 " id ="input_oc">
                <div class="col-md-3 mb-3 ">
                 
                <form id="ocs">
                <input type="file"  name="oc" id="oc" data-preview-file-type="any" accept="application/pdf" aria-describedby="inputGroupPrepend3">
                </form>
                 </div>
                <div class="col-md-3 mb-3 offset-2">
                 
                        <button class="btn btn-success " type='button' data-toggle="modal"  id="upload_oc"><i class="fas fa-file-upload"></i> Subir</button>
               </div>
          </div>

   <div id="actions_oc">
      
          <label for="actividad">¿Qué acciones desea realizar sobre el archivo? </label> 
          <div class="row mb-4 ">
                 
                <div class="col-md-2 mb-3 ">
                      <button class="btn btn-primary " type='button' data-toggle="modal"  id="show_oc"><i class="fas fa-file-upload"></i> Ver</button>
                </div>
                <div class="col-md-2 mb-3  mr-5 ">
                      <button class="btn btn-danger " type='button' data-toggle="modal"  id="delete_oc"><i class="fas fa-file-upload"></i> Eliminar</button>
               </div>
          </div>
        
         </div> <!-- End card body archivos-->
        </div> 
       </div>
      </div> <!-- End content Evaluation-->
    </div>
   
<script src="<?php echo base_url(); ?>assets/js_admin/aprobation.js"></script>
<script src="<?php echo base_url(); ?>assets/js_admin/order_c.js"></script>

