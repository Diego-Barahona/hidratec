$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
    },
});

$(() => {
    getReparations();
});

/*Funcion para recuperar las ordenes de trabajo*/
getReparations = () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/tmGetReparation`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            let data = xhr.response;
            let aux = [];
            console.log(data);
            data.forEach((item)=>{
                let check_technical;
                let check_adm;
                console.log(item);
                if(item.check_technical == '1') check_technical = 'Realizado';
                else check_technical = 'No Realizado';
                
                if(item.check_adm == '1') check_adm = 'Aprobado';
                else check_adm = 'No Aprobado';
                reparation = 
                {
                    number_ot : item.number_ot,
                    date : item.date,
                    client: item.client,
                    component: item.component,
                    service : item.service,
                    check_technical: check_technical,
                    check_adm: check_adm,
                }
                aux.push(reparation);
            });
            tabla.clear();
            tabla.rows.add(aux);	
            tabla.order( [ 7, 'asc' ] ).draw();      
		} else {
			swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener las reparaciones",
			});
		}
	});
	xhr.send();
};

/*Constante para rellenar las filas de la tabla: lista de ordenes de trabajo*/
const tabla = $('#tableReparations').DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
    "columnDefs": [
        {
            className: "text-center", "targets": [7] ,
        },
        {
            className: "text-center", "targets": [8] ,
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
				return `<button type='button' name='btn_substaks' class='btn btn-success'>
                Ver subtareas
                <i class="fas fa-search"></i>
                </button>`
			}else{
				return `<button type='button' name='btn_substaks' class='btn btn-primary'>
				Asignar Subtareas
				<i class="fas fa-pencil-alt"></i>
				</button>`
			}
		   }
		},
        { defaultContent: "oc",
            "render": function (data, type, row){
                if(row.check_technical === 'Realizado'){
                    return `<button type='button' class='btn btn-success'>
                    Realizado
                    </button>`
                }else{
                    return `<button type='button' name='btn_approve' class='btn btn-primary'>
                    Marcar Como Realizado
                    <i class="fas fa-pencil-alt"></i>
                    </button>`
                }
            }
        },
	],
});


$("#tableReparations").on("click", "button", function () {
    let data = tabla.row($(this).parents("tr")).data();
    if ($(this)[0].name == "btn_substaks") {
        let ot = data.number_ot;
		let url = 'tmAdminSubstasks/reparation/index'+'?ot='+ot;
		window.location.assign(host_url+url);
	}else if ($(this)[0].name == "btn_approve"){
        approve(data);
    }
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
                    getReparations();
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