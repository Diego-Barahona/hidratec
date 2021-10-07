<!-- formulario de vista de evaluación para superadmin -->
<div id='reparation_info'>
    <div class="card">
        <div class="card-header" id="headingTR">
            <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#reparationGeneral" aria-expanded="false" aria-controls="technicalReportGeneral">
                <i class="fas fa-table"></i>
                Información general
            </button>
            </h5>
        </div>
        <div id="reparationGeneral" class="collapse show" aria-labelledby="headingTR">
            <div class="card-body">
                <div class="row mb-2 ">
                    <div class="col-md-3 mb-3 ">
                        <div class="form-check">
                                <input class="form-check-input"  type="checkbox" value="" id="r_check_adm" disabled>
                                <label class="form-check-label"  for="r_check_adm">
                                Aprobado por administración
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3 ">
                        <div class="form-check">
                            <input class="form-check-input"  type="checkbox" value="" id="r_check_technical" disabled>
                            <label class="form-check-label"  for="r_check_technical">
                                Aprobado por técnico master
                            </label>
                        </div>
                    </div>   
                    <div class="col-md-6 mb-3" style='text-align: right;'>
                        <button id="r_popover" type="button" class="btn btn-primary rounded-circle" data-toggle="popover" data-placement="left"><i class="fas fa-info"></i></button>
                    </div>               
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="actividad">Fecha de asignación</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="r_date_assignment" id="r_date_assignment" readonly>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Técnico asignado para la reparación</label>
                        <select class="form-select form-control" id="r_technical" name="r_technical" disabled>
                            <option></option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Días de reparación</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="r_days_reparation" id="r_days_reparation" readonly>
                        </div>
                    </div>
                </div> 
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="actividad">Fecha de reparación</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="r_date_reparation" id="r_date_reparation" readonly>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="form-group" style="margin-top: 40px; float:right;">
        <button class="btn btn-success" value='0' type='button' id="r_btnEdit"><i id='r_i_btnEdit' class="fas fa-edit" style="margin-right: 5px;"></i>Editar</button>
        <button class="btn btn-success" style='display:none' type='button' id="r_btnSave"><i class="fas fa-save" style="margin-right: 5px;"></i>Guardar Cambios</button>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js_admin/reparation.js"></script>

