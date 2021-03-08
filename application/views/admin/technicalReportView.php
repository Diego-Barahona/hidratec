<!-- formulario de vista de evaluación para superadmin -->
<div role="alert" id="alert_technical_report">
    <strong id="tr_title_alert"></strong>
</div>
<div id='technical_report_info'>

    <div class="card">
        <div class="card-header" id="headingTR">
            <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#technicalReportGeneral" aria-expanded="true" aria-controls="technicalReportGeneral">
                <i class="fas fa-table"></i>
                Información general 
            </button>
            </h5>
        </div>
        <div id="technicalReportGeneral" class="collapse show" aria-labelledby="headingTR">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="actividad">Fecha de reporte técnico</label>
                        <div class="input-group" id='frm_date_technical_report'>
                            <input type="text" class="form-control" name="tr_date_technical_report" id="tr_date_technical_report"  readonly>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3" id="frm_technical">
                        <label>Técnico asignado para el reporte técnico</label>
                        <select class="form-select form-control" id="tr_technical" name="tr_technical" disabled>
                            <option></option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3" style='text-align: center;'>
                        <div style='margin-top: 30px;'>
                            <input type="checkbox" class="form-check-input" id="tr_check_technical" disabled>
                            <label class="form-check-label" for="tr_check_technical">Aprobación Técnico</label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3" style='text-align: center;'>
                        <div style='margin-top: 30px;'>
                            <input type="checkbox" class="form-check-input" id="tr_check_adm" disabled>
                            <label class="form-check-label" for="tr_check_adm">Aprobación Administración</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8 mb-3">
                        <div>
                            <label for="actividad">Detalles</label>
                            <div class="input-group">
                                <textarea type="text" class="form-control" rows="3" name="tr_details" id="tr_details" placeholder="" aria-describedby="inputGroupPrepend3" readonly></textarea>
                            </div>
                        </div>
                        </br>
                        <div>
                            <label>Notas</label>
                            <div class="input-group">
                                <textarea type="text" class="form-control" rows="3" name="tr_notes" id="tr_notes" placeholder="" aria-describedby="inputGroupPrepend3" readonly></textarea>
                            </div>
                        </div>
                    </div>  
                    <div class="col-md-4 mb-3" style='text-align: center;'>
                        <label id='tr_label_image_header'>Imagen Cabecera</label>
                        <div class="input-group">
                            <img id='tr_image_header' style='display:block;margin:auto;' src='' width="250" heigth="250">
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#technicalReportDetails" aria-expanded="true" aria-controls="technicalReportGeneral">
                <i class="fas fa-table"></i>
                Detalle Informe Técnico
            </button>
            </h5>
        </div>
        <div id="technicalReportDetails" class="collapse show" aria-labelledby="headingOne">
            <div class="card-body" id='tr_images'>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#technicalReportConclusion" aria-expanded="true" aria-controls="technicalReportGeneral">
                <i class="fas fa-table"></i>
                Conclusiones y recomendaciones
            </button>
            </h5>
        </div>
        <div id="technicalReportConclusion" class="collapse show" aria-labelledby="headingOne" >
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-6 mb-3">
                        <label for="actividad">Conclusiones</label>
                        <div class="input-group">
                            <textarea type="text" class="form-control" rows="2" name="tr_conclusion" id="tr_conclusion" placeholder="" aria-describedby="inputGroupPrepend3" readonly></textarea>
                        </div>
                    </div>  
                    <div class="col-md-6 mb-3">
                        <label for="actividad">Recomendaciones</label>
                        <div class="input-group">
                            <textarea type="text" class="form-control" rows="2" name="tr_recommendation" id="tr_recommendation" placeholder="" aria-describedby="inputGroupPrepend3" readonly></textarea>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js_admin/technicalReport.js"></script>
