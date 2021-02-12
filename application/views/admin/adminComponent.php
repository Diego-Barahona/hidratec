<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Recursos / Componentes</li>
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
           En esta sección podra cargar todas las ubicaciones existentes donde se puede encontrar almacenada una orden a nivel de taller.
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Lista de componentes
      </div>
      <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered" id="table-location" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Editar</th>
                <th>Bloquear/Desbloquear</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
    <div style="padding-right: 40px">
      <button class="btn btn-success float-right" type='button' data-toggle="modal" data-target="#addComponent" id="btn"><i class="fas fa-plus"></i> Crear componente</button>
    </div>
    <div class="row mb-3"></div>

  </div>
</div>