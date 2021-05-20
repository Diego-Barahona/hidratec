$(() => {


  get_orders_ht();
	get_orders_ev();
	get_orders_tr();
	get_orders_reparation();

});

const tabla = $("#table-orders").DataTable({
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columns: [
		{ data: "number_ot" },
		{ data: "date" },
		{ data: "priority" },
		{ data: "component" },
    { data: "enterprise" },
    { data: "service" },
		{
			defaultContent: `<button type='button' name='btn_admin' class='btn btn-primary'>
                                  Realizar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
	],
});



const tablaReparation = $("#tableReparations").DataTable({
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	"columnDefs": [
        {
            className: "text-center", "targets": [4] ,
        },
        {
            className: "text-center", "targets": [5] ,
        },
    ],
	columns: [
		{ data: "number_ot" },
		{ data: "component" },
        { data: "enterprise" },
        { data: "service" },	
		{ defaultContent: `<button type='button' name='btn_substaks' class='btn btn-primary'>
				Asignar subtareas
				<i class="fas fa-pencil-alt"></i>
				</button>`
		},

	 	{ defaultContent: 
			`<button type='button' name='btn_approve' class='btn btn-primary'>
					Marcar Como Realizado
					<i class="fas fa-pencil-alt"></i>
					</button>`
	 	},
	],
});


let down;
let e_quotation;
let e_aprobation;
let finished;
let reparation;
let evaluation;
let retired;
let hydraulic;
let hydraulicTests=[];
let evaluations=[];
let technicalsReports = [];
let reparations = [];
let urlRedirect = '';

get_orders_ht= () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getHydraulicTestEnable`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            let data =xhr.response;
            data.forEach((item)=>{
             validation = JSON.parse(item.details);
             interaction = JSON.parse(item.user_interaction);
             config = JSON.parse(item.config);
             if(validation.approve_technical == "false"){
             report = 
                  {
                      number_ot : item.number_ot,
                      priority: item.priority,
                      technical : interaction ? interaction.date_create :"" ,
                      date : validation ? validation.date_ht : "Pendiente",
                      conclusion : validation ? validation.conclusion : "",
                      notes : validation ? validation.notes : "",
                      enterprise : item.enterprise,
                      component : item.component,
                      service : item.service,
                      approve_technical:  validation.approve_technical=="true"? "Realizado":"No realizado",
                      approve_admin:  validation.approve_admin == "true"?  "Aprobado":"No aprobado" ,
					            type:'hidraulic'
                      ,
                  }
                console.log(report.approve_technical);
                  
                 hydraulicTests.push(report);

                }
                });
         
           $("#hydraulicTest").html(hydraulicTests.length);
		} else {
			swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener los reportes técnicos",
			});
		}
	});
	xhr.send();
};

get_orders_ev= () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getEvaluationEnable`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            let data =xhr.response;
            data.forEach((item)=>{
             validation = JSON.parse(item.details);
             interaction = JSON.parse(item.user_interaction);
             if(validation){
             if(validation.approve_technical == "false"){
             report = 
                  {
                      number_ot : item.number_ot,
                      priority: item.priority,
                      technical : interaction ? interaction.date_create :"" ,
                      date : validation ? validation.date_evaluation : "Pendiente",
                      enterprise : item.enterprise,
                      component : item.component,
                      service : item.service,
					  type:'evaluation'
                  }
                
				  
				  evaluations.push(report);

                }

			}else{

				report = 
				{
					number_ot : item.number_ot,
					priority: item.priority,
					technical : interaction ? interaction.date_create :"" ,
					date :  "Pendiente",
					enterprise : item.enterprise,
					component : item.component,
					service : item.service,
					type:'evaluation',
				}

				evaluations.push(report);
			  

			}
                });
         
           $("#evaluation").html(evaluations.length);
		} else {
			swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener las evaluaciones",
			});
		}
	});
	xhr.send();
};



get_orders_tr= () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/tmGetTechnicalReport`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            let data =xhr.response;
            data.forEach((item)=>{
             validation = JSON.parse(item.details);
             interaction = JSON.parse(item.user_interaction);
             if(validation.check_technical == "false"){
             report = 
                  {
                      number_ot : item.number_ot,
					  priority: item.priority,
					  component: item.client,
					  enterprise: item.client,
					  service: item.service,
                      date : "Pendiente",
                  }
                  
				  technicalsReports.push(report);

				}
			});
         
           $("#technicalReportCount").html(technicalsReports.length);
		} else {
			swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener los reportes técnicos",
			});
		}
	});
	xhr.send();
};


get_orders_reparation = () => {
	reparations = [];
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/tmGetReparation`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            let data = xhr.response;
            data.forEach((item)=>{
                if(item.check_technical == '0'){
					reparation = 
					{
						number_ot : item.number_ot,
						component: item.component,
						enterprise: item.client,
						service : item.service,
					}
					reparations.push(reparation);
				}
            });
            tablaReparation.clear();
            tablaReparation.rows.add(reparations);	
            tablaReparation.draw();      
		} else {
			swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener las reparaciones",
			});
		}
		$("#reparationCount").html(reparations.length);
	});
	xhr.send();
};


loadDataModal = (title, data) => {
	$("#titlemodal").html(title);
	tabla.clear();
	tabla.rows.add(data);
	tabla.draw();
};



$("#btnHydraulicTest").on("click", () => {
	loadDataModal("Pruebas hidráulicas por realizar", hydraulicTests);
	$("#modal").modal("show");
});

$("#btnevaluation").on("click", () => {
	loadDataModal("Evaluaciones por realizar", evaluations);
	$("#modal").modal("show");
});




approve = (item) => {
    swal({
        title: `Aprobar Reparación`,
        icon: "warning",
        text: `Esta  segur@ de marcar como realizada la reparación de la ot n°:${item.number_ot}?, esta acción es irreversible`,
        buttons: {
            confirm: {
                text: `Confirmar`,
                value: "approve",
            },
            cancel: {
                text: "Cancelar",
                value: "cancelar",
                visible: true,
            },
        },
    }).then((action) => {
        if (action == "approve") {
            data = {
                ot_id: item.number_ot,
            }
            $.ajax({
                type: "POST",
                url: host_url + "api/tmApproveReparation",
                data: {data},
                dataType: "json",
                success: () => {
                 swal({
                     title: "Éxito!",
                     icon: "success",
                     text: "Reparación actualizada con éxito.",
                     button: "OK",
                 }).then(() => {
                    get_orders_reparation();
                 });
                }, 
                error: () => {
                    swal({
                        title: "Error",
                        icon: "error",
                        text: "No se pudo encontrar el recurso",
                    }).then(() => {
                        $("body").removeClass("loading");
                    });
                },
            });  

        }
    });

}




$("#btnTechnicalReports").on("click", () => {
	urlRedirect = 'technicalReport';
	loadDataModal("Informes técnicos por realizar", technicalsReports);
	$("#modal").modal("show");
});

$("#btnReparations").on("click", () => {
	$("#modalReparation").modal("show");
});


$("#table-orders").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	if ($(this)[0].name == "btn_admin") {

		if(data.type =="evaluation"){
		let ot = data.number_ot;
		let url = 'editEvaluation'+'?ot='+ot; 
		window.location.assign(host_url+url);
	    }else{

		if(data.type =="hidraulic"){
		let ot = data.number_ot;
		let url = 'hydraylicTestForm'+'?ot='+ot; 
		window.location.assign(host_url+url);
        }else{
     
      if(urlRedirect == 'technicalReport'){
			window.location.assign(host_url+`tmAdminViewTechnicalReport/${data.number_ot}`);
		}   
     }

	}
  }
});

$("#tableReparations").on("click", "button", function () {
    let data = tablaReparation.row($(this).parents("tr")).data();
    if ($(this)[0].name == "btn_substaks") {
        alert('substaks');
	}else if ($(this)[0].name == "btn_approve"){
        approve(data);
    }
});


