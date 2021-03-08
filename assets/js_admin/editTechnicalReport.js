$(() => {
    get_data_technical_report();
});
let cont = 0;
let tr_id_images = [];
let tr_file_images = [];
let tr_technicals = [];
let id_image_change;
let id_file_change;
let img_header = false;
let img_header_file = '';


const tr_table_images = $('#tr_table_images').DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        {
            "targets": [ 0 ],
            "visible": false,
            "searchable": false,
        },
        { "width": "15%", "targets": [2,3]},
		{ "width": "30%", "targets": 1 },
		{ "width": "5%", "targets": 0 },
		{ className: "text-center", "targets": [1,2,3,4]}
	  ],
	columns: [
        { data: "id" },
        { data: "name" },
        { data: "files",
          render: function(data){
              binary = data;
              return '<img src="'+host_url+"assets/upload/"+binary+'" width="200" heigth="200"/>';
          } 
        },
		{
            defaultContent: `<button type='button' name='tr_btn_look_image' class='btn btn-primary'>
                                 Ver 
								 <i class="fas fa-eye"></i>
                              </button>`,
		},
		{
            defaultContent: `<button type='button' name='tr_btn_select_image' class='btn btn-primary'>
                                <i class="fas fa-hand-pointer"></i>
                              </button>`,
		}, 
	],
});

get_data_technical_report = () =>{
    $('#tr_images').empty();
    id= $("#ot_number").val();
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getTechnicalReportByOrder/${id}`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            console.log('entro ')
			let data = xhr.response[0][0].data;
            
			let data_images = xhr.response[0][0].data_images;

            let user = xhr.response[0][0].user;
            
            if(data){
                technical_report = JSON.parse(data);
                console.info(xhr.response[0][0].data);
                console.info(technical_report);
                $("#tr_date_technical_report").val(technical_report.date_technical_report);
                $("#tr_details").val(technical_report.details);
                $("#tr_notes").val(technical_report.notes);
                if(technical_report.check_adm === 'true'){
                    $("#tr_check_adm").prop("checked", true);
                }else{
                    $("#tr_check_adm").prop("checked", false);
                }
                if(technical_report.check_technical === 'true'){
                    $("#tr_check_technical").prop("checked", true);
                }else{
                    $("#tr_check_technical").prop("checked", false);
                }
                
                $("#tr_image_header").attr('src',`${host_url}assets/upload/${technical_report.image_header}`);;
                img_header_file = technical_report.image_header;
                $("#tr_conclusion").val(technical_report.conclusion);
                $("#tr_recommendation").val(technical_report.recommendation);
            }

            if(data_images){
                technical_report_images = JSON.parse(data_images);
                $.each(technical_report_images, function(i, item) {
                    let image = "<div id='tr_div_details_image_"+item.id+"'><div class='row mb-2'><div class='col-md-5 mb-3'><label id='tr_label_image_"+item.id+"'>Imagen</label><button id='tr_btn_image_"+item.id+"' onclick='loadImages("+item.id+")' class='btn btn-primary' style='margin-right: 5px; margin-bottom: 5px; display:none;'><i class='fas fa-plus'></i>Seleccione imagen</button><div class='input-group'><img style='display:block;margin:auto;' width='400' heigth='400' id='tr_image_file_"+item.id+"' src='http://localhost/hidrat/assets/upload/"+item.image+"' width='100%' class='responsive'></div></div>"
                    let minus = "<div class='col-md-7 mb-3'><div name='tr_delete_' id='tr_delete_"+item.id+"' style='text-align: right; display:none;'><button class='btn btn-danger rounded-circle' id='tr_btn_delete_"+item.id+"' onclick='deleteFields("+item.id+")'><i class='fas fa-minus'></i></button></div>"
                    let name = "<div><label>Nombre</label><div class='input-group'><input value="+item.name+" type='text' class='form-control' id='tr_image_name_"+item.id+"' readonly></div></div>"
                    let description = "<div style='padding-top: 15px;'><label>Descripción</label><div class='input-group'><textarea type='text' rows='6' class='form-control' id='tr_image_description_"+item.id+"' readonly>"+item.description+"</textarea></div></div></div></div><hr></div>"
                    let admin_images = image+minus+name+description;
                    $(admin_images).appendTo("#tr_images"); 
                    tr_id_images.push(item.id);
                    tr_file_images.push(item.image);
                });
            }

            if(tr_technicals.length == 0){
                xhr.response[1].map((u) => {
                    let option = document.createElement("option"); 
                    $(option).val(u.id); 
                    $(option).attr('name', u.full_name);
                    $(option).html(u.full_name); 
                    $(option).appendTo("#tr_technical");
                    tr_technicals.push(u.full_name);
                });
            }

            if(user){
                $("#tr_technical").val(user);
            };
            disabledAlertTr();
		}else { 
            alertNotTechnical(xhr.response.msg);
        }
	});
	xhr.send();
}

enableFields = ()=>{
    a = $("#tr_btnEdit").val();
    if(a == 0){
        $("#tr_date_technical_report").attr("readonly", false);
        $("#tr_technical").attr("readonly", false);
        $("#tr_details").attr("readonly", false);
        $("#tr_notes").attr("readonly", false);
        $("#tr_conclusion").attr("readonly", false);
        $("#tr_recommendation").attr("readonly", false);
        $("#tr_technical").removeAttr("disabled");
        $("#tr_check_adm").removeAttr("disabled");
        $("#tr_check_technical").removeAttr("disabled");
        for(let i=0; i < tr_id_images.length; i++){
            $("#tr_image_description_"+tr_id_images[i]).attr("readonly", false);
            $("#tr_delete_"+tr_id_images[i]).show();
            $("#tr_label_image_"+tr_id_images[i]).hide();
            $("#tr_btn_image_"+tr_id_images[i]).show();
        }
        $("#tr_date_technical_report").datepicker({
            showOn: "button",
            buttonText: "Calendario",
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            buttonImage: host_url + 'assets/img/about/calendario2.png',
        });
        $("#tr_div_add").show();
        $("#tr_btn_image_header").show();
        $("#tr_label_image_header").hide();
        $("#tr_btnEdit").val(1);
        $("#tr_btnEdit").removeClass("btn btn-success");
        $("#tr_btnEdit").addClass("btn btn-danger");
        $("#tr_btnEdit").text("Cancelar");
        $("#tr_btnSave").show();
    }else if(a==1){
        $("#tr_date_technical_report").attr("readonly", true);
        $("#tr_technical").attr("readonly", true);
        $("#tr_details").attr("readonly", true);
        $("#tr_notes").attr("readonly", true);
        $("#tr_conclusion").attr("readonly", true);
        $("#tr_recommendation").attr("readonly", true);
        $("#tr_technical").attr("disabled", true);
        $("#tr_check_adm").attr("disabled", true);
        $("#tr_check_technical").attr("disabled", true);
        $("#tr_date_technical_report").datepicker("destroy");

        $("#tr_div_add").hide();
        $("#tr_btn_image_header").hide();
        $("#tr_label_image_header").show();
        $('#tr_images').empty();
        $("#tr_btnEdit").val(0);
        $("#tr_btnEdit").removeClass("btn btn-danger");
        $("#tr_btnEdit").addClass("btn btn-success");
        $("#tr_btnEdit").text("Editar");
        $("#tr_btnSave").hide();
        get_data_technical_report();
    }
}

createFields = () =>{
    let cont;
    if(tr_id_images.length > 0){
        cont = Math.max(...tr_id_images)+1;
    }else{
        cont =1;
    }
    
    let image = "<div id='tr_div_details_image_"+cont+"'><div class='row mb-2'><div class='col-md-5 mb-3'><button id='tr_btn_image_"+cont+"' onclick='loadImages("+cont+")' class='btn btn-primary' style='margin-right: 5px; margin-bottom: 5px;'><i class='fas fa-plus'></i>Seleccione imagen</button><div class='input-group'><img style='display:block;margin:auto;' width='400' heigth='400' src='' id='tr_image_file_"+cont+"' width='100%' class='responsive'></div></div>"
    let minus = "<div class='col-md-7 mb-3'><div name='tr_delete_' id='tr_delete_"+cont+"' style='text-align: right;'><button class='btn btn-danger rounded-circle' id='tr_btn_delete_"+cont+"' onclick='deleteFields("+cont+")'><i class='fas fa-minus'></i></button></div>"
    let name = "<div><label>Nombre</label><div class='input-group'><input type='text' class='form-control' id='tr_image_name_"+cont+"' readonly></div></div>"
    let description = "<div style='padding-top: 15px;'><label>Descripción</label><div class='input-group'><textarea type='text' rows='6' class='form-control' id='tr_image_description_"+cont+"'></textarea></div></div></div></div><hr></div>"
    let admin_images = image+minus+name+description;
    $(admin_images).appendTo("#tr_images"); 
}

deleteFields = (id) => {
    let position_file_change;

    for(i=0; i< tr_id_images.length ;i++){
        let number2 = parseInt(tr_id_images[i]);
        if(id === number2){
            position_file_change = i;
        }
    }

    tr_id_images = jQuery.grep(tr_id_images, function(value) {
        return value != id;
    });

    tr_file_images = jQuery.grep(tr_file_images, function(value) {
        return value != tr_file_images[position_file_change];
    });

    $('#tr_div_details_image_'+id).remove();
}

saveTechnicalReport = () =>{
    let details_images = [{}];
    if(tr_id_images.length==0){
        details_images = null;
    }else{
        for(i=0; i<(tr_id_images).length; i++){
            details_images.push({
                "id" : tr_id_images[i],
                "name" : $('#tr_image_name_'+tr_id_images[i]).val(), 
                "image" : tr_file_images[i],
                "description" : $('#tr_image_description_'+tr_id_images[i]).val(),  
            });
        }
    }

    data = {
        date_technical_report: $('#tr_date_technical_report').val(),
        image_header: img_header_file,
        details : $('#tr_details').val(),
        notes : $('#tr_notes').val(),
        check_adm :  $('#tr_check_adm').is(':checked'),
        check_technical : $('#tr_check_technical').is(':checked'),
        conclusion : $('#tr_conclusion').val(),
        recommendation : $('#tr_recommendation').val(),
        details_images: details_images,
        technical : $('#tr_technical').val(),
        ot_id : $("#ot_number").val(),
    } 

    $.ajax({
        type: "POST",
        url: host_url + "api/editTechnicalReport",
        data: {data},
        dataType: "json",
        success: () => {
         swal({
             title: "Éxito!",
             icon: "success",
             text: "Reporte técnico actualizado con éxito.",
             button: "OK",
         }).then(() => {
            $("#tr_btnEdit").val('1');
            cont = 0;
            tr_id_images = [];
            tr_file_images = [];
            id_image_change ='';
            id_file_change = '';
            img_header = false;
            img_header_file = '';
            enableFields();
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

$("#tr_table_images").on("click", "button", function () {
    let data = tr_table_images.row($(this).parents("tr")).data();

    if ($(this)[0].name == "tr_btn_look_image") {
		url = `${host_url}assets/upload/${data.files}`;
	    $('.imagepreview').attr('src',url);
		$('#tr_show_image').modal('show');   
	}else if($(this)[0].name == "tr_btn_select_image"){

        if(img_header == true){
            $('#tr_image_header').attr('src',`${host_url}assets/upload/${data.files}`);
            img_header_file = data.files;
            $('#tr_search_image').modal('hide');
        }else if(img_header == false){
            $('#tr_div_details_image_'+id_image_change).attr("id","tr_div_details_image_"+data.id);

            $('#tr_image_name_'+id_image_change).val(data.name);
            $('#tr_image_name_'+id_image_change).attr("id","tr_image_name_"+data.id);
    
            $('#tr_image_file_'+id_image_change).attr('src',`${host_url}assets/upload/${data.files}`);
            $('#tr_image_file_'+id_image_change).attr("id","tr_image_file_"+data.id);
    
            $('#tr_image_description_'+id_image_change).attr("id","tr_image_description_"+data.id);
    
            $('#tr_btn_image_'+id_image_change).attr("id","tr_btn_image_"+data.id);
            $("#tr_btn_image_"+data.id).attr("onclick", "loadImages("+data.id+")");
    
            $('#tr_btn_delete_'+id_image_change).attr("id","tr_btn_delete_"+data.id);
            $("#tr_btn_delete_"+data.id).attr("onclick", "deleteFields("+data.id+")");
            
            let position_file_change;
            for(i=0; i< tr_id_images.length ;i++){
                if(tr_id_images[i] == id_image_change){
                    position_file_change = i;
                }
            }
    
            tr_id_images = jQuery.grep(tr_id_images, function(value) {
                return value != id_image_change;
            });
    
            tr_file_images = jQuery.grep(tr_file_images, function(value) {
                return value != tr_file_images[position_file_change];
            });
    
            tr_id_images.push(data.id);
            tr_file_images.push(data.files);
            $('#tr_search_image').modal('hide');
        }
        img_header = false;
    }
});

loadImages = (id) =>{
    let data;
    if(tr_file_images.length == 0 || id == null){
        data = {
            ot_id : $("#ot_number").val(),
            images : null,
        }
        if(id == null){
            img_header = true;
        }
    }else{
        data = {
            ot_id : $("#ot_number").val(),
            images : tr_id_images,
        }
    }

    $.ajax({
        type: "POST",
        url: host_url + "api/getImagesByTechnicalReport",
        data: {data},
        dataType: "json",
        success: (xhr) => {
            console.info(xhr);
            tr_table_images.clear();
			tr_table_images.rows.add(xhr);
			tr_table_images.draw();
            id_image_change = id;
            $("#tr_search_image").modal();
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

alertNotTechnical = (msg)=>{
    $("#technical_report_info" ).css("display","none");
    $("#alert_technical_report").addClass("alert alert-warning col-md-6 mb-3").text("Aviso : "+ msg);
    $("#tr_title_alert").text( "Detalle:");
}

disabledAlertTr = () =>{
    $("#technical_report_info" ).show();
    $("#alert_technical_report").removeClass("alert alert-warning col-md-6 mb-3");
    $("#alert_technical_report").text('');
    $("#tr_title_alert").css("display","none");
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

$("#tr_btn_add").on("click", createFields);

$("#tr_btnEdit").on("click", enableFields);

$("#tr_btnSave").on("click", saveTechnicalReport);
