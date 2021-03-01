
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
            evaluation= JSON.parse(data);
            $( "#date_evaluation" ).val(evaluation.date_evaluation);
            $( "#description_ev" ).val(evaluation.description);
            $( "#notes" ).val(evaluation.notes);
            $( "#technical" ).val(technical);
			technicals_user = xhr.response[0].user_assignment;
			
		}else { 
            alert_not_evaluation(xhr.response.msg);
        }
	});
	xhr.send();
}



edit_evaluation = () => {
    
	event.preventDefault();
	let id = $("#id_ot").val();//Image ID 
	let data = {
        date_evaluation :$("#date_evaluation").val(),
        description: $("#description_ev").val(),
        notes: $("#notes").val(),
        technical: $("#technical").val(),
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




alert_not_evaluation = (msg)=>{
    $("#evaluation_info" ).css("display","none");
    $("#alert_evaluation").addClass("alert alert-warning col-md-6 mb-3").text("Aviso : "+ msg);
    $("#title_alert").text( "Detalle:");
}



$("#btn_edit").on("click", () => {
	edit_evaluation();
});
















