<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Órdenes de trabajo / Lista general</li>
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
           En esta sección podra realizar la administración de órdenes de trabajo , posibilitanto el seguimientos de estas en todas las etapas del proceso de una OT.
          </div>
        </div>
      </div>
    </div>


    <div class="accordion" id="accordionExample">
      <div class="card mb-3">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
          <div style="padding-right: 40px">
      <button class="btn btn-success float-right" type='button' data-toggle="modal" data-target="#addLocation" id="newOrder"><i class="fas fa-plus"></i> Crear OT</button>
    </div>
          </h2>
        </div>

      </div>
    </div>
   

   

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Lista de Órdenes de trabajo
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="table-location" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>N° de OT </th>
                <th>Fecha de ingreso </th>
                <th>Cliente</th>
                <th>Componente </th>
                <th>Estado </th>
                <th>Administrar</th>
                <th>Editar</th>
                <th>Imagenes</th>
              </tr>
            </thead>
            <body>
              <tr>
                <th>2334</th>
                <th>9/12/2021</th>
                <th>AC perforaciones</th>
                <th>Valvula </th>
                <th>En evaluación </th>
                <th><a href="<?php echo base_url(); ?>stagesOrder">Administrar</a></th>
                <th><a href="#">Detalles</a></th>
                <th><a href="#">Imagenes</a></th>
              </tr>
            </body>
          </table>
        </div>
      </div>
    </div>
    
    <div class="row mb-3"></div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/js_admin/adminOrders.js"></script>