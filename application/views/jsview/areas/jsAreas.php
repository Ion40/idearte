<script>
$(document).ready(function () {
	$("#tblAreas").DataTable({
			"lengthMenu": [
				[5, 10, 25, 50, 100, -1],
				[5, 10, 25, 50, 100, "Todo"]
			],
			"order": [
				[2, "desc"]
			],
			"language": {
				"infoEmpty": "Registro 0 a 0 de 0 entradas",
				"zeroRecords": "No se encontro coincidencia",
				"infoFiltered": "(filtrado de _MAX_ registros en total)",
				"emptyTable": "NO HAY DATOS DISPONIBLES",
			    "lengthMenu": "Mostrar _MENU_  registros en tabla",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"search": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'+
														'<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"></path>'+
														'<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"></path>'+
													'</svg>'
			},
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<'table-responsive'tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"
		});
	}); 
 
$("#btnAddArea").click(function(){
    $("#modalTitle").text("Nueva Area");
    $("#idArea").val("");
    $("#nombreArea").val("");
	$("#siglas").val("");
    $("#btnGuardarArea").show()
    $("#btnActualizarArea").hide()
    $("#modalAreas").modal("show");
});

$("#btnGuardarArea").click(function(){
    $("#loading").modal("show");
    if($("#nombreArea").val() == ""){
        $("#loading").modal("hide");
        Swal.fire({
			text: "El campo Nombre Area es obligatorio",
			icon: "warning",
			buttonsStyling: false,
			confirmButtonText: "Cerrar",
			allowOutsideClick: false,
			customClass: {
				confirmButton: "btn btn-primary"
			}
		});
    }else{
        let mensaje = '', tipo = '';
		let form_data = {
			area: $("#nombreArea").val(),
			siglas: $("#siglas").val()
		};

		$.ajax({
			url: "guardarArea",
			type: "POST",
			data: form_data,
			success: function(data){
                $("#loading").modal("hide");
				let obj = jQuery.parseJSON(data);
				$.each(obj, function(i, key){
					mensaje = key["mensaje"];
					tipo = key["tipo"];
				});

				Swal.fire({
					text: mensaje,
					icon: tipo,
					allowOutsideClick: false,
					customClass: {
						confirmButton: "btn btn-primary"
					}
				}).then((result) => {
					if(tipo == "success"){
						location.reload();
					}
				});
			}
		});
    }
});

function editar(idarea,nombrearea,siglas){
    $("#modalTitle").text("Editar Area");
	$("#idArea").val(idarea);
    $("#nombreArea").val(nombrearea);
	$("#siglas").val(siglas);
	$("#btnGuardarArea").hide();
	$("#btnActualizarArea").show();
    $("#modalAreas").modal("show");
}

$("#btnActualizarArea").click(function () {
    $("#loading").modal("show");
    if($("#nombreArea").val() == ""){
        $("#loading").modal("hide");
        Swal.fire({
			text: "El campo Nombre Area es obligatorio",
			icon: "warning",
			buttonsStyling: false,
			confirmButtonText: "Cerrar",
			allowOutsideClick: false,
			customClass: {
				confirmButton: "btn btn-primary"
			}
		});
    }else{
        let mensaje = '', tipo = '';
		let form_data = {
            idarea: $("#idArea").val(),
			area: $("#nombreArea").val(),
			siglas: $("#siglas").val()
		};

		$.ajax({
			url: "actualizarArea",
			type: "POST",
			data: form_data,
			success: function(data){
                $("#loading").modal("hide");
				let obj = jQuery.parseJSON(data);
				$.each(obj, function(i, key){
					mensaje = key["mensaje"];
					tipo = key["tipo"];
				});

				Swal.fire({
					text: mensaje,
					icon: tipo,
					allowOutsideClick: false,
					customClass: {
						confirmButton: "btn btn-primary"
					}
				}).then((result) => {
					if(tipo == "success"){
						location.reload();
					}
				});
			}
		});
    }
}); 


function baja(idarea, estado){
	let mensaje = "", textoBoton = "";
	if(estado == "A"){
		mensaje = "¿Estas segur@ que deseas dar de baja esta Area?";
		textoBoton = "Dar de baja";
	}else{
		mensaje = "¿Estas segur@ que deseas dar de alta esta Area?";
		textoBoton = "Dar de alta";
	}

	Swal.fire({
		text: mensaje,
		icon: 'question',
		showCancelButton: true,
		customClass: {
				confirmButton: "btn btn-primary",
				cancelButton: "btn btn-danger"
			},
		confirmButtonText: textoBoton,
		allowOutsideClick: false
		}).then((result) => {
		if (result.isConfirmed) {
			let mensaje = '', tipo = '';
			let form_data = {
				idArea: idarea,
				estado:	estado
			};

			$.ajax({
				url: "actualizarEstadoArea",
				type: "POST",
				data: form_data,
				success: function(data){
					let obj = jQuery.parseJSON(data);
					$.each(obj, function(i, key){
						mensaje = key["mensaje"];
						tipo = key["tipo"];
					});

					Swal.fire({
						text: mensaje,
						icon: tipo,
						allowOutsideClick: false,
						customClass: {
							confirmButton: "btn btn-primary"
						}
					}).then((result) => {
						if(tipo == "success"){
							location.reload();
						}
					});
				}
			});
		}
	});
}
</script>