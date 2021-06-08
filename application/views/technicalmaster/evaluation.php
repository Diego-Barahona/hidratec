
    <input type="hidden" class="form-control" id="ot_number" name="ot_number" value='<?= $id ?>' >
    <input type="hidden" class="form-control" id="id_ot" name="id_ot" value='<?= $id ?>' >
    <div id="content-wrapper">
    <div class="container-fluid mb-5" id="adminColors">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Evaluación</li>
            <li class="breadcrumb-item active">OT NÚMERO <?php echo $id; ?></li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
         </div>
        <div class="card-body">

        <div class="card-header" >
                 <button class="btn btn-link" data-toggle="collapse" data-target="#c2" aria-expanded="true" aria-controls="technicalReportGeneral">
                    <i class="fas fa-table"></i>
                    Evaluación
                   </button>
           </div>
         
        
         <div class="card-body collapse in " id= "c2">
          
 <!-- evaluation-->

 <form>
    
    <input type="hidden" class="form-control" id="record_path_pdf" name="id" >
    <input type="hidden" class="form-control" id="name_technical" name="name_technical" >
        <input type="hidden" class="form-control" id="user_create_ev" name="id" >
        <input  type="hidden"  class="form-control" id="date_create_ev" name="id" >
        <input  type="hidden"  class="form-control" id="user_modify_ev" name="id" >
        <input  type="hidden"  class="form-control" id="date_modify_ev" name="id" >
        <input type="hidden"  class="form-control" id="user_approve_ev" name="id" >
        <input  type="hidden"  class="form-control" id="date_approve_ev" name="id" >
        <input type="hidden" class="form-control" id="technical_id" name="technical_id" >
        <input type="hidden" class="form-control" id="priority_ev" name="priority_ev" >
     
       
    <div class="row mb-2 ">
               
                <div class="col-md-3 mb-3 ">
                 
                      <div class="form-check">
                           <input class="form-check-input"  style="background:white" type="checkbox" id="approve_technical_ev" disabled>
                           <label class="form-check-label"  for="approve_technical_ev">
                            Aprobado por técnico master
                          </label>
                        </div>
                     </div>

                 
        </div>
        <div class="row mb-2">
              
              <div class="col-md-4 mb-3">
                  <label for="actividad">Fecha de evaluación</label>
                  <div class="input-group" id='frm_date_admission'>
                      <input type="text" class="form-control"style="background:white"  name="date_evaluation" id="date_evaluation" disabled>
                      <div class="invalid-feedback"></div>
                  </div>
              </div>
          </div>
          <div class="row mb-2">
              <div class="col-md-6 mb-3">
                  <label for="actividad">Descripción</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" style="background:white" rows="2" name="description_ev" id="description_ev" placeholder="" aria-describedby="inputGroupPrepend3" disabled></textarea>
                        <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una descripción porfavor.
                        </div>
                      </div>
              </div>  
              <div class="col-md-6 mb-3">
                  <label for="actividad">Notas</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" style="background:white" rows="2" name="notes" id="notes" placeholder="" aria-describedby="inputGroupPrepend3" disabled></textarea>
                        <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una descripción porfavor.
                        </div>
                  </div>
              </div>  
          </div>
          
      

          <div class="row mb-2 mr-2 mb-5 justify-content-end">
                      <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="hab_edit_ev" >
                                <label class="form-check-label" for="approve_ht">
                                 Activar edición 
                               </label>
                             </div>
          </div>

          <div class="form-group float-right">
            <button type="button" style="height:40px; width:120px "id="btn_edit" class="btn btn-primary">Guardar</button>
         </div>
          </form>





          </div> 
          </div> 
    </div> 
  </div> <!-- content-wrapper-->
  </div> 

    <script src="<?php echo base_url(); ?>assets/js_admin/technical_master/evaluationForm.js"></script>
  

