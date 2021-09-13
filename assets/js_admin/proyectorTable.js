
$(() => {
	getProduction();
});



const tabla = $("#table-work").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
    pageLength: 5,
	columns: [
        { data: "number_ot" },
		{ data: "component" }, 
        { data: "service" }, 
		{ data: "dias_rep" },
        { data: "fecha_rep" },
        { data: "technical" },
		
		/* { defaultContent: "oc",
			"render": function (data, type, row){
				if(row){
					return `<button type='button' name='btnApprove' class='btn btn-primary'>
					Aprobar
					<i class="fas fa-thumbs-up"></i>
					</button>`
				}else{
					return 
				}
			}
		}, */
	
	],
});


getProduction = () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/projector/getOrders`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            let data = xhr.response;
			console.log(data);
            tabla.clear();
			tabla.rows.add(data);	
			tabla.draw();
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


