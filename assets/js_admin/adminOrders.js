$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
    },
});

$(() => {
    get_orders_test();
	//get_orders();
});


$("#newOrder").on('click', () => {
	window.open(host_url+'newOrder', '_self');
})
currentName="2428628432869191297121313173";
/*Funcion para recuperar las ordenes de trabajo*/
get_orders = () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getOrders`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            let data = xhr.response;
            tabla.clear();
			tabla.rows.add(data);	
			tabla.order( [ 1, 'desc' ] ).draw();
			$('#table_orders thead tr').clone(true).appendTo( '#table_orders thead' );

			$('#table_orders thead tr:eq(1) th').each( function (i) {
				var title = $(this).text(); //es el nombre de la columna
				$(this).html( '<input type="text" style="border-radius: .2rem; border: 1px solid #d1d3e2;"/>' );
		 
				$( 'input', this ).on( 'keyup change', function () {
					if (tabla.column(i).search() !== this.value ) {
						tabla
							.column(i)
							.search( this.value )
							.draw();
					}
				} );
			} );   

		} else {
			swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener las órdenes de trabajo",
			});
		}
	});
	xhr.send();
};

get_orders_test = () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getOrdersTest`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            let data = xhr.response;
         
            $global=[];
			
            data.forEach((item)=>{
			$alert=[];
			evaluation = JSON.parse(item.evaluation);
			technical_report = JSON.parse(item.technical_report);
			hydraulic_test = JSON.parse(item.hydraulic_test);
			
			 alert_on =false;
			 
			 if(evaluation){ 
				 if(item.ev_state){ 
					 if(item.ev_state == 1){
                        if(evaluation.approve_admin ==="false" && evaluation.approve_technical==="true"){ alert_on =true; $alert.push('Aprobar evaluación'); } 
			 }}}

             if(technical_report){ 
				if(item.tr_state){ 
					if(item.tr_state==1){
						if(technical_report.check_adm === "false" && technical_report.check_technical==="true"){ alert_on =true; $alert.push('Aprobar reporte técnico');
						  }
			  }}}
				
			 if(hydraulic_test){ 
				if(item.ht_state){ 
					if(item.ht_state==1){
				         if(hydraulic_test.approve_admin ==="false" && hydraulic_test.approve_technical==="true"){ alert_on =true; $alert.push('Aprobar prueba hidráulica');}
			 }}}
			 
			 if(item.check_adm == 0 && item.check_technical == 1 ){
				alert_on =true;
				$alert.push('Aprobar reparación');
			 }
             console.log(item.number_ot);
			 console.log(alert_on);
			 console.log($alert);
			 
			 object = {
                number_ot: item.number_ot,
				date: item.date,
                enterprise:item.enterprise,
                component:item.component,
                state:item.state,
		        service: item.service,
				alert:alert_on,
				alert_info:$alert,

			 }
			
			 $global.push(object);
			
			
			});

            tabla.clear();
			tabla.rows.add($global);	
			tabla.order( [ 1, 'desc' ] ).draw();
			$('#table_orders thead tr').clone(true).appendTo( '#table_orders thead' );

			$('#table_orders thead tr:eq(1) th').each( function (i) {
				var title = $(this).text(); //es el nombre de la columna
				$(this).html( '<input type="text" style="border-radius: .2rem; border: 1px solid #d1d3e2;"/>' );
		 
				$( 'input', this ).on( 'keyup change', function () {
					if (tabla.column(i).search() !== this.value ) {
						tabla
							.column(i)
							.search( this.value )
							.draw();
					}
				} );
			} );   

		} else {
			swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener las órdenes de trabajo",
			});
		}
	});
	xhr.send();
};

/*Constante para rellenar las filas de la tabla: lista de ordenes de trabajo*/
const tabla = $('#table_orders').DataTable({
	fixedHeader: true,
	orderCellsTop: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        { "width": "10%", "targets": 0 }, /*Id */
        { "width": "15%", "targets": 1 }, /*Fecha Ingreso*/
        { "width": "20%", "targets": 2 }, /*Cliente */
        { "width": "15%", "targets": 3 }, /*Componente */
        { "width": "10%", "targets": 4 }, /*Estado */
        { "width": "10%", "targets": 5 }, /*Tipo De Servicio */
		{ "width": "5%", "targets": 6 }, /*alertas */
        { "width": "5%", "targets": 7 },  /*Administrar */
        { "width": "5%", "targets": 8 },  /*Editar */
		{ "width": "5%", "targets": 9 },
		{className: "text-center", "targets": [6]}/*Imagenes */
    ],
	columns: [
        { data: "number_ot"},
        { data: "date" },
        { data: "enterprise" },
        { data: "component" },
        { data: "state" },
		{ data: "service" },
		{   defaultContent: "oc",
        "render": function (data, type, row){
                                if(row.alert == true){
                                     return `<button type='button' name='alert_info' class='btn btn-danger'>
									 <i class="fas fa-exclamation-circle"></i>
                                             </button>`
                                }else{
                                 return `<button type='button' name='alert_show' class='btn btn-success'>
								 <i class="fas fa-bell-slash"></i>
                                </button>`
                                }
                   }
     },// end defaultCon
		{
            defaultContent: `<button type='button' name='btn_adm' class='btn btn-primary'>
                                  Administrar
								  <i class="fas fa-shield-alt"></i>
                              </button>`,
		},
		{
            defaultContent: `<button type='button' name='btn_update' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		{
			defaultContent: `<button type='button' name='btn_images' class='btn btn-primary'>
                                Imagenes
                                <i class="fas fa-images"></i>
                            </button>`,                    
		},
	],
});

/*Función para discriminar en mostrar la información para editar o des/hab un nuevo cliente*/
$("#table_orders").on("click", "button", function () {
    let data = tabla.row($(this).parents("tr")).data();
    if ($(this)[0].name == "btn_adm") {
		let ot = data.number_ot;
		let url = 'stagesOrder'+'?ot='+ot;
		window.location.assign(host_url+url);
	}else{
	if($(this)[0].name == "btn_images"){
		let ot = data.number_ot;
		let url = 'adminImages'+'?ot='+ot;
		window.location.assign(host_url+url);
    }else{
		if($(this)[0].name == "alert_info"){
			swal({
				title: `Aprobaciones pendientes`,
				icon: "warning",
				text: addAlerts(data.alert_info),
				buttons: {
					
					cancel: {
						text: "Aceptar",
						value: "cancelar",
						visible: true,
					},
				},
			});
        }else{
			if($(this)[0].name == "alert_show"){
				console.log("alert");}
				else{

		let ot = data.number_ot;
		let url = 'newUpdateOrder'+'?ot='+ot;
		window.location.assign(host_url+url);	
		}
	}
	}}


	
});

addAlerts = errores => {
	let arrayErrores = Object.keys(errores);
	let cadena_error = "";
	let size = arrayErrores.length;
	let cont = 1;
	arrayErrores.map(err => {
		if(size!= cont){
			cadena_error += errores[`${err}`] +'\n'+'\n';
		}else{
			cadena_error += errores[`${err}`];
		}
		cont++;
	});
	return cadena_error;
};







    

