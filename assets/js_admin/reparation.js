$(() => {
    get_data_reparation();
});

let r_technicals = [];
let r_check_adm_old = '';

get_data_reparation = () =>{
    
    id= $("#ot_number").val();
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getReparationByOrder/${id}`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            if(r_technicals.length == 0){
                xhr.response[1].map((u) => {
                    let option = document.createElement("option"); 
                    $(option).val(u.id); 
                    $(option).attr('name', u.full_name);
                    $(option).html(u.full_name); 
                    $(option).appendTo("#r_technical");
                    r_technicals.push(u.full_name);
                });
            }

            if(xhr.response[0][0].check_adm == 1){
                $("#r_check_adm").prop("checked", true);
                r_check_adm_old = 'true';
            }else{
                $("#r_check_adm").prop("checked", false);
                r_check_adm_old = 'false';
            }

            if(xhr.response[0][0].check_technical == 1){
                $("#r_check_technical").prop("checked", true);
            }else{
                $("#r_check_technical").prop("checked", false);
            }

            if(xhr.response[0][0].user){
                $("#r_technical").val(xhr.response[0][0].user);
            }else{
                $("#r_technical").val('');
            }

            if(xhr.response[0][0].date){
                $("#r_date_reparation").val(xhr.response[0][0].date);
            }else{
                $("#r_date_reparation").val('');
            }

            if(xhr.response[0][0].days){
                $("#r_days_reparation").val(xhr.response[0][0].days);
            }else{
                $("#r_days_reparation").val('');
            }

            interaction = JSON.parse(xhr.response[0][0].user_interaction);
            date_reparation = interaction.date_reparation;
            technical_assignment = interaction.technical_assignment;
            date_modify = interaction.date_modify;
            user_modify = interaction.user_modify;
            date_approve = interaction.date_approve;
            user_approve = interaction.user_approve;
            $("#r_popover").popover(
                { 
                html: true,
                title: "Información",
                content: "Técnico que realizó la reparación: " + technical_assignment +"<br />"+"Fecha reparación: "+date_reparation+"<br />"+
                        "Modificado por: " +user_modify+"<br />"+"Fecha mod.: "+date_modify+"<br />"+
                        "Aprobado por: " +user_approve+"<br />"+"Fecha aprv.: "+date_approve
                }
            ); 


		}else {
			swal({
				title: "Error",
				icon: "error",
				text: "No se pudo encontrar el recurso",
			});
		}
	});
	xhr.send();
}

r_enableFields = ()=>{
    a = $("#r_btnEdit").val();
    if(a == 0){
        $("#r_date_reparation").attr("readonly", false);
        $("#r_days_reparation").attr("readonly", false);
        $("#r_technical").removeAttr("disabled");
        $("#r_check_adm").removeAttr("disabled");
        $("#r_check_technical").removeAttr("disabled");

        $("#r_date_reparation").datepicker({
            showOn: "button",
            buttonText: "Calendario",
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            buttonImage: host_url + 'assets/img/about/calendario2.png',
        });
        $("#r_btnEdit").val(1);
        $("#r_btnEdit").removeClass("btn btn-success");
        $("#r_btnEdit").addClass("btn btn-danger");
        $("#r_btnEdit").text("Cancelar");
        $("#r_btnSave").show();
    }else if(a==1){
        $("#r_date_reparation").attr("readonly", true);
        $("#r_days_reparation").attr("readonly", true);
        $("#r_technical").attr("disabled", true);
        $("#r_check_adm").attr("disabled", true);
        $("#r_check_technical").attr("disabled", true);
        $("#r_date_reparation").datepicker("destroy");
        $("#r_btnEdit").val(0);
        $("#r_btnEdit").removeClass("btn btn-danger");
        $("#r_btnEdit").addClass("btn btn-success");
        $("#r_btnEdit").text("Editar");
        $("#r_btnSave").hide();
        get_data_reparation();
    }
}

saveReparation = () =>{
    let user_assignment =null;
    let check_adm = 0;
    let check_technical = 0;
    if($("#r_technical").val()) user_assignment = $("#r_technical").val(); else user_assignment = null;
    if($('#r_check_adm').is(':checked')) check_adm = 1; else check_adm = 0;
    if($('#r_check_technical').is(':checked')) check_technical = 1; else check_technical = 0;
    data = {
        check_adm :  check_adm,
        check_technical : check_technical,
        user_assignment : user_assignment,
        ot_id : $("#ot_number").val(),
        days_reparation: $('#r_days_reparation').val(),
        date_reparation: $('#r_date_reparation').val(),
        check_adm_old: r_check_adm_old,
        date_approve: date_approve,
        user_approve: user_approve,
        technical_assignment: $('#r_technical option:selected').text(),
    } 

    $.ajax({
        type: "POST",
        url: host_url + "api/editReparation",
        data: {data},
        dataType: "json",
        success: () => {
         swal({
             title: "Éxito!",
             icon: "success",
             text: "Reparación actualizada con éxito.",
             button: "OK",
         }).then(() => {
            $("#r_btnEdit").val('1');
            $("#r_popover").popover('dispose');
            r_enableFields();
            get_data_reparation();
         });
        }, 
        statusCode: {
         405: (xhr) =>{
            let msg = xhr.responseJSON;
            swal({
                title: "Error",
                icon: "error",
                text: addErrorStyle(msg),
            });
        },
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

/*Función para manejo de errores*/
addErrorStyle = errores => {
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

$("#r_btnEdit").on("click", r_enableFields);

$("#r_btnSave").on("click", saveReparation);
