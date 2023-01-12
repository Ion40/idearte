<script>
    $(document).ready(function () { 
        cargarUsuarios();
        $("#listAreas").select2({
			placeholder: '--- Seleccione un Area ---',
			allowClear: true,
			ajax: {
				url: 'getAreasAjax',
				dataType: 'json',
				type: "POST",
				quietMillis: 100,
				data: function (params) {
					let queryParameters = {
						q: params.term
					}

                    return queryParameters;
				},
				processResults: function (data) {
					let res = [];
					for(let i  = 0 ; i < data.length; i++) {
						res.push({id:data[i].IdArea, text:data[i].NombreArea});
					}
					return {
						results: res
					}
				},
				cache: true
			}
		}
	).trigger('change.select2');
     });

$("#Confirmpassword").on("keyup", function(){
    if($(this).val() != $("#password").val()){
        $("#password").addClass("is-invalid");
        $("#Confirmpassword").addClass("is-invalid");
    }else{
        $("#password").removeClass("is-invalid");
        $("#Confirmpassword").removeClass("is-invalid");
        $("#password").addClass("is-valid");
        $("#Confirmpassword").addClass("is-valid");
    }
});     

function cargarUsuarios(){
	let table = $("#tblUsuarios").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: true,
        destroy: true,
		"ajax": {
			"url": "getUsuariosAjaxDt",
			"type": "POST"
		},
        columns: [
                { data: "Usuario"},
                { data: "Nombre"},
                { data: "Puesto"},
                { data: "Telefono"},
                { data: "Area"},
                { data: "Estado"},
                { data: "FechaCrea"},
                { data: "Opciones"}
            ],
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
													'</svg>',
                "loadingRecords": "",
			    "processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url()?>assets/img/loading.gif'></i></div>",
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
}

$("#btnAddUser").click(function(){
    $("#modalTitle").text("Nuevo Usuario");
    $("#btnGuardarUser").show();
    $("#password").prop("readonly", false);
    campos = document.querySelectorAll("#campos input.form-control");
    [].slice.call(campos).forEach(function (campo) {
        $("#" + campo.id).removeClass("is-invalid");
        campo.value = "";
     });
    $("#btnActualizarUser").hide();
    
    $("#btnMas").removeClass("active");
    $("#btnFem").removeClass("active");
    $("#chkmasculino").prop("checked",true);
    $("#btnMas").addClass("active");
    $("#password").removeClass("is-valid");
    $("#Confirmpassword").removeClass("is-valid");

    $("#listAreas option:selected").val("").trigger("change");


    $("#modalUser").modal("show");
});

$("#btnGuardarUser").click(function () {
	$("#loading").modal("show");

	let campos, valido;
	campos = document.querySelectorAll("#campos input.form-control");
	valido = true;

	[].slice.call(campos).forEach(function (campo) {

		$("#" + campo.id).removeClass("is-invalid");

		if (campo.value.trim() === '') {
			valido = false;
			$("#" + campo.id).addClass("is-invalid");
		}

	});

	if (valido) {
        let banera = true, valida = false;
		if(!$("#listAreas option:selected").val()){
            $("#loading").modal("hide");
            bandera = false;
            Swal.fire({
                allowOutsideClick: false,
                icon: "warning",
                text: "Debe seleccionar un área",
                confirmButtonText: "cerrar",
                customClass: {
                            confirmButton: "btn btn-primary"
                        }
            });
        }else{
            bandera = true;
            valida = true;
        }

        if(bandera){
           let mensaje = "", icon = "", genero = "";

            if($("#chkmasculino").prop("checked") == true){
                genero = 1;
            }else if($("#chkfemenino").prop("checked") == true){
                genero = 2;
            }

           let form_data = {
            idArea: $("#listAreas option:selected").val(),
            user: $("#nombreuser").val(),
            pass: $("#password").val(),
            nombre: $("#nombre").val(),
            puesto: $("#puesto").val(),
            telefono: $("#telefono").val(),
            genero: genero
           };

           if($("#Confirmpassword").val() != $("#password").val()){
                $("#loading").modal("hide");    
                $("#password").addClass("is-invalid");
                $("#Confirmpassword").addClass("is-invalid");
                Swal.fire({
                    allowOutsideClick: false,
                    icon: "warning",
                    text: "Las contraseñas no coinciden",
                    confirmButtonText: "cerrar",
                    customClass: {
                                confirmButton: "btn btn-primary"
                            }
                });
            }else{
                $("#password").removeClass("is-invalid");
                $("#Confirmpassword").removeClass("is-invalid");
                $.ajax({
                    url: "guardarUser",
                    type: "POST",
                    data: form_data,
                    success: function(data){
                        let obj = jQuery.parseJSON(data);
                        $.each(obj, function(i, key){
                            mensaje = key["mensaje"];
                            icon = key["tipo"];
                        });

                        Swal.fire({
                            text: mensaje,
                            icon: icon,
                            allowOutsideClick: false,
                            customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                        }).then((result) => {
                            $("#loading").modal("hide");
                            $("#modalUser").modal("hide");
                            cargarUsuarios();
                        });
                    }
                });
            }
        }
	} else {
		$("#loading").modal("hide");

		Swal.fire({
			allowOutsideClick: false,
			icon: "warning",
			text: "Todos los campos son obligatorios",
			confirmButtonText: "cerrar",
            customClass: {
						confirmButton: "btn btn-primary"
					}
		});
	}
});

function editar(iduser,user,nombre,puesto,telefono,genero,idarea,area){//,idrol,rol,idarea,area,genero,solicita,aut){
    $("#modalTitle").text("Editar Usuario");
    $("#btnGuardarUser").hide();
    $("#btnActualizarUser").show();
    $("#password").prop("readonly", true);
    $("#password").val("000000000");
    $("#iduser").val(iduser);
    $("#nombreuser").val(user);
    $("#nombre").val(nombre);
    $("#puesto").val(puesto);
    $("#telefono").val(telefono);
    if(genero == 1){
        $("#chkmasculino").prop("checked",true);
        $("#btnMas").addClass("active");
        $("#btnFem").removeClass("active");
    }else{
        $("#chkfemenino").prop("checked", true)
        $("#btnFem").addClass("active");
        $("#btnMas").removeClass("active");
    }

    $("#listAreas option:selected").val(idarea).trigger("change");
    //$("#listAreas option:selected").text(area).trigger("change");
    $("#select2-listAreas-container").text(area).trigger("change");

    $("#modalUser").modal("show");
}

function baja(iduser, estado){
	let mensaje = "", textoBoton = "";
	if(estado == "A"){
		mensaje = "¿Estas segur@ que deseas dar de baja este Usuario?";
		textoBoton = "Dar de baja";
	}else{
		mensaje = "¿Estas segur@ que deseas dar de alta este Usuario?";
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
        cancelButtonText: "Cancelar",
		allowOutsideClick: false
		}).then((result) => {
		if (result.isConfirmed) {
			let mensaje = '', tipo = '';
			let form_data = {
				iduser: iduser,
				estado:	estado
			};

			$.ajax({
				url: "bajaUser",
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
							cargarUsuarios();
						}
					});
				}
			});
		}
	});
}

$("#btnActualizarUser").click(function(){
    $("#loading").modal("show");

	let campos, valido;
	campos = document.querySelectorAll("#campos input.form-control");
	valido = true;

	[].slice.call(campos).forEach(function (campo) {

		$("#" + campo.id).removeClass("is-invalid");

		if (campo.value.trim() === '') {
			valido = false;
			$("#" + campo.id).addClass("is-invalid");
		}

	});

	if (valido) {
        let banera = true, jefe = "", valida = false;
		if($("#listRoles option:selected").val() == "" || !$("#listAreas option:selected").val()){
            $("#loading").modal("hide");
            bandera = false;
            Swal.fire({
                allowOutsideClick: false,
                icon: "warning",
                text: "Debe seleccionar un rol y un área",
                confirmButtonText: "cerrar",
                customClass: {
                            confirmButton: "btn btn-primary"
                        }
            });
        }else{
            bandera = true;
            valida = true;
        }

        if(valida){
            if($("#chksolicita").prop("checked") == false && $("#chkautoriza").prop("checked") == false){
                $("#loading").modal("hide");
                bandera = false;
                Swal.fire({
                    allowOutsideClick: false,
                    icon: "warning",
                    text: "Debe seleccionar una opcion de autorización",
                    confirmButtonText: "cerrar",
                    customClass: {
                                confirmButton: "btn btn-primary"
                            }
                });
            }else{
                banera = true;
            }

            if($("#chksolicita").prop("checked") == true){
                if(!$("#listJefes option:selected").val()){
                    $("#loading").modal("hide");
                    bandera = false;
                    jefe = "";
                    Swal.fire({
                        allowOutsideClick: false,
                        icon: "warning",
                        text: "Debe asignar un jefe este usuario",
                        confirmButtonText: "cerrar",
                        customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                    }); 
                }else{
                    jefe = $("#listJefes option:selected").val();
                    bandera = true;
                }
            }else{
                jefe = "";
            }
        }

        if(bandera){
           let mensaje = "", icon = "", genero = "", autoriza = "", solicita = "";

            if($("#chkmasculino").prop("checked") == true){
                genero = 1;
            }else if($("#chkfemenino").prop("checked") == true){
                genero = 2;
            }

            if($("#chksolicita").prop("checked") == true){
                solicita = true;
                autoriza = false;
            }else if($("#chkautoriza").prop("checked") == true){
                solicita = false;
                autoriza = true;
            }

           let form_data = {
            idUser: $("#iduser").val(),
            idArea: $("#listAreas option:selected").val(),
            user: $("#nombreuser").val(),
            nombre: $("#nombre").val(),
            puesto: $("#puesto").val(),
            telefono: $("#telefono").val(),
            genero: genero
           };

           //console.log(form_data);
         $.ajax({
              url: "actualizarUser",
              type: "POST",
              data: form_data,
              success: function(data){
                  let obj = jQuery.parseJSON(data);
                  $.each(obj, function(i, key){
                      mensaje = key["mensaje"];
                      icon = key["tipo"];
                  });

                  Swal.fire({
                      text: mensaje,
                      icon: icon,
                      allowOutsideClick: false,
                      customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                  }).then((result) => {
                    $("#loading").modal("hide");
                    $("#modalUser").modal("hide");
                    cargarUsuarios();
                  });
              }
          });
        }
	} else {
		$("#loading").modal("hide");

		Swal.fire({
			allowOutsideClick: false,
			icon: "warning",
			text: "Todos los campos son obligatorios",
			confirmButtonText: "cerrar",
            customClass: {
						confirmButton: "btn btn-primary"
					}
		});
	}
});

$("#btnMas").click(function () {
    $("#chkmasculino").prop("checked",true);
    $("#chkfemenino").prop("checked",false);
});
$("#btnFem").click(function () {
    $("#chkfemenino").prop("checked",true);
    $("#chkmasculino").prop("checked",false);
});

</script>