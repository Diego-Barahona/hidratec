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

    <?= require("tablesorders.php");?>
    <div class="form-group">
          <div class="row mb-2">
            <div class="col-md-12 col-lg-2 control-label">
            <button class="btn btn-success float-right form-control" type='button' data-toggle="modal" data-target="#addLocation" id="btn"><i class="fas fa-plus"></i> Crear OT</button>
            </div>
            <div class="col-md-12 col-lg-2 control-label">
            <button class="btn btn-success float-right form-control" type='button' data-toggle="modal" data-target="#addLocation" id="btn"><i class="fas fa-search"></i> Buscar OT</button>
            </div>
          </div>
      </div>

    

    <div class="row mb-3"></div>

  </div>
</div>