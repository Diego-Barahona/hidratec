
<div id="content-wrapper">
  <div class="container-fluid mb-5">
    <div class="card mb-3">
      <div class="card-header">
            <ul class="nav nav-pills card-header-pills  ">
              <li class="nav-item ">
                  <a class="nav-link active" data-toggle="tab" href="#evaluacion">Evaluacion  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#technicalReport">Informe Técnico</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link " data-toggle="tab" href="#aprobadas">Aprobación</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link " data-toggle="tab" href="#aprobadas">Reparación</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link " data-toggle="tab" href="#hidraulicTest">Prueba Hidráulica</a>
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
     <?php require('evaluationView.php');} ?>
     <!-- Evaluations End -->
    

   <?php require('hidraulicTest.php');?>
  


   <!--   <div class="table-responsive tab-pane fade " id="technicalReport" class="tab-pane fade ">
         <?php //if ($_SESSION['rango']=="1"){require('technicalReportView.php'); }
          //else if ($_SESSION['rango']=="2"){require('technicalReportEdit.php'); }
         ?>
     </div> -->
     <div class="table-responsive tab-pane fade " id="technicalReport" class="tab-pane fade ">
        <?php require('technicalReportEdit.php'); ?> 
     </div>




</div><!--hidraulictest-->
</div><!--cotizacion-->
</div><!--aprobadas--> 

