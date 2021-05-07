$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
    },
});

$(() => {
    getTechnicalReports();
});


/*Funcion para recuperar las ordenes de trabajo*/
getTechnicalReports = () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/tmGetTechnicalReport`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            let data = xhr.response;
            if(data){
                $aux=[];
                data.forEach((item)=>{
                    validation = JSON.parse(item.details);
                    if(validation){
                        let check_technical;
                        let check_adm;
                        if(validation.check_technical == 'true') check_technical = 'Realizado';
                        else check_technical = 'No Realizado';
                        
                        if(validation.check_adm == 'true') check_adm = 'Aprobado';
                        else check_adm = 'No Aprobado';
                        report = 
                        {
                            number_ot : item.number_ot,
                            date : validation.date_technical_report,
                            client: item.client,
                            component: item.component,
                            service : item.service,
                            check_technical: check_technical,
                            check_adm: check_adm,
                        }
                        $aux.push(report);
                    }
                });
    
                tabla.clear();
                tabla.rows.add($aux);	
                tabla.order( [ 5, 'asc' ] ).draw();
            }
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

/*Constante para rellenar las filas de la tabla: lista de ordenes de trabajo*/
const tabla = $('#tableTechnicalReports').DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
    "columnDefs": [
        {
            className: "text-center", "targets": [6] ,
        },
        {
            className: "text-center", "targets": [7] ,
        },
    ],
	columns: [
        { data: "number_ot"}, 
        { data: "date" }, 
        { data: "client" }, 
        { data: "component" }, 
        { data: "service" }, 
        { data: "check_technical" }, 
        { data: "check_adm" }, 
        { defaultContent: "oc",
		   "render": function (data, type, row){
			if(row.check_technical === 'Realizado'){
				return `<button type='button' name='btn_tr' class='btn btn-primary'>
                Ver informe
                <i class="fas fa-search"></i>
                </button>`
			}else{
				return `<button type='button' name='btn_tr' class='btn btn-warning'>
				Realizar
				<i class="fas fa-pencil-alt"></i>
				</button>`
			}
		   }
		},
	
	],
});


$("#tableTechnicalReports").on("click", "button", function () {
    let data = tabla.row($(this).parents("tr")).data();
    if ($(this)[0].name == "btn_tr") {
        window.location.assign(host_url+`tmAdminViewTechnicalReport/${data.number_ot}`);
	}
});
