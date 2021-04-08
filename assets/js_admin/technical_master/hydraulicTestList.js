$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
    },
});


$(() => {
    get_orders_ht();

});



currentName="2428628432869191297121313173";


get_orders_ht = () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getHydraulicTestEnable`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            let data =xhr.response;
         
            $global=[];
            data.forEach((item)=>{
             validation = JSON.parse(item.details);
             interaction = JSON.parse(item.user_interaction);
             config = JSON.parse(item.config);
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
                      approve_technical:  validation.approve_technical=="true"? "Aprobado":"Pendiente ",
                      approve_admin:  validation.approve_admin == "true"?  "Aprobado":"Pendiente ",

                  }

                  
                 $global.push(report);
                });



            tabla.clear();
			tabla.rows.add($global);	
			tabla.order( [ 1, 'desc' ] ).draw();
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

const tabla = $('#table_ht').DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columns: [
        { data: "number_ot"},
        { data: "date" },
        { data: "enterprise" },
        { data: "component" },
        { data: "approve_technical" },
        { data: "approve_admin" },
		{ data: "service" },
		{
            defaultContent: `<button type='button' name='btn_edit_ht' class='btn btn-primary'>
                                 Editar
								 <i class="fas fa-search"></i>
                              </button>`,
		},
	
	],
});




/*Función para discriminar en mostrar la información para editar o des/hab un nuevo cliente*/
$("#table_ht").on("click", "button", function () {
    let data = tabla.row($(this).parents("tr")).data();
    if ($(this)[0].name == "btn_edit_ht") {
        let ot = data.number_ot;
		let url = 'hydraylicTestForm'+'?ot='+ot;
		window.location.assign(host_url+url);
	}
});



  $( function() {
    $( "#date_ht").datepicker({
        showOn: "button",
        buttonText: "Calendario",
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        buttonImage: host_url + 'assets/img/about/calendario2.png',
    });
  } );



