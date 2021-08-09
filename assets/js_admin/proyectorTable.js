
$(() => {
	datatable();
});



const tabla_1 = $("#table-work").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
    pageLength: 5,
	columns: [
        { data: "ot" },
		{ data: "component" },
        { data: "service" },
		{ data: "dias_rep" },
        { data: "fecha_rep" },
        { data: "technical" },
		{
			defaultContent: `<button type='button' name='editButton' class='btn btn-danger'>
                                  Atrasado
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
	
	],
});



datatable = ()=> { 

    let object = 
    [{ot: 12 ,component:"BOMBA" , service:"Reparacion" , dias_rep: 4 , fecha_rep : '2021/07/23', technical:"Juan Plaza"},
    {ot: 12 ,component:"VALVULA" , service:"Mantención" , dias_rep: 4 , fecha_rep : '2021/05/23',  technical:"Sebastian Vega"},
    {ot: 13 ,component:"CILINDRO" , service:"Reparacion" , dias_rep: 4 , fecha_rep : '2021/07/26',  technical:"Marcos Ramirez"},
    {ot: 14 ,component:"BOMBA" , service:"Reparacion" , dias_rep: 4 , fecha_rep : '2021/06/23',  technical:"Juan Plaza"},
    {ot: 15 ,component:"CILINDRO" , service:"Fabricación" , dias_rep: 4 , fecha_rep : '2021/06/18',  technical:"Maximiliano Peñafiel"},
    {ot: 18 ,component:"MOTOR" , service:"Reparacion" , dias_rep: 4 , fecha_rep : '2021/07/23',  technical:"Diego Barahona"},
    {ot: 11 ,component:"MOTO" , service:"Mantención" , dias_rep: 4 , fecha_rep : '2021/07/26',  technical:"Miguel Ramirez"},
    {ot: 120 ,component:"BOMBA" , service:"Reparacion" , dias_rep: 4 , fecha_rep : '2021/07/26',  technical:"Juan Plaza"}];

	tabla_1.clear();
    tabla_1.rows.add(object);
	tabla_1.draw();

}





