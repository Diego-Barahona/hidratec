
<input type="hidden" class="form-control" id="ot_number" name="ot_number" value='<?= $id ?>' >
<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Órdenes de trabajo / Listado de pruebas hidráulicas</li>
    </ol>
    <div class="accordion" id="accordionExample">
      <div class="card mb-3">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              INSTRUCCIONES
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
           En esta sección se podrá realizar la elaboración de las pruebas hidráulicas de las OT que han sido ingresadas por sistema , ademas de su respectiva aprobación por parte de técnico master.
        </div>
      </div>
    </div>
    
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Lista de prueba hidráulicas
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="table_ht" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>N° de OT </th>
                <th>Fecha de realización </th>
                <th>Realizado </th>
                <th>Aprobado por administración</th>
                <th>Tipo de servicio</th>
                <th>Acción</th>
                <th>Informe</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="row mb-3"></div>
  </div>
</div>





<script src="<?php echo base_url(); ?>assets/js_admin/technical_master/hydraulicTestList.js"></script>