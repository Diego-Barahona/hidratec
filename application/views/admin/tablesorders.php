
 <div id="content-wrapper">
  <div class="container-fluid mb-5">
    <div class="card mb-3">
      <div class="card-header">
            <ul class="nav nav-pills card-header-pills  ">
              <li class="nav-item ">
                  <a class="nav-link active" data-toggle="tab" href="#evaluacion">Evaluacion  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#cotizacion">Informe Técnico</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link " data-toggle="tab" href="#aprobadas">Aprobación</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link " data-toggle="tab" href="#aprobadas">Reparación</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link " data-toggle="tab" href="#aprobadas">Prueba Hidráulica</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link " data-toggle="tab" href="#aprobadas">Historial de estados</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link " data-toggle="tab" href="#aprobadas">Notas</a>
              </li>
            </ul>
      </div>
     <div class="card-body tab-content">
     <!-- Evaluations View and Edit -->
     <?php if ($_SESSION['rango']=="1"){ ?>
     <?php require('evaluationEdit.php');} ?>
     <!-- Evaluations End -->

<div class="table-responsive tab-pane fade  " id="cotizacion" class="tab-pane fade ">

<div class="table-responsive tab-pane fade" id="aprobadas" class="tab-pane fade ">
         <div class="card-header">
              <i class="fas fa-table"></i>
                En aprobación
         </div>
          <table class="table table-bordered" id="table-component" width="100%" cellspacing="0">
          <thead>
              <tr>
                <th>Ot</th>
                <th>Estado</th>
                <th>componente</th>
                <th>Fecha</th>
                <th>Cambio estado</th>
        
              </tr>
            </thead>
            <body>
            <tr>
                <th>2334</th>
                <th>En aprobacion </th>
                <th>Valvula</th>
                <th>aprobar </th>
                <th>cambio estado</th>
                
              </tr>
            </body>
          </table>
 </div>
</div>
</div>
