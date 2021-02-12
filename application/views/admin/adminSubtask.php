<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Recursos / Subtareas</li>
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
          En esta sección podra cargar nuevas subtareas que pueden ser utilizadas en los procesos de evaluación y reparación de OT.
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Lista de subtareas
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="table-subtask" width="100%" cellspacing="0">
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
      <button class="btn btn-success float-right" type='button' data-toggle="modal" data-target="#addSubtask" id="btn"><i class="fas fa-plus"></i> Crear subtarea</button>
    </div>
    <div class="row mb-3"></div>

  </div>
</div>