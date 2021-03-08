$(() => {
    get_data_technical_report();
});

get_data_technical_report = () =>{
    $('#tr_images').empty();
    id= $("#ot_number").val();
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getTechnicalReportByOrder/${id}`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
			let data = xhr.response[0][0].data;
            
			let data_images = xhr.response[0][0].data_images;

            let user = xhr.response[0][0].user;
            
            if(data){
                technical_report = JSON.parse(data);
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
            disabledAlert();
		}else { 
            alert_not_evaluation(xhr.response.msg);
        }
	});
	xhr.send();
}

alert_not_evaluation = (msg)=>{
    $("#technical_report_info" ).css("display","none");
    $("#alert_technical_report").addClass("alert alert-warning col-md-6 mb-3").text("Aviso : "+ msg);
    $("#title_alert").text( "Detalle:");
}

disabledAlert() = () =>{
    $("#technical_report_info" ).show();
    $("#alert_technical_report").removeClass("alert alert-warning col-md-6 mb-3");
    $("#alert_technical_report").text('');
    $("#tr_title_alert").css("display","none");
}