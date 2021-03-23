
$(() => {
    get_data_evaluation();
	getFields();
   
});

let technicals_user = 0; 

get_data_evaluation = () =>{

    id= $("#ot_number").val();
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getEvaluationByOrder/${id}`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
			
			let data = xhr.response[0].details;
			let technical=xhr.response[0].full_name;
			let file=xhr.response[0].export;

        
		
			if(data){
				let evaluation= JSON.parse(data);

				if(evaluation.approve_admin === "true"){$( "#approve_admin_ev" ).prop('checked', true);
				} else {$( "#approve_admin_ev" ).prop('checked', false );}

				if(evaluation.approve_technical === "true"){
				$("#export_ev").show();
				$( "#approve_technical_ev").prop('checked', true);
				
				} else {
					$("#export_ev").css("display","none");
					$( "#approve_technical_ev" ).prop('checked', false );
				}
                
				$( "#date_evaluation").val(evaluation.date_evaluation);
				$( "#description_ev").val(evaluation.description);
				$( "#notes" ).val(evaluation.notes);
				$("#record_path_pdf").val(file);
                 $("#name_technical").val(technical);
				
				
			}else{
				$( "#date_evaluation" ).val('');
				$( "#description_ev" ).val('');
				$( "#approve_technical_ev" ).prop('checked', false);
			    $( "#approve_admin_ev" ).prop('checked', false);
				$( "#notes" ).val('');
				$("#record_path_pdf").val("");
			    $("#name_technical").val("");
			}

			if(technical){
				let a = $(`option[name ="${technical}"]`).val();
				$("#technical").val(a);
			}else{
				$("#technical").val('');
			}
			technicals_user = xhr.response[0].user_assignment;
			disabledAlertEv();
		}else { 
            alert_not_evaluation(xhr.response.msg);
        }

	});
	xhr.send();
}


alert_not_evaluation = (msg)=>{
	
    $("#evaluation_info" ).css("display","none");
    $("#alert_evaluation").addClass("alert alert-warning col-md-6 mb-3").text("Aviso : "+ msg);
    $("#title_alert_ev").text( "Detalle:");
}

disabledAlertEv= () =>{
    $("#evaluation_info" ).show();
    $("#alert_evaluation").removeClass("alert alert-warning col-md-6 mb-3");
    $("#alert_evaluation").text('');
    $("#title_alert_ev").css("display","none");
}




$("#hab_edit_ev").change(() => { 
	let check = $('#hab_edit_ev').is(':checked');
	if(check){
        $( "#date_evaluation" ).prop( "disabled", false );
        $( "#description_ev" ).prop( "disabled", false );
        $( "#notes" ).prop( "disabled", false );
        $( "#technical" ).prop( "disabled", false );
		$( "#approve_admin_ev" ).prop( "disabled", false );
        $( "#approve_technical_ev" ).prop( "disabled", false );
		$("#date_evaluation").datepicker({
            showOn: "button",
            buttonText: "Calendario",
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            buttonImage: host_url + 'assets/img/about/calendario2.png',
        });
	
	}else{
        $( "#date_evaluation" ).prop( "disabled", true );
        $( "#description_ev" ).prop( "disabled", true);
        $(  "#notes").prop( "disabled", true );
        $(  "#technical").prop( "disabled", true );
		$( "#approve_admin_ev" ).prop( "disabled", true );
        $( "#approve_technical_ev" ).prop( "disabled", true );
		$( "#id_ot" ).prop( "disabled", true );
		$("#date_evaluation").datepicker("destroy");	

		
	}
});


edit_evaluation = () => {
    
	event.preventDefault();
	let id = $("#id_ot").val();//Image ID 
	let data = {
		id : $("#id_ot").val(),
        date_evaluation :$("#date_evaluation").val(),
        description: $("#description_ev").val(),
        notes: $("#notes").val(),
        technical: $("#technical").val(),
		name_technical:  $("#name_technical").val(),
		old_pdf: $("#record_path_pdf").val(),
		approve_technical: $("#approve_technical_ev").is(':checked'),
		approve_admin: $("#approve_admin_ev").is(':checked'),
		
	};

	Object.keys(data).map((d) => $(`.${d}`).hide());
	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + `api/editEvaluation/${id}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Exito",
				icon: "success",
				text: result.msg,
                button: "OK",
			}).then(() => {
				get_data_evaluation();
				$('#hab_edit_ev').prop( "checked", false );
				$( "#date_evaluation" ).prop( "disabled", true );
				$( "#description_ev" ).prop( "disabled", true);
				$( "#notes" ).prop( "disabled", true );
				$( "#approve_admin_ev" ).prop( "disabled", true );
				$( "#approve_technical_ev" ).prop( "disabled", true );
				$( "#technical" ).prop( "disabled", true );
				$("#date_evaluation").datepicker("destroy");	

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



let technicals = [];

getFields = () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getFieldsOrder`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            if(technicals.length == 0){
				
                xhr.response[2].map((u) => {
                    let option = document.createElement("option"); 
                    $(option).val(u.id); 
                    $(option).attr('name', u.full_name);
                    $(option).html(u.full_name); 
                    $(option).appendTo("#technical");
					$("#technical").val(technicals_user);
                     technicals.push(u.full_name);
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

showExportEvaluation = ()=>{ 

	id= $("#ot_number").val();
 
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getEvaluationByOrder/${id}`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
			    
			$file=xhr.response[0].export; //definir en base de datos 
			$url= host_url+$file;
			console.log($url);
			window.open($url);
		
        }else { 
			
			swal({
				title: "Error",
				icon: "error",
				text:  "Error al cargar el archivo ",
			});
		}
	});
	xhr.send();
}


$("#btn_edit").on("click", () => {
	edit_evaluation();
});

$("#btn_export_ev").on("click",showExportEvaluation );








