<div class="modal" data-bs-backdrop="static" id="loading" tabindex="-1" role="dialog"
	aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content" style="background-color:transparent;box-shadow: none; border: none;">
			<div class="text-center">
				<img width="130px" src="<?php echo base_url() ?>assets/img/loading.gif">
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalIncidencias1" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
						<div class="modal-dialog mw-850px">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Observaciones correspondiente a la orden n° <span id="spanOrdenIncidencia1"></span></h5>

									<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
										<span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
												fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
													transform="rotate(-45 6 17.3137)" fill="black" />
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
													fill="black" />
											</svg>
										</span>
									</div>
								</div>

								<div class="modal-body card-body">
									<div class="scroll-y mh-325px my-5 px-8" >
										<div class="timeline" id="timeline1">

										</div>
									</div>
								</div>

								<!--<div class="modal-footer">
									<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Save changes</button>
								</div>-->
							</div>
						</div>
					</div>


<!--<div class="position-fixed top-50 end-0 p-3 z-index-3">
    <div id="kt_docs_toast_toggle" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white">
            <span class="svg-icon svg-icon-2 svg-icon-primary me-3">...</span>
            <strong class="me-auto">Keenthemes</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Hello, world! This is a toast message.
        </div>
    </div>
</div>-->


<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script>
	var hostUrl = "";

</script>
<script src="<?php echo base_url() ?>/assets/plugins/global/plugins.bundle.js"></script>
<script src="<?php echo base_url() ?>/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="<?php echo base_url() ?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="<?php echo base_url() ?>/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="<?php echo base_url() ?>/assets/js/widgets.bundle.js"></script>
<script src="<?php echo base_url() ?>/assets/js/custom/widgets.js"></script>
<!--<script src="<?php echo base_url() ?>/assets/js/custom/apps/chat/chat.js"></script>
<script src="<?php echo base_url() ?>/assets/js/custom/modals/create-campaign.js"></script>
<script src="<?php echo base_url() ?>/assets/js/custom/modals/create-app.js"></script>
<script src="<?php echo base_url() ?>/assets/js/custom/modals/upgrade-plan.js"></script>
<script src="<?php echo base_url() ?>/assets/js/custom/modals/create-project/type.js"></script>
<script src="<?php echo base_url() ?>/assets/js/custom/modals/create-project/budget.js"></script>
<script src="<?php echo base_url() ?>/assets/js/custom/modals/create-project/settings.js"></script>
<script src="<?php echo base_url() ?>/assets/js/custom/modals/create-project/team.js"></script>
<script src="<?php echo base_url() ?>/assets/js/custom/modals/create-project/targets.js"></script>
<script src="<?php echo base_url() ?>/assets/js/custom/modals/create-project/files.js"></script>
<script src="<?php echo base_url() ?>/assets/js/custom/modals/create-project/complete.js"></script>-->
<script src="<?php echo base_url() ?>/assets/js/custom/modals/create-project/main.js"></script>
<script src="<?php echo base_url() ?>/assets/js/custom/intro.js"></script>
<script src="<?php echo base_url() ?>/assets/js/jquery.form.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/numeroALetras.js"></script>
<script src="<?php echo base_url() ?>/assets/js/xlsx.full.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/jquery.growl.js"></script>
<script src="<?php echo base_url() ?>/assets/js/fileup.js"></script>
<script src="<?php echo base_url() ?>assets/js/jstree.js"></script>
<script src="<?php echo base_url() ?>assets/js/rowgroup.js"></script>
<script src="<?php echo base_url() ?>assets/js/imgViewer.js"></script>

<!--end::Page Custom Javascript-->
<!--end::Javascript-->
<script>
	let actual = 0;
	$(document).ready(function () {
		$.ajax({
  			url:"reprogramarAutoTareas",
  			type: "POST",
  			success: function(){}
  		});
		//actual = $(".badge-message_dash").text();
		$("#kt_body").trigger('click');
        incidenciaNueva();
        atencionNueva();
       // cerrarTareaNoti();
       // reprogramada();
       // tareaEnEspera();
       // tareaAnulada();
       // conectadosCant1();
        //cantidadTareasContador();
        incidenciasNotifList();
        mensajesSinLeerDash();
        /*if($("#idUserChat1").val() != ""){
            cargarChat1($("#idUserChat1").val());
        }*/
        setInterval(() => {
            incidenciaNueva();
            incidenciasNotifList();
           // reprogramada();
            //cantidadTareasContador();
        }, 9000);
        setInterval(() => {
            atencionNueva();
        }, 8000);
        setInterval(() => {
            mensajesSinLeerDash();
            /*if($("#idUserChat1").val() != ""){
                cargarChat1($("#idUserChat1").val());
                scrollToBottomFooter();
            }*/
        }, 8000);

		//$("#kt_flatpickr").flatpickr();
		var url = window.location.href;
        $(".aside-menu .menu-item a").each(function() {
            if (url == (this.href)) {
               $(this).addClass("active");
               $(this).parent().parent().addClass("hover");
			   $(this).parent().parent().addClass("show");
            }
        });


	});


function ToasterSMS(tipo) {
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toastr-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};
    switch (tipo){
        case "error":
            toastr.error("Observacion de prueba", "Observaciones");
        break;
    }
}

$("#pinky").click(function(){
    conectadosCant1();
    mensajesSinLeerDash();
});

function conectadosCant1() {
		let cantidad = "",
			imagen = "";
		$("#listaConect").html("");
		//$("#uconectadosBagde").text("0");

		$.ajax({
			url: "<?php echo base_url("index.php/userListChat") ?>",
			type: "POST",
			async: false,
			success: function (data) {
				if (data != "") {
					let obj = jQuery.parseJSON(data);
					$.each(obj, function (i, key) {
						if (key["Genero"] == 1) {
							imagen = "user.png";
						} else {
							imagen = "female.png";
						}

						cantidad = key["Conectados"];
						$("#listaConect").append(`
							<div class="d-flex flex-stack py-4" >
								<div class="d-flex align-items-center">
									<div class="symbol symbol-35px me-4">
										<span class="symbol-label bg-light-info">
											<span class="svg-icon svg-icon-3 svg-icon-info">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"/>
													<path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"/>
												</svg>
											</span>
										</span>
									</div>
									<div class="mb-0 me-2">
                                        <span style="display:none;" class="recorrerChatDash">${key.IdUsuario}</span>
										<a href="javascript:void(0)" onclick="cargarChat1('${key.IdUsuario}','${key.Nombre}'),scrollToBottomFooter()" id="kt_drawer_chat_toggle" class="fs-6 text-gray-800 text-hover-primary fw-bolder"> ${key["Nombre"] } <i class="fas fa-paper-plane fa-fw"></i></a>
                                        <div class="text-gray-400 fs-7">  ${key["Puesto"]} </div>
									</div>
								</div>
                                    <p id="contadorChatUsuarioDash${key.IdUsuario}"></p>
							</div>`);
					});
					//$("#uconectadosBagde").text(cantidad);
					//$("#uconectados").text(cantidad);
				}

			}
		});
}

$("#kt_drawer_chat_close").click(function () {
    $("#idUserChat1").val("");
 });

 const scrollToBottomFooter = () => {
	 const element = document.getElementById("panelMensajes1");
   element.scrollTop = element.scrollHeight;
}

function cargarChat1(idUser,nombre) {
    $("#txtMensaje1").attr("disabled", false);
	$("#panelMensajes1").html("");
    $("#nameUser1").text(nombre);
    $("#idUserChat1").val(idUser);
	$.ajax({
		url:"<?php echo base_url("index.php/mostrarMensajes") ?>/"+idUser,
		type: "GET",
		async: false,
		success: function(data){
			let obj = jQuery.parseJSON(data);
			$.each(obj, function (i, key) {
				chatVistodash(key.Id);
				$("#panelMensajes1").append(`
				<div class="d-flex ${key.justify} mb-10">
					<!--begin::Wrapper-->
					<div class="d-flex flex-column ${key.aling}">
						<!--begin::User-->
						<div class="d-flex align-items-center mb-2">
							<!--begin::Details-->
							<div class="me-3">
								<span class="text-muted fs-7 mb-1">${key.FechaMensaje}</span>
								<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">${key.Nombre}</a>
							</div>
							<!--end::Details-->
							<!--begin::Avatar-->
							<div class="symbol symbol-35px symbol-circle">
								<img alt="Pic" src="${key.fotoUser}">
							</div>
							<!--end::Avatar-->
						</div>
						<!--end::User-->
						<!--begin::Text-->
						<div class="p-5 rounded text-dark fw-bold mw-lg-400px ${key.clase}"
							data-kt-element="message-text">${key.Mensaje}</div>
						<!--end::Text-->
					</div>
					<!--end::Wrapper-->
				</div>
				`);
			});
            scrollToBottomFooter();
		}
	});

}

$("#sendMessage1").click(function () {
	if($("#idUserChat1").val() === ""){
		Swal.fire({
          text: "No ha seleccionado ningún usuario para enviar el mensaje.",
          icon: "error",
          allowOutsideClick: false,
		  confirmButtonText: "Cerrar",
          customClass: {
             confirmButton: "btn btn-primary"
          }
        });
	}else{
		if($("#txtMensaje1").val() === ""){
			/*Swal.fire({
			text: "El mensaje está vacío. Por favor ingrese un mensaje.",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "Cerrar",
			customClass: {
				confirmButton: "btn btn-primary"
			}
		  });*/
		}else{
			let form_data = {
				idEnvia: $("#txtIdEnvia1").val(),
				idRecive: $("#idUserChat1").val(),
				mensaje: $("#txtMensaje1").val()
			};
			$.ajax({
				url:"guardarMensaje",
				type: "POST",
				data: form_data,
				success: function(data){
					$("#txtMensaje1").val("");
                    $("#txtMensaje1").focus();
					cargarChat1($("#idUserChat1").val());
                    scrollToBottomFooter();
				}
			});
		}
	}
});

function mensajesSinLeerDash(){
    let suma = 0;
    actual = $(".badge-message_dash").text();
	$.ajax({
		url: "<?php echo base_url("index.php/mostrarMensajesSinLeer") ?>",
		type: "POST",
		async: false,
		success: function(data){
			let obj = jQuery.parseJSON(data);
			$.each(obj, function (i, key) {
                if(key.cantidad>0){
                    suma += key.cantidad;
                    $(".recorrerChatDash").each(function(){
					if(Number($(this).text()) === key.IdUsuarioEnvia){
						//$("#contadorChatUsuarioDash"+$(this).text()).text("");
						if(key.cantidad>0){
                            scrollToBottomFooter();
							$("#contadorChatUsuarioDash"+$(this).text()).empty().html(`
							<span class="badge badge-sm badge-circle badge-danger">${key.cantidad}</span>
						`);
                        cargarChat1($("#idUserChat1").val());
						}
					}
				});
               }
			});
			/*let sonido = new Audio();
	         sonido.src = "<?php echo base_url() ?>/assets/message.mp3";
	         sonido.play();*/
            document.getElementById("cantidadChatBadge").innerHTML = suma;
            document.getElementById("uconectados").innerHTML = suma;

			if(actual > 0 && actual < suma){
				let sonido = new Audio();
		         sonido.src = "<?php echo base_url() ?>/assets/message.mp3";
		         sonido.play();
			}/*else{
				console.log("igual");
			}*/
		}
	});
}


function chatVistodash(id) {
	$.ajax({
		url: "<?php echo base_url("index.php/chatVisto") ?>/"+id,
		type: "POST",
		success: function () {
		}
	});
}


/****************************************** */
function incidenciaNueva() {
    $.ajax({
        url: "<?php echo base_url("index.php") ?>/incidenciaNueva",
        type: "POST",
        success: function (data) {
            if(data != ""){
                let obj = jQuery.parseJSON(data);
            $.each(obj, function (i, key) {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": true,
                        "positionClass": "toastr-bottom-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "10000",
                        "timeOut": "5000",
                        "extendedTimeOut": "10000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.options.onHidden = function() {
                        $.ajax({
                            url: "vistoIncidencias/"+key["IdIncidencia"],
                            type: "POST",
                            success: function(){
                                console.log(key["IdIncidencia"]+" visto");
                            }
                        });
                    };
                    toastr.error(`Se ha agregado una nueva observacion a la orden n° ${key["NoOrdenTrabajo"]} del dia ${key.Fecha}`, "Observaciones");
                    let sonido = new Audio();
                        sonido.src = "<?php echo base_url() ?>/assets/alert.mpeg";
                        sonido.play();
                });
            }

        }
    });
}

function atencionNueva() {
    let tipo = '';
    $.ajax({
        url: "<?php echo base_url("index.php") ?>/atencionNueva",
        type: "POST",
        success: function (data) {
            if(data != ""){
                let obj = jQuery.parseJSON(data);
            $.each(obj, function (i, key) {
                    tipo = key.type;
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": true,
                        "positionClass": "toastr-bottom-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.options.onHidden = function() {
                        $.ajax({
                            url: "vistoTareas/"+key["Id"],
                            type: "POST",
                            success: function(){
                                console.log(key["Id"]+" visto");
                            }
                        });
                    };
                    //return key.mensaje;
                    toastr[tipo](`${key.mensaje}`, "Tareas");
                    //console.log(key.mensaje);
                });
            }

        }
    });
}

function cerrarTareaNoti() {
    $.ajax({
        url: "<?php echo base_url("index.php") ?>/atencionNueva/F",
        type: "POST",
        success: function (data) {
            if(data != ""){
                let obj = jQuery.parseJSON(data);
            $.each(obj, function (i, key) {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toastr-bottom-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.options.onHidden = function() {
                        $.ajax({
                            url: "vistoTareas/"+key["Id"],
                            type: "POST",
                            success: function(){
                                console.log(key["Id"]+" visto");
                            }
                        });
                    };
                    toastr.success(`${key.Atiende} finalizó la tarea con orden n° ${key["NoOrdenTrabajo"]} correspondiente al área ${key.NombreArea}`, "Tareas");
                });
            }

        }
    });
}

function tareaEnEspera() {
    $.ajax({
        url: "<?php echo base_url("index.php") ?>/atencionNueva/E",
        type: "POST",
        success: function (data) {
            if(data != ""){
                let obj = jQuery.parseJSON(data);
            $.each(obj, function (i, key) {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toastr-bottom-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.options.onHidden = function() {
                        $.ajax({
                            url: "vistoTareas/"+key["Id"],
                            type: "POST",
                            success: function(){
                                console.log(key["Id"]+" visto");
                            }
                        });
                    };
                    toastr.warning(`La tarea con orden n° ${key["NoOrdenTrabajo"]} correspondiente al área ${key.NombreArea} está en espera`, "Tareas");
                });
            }

        }
    });
}

function reprogramada() {
    $.ajax({
        url: "<?php echo base_url("index.php") ?>/atencionNueva/R",
        type: "POST",
        success: function (data) {
            if(data != ""){
                let obj = jQuery.parseJSON(data);
            $.each(obj, function (i, key) {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toastr-bottom-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.options.onHidden = function() {
                        $.ajax({
                            url: "vistoTareas/"+key["Id"],
                            type: "POST",
                            success: function(){
                                console.log(key["Id"]+" visto");
                            }
                        });
                    };
                    toastr.info(`La tarea con orden n° ${key["NoOrdenTrabajo"]} correspondiente al área ${key.NombreArea} fue reprogramada`, "Tareas");
                });
            }

        }
    });
}

function tareaAnulada() {
    $.ajax({
        url: "<?php echo base_url("index.php") ?>/atencionNueva/I",
        type: "POST",
        success: function (data) {
            if(data != ""){
                let obj = jQuery.parseJSON(data);
            $.each(obj, function (i, key) {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toastr-bottom-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.options.onHidden = function() {
                        $.ajax({
                            url: "vistoTareas/"+key["Id"],
                            type: "POST",
                            success: function(){
                                console.log(key["Id"]+" visto");
                            }
                        });
                    };
                    toastr.error(`La tarea con orden n° ${key["NoOrdenTrabajo"]} correspondiente al área ${key.NombreArea} fué anulada`, "Tareas");
                });
            }

        }
    });
}

//contadorTareasLits
//jsolicitudesr

function cantidadTareasContador(){
    //$("#contadorTareasLits").text("0");
    $.ajax({
        url: "<?php echo base_url("index.php/tareasNotifList") ?>",
        type: "GET",
        success: function (data) {
            if(data){
                let obj = jQuery.parseJSON(data);
                $.each(obj, function (i, key) {
                    $("#contadorTareasLits").text(key["Contador"]);
                });
            }
        }
    });
}

function incidenciasNotifList() {
//$("#contadorTareasLits").text("0");
    $.ajax({
        url: "<?php echo base_url("index.php/incidenciasNotifList") ?>",
        type: "GET",
        success: function (data) {
            if(data){
                let obj = jQuery.parseJSON(data);
                $.each(obj, function (i, key) {
                    $("#contadorIncidenciasList").text(key["Contador"]);
                });
            }
        }
    });
}
/*
jsIncidencias
listTaskIncidencias*/

/*$("#notifListTareas").click(function () {
    $("#listTask").html("");
    $.ajax({
        url: "<?php echo base_url("index.php/tareasNotifList") ?>",
        type: "GET",
        success: function (data) {
            if(data){
                let obj = jQuery.parseJSON(data);
                $.each(obj, function (i, key) {
                    //$("#jsIncidencias").text(key["Contador"]);
                    $("#listTask").append(`<div class="d-flex flex-stack py-4">
                        <!--begin::Section-->
                        <div class="d-flex align-items-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-35px me-4">
                                <span class="symbol-label bg-light-${key["Clase"]}">
                                    <!--begin::Svg Icon | path: icons/duotune/technology/teh008.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-${key["Clase"]}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="black"></path>
                                                    <path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="black"></path>
                                                </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Title-->
                            <div class="mb-0 me-2">
                                <a href="javascript:void(0)" class="fs-6 text-gray-800 text-hover-primary fw-bolder">Orden n° ${key["NoOrdenTrabajo"]}</a>
                                <div class="text-gray-400 fs-7">Pedido: ${key["Cantidad"]} ${key["Nombre"]}</div>
                                <div class="text-gray-400 fs-7">Area: ${key["NombreArea"]}</div>
                                <div class="text-gray-400 fs-7">${key["Atiende"]}</div>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Label-->
                        ${key["Estado"]}

                        <!--end::Label-->
                    </div>`)
                });
            }
        }
    });
});*/

$("#notifListIncidencias").click(function () {
    $("#listTaskIncidencias").html("");
    $.ajax({
        url: "<?php echo base_url("index.php/incidenciasNotifList") ?>",
        type: "GET",
        success: function (data) {
            let obj = jQuery.parseJSON(data);
            $.each(obj, function (i, key) {
                $("#jsIncidencias").text(key["Contador"]);
                $("#listTaskIncidencias").append(`<div class="d-flex flex-stack py-4">
                	<!--begin::Section-->
                	<div class="d-flex align-items-center">
                		<!--begin::Symbol-->
                		<div class="symbol symbol-35px me-4">
                			<span class="symbol-label bg-light-danger">
                				<!--begin::Svg Icon | path: icons/duotune/technology/teh008.svg-->
                				<span class="svg-icon svg-icon-2 svg-icon-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="black"></path>
												<path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="black"></path>
											</svg>
                				</span>
                				<!--end::Svg Icon-->
                			</span>
                		</div>
                		<!--end::Symbol-->
                		<!--begin::Title-->
                		<div class="">
                			<a onclick="verIncidenciasNotifooter('${key["IdOrden"]}','${key["NoOrdenTrabajo"]}')" href="javascript:void(0)" class="fs-6 text-gray-800 text-hover-primary fw-bolder">
                                El usuario ${key["Nombre"]} agregó una observación a la orden n° ${key["NoOrdenTrabajo"]}
                                el dia ${key["FechaIncidencia"]}
                            </a>
                			<!--<div class="text-gray-400 fs-7"></div>
                            <div class="text-gray-400 fs-7">creada </div>-->
                		</div>
                		<!--end::Title-->
                	</div>
                	<!--end::Section-->
                	<!--begin::Label-->
                	<!--end::Label-->
                </div>`)
            });
        }
    });
});

function verIncidenciasNotifooter(idTarea,orden){
    $("#modalVerTodos").modal("hide");
    $("#timeline1").html("");
    $("#spanOrdenIncidencia1").text(orden);
    let e = 0;
    let colores = ["bg-info","bg-success","bg-danger","bg-warning","bg-primary"];
    $.ajax({
        url: "<?php echo base_url("index.php/mostrarIncidencias") ?>/"+idTarea,
        type: "GET",
        async: false,
		success: function (data){
            if (data != "") {
			   let obj = jQuery.parseJSON(data);
               $.each(obj, function (i, key) {
                $("#timeline1").append(`<div class="timeline-item">
										<!--begin::Timeline line-->
										<div class="timeline-line w-40px"></div>
										<!--end::Timeline line-->
										<!--begin::Timeline icon-->
										<div class="timeline-icon symbol symbol-circle symbol-40px">
											<div class="symbol-label ${colores[e]}">
												<i class="fas fa-comments fa-fw text-white"></i>
											</div>
										</div>
										<!--end::Timeline icon-->
										<!--begin::Timeline content-->
										<div class="timeline-content mb-10 mt-n1">
											<!--begin::Timeline heading-->
											<div class="pe-3 mb-5">
												<!--begin::Title-->
												<div class="fs-5 fw-bold mb-2">${key.Descripcion}</div>
												<!--end::Title-->
												<!--begin::Description-->
												<div class="overflow-auto pb-5">
													<!--begin::Wrapper-->
													<div class="d-flex align-items-center mt-1 fs-6">
														<!--begin::Info-->
														<div class="text-muted me-2 fs-7">Agregado el ${key.FechaCrea} por</div>
														<!--end::Info-->
														<!--begin::User-->
														<a href="javascript:void(0)" class="text-primary fw-bolder me-1">${key.Nombre}</a>
														<!--end::User-->
													</div>
													<!--end::Wrapper-->
												</div>
												<!--end::Description-->
											</div>
											<!--end::Timeline heading-->
										</div>
										<!--end::Timeline content-->
									</div>`);
                      e++;
                      if(e == 5){
                        e = 0;
                      }
               });
            }
        }
    });
    $("#modalIncidencias1").modal("show");
}
</script>
</body>
<!--end::Body-->

</html>
