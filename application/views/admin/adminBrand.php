<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Recursos / Marcas </li>
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
           En esta sección podra cargar nuevas marcas de componentes que pueden ser utilizadas para el registro de información sobre OT.
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Lista de marcas
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="table-brand" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Bloquear/Desbloquear</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div style="padding-right: 40px">
      <button class="btn btn-success float-right" type='button' data-toggle="modal" data-target="#addBrand" id="btn"><i class="fas fa-plus"></i> Crear marca</button>
    </div>
    <div class="row mb-3"></div>

  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="addBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Crear marca</h5>
        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm">
            <p id="UserModalInfo"></p>
          </div>
        </div>
        <div class="form-group">
        <form>
            <input type="hidden" class="form-control" id="id" name="id" >
            <div class="form-group" id="frm_name">
                <label>Nombre</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese nombre">
                 <div class="invalid-feedback"></div>
            </div>
            <div class="form-group float-right">
            <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" id="createBrand" class="btn btn-primary">Guardar</button>
          </div>

      </form>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/js_admin/adminBrand.js"></script>
