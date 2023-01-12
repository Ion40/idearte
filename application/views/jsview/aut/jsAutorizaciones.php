<script>
$(document).ready(function () { 
    cargarAutorizaciones();
    $("#listModulos").select2({
			placeholder: '--- Seleccione un Modulo ---',
			allowClear: true,
			ajax: {
				url: 'getModulosAjax',
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
						res.push({id:data[i].IdModuloAut, text:data[i].Descripcion});
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

 $("#listModulos").on("change", function(){
    if($(this).val() != ""){
        $("#nombreAut").val(`${$("#listModulos option:selected").text()}/`);
    }else{
        $("#nombreAut").val("");
    }
 });

$("#btnAddAut").click(function(){
    $("#modalTitle").text("Nueva Autorización");
    $("#listModulos option:selected").val("").trigger("change");
    $("#idAut").val("");
    $("#nombreAut").val("");
    $("#descripcion").val("");
    $("#btnGuardarAut").show();
    $("#btnActualizarAut").hide();

    $("#modalAut").modal("show");
});

$("#btnGuardarAut").on("click", function () { 
    $("#loading").modal("show");
	let campos, valido;
	campos = document.querySelectorAll("#campos .valida");
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
		if(!$("#listModulos option:selected").val()){
            $("#loading").modal("hide");
            bandera = false;
            Swal.fire({
                allowOutsideClick: false,
                icon: "warning",
                text: "Debe seleccionar un módulo",
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
           let mensaje = "", icon = "";

           let form_data = {
            idModulo: $("#listModulos option:selected").val(),
            autorizacion: $("#nombreAut").val(),
            descripcion: $("#descripcion").val()
           };

          $.ajax({
              url: "guardarAut",
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
                    $("#modalAut").modal("hide");
                    cargarAutorizaciones();
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

function cargarAutorizaciones(){
	let table = $("#tblAut").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: true,
        destroy: true,
		"ajax": {
			"url": "getAutorizacionesAjax",
			"type": "POST"
		},
        columns: [
                {data: "IdAutorizacion"},
                {data: "ModuloAut"},
                {data: "Modulo"},
                {data: "Descripcion"},
                {data: "FechaCrea"},
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

</script>