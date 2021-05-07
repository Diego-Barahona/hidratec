$(() => {
	
    get_orders_ht();
	get_orders_ev();
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
        }

	}
  }
});
