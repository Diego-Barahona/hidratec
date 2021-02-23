
$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
    },
});

$(() => {
    getImages();
});

$("#name_e").change(() => { 
	let name = $("#name_e").val();
	if(name){
		$("#frm_name > input").removeClass("is-invalid");
	}else{
		$("#frm_name > input").addClass("is-invalid");
	}
});




const tabla = $('#table_images').DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
		{ "width": "15%", "targets": [2,3]},
		{ "width": "30%", "targets": 1 },
		{ "width": "5%", "targets": 0 },
		{ className: "text-center", "targets": [1,2,3]} ,
	  ],
	columns: [
    
        { data: "name" },
        { data: "files",
          render: function(data){
              binary = data;
              return '<img src="'+host_url+"assets/upload/"+binary+'" width="200" heigth="200"/>';
          } 
        },
		
		{
            defaultContent: `<button type='button' name='btn_look' class='btn btn-primary'>
                                 Ver 
								 <i class="fas fa-eye"></i>
                              </button>`,
		},
		{
            defaultContent: `<button type='button' name='btn_edit' class='btn btn-primary'>
                                  Editar 
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		
	],
});


$("#table_images").on("click", "button", function () {
    let data = tabla.row($(this).parents("tr")).data();
	
	if($(this)[0].name == "btn_look"){
	url = `${host_url}assets/upload/${data.files}`;
	$('.imagepreview').attr('src',url);
		$('#show_image').modal('show');   
		//showImage(url);
	}else {
		
		$("#name_e").val(data.name);
		$("#id_e").val(data.id);//ID image 
		$('input[type=file]').val('');
		$("#editImage").modal("show");
		
	}
    
});

getImages = () => {
	id= $("#id").val();
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getImagesByOrder/${id}`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
			let data = xhr.response;
			tabla.clear();
			tabla.rows.add(data);
			tabla.draw();
			$("#file").show();
			$("#file_e").show();
		} else {
			swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener las ubicaciones",
			});
		}
	});
	xhr.send();
};


registerImagen = () => {
	event.preventDefault();
	let files = $("#file")[0].files;

	let data = {
		id: $("#id").val(), // OT ID  
		name: $("#name").val(),
		file: files.length
	};
	Object.keys(data).map((d) => $(`.${d}`).hide());
	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/addImage",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			let id = result.id;
			uploadImage(id);
		},
		error: (result) => {
			$("#file").show();
			$("#file_e").show();
		    
			swal({
				title: "Error",
				icon: "error",
				text: "Error: Ingrese nombre (sin repetir uno ya existente) y cargue la imagen.",
			})
		}
				
	});
};

uploadImage = (id) => {
    ot= $("#id").val();
   
	$.ajax({
		data: new FormData(document.getElementById("foto")),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}api/upImage/${id}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha guardado la imagen ",
				button: "OK",
			}).then(() => {
				getImages();
				$("#name").val("");
                $('#file').val('');
				swal.close();
				
		       // let url = 'adminImages'+'?ot='+ot;
		       // window.open(host_url+url);
			});
		},
		error: () => {
			swal({
				title: "Error",
				icon: "error",
				text: "Ha ocurrido un error",
			});
		},
	});
};



$("#addImage").on('click', registerImagen);

 







