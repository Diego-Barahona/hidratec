$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
    },
});

$(() => {
    get_orders();
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
        { "width": "5%", "targets": 6 },  /*Administrar */
        { "width": "5%", "targets": 7 },  /*Editar */
		{ "width": "5%", "targets": 8 },  /*Imagenes */
    ],
	columns: [
        { data: "number_ot"},
        { data: "date" },
        { data: "enterprise" },
        { data: "component" },
        { data: "state" },
		{ data: "service" },
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
		let ot = data.number_ot;
		let url = 'newUpdateOrder'+'?ot='+ot;
		window.location.assign(host_url+url);	
		}
	}
});







    

