
$(() => {
    get_data_ht();
	getFields_ht();
	get_info_ht();
   
});


let check_admin_old = false;

let medida = []; 

$("#hab_edit").change(() => { 
	let check = $('#hab_edit').is(':checked');
	if(check){
        $( "#date_ht" ).prop( "disabled", false );
        $( "#conclusion_ht" ).prop( "disabled", false );
        $( "#notes_ht" ).prop( "disabled", false );
        $( "#approve_admin_ht" ).prop( "disabled", false );
		$( "#approve_technical_ht" ).prop( "disabled", false );
        $( "#technical_ht" ).prop( "disabled", false );
	}else{
        $( "#date_ht" ).prop( "disabled", true );
        $( "#conclusion_ht" ).prop( "disabled", true);
        $( "#notes_ht" ).prop( "disabled", true );
        $( "#approve_admin_ht" ).prop( "disabled", true );
		$( "#approve_technical_ht" ).prop( "disabled", true );
        $( "#technical_ht" ).prop( "disabled", true );
		
	}
});


unable_edition =()=>{
	$('#hab_edit').prop( "checked", false );
	$( "#date_ht" ).prop( "disabled", true );
	$( "#conclusion_ht" ).prop( "disabled", true);
    $( "#notes_ht" ).prop( "disabled", true );
	$( "#approve_admin_ht" ).prop( "disabled", true );
	$( "#approve_technical_ht" ).prop( "disabled", true );
    $( "#technical_ht" ).prop( "disabled", true );
}


edit_ht = () => {

   
	event.preventDefault();
	let id = $("#ot_number").val();//Image ID 
	
	let data = {
        date_ht :$("#date_ht").val(),
        conclusion: $("#conclusion_ht").val(),
        notes: $("#notes_ht").val(),
        approve_technical: $("#approve_technical_ht").is(':checked'),
		approve_admin: $("#approve_admin_ht").is(':checked'),
        technical: $("#technical_ht").val(),
		user_create:$("#user_create").val(),//lineas nuevas
		date_create: $("#date_create").val(),
		user_approve: $("#user_approve").val(),
		date_approve:$("#date_approve").val(),//fin
		check_admin_old: check_admin_old,
	};

	Object.keys(data).map((d) => $(`.${d}`).hide());
	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + `api/editHydraulicTest/${id}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Exito",
				icon: "success",
				text: result.msg,
                button: "OK",
			}).then(() => {
				unable_edition();
				swal.close();
			   });
		},
		error: (result) => {
            swal({
				title: "Denegado!",
				icon: "error",
				text: result.responseJSON.msg,
			}).then(() => {
			 swal.close();
			});
		     
		},
	});
};




let technicals_user_ht = 0; 
info_popover="";
get_data_ht = () =>{

    id= $("#ot_number").val();
 
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getHydraulicTestByOrder/${id}`);
	xhr.responseType = "json";
	xhr.setRequestHeader("Cache-Control", "no-cache");
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
		
			let data1 = xhr.response[0].details;
			let data2 =xhr.response[0].user_interaction;//nueva linea
			let technical=xhr.response[0].full_name;
			
			if(data1){ //linea nueva
				let ht= JSON.parse(data1);
			    
			    if(ht.approve_admin === "true" ){	
					$("#approve_admin_ht" ).prop('checked', true);
					check_admin_old = true;

			    } else {
					$( "#approve_admin_ht" ).prop('checked', false );
				    check_admin_old = false;                               
				}

			    if(ht.approve_technical === "true"){
				     
					$( "#approve_technical_ht").prop('checked', true);
			    } else {
					
					$( "#approve_technical_ht" ).prop('checked', false );}
				
				$( "#date_ht" ).val(ht.date_ht);
				$( "#conclusion_ht" ).val(ht.conclusion);
				$( "#notes_ht" ).val(ht.notes);
				$( "#technical_ht" ).val(technical);
			
			}else{
				$( "#date_ht" ).val('');
				$( "#conclusion_ht" ).val('');
				$( "#notes_ht" ).val('');
				$( "#approve_technical_ht" ).prop('checked', false);
			    $( "#approve_admin_ht" ).prop('checked', false);
	
			}

			if(data2){
				let us = JSON.parse(data2);//linea nueva
				$("#user_create").val(us.user_create);//lineas nuevas
				$("#user_modify").val(us.user_modify);
				$("#user_approve").val(us.user_approve);
				$("#date_create").val(us.date_create);
				$("#date_modify").val(us.date_modify);
				$("#date_approve").val(us.date_approve);//fin lineas nuevas
				
			
			}else { 
				$("#user_create").val("");//lineas nuevas
				$("#user_modify").val("");
				$("#user_approve").val("");
				$("#date_create").val("");
				$("#date_modify").val("");
				$("#date_approve").val("");
				
			}

			if(technical){
				$("#technical_ht" ).val(technical);
			}else{
				$("#technical_ht" ).val('');
			}
           
			technicals_user_ht = xhr.response[0].user_assignment;
            disabledAlert_ht();
		}else { 
            alert_not_evaluation_ht(xhr.response.msg);
        }
	});
	xhr.send();
}

alert_not_evaluation_ht = (msg)=>{
	
    $("#hydraulic_info" ).css("display","none");
    $("#alert_hydraulicTest").addClass("alert alert-warning col-md-6 mb-3").text("Aviso : "+ msg);
    $("#title_alert_ht").text( "Detalle:");
}

disabledAlert_ht= () =>{

    $("#hydraulic_info" ).show();
    $("#alert_hydraulicTest").removeClass("alert alert-warning col-md-6 mb-3");
    $("#alert_hydraulicTest").text('');
    $("#title_alert_ht").css("display","none");
}


$("#ht_popover").on("click",function(){
    $("#ht_popover").popover(
		{ 
		html: true,
		title: "Información",
		content: "Creado por: " +$("#user_create").val()+"<br />"+"Fecha creación: "+ 
	    $("#date_create").val()+"<br />"+"Modificado por: " +$("#user_modify").val()+"<br />"+"Fecha mod.: "+ $("#date_modify").val()+"<br />"+
	    "Aprobado por: " +$("#user_approve").val()+"<br />"+"Fecha aprv.: "+ $("#date_approve").val()});   
});



let technicals_ht = [];

getFields_ht = () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getFieldsOrder`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            if(technicals_ht.length == 0){
				
                xhr.response[2].map((u) => {
                    let option = document.createElement("option"); 
                    $(option).val(u.id); 
                    $(option).attr('name', u.full_name);
                    $(option).html(u.full_name); 
                    $(option).appendTo("#technical_ht");
					$("#technical_ht").val(technicals_user);
                     technicals_ht.push(u.full_name);
                });
            }
		} else {
			swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener technicos",
			});
		}
	});
	xhr.send();
};






const tabla_ht = $("#table-ht").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columns: [
		{ data: "dato" },
		{ data: "speed" },
		{ data: "presion" },
		{ data: "caudal" },
		{ data: "time" },
		{
			defaultContent: `<button type='button' name='editButton' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		{
			defaultContent: `<button type='button' name='deleteButton' class='btn btn-danger'>
                                    Eliminar
                                  <i class="fas fa-times"></i>
                              </button>`,
		},
	],
});

let edit= false;
let currentID= 0;

$("#table-ht").on("click", "button", function () {
	let data = tabla_ht.row($(this).parents("tr")).data();
	if ($(this)[0].name == "deleteButton") {
		swal({
			title: `Eliminar dato`,
			icon: "warning",
			text: `¿Está seguro/a de Eliminar el dato: "${data.id}"?`,
			buttons: {
				confirm: {
					text: "Bloquear/Desbloquear",
					value: "exec",
				},
				cancel: {
					text: "Cancelar",
					value: "cancelar",
					visible: true,
				},
			},
		}).then((action) => {
			if (action == "exec") {
				deleted(data.id);
			} else {
				swal.close();
			}
		});
	}else { 
		edit=true;
		currentID=data.id;
        $("#title_modal").text("Editar registro");
		$('#id_medidas').val(data.id);
		$('#dato').val(data.dato);
		$('#speed').val(data.speed);
		$('#presion').val(data.presion);
	    $('#caudal').val(data.caudal);
	    $('#time').val(data.time);
        $("#medidas").modal("show");
        
	}
});

		
get_info_ht = () =>{

    id= $("#ot_number").val();
 
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/get_info_ht/${id}`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
			
			let info = xhr.response[0].extra_info;

		    if(info){
			data = JSON.parse(info);
		    
			data.forEach((item,index)=>{
				  medida[index] = item;
			});
			
            tabla_ht.clear();
			tabla_ht.rows.add(data);
			tabla_ht.draw();
		}else { 
			medida=[];
			tabla_ht.clear();
			tabla_ht.rows.add("");
			tabla_ht.draw();
		}
		
        }
	});
	xhr.send();
}

// Delete by id
deleted= (key) =>{
 
    id= $("#ot_number").val();

	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/get_info_ht/${id}`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
			let info = xhr.response[0].extra_info;
			info = JSON.parse(info);
			update =  data.filter(function(item) {
				return item.id != key;
			});//filter all "id"  different to "key_id" 
			data =JSON.stringify(update);

			$.ajax({
				data: {
					data
				},
				type: "POST",
				url: host_url + `api/editInfoHt/${id}`,
				crossOrigin: false,
				dataType: "json",
				success: () => {
						get_info_ht();
						medida=[];
				},
				error: () => {
					swal({
						title: "Denegado!",
						icon: "error",
						text: "No se han podido eliminar los datos ",
					}).then(() => {
					 swal.close();
					});	 
				},
			});     
	}
});
  xhr.send();
	
}

edit_by_info= (key) =>{
    
   valid = true;
   if($('#dato').val()== ""){ valid = false; }
   if($('#speed').val()== ""){ valid = false; }
   if($('#presion').val()== ""){ valid = false; }
   if($('#caudal').val()== ""){ valid = false; }
   if($('#time').val()== ""){ valid = false; }

   if(valid){

	id= $("#ot_number").val(); 
	let data1 = {
		id:1, 
		dato:$('#dato').val(),
		speed:$('#speed').val(),
		presion:$('#presion').val(),
		caudal:$('#caudal').val(),
		time:$('#time').val(),
	};

	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/get_info_ht/${id}`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
			let info = xhr.response[0].extra_info;
			update = JSON.parse(info);
	
			update.forEach((item)=>{
				if(item.id === key) {
					item.dato=data1.dato;
					item.speed=data1.speed;
					item.presion=data1.presion;
					item.caudal=data1.caudal;
					item.time=data1.time;
				}
		  });
      
		  data =JSON.stringify(update);
		 
			$.ajax({
				data: {
					data
				},
				type: "POST",
				url: host_url + `api/editInfoHt/${id}`,
				crossOrigin: false,
				dataType: "json",
				success: () => {
					swal({
						title: "Exito",
						icon: "success",
						text: "El registro se edito con exito",
					}).then(() => {
						swal.close();
						$("#medidas").modal("hide");
						get_info_ht();
						medida=[];
					   });	 
						
				},
				error: () => {
					swal({
						title: "Denegado!",
						icon: "error",
						text: "No se han podido eliminar los datos ",
					}).then(() => {
					 swal.close();
					});	 
				},
			});     
       }
});
		
xhr.send();

}else { 
	swal({
		title: "Registro denegado!",
		icon: "error",
		text: "Complete  todos los campos  ",
	}).then(() => {
	 swal.close();
	});	 


}

	
}




// create register  
edit_info =()=>{

	valid = true;
	if($('#dato').val()== ""){ valid = false; }
	if($('#speed').val()== ""){ valid = false; }
	if($('#presion').val()== ""){ valid = false; }
	if($('#caudal').val()== ""){ valid = false; }
	if($('#time').val()== ""){ valid = false; }
	if(valid){

	id= $("#ot_number").val();
    let data1 = {
			id:1, 
			dato:$('#dato').val(),
			speed:$('#speed').val(),
			presion:$('#presion').val(),
			caudal:$('#caudal').val(),
			time:$('#time').val(),
		};

	if(medida.length === 0){ medida.push(data1);
	}else{  medida.push(data1);
	        medida.forEach((item,index)=>{ //actualiza id  para cada registro en orden creciente
		    item.id= index;
	});}
	
	data=JSON.stringify(medida);
	
	$.ajax({
		data: {
			data
		},
		type: "POST",
		url: host_url + `api/editInfoHt/${id}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Exito",
				icon: "success",
				text: "El registro se creo con éxito.",
				button: "OK",
			}).then(() => {
				get_info_ht();
				$("#medidas").modal("hide");
				medida=[];
		
			   });	 
		},
		error: (result) => {
			swal({
				title: "Denegado!",
				icon: "error",
				text: result.responseJSON.msg,
			}).then(() => {
			 swal.close();
			});	 
		},
	});

}else { 
   
	swal({
		title: "Registro denegado!",
		icon: "error",
		text: "Complete todos lo campos.  ",
	}).then(() => {
	 swal.close();
	});	 

}
	
	};
    
clearInput=()=> { 
	$("#title_modal").text("Agragar registro ");
	$('#dato').val("");
	$('#speed').val("");
    $('#presion').val("");
    $('#caudal').val("");
	 $('#time').val("");

};

$("#btn_hidraulic").on("click", edit_ht);

$("#btn_information").on("click", ()=>{	
	edit=false;
	clearInput();
	$("#medidas").modal("show");});


$("#edit_information").on("click", ()=>{
 if(edit){ 
	edit_by_info(currentID);
 }else { 
	edit_info();
 }
});
 



