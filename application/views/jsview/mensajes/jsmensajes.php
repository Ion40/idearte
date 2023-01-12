<script>
$(document).ready(function () { 
    userListChat();
	mensajesSinLeer();
    setInterval(() => {
        userListChat();
		mensajesSinLeer();
		/*if(Number($("#idUserChat").text()) > 0){
			cargarChat($("#idUserChat").text());
		}*/
		
    }, 1000);
});

//Mantener scroll al fnal del elemento
const scrollToBottom = () => {
	 const element = document.getElementById("panelMensajes");
   element.scrollTop = element.scrollHeight;
}

function userListChat(){
   $("#chatUserList").empty();
   let conected = "";
   $.ajax({ 
      url: "userListChat",
      type: "POST",
	  async: false,
	  success: function (data) {
        if(data != ""){
            let obj = jQuery.parseJSON(data);
            $.each(obj, function(i, key){
                if(key.Conectado === 1){
                    conected= `<div class="symbol-badge bg-success start-100 top-100 border-4 h-15px w-15px ms-n2 mt-n2"></div>`;
                }else{
                    conected= "";
                }
                $("#chatUserList").append(`
                <!--begin::User-->
				<div style="cursor: pointer;" class="d-flex flex-stack py-4" onclick="cargarChat(${key.IdUsuario}), cargarMensaje('${key.IdUsuario}',${key.Conectado},'${key.Nombre}'),scrollToBottom()">
					<!--begin::Details-->
					<div class="d-flex align-items-center">
						<!--begin::Avatar-->
						<div class="symbol symbol-45px symbol-circle">
                                                    <img alt="Pic" src="${key.fotoUser}">
                                                    ${conected}
							<!--<span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">M</span>
							<div class="symbol-badge bg-success start-100 top-100 border-4 h-15px w-15px ms-n2 mt-n2"></div>-->
						</div>
						<!--end::Avatar-->
						<!--begin::Details-->
						<div class="ms-5">
							<a href="javascript:void(0)" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">${key.Nombre}</a>
							<div class="fw-bold text-muted">${key.NombreArea}</div>
						</div>
						<!--end::Details-->
					</div>
					<!--end::Details-->
					<!--begin::Lat seen-->
					<div class="d-flex flex-column align-items-end ms-2">
						<span style="display:none;" class="recorrer">${key.IdUsuario}</span>
						<!--<span class="text-muted fs-7 mb-1" id="conectTimeChat">${key.TiempoActivo}</span>-->
						<p id="contadorChatUsuario${key.IdUsuario}"></p>
					</div>
					<!--end::Lat seen-->
				</div>
				<!--end::User-->
				<!--begin::Separator-->
				<div class="separator separator-dashed"></div>
                `);
            });
         }
      }
   }); 
}

function mensajesSinLeer(){
	$.ajax({
		url: "mostrarMensajesSinLeer",
		type: "POST",
		async: false,
		success: function(data){
			let obj = jQuery.parseJSON(data);
			$.each(obj, function (i, key) { 
				$(".recorrer").each(function(){
					if(Number($(this).text()) === key.IdUsuarioEnvia){
						$("#contadorChatUsuario"+$(this).text()).text("");
						if(key.cantidad>0){
							$("#contadorChatUsuario"+$(this).text()).append(`
							<span class="badge badge-sm badge-circle badge-danger">${key.cantidad}</span>
						`);	
						cargarChat($("#idUserChat").text());
						scrollToBottom();
						}
					}		
				});
	
			});
		}
	});
}

$("#sendMessage").click(function () { 
	if($("#idUserChat").text() === ""){
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
		if($("#txtMensaje").val() === ""){
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
				idEnvia: $("#txtIdEnvia").val(),
				idRecive: $("#idUserChat").text(),
				mensaje: $("#txtMensaje").val()
			};
			$.ajax({
				url:"guardarMensaje",
				type: "POST",
				data: form_data,
				success: function(data){
					$("#txtMensaje").val("");
					cargarChat($("#idUserChat").text());
					scrollToBottom();
				}
			});
		}
	}
});

function cargarMensaje(idUser,conectado,nombre) { 
	$("#headerActivo").html("");
	$("#idUserChat").text(idUser);
	$("#nombrePila").text(nombre);
	$("#panelMensajes").html("");
	//"bg-light-success text-end";
	if(conectado === 1){
		$("#headerActivo").append(`
		<span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
		<span class="fs-7 fw-bold text-muted">Conectado</span>`);
	}else{
		$("#headerActivo").append(`
		<span class="badge badge-secondary badge-circle w-10px h-10px me-1"></span>
		<span class="fs-7 fw-bold text-muted">Desconectado</span>`);
	}
	cargarChat(idUser);
	scrollToBottom();
}

function cargarChat(idUser) { 
	$("#panelMensajes").html("");
	$.ajax({
		url:"mostrarMensajes/"+idUser,
		type: "GET",
		async: false,
		success: function(data){
			let obj = jQuery.parseJSON(data);
			$.each(obj, function (i, key) { 
				chatVisto(key.Id);
				$("#panelMensajes").append(`
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
		}
	});
}

function chatVisto(id) {
	$.ajax({
		url: "chatVisto/"+id,
		type: "POST",
		success: function () {

		}
	});
}

</script>