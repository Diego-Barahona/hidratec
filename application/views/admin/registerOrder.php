<div id="content-wrapper">
    <div class="container-fluid mb-5" id="adminColors">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Órdenes de trabajo</li>
            <li class="breadcrumb-item active">Crear OT</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Información general 
            </div>

            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="actividad">Fecha de ingreso</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="rut_empresa" id="rut_empresa" placeholder="" aria-describedby="inputGroupPrepend3">
                            <div class="invalid-feedback rut_empresa" style="display: none;  color:red">
                                Ingrese un rut porfavor.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="actividad">Empresa</label>
                        <select class="custom-select d-block w-100" id="servicio" required="">
                            <option value="0">Opciones...</option>
                            <option value="Reparación">AC PERFORACIONES </option>
                            <option value="Fabricación">CASERONES </option>
                        </select>
                        <div class="invalid-feedback servicio" style="display: none;  color:red">
                            Seleccione un servicio porfavor.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                    <label for="actividad">Tipo servicio</label>
                        <select class="custom-select d-block w-100" id="servicio" required="">
                            <option value="0">Opciones...</option>
                            <option value="Reparación">Reparación</option>
                            <option value="Fabricación">Fabricación</option>
                            <option value="Mantención">Mantención</option>
                        </select>
                        <div class="invalid-feedback servicio" style="display: none;  color:red">
                            Seleccione un servicio porfavor.
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    
                   
                    <div class="col-md-4 mb-3">
                        <label for="actividad">Tipo de componente</label>
                        <select class="custom-select d-block w-100" id="servicio" required="">
                            <option value="0">Opciones...</option>
                            <option value="Reparación">Reparación</option>
                            <option value="Fabricación">Fabricación</option>
                        </select>
                        <div class="invalid-feedback servicio" style="display: none;  color:red">
                            Seleccione un servicio porfavor.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="actividad">Tipo de prioridad</label>
                        <select class="custom-select d-block w-100" id="servicio" required="">
                            <option value="0">Opciones...</option>
                            <option value="Baja">BAJA</option>
                            <option value="Media">MEDIA</option>
                            <option value="Alta">ALTA</option>
                        </select>
                        <div class="invalid-feedback servicio" style="display: none;  color:red">
                            Seleccione un servicio porfavor.
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12 mb-3">
                        <label for="actividad">Nota</label>
                        <div class="input-group">
                            <textarea type="text" class="form-control" rows="5" name="descripcion" id="descripcion" placeholder="" aria-describedby="inputGroupPrepend3"></textarea>
                            <div class="invalid-feedback descripcion" style="display: none;  color:red">
                                Ingrese una nota porfavor.
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
               Información de ingreso
            </div>

            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="actividad">Fecha de ingreso</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="date_admission" id="date_admission" placeholder="" aria-describedby="inputGroupPrepend3">
                            <div class="invalid-feedback rut_empresa" style="display: none;  color:red">
                                Ingrese una fecha porfavor.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                    <label for="actividad">Dias para cotización</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="rut_empresa" id="rut_empresa" placeholder="" aria-describedby="inputGroupPrepend3">
                            <div class="invalid-feedback rut_empresa" style="display: none;  color:red">
                                Ingrese numero de días porfavor.
                            </div>
                        </div>
                    </div> 
                </div>   
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
               Configuración
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
          
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                     <label class="custom-control-label" for="customSwitch1">Evaluación</label>
                                     </div>
                            
                        </div>
                    <div class="col-md-4 mb-3">
                        
                            <div class="custom-control custom-switch">
                                 <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                 <label class="custom-control-label" for="customSwitch1">Informe Técnico</label>
                            </div>
                 
                     </div>
                     <div class="col-md-4 mb-3">
                               <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                      <label class="custom-control-label" for="customSwitch1">Prueba Hidráulica</label>
                             </div>
                        
                        </div>
                     </div>

                     <div class="row mb-2">
                     <div class="col-md-4 mb-3">
                         <label for="actividad">Asignar técnico</label>
                             <select class="custom-select d-block w-100" id="servicio" required="">
                               <option value="0">Opciones...</option>
                               <option value="J">MARCOS PLAZA</option>
                               <option value="M">JUAN LOPEZ </option>
                             </select>
                         <div class="invalid-feedback servicio" style="display: none;  color:red">
                            Seleccione un técnico por favor.
                         </div>
                    </div>
                    </div>
                    <div class="row mb-2">
                     
                          
                    <div style="padding-right: 40px">
                           <button class="btn btn-success " type='button' data-toggle="modal" data-target="#addComponent" id="btn"> Crear OT</button>
                            </div>
                    </div>



                
            </div>
        </div>
    </div>
</div>

<script>
  
  $( function() {
    $( "#date_admission" ).datepicker({
      showOn: "button",
      buttonImageOnly: true,
      buttonText: "Select date",
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>





