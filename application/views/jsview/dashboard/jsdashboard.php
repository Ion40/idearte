<script>
    $(document).ready(function () {
        //$.bindViewer(".viewer-item");
         $("#multiple").imageuploadify();
        let contador = 0;
        $.fn.modal.Constructor.prototype._initializeFocusTrap = function () { return { activate: function () { }, deactivate: function () { } } };
        $(window).on("DOMMouseScroll mousewheel", function (event) {
            if(event.originalEvent.detail > 0 || event.originalEvent.wheelDelta < 0){
                $(".menuTask").removeClass("show");
            }else{
                $(".menuTask").removeClass("show");
            }
        });

        if($("#txtIdArea").val() != ""){
            Tasks($("#txtIdArea").val(),$("#contadorClick").val());
            contadorObservaciones();
        }
        setInterval(() => {
            if($("#txtIdArea").val() != ""){
                Tasks($("#txtIdArea").val(),$("#contadorClick").val());
                contadorObservaciones();
                if($("#modalVerTodos").hasClass("show")){
                    if(!$(".notaRecepcionMaterial").is(":focus")){
                        verTodos($("#diaVerTodos").text());
                    }
                }
            }
        }, 5000);
        /******************************************* */
        $("#fecha,#fechareal").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            parentEl: "#modalTareas .modal-body",
            minYear: 2022,
            "autoApply": true,
            maxYear: parseInt(moment().format("YYYY"),10),
            "locale":{
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                        format: "yyyy-MM-DD"
            }
        });

       $("#SActual").on("click", function(){
            contador = 0;
            $("#contadorClick").val(contador);
            Tasks($("#txtIdArea").val(),contador);
        });

        $("#SAnterior").on("click", function(){
            contador-= 1;
            $("#contadorClick").val(contador);
            Tasks($("#txtIdArea").val(),contador);
        });

        $("#SSig").on("click",function(){
           contador+= 1;
           $("#contadorClick").val(contador);
           Tasks($("#txtIdArea").val(),contador);
        });
    });

    function Tasks(idArea,num) {
        $("#textoFechas").show();
        $("#txtIdArea").val(idArea);
        $(".fechaTask").empty();
        $("#dateInicial").text("-");
        $("#dateFinal").text("-");
        let prioridad = "", title = "", button = "", button1 = "", opciones = "", detalle="";
        $("#cardTask .card-body").html("");
        $("#fechaTask").text("");
        $.ajax({
                    url: "<?php echo base_url("index.php/mostrarTaskSemana") ?>"+"/"+idArea+"/"+num,
                    type: "POST",
                    async: false,
                    success: function (data) {
                        if (data != "") {
                            let obj = jQuery.parseJSON(data);
                            $.each(obj, function (i, key) {
                                $("#dateInicial").text(key.PrimerDia);
                                $("#dateFinal").text(key.UltimoDia);
                                switch (key.Prioridad) {
                                    case 1:
                                        prioridad = "border-success";
                                        title = "Prioridad Normal";
                                        break;
                                    case 2:
                                        prioridad = "border-warning";
                                        title = "Prioridad Alta";
                                        break;
                                    case 3:
                                        prioridad = "border-danger";
                                        title = "Prioridad Urgente";
                                        break;
                                    default:
                                        break;
                                }
                                if(key.EstadoTareaChar === "A" || key.EstadoTareaChar === "E"){
                                    detalle = '';
                                    button = `<div class="separator mt-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3 py-3">
                                                            <a onclick="atenderTarea('${key.Id}','${key.IdArea}')" class="btn btn-primary btn-sm" href="javascript:void(0)"><i class="fas fa-lock fa-fw"></i> Atender tarea</a>
                                                        </div>
                                                    </div>`;
                                    button1 = `
                                                    <span class="badge badge-primary fw-bold ">
                                                        <a class="text-white" onclick="atenderTarea('${key.Id}','${key.IdArea}')" href="javascript:void(0)"><i class="fas fa-lock text-white fa-fw"></i> Atender</a>
                                                    </span>
                                   <!-- <div class="d-flex flex-stack">
                                                        <div class="me-3">
                                                            <br>
                                                            <span class="w-50px ms-n1 me-1 text-gray-800 text-hover-primary fw-bolder">
                                                               <a onclick="atenderTarea('${key.Id}','${key.IdArea}')" class="btn btn-primary btn-sm" href="javascript:void(0)"><i class="fas fa-lock fa-xs"></i>Atender</a>
                                                            </span>
                                                        </div>
                                                    </div>-->`;
                                }else {
                                    let idUsuario = $("#txtIdUsuarioLog").val();
                                    if(key.IdUsuarioAtiende === Number(idUsuario) && key.EstadoTareaChar === "P"){
                                        button = `<div class="separator mt-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3 py-3">
                                                            <a onclick="cerrarTarea('${key.Id}')" class="btn btn-success btn-sm px-4" href="javascript:void(0)"><i class="fas fa-check-circle fa-fw"></i> Cerrar tarea</a>
                                                        </div>
                                                    </div>`;
                                               button1 = `
                                               <span class="badge badge-success fw-bold">
                                                        <a onclick="cerrarTarea('${key.Id}')" class="text-white" href="javascript:void(0)"><i class="fas fa-check-circle fa-fw text-white"></i> Cerrar</a>
                                                    </span>
                                                   <!--<div class="d-flex flex-stack ">
                                                        <div class="me-3">
                                                            <br>
                                                            <span class="w-50px ms-n1 me-1 text-gray-800 text-hover-primary fw-bolder">
                                                               <a onclick="cerrarTarea('${key.Id}')" class="btn btn-success btn-sm " href="javascript:void(0)"><i class="fas fa-check-circle fa-fw fa-xs"></i>Cerrar</a>
                                                            </span>
                                                        </div>
                                                    </div>-->`;
                                                    detalle = ` <div class="menu-item px-3">
                                                                <a id="detTareas${key.Id}" href="javascript:void(0)" onclick="detTareas('${key.Id}','${key.NoOrdenTrabajo}','${key.Fecha}','${key.FechaRealEntrega}','${key.Nombre}','${key.Cantidad}','${key.Descripcion}','${key.Prioridad}','${key.IdArea}','${key.NombreArea}','${key.Imagen}','${key.ContactoCliente}')" class="menu-link px-3"><i class="fas fa-exclamation-circle fa-fw"></i> Detalles de tarea</a>
                                                            </div>`;
                                    }else if(key.EstadoTareaChar === "P" || key.EstadoTareaChar === "F"){
                                        button = "";
                                        button1 = "";
                                        detalle = ` <div class="menu-item px-3">
                                                                <a id="detTareas${key.Id}" href="javascript:void(0)" onclick="detTareas('${key.Id}','${key.NoOrdenTrabajo}','${key.Fecha}','${key.FechaRealEntrega}','${key.Nombre}','${key.Cantidad}','${key.Descripcion}','${key.Prioridad}','${key.IdArea}','${key.NombreArea}','${key.Imagen}','${key.ContactoCliente}')" class="menu-link px-3"><i class="fas fa-exclamation-circle fa-fw"></i> Detalles de tarea</a>
                                                            </div>`;
                                }else{
                                        button = "";
                                        button1 = "";
                                    }
                                }
                                if(key.EstadoTareaChar != "R" && key.EstadoTareaChar != "I"){
                                    opciones = `<button  onclick="crearInstancia('${key.Dia}')" class="btn btn-icon btn-color-gray-400 btn-active-color-primary mt-n2 me-n3"
                                                    data-kt-menu-placement="top-start"  data-kt-menu-trigger="click"
                                                    data-kt-menu-overflow="true">
                                                    <span onclick="crearInstancia('${key.Dia}')" class="svg-icon svg-icon-3x">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="black"></rect>
                                                            <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="black">
                                                            </rect>
                                                            <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="black">
                                                            </rect>
                                                            <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="black"></rect>
                                                        </svg>
                                                    </span>
                                                </button>
                                                <div onmouseleave="ocultar('${key.Dia}')" id="kt_menu${key.Dia}" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-250px menuTask"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">
                                                           Acciones </div>
                                                    </div>
                                                    <div class="separator mb-3 opacity-75"></div>
                                                    <?php $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "17");if ($permiso) {?>
                                                        <div class="menu-item px-3">
                                                            <a onclick="reprogramarTarea('${key.Id}','${key.NoOrdenTrabajo}','${key.Fecha}','${key.FechaRealEntrega}','${key.Nombre}','${key.Cantidad}','${key.Descripcion}','${key.Prioridad}','${key.IdArea}','${key.NombreArea}','${key.ContactoCliente}')" href="javascript:void(0)" class="menu-link px-3"><i class="fas fa-calendar-plus fa-fw"></i> Reprogramar Tarea</a>
                                                        </div>
                                                    <?php }?>
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" onclick="enEspera('${key.Id}')" class="menu-link px-3"><i class="fas fa-hand-paper fa-fw"></i> Poner en espera</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                                <a href="javascript:void(0)" onclick="agregarIncidencia('${key.Id}')" class="menu-link px-3"><i class="fas fa-comment fa-fw"></i> Agregar observaciones</a>
                                                            </div>
                                                            <div class="menu-item px-3">
                                                                <a href="javascript:void(0)" onclick="verIncidencias('${key.Id}','${key.NoOrdenTrabajo}')" class="menu-link px-3"><i class="fas fa-comments fa-fw"></i> Ver observaciones</a>
                                                            </div>
                                                            <div class="menu-item px-3">
                                                                <a href="javascript:void(0)" onclick="verComentEspera('${key.Id}')" class="menu-link px-3"><i class="fas fa-hand-paper fa-fw"></i> Ver comentario espera</a>
                                                            </div>
                                                           ${detalle}
                                                     <?php $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "25");if ($permiso) {?>
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)" onclick="editTareas('${key.Id}','${key.NoOrdenTrabajo}','${key.Fecha}','${key.FechaRealEntrega}','${key.Nombre}','${key.Cantidad}','${key.Descripcion}','${key.Prioridad}','${key.IdArea}','${key.NombreArea}','${key.ContactoCliente}')" class="menu-link px-3 text-info"><i class="fas fa-pen fa-fw text-info"></i> Editar Tarea</a>
                                                        </div>
                                                    <?php }?>

                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" onclick="anularTarea('${key.Id}')" class="menu-link px-3 text-danger"><i class="fas fa-ban fa-fw text-danger"></i> Anular Tarea</a>
                                                    </div>
                                                    ${button}
                                                </div>`;
                                }else{
                                    opciones = '';
                                }
                                $("#fechaTask"+key.Dia).empty().text(`Fecha: ${key.Fecha}`); //pt-5 pb-7 debe ir en la card despues de px-7
                                $("#div"+key.Dia).append(`
                                    <div class="overflow-hidden position-relative card px-7 pt-3 pb-2 border-dashed border-1 border-gray-300 mb-4 bg-white">
                                        <div data-bs-toggle="tooltip" title="${title}" data-bs-original-title="${title}"
                                            data-bs-placement="right" class="ribbon ribbon-triangle ribbon-top-end ${prioridad}">
                                            <!--begin::Ribbon icon-->
                                            <div class="ribbon-icon mt-n5 me-n6">
                                                <!--begin::Svg Icon | path: icons/duotune/electronics/elc006.svg-->
                                                <span style="display:none;" class="recorrer">${key.Id}</span>
                                                <span class="recorrer svg-icon svg-icon-2 svg-icon-white" id="contadorObservaciones${key.Id}">

                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Ribbon icon-->
                                        </div><br>
                                        <!--begin::Section-->
                                        <div class="d-flex flex-stack mb-2">
                                            <!--begin::Section-->
                                            <div class="me-3">
                                                <!--begin::Icon-->
                                                <span class="w-50px ms-n1 me-1 text-gray-800 text-hover-primary fw-bolder">Orden: </span>
                                                <span class="w-50px ms-n1 me-1">${key.NoOrdenTrabajo}</span>
                                                <!--end::Icon-->
                                                <br>
                                                <span class="w-50px ms-n1 me-1 text-gray-800 text-hover-primary fw-bolder">Pedido: </span>
                                                <span class="w-50px ms-n1 me-1">${key.Nombre}</span>
                                                <!--begin::Title-->
                                                <br>
                                                <span class="w-50px ms-n1 me-1 text-gray-800 text-hover-primary fw-bolder">Cantidad: </span>
                                                <span class="w-50px ms-n1 me-1">${key.Cantidad}</span>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Section-->
                                            <!--begin::Action-->
                                            <div class="m-0">
                                                <!--begin::Menu-->
                                                ${opciones}
                                                <!--begin::Menu 2-->
                                                <!--end::Menu 2-->
                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Content-->
                                        <div class="d-flex flex-stack fs-7 mb-2">
                                            <!--begin::Info-->
                                            <span class="text-gray-400 fw-bolder">Atiende:
                                                <span class="text-gray-800 fw-bolder">${key.Atiende}</span></span>
                                            <!--end::Info-->
                                            <!--begin::Label-->
                                            ${key.EstadoTarea}
                                            <!--end::Label-->
                                        </div>
                                        <div class="d-flex flex-stack fs-7 mb-2">
                                            <!--begin::Info-->
                                            <span class="text-gray-400 fw-bolder"><span class="text-gray-800 fw-bolder"></span></span>
                                            ${button1}
                                        </div>
                                    </div>
                                `);
                            });
                        }
                    }
                });
    }

function crearInstancia(id) {
    $(".menuTask").removeClass("show");
    //$("#kt_menu"+id).removeClass("show");
    KTMenu.createInstances();
    var menuElement = document.querySelector("#kt_menu"+id);
    var menu = KTMenu.getInstance(menuElement);
    var item = document.querySelector(".kt_menu_item");
    menu.hide(item);
    console.log(menu);
}

function ocultar(id) {
    $(".menuTask").removeClass("show");
}

function reprogramarTarea(idTarea,orden,fecha,fechareal,tarea,cantidad,desc,prioridad,idarea,area,cliente){
    ////$("#modalVerTodos").modal("hide");
    $(".imageuploadify-container").remove();
    $("#divImagen2").show();
    $("#divImagen").hide();
    $("#fecha,#fechareal").attr("disabled", false);
    $("#listAreas option:selected").val(idarea).attr("disabled",true);
    $("#idTarea").val(idTarea).attr("disabled",true);;
    $("#numOrden").val(orden).attr("disabled",true);;
    $("#fecha").val(fecha);
    $("#fechareal").val(fechareal);
    $("#nombre").val(tarea).attr("disabled",true);;
    $("#cantidad").val(cantidad).attr("disabled",true);;
    $("#descripcion").val(desc).attr("disabled",true);;
    $("#cliente").val(cliente).attr("disabled",true);;
    $("#listAreas option:selected").val(idarea).attr("disabled",true);
    $("#listAreas option:selected").text(area);
    //$("#imgAdjunta").css({'background-image':'url('+imagen+')'});
    $("#modalTitle").text("Reprogramar Tarea");
    $("#chkNormal").removeClass("disabled");
    $("#chkAlta").removeClass("disabled");
    $("#chkUrgente").removeClass("disabled");
    $(".change_image").hide();
   // $("#imagenTarea").css({'background-image':'url()'});
    //$("#imgAdjunta3").show();
    //$("#imgAdjunta3").attr("src",imagen);
    switch (Number(prioridad)) {
        case 1:
              $("#chkNormal").addClass("active");
              $("#chkAlta,#chkUrgente").removeClass("active");
            break;
        case 2:
              $("#chkAlta").addClass("active");
              $("#chkNormal,#chkUrgente").removeClass("active");
            break;
        case 3:
              $("#chkUrgente").addClass("active");
              $("#chkNormal,#chkAlta").removeClass("active");
            break;
        default:
              $("#chkNormal").addClass("active");
            break;
    }
    if($("#listAreas option:selected").val() == "5"){
        $("#divCliente").show();
        $("#cliente").val(cliente);
    }else{
        $("#divCliente").hide();
        $("#cliente").val("");
    }
    let campos = document.querySelectorAll("#campos input.valida1, textarea.form-control");
   /* [].slice.call(campos).forEach(function (campo) {
        $("#" + campo.id).attr("disabled",true);
     });*/
    $("#btnAppend").empty();
    $.ajax({
        url: "mostrarImagenes/"+idTarea,
        type: "GET",
        success: function(data){
            let obj = jQuery.parseJSON(data);
            $.each(obj, function(i,key){
                $("#btnAppend").append(`
                    <div class="imageuploadify-container" style="margin-left: 5px;">
                      <button type="button" onclick="$(this).parent().remove();" class="btn btn-danger"></button>
                        <div class="imageuploadify-details" style="opacity: 0;">
                        </div>
                        <img src="${key["Imagen"]}">
                     </div>`)
            });
        }
    });
    $("#campos").show();
    $("#btnReprogramar").show();
    $("#btnActualizarTask").hide();
    $("#modalTareas").modal("show");
}

function detTareas(idTarea,orden,fecha,fechareal,tarea,cantidad,desc,prioridad,idarea,area,imagen,cliente){
    //$("#modalVerTodos").modal("hide");
    $(".imageuploadify-container").remove();
    $("#divImagen2").hide().attr("disabled",true);
    $("#divImagen").show().attr("disabled",true);
    $("#idTarea").val(idTarea).attr("disabled",true);
    $("#numOrden").val(orden.trim()).attr("disabled",true);
    $("#cliente").attr("disabled", true).attr("disabled",true);
    $("#fecha").val(fecha).attr("disabled",true);
    $("#fechareal").val(fechareal).attr("disabled",true);
    $("#nombre").val(tarea.trim()).attr("disabled",true);
    $("#cantidad").val(cantidad).attr("disabled",true);
    $("#descripcion").val(desc.trim()).attr("disabled",true);
    $("#listAreas option:selected").val(idarea).attr("disabled",true);
    $("#listAreas option:selected").text(area).attr("disabled",true);
    //$("#imgAdjunta,#imgAdjunta1,#imgAdjunta2").css({'background-image':'url('+imagen+')'});
     $(".change_image").hide();//
    //$("#imagenTarea").css({'background-image':'url()'});
    //$("#imgAdjunta3").show();
    //$("#imgAdjunta3").attr("src",imagen);
    $("#modalTitle").text("Detalle de Tarea");
    switch (Number(prioridad)) {
        case 1:
              $("#chkNormal").addClass("active");
              $("#chkNormal").removeClass("disabled");
              $("#chkAlta,#chkUrgente").removeClass("active");
              $("#chkAlta,#chkUrgente").addClass("disabled");
            break;
        case 2:
              $("#chkAlta").addClass("active");
              $("#chkAlta").removeClass("disabled");
              $("#chkNormal,#chkUrgente").removeClass("active");
              $("#chkNormal,#chkUrgente").addClass("disabled");
            break;
        case 3:
              $("#chkUrgente").addClass("active");
              $("#chkUrgente").removeClass("disabled");
              $("#chkNormal,#chkAlta").removeClass("active");
              $("#chkNormal,#chkAlta").addClass("disabled");
            break;
        default:
              $("#chkNormal").addClass("active");
            break;
    }
    if($("#listAreas option:selected").val() == "5"){
        $("#divCliente").show();
        $("#cliente").val(cliente);
    }else{
        $("#divCliente").hide();
        $("#cliente").val("");
    }
    let campos = document.querySelectorAll("#campos input.valida1, textarea.form-control");
    /*[].slice.call(campos).forEach(function (campo) {
        $("#" + campo.id).attr("disabled",true);
     });*/
     $("#fecha,#fechareal").attr("disabled", true);
     $("#btnAppend").empty();
     $("#divImagenes").empty();
    $.ajax({
        url: "mostrarImagenes/"+idTarea,
        type: "GET",
        success: function(data){
            let obj = jQuery.parseJSON(data);
            $.each(obj, function(i,key){
                $("#divImagenes").append(`
                    <div style="cursor:pointer;" class="symbol-image symbol me-3">
                        <img onmouseover="cambiarImagen('${key["Imagen"]}')" onclick="verImagen1('${key["Imagen"]}')" class="imagenPreview" src="${key["Imagen"]}" style="width: 100px;height: 100px; ">
                    </div>`)
            });
        }
    });
    $("#campos").show();
    $("#btnReprogramar").hide();
     $("#btnActualizarTask").hide();
    $("#modalTareas").modal("show");
}

function cambiarImagen(imagen){
    document.getElementById("mainImage").src = imagen;
}

function verImagen() {
    let imagen = $("#mainImage").attr("src")
    document.getElementById("ImagenPreview").src = imagen;
    $("#modalImagenPreview").modal("show");
}

function verImagen1(imagen) {
    //let imagen = $("#mainImage").attr("src")
    document.getElementById("ImagenPreview").src = imagen;
    $("#modalImagenPreview").modal("show");
}

$("#btnReprogramar").click(function () {
    //$("#modalVerTodos").modal("hide");
    $("#loading").modal("show");
    let mensaje = "", icon = "";
           let prioridad = 0;
           if($("#chkNormal").hasClass("active")){
                prioridad = 1;
            }else if($("#chkAlta").hasClass("active")){
                prioridad = 2;
            }else if($("#chkUrgente").hasClass("active")){
                prioridad = 3;
            }

           let form_data = {
            idtarea: $("#idTarea").val(),
            nombre: $("#nombre").val(),
            cantidad: $("#cantidad").val(),
            descripcion: $("#descripcion").val(),
            numOrden: $("#numOrden").val(),
            prioridad: prioridad,
            idArea: $("#listAreas option:selected").val(),
            fecha: $("#fecha").val(),
            fechareal: $("#fechareal").val(),
            cliente: $("#cliente").val()
           };

           console.log(form_data);

         $.ajax({
              url: "reprogramarTarea",
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
                    subirMultiImagenes($("#numOrden").val(),$("#listAreas option:selected").val());
                    $("#loading").modal("hide");
                    $("#modalTareas").modal("hide");
                    Tasks($("#txtIdArea").val(),$("#contadorClick").val());
                  });
              }
          });
});

function enEspera(idTarea){
    //$("#modalVerTodos").modal("hide");
  Swal.fire({
    //title: '<label for="comentarioEspera" class="form-label ">Poner Tarea en espera </label>',
    title: '<i class="fas fa-hand-paper fa-fw fa-2x"></i>Poner tarea en espera',
    html:
        `<div class="row col-md-12">
            <div class="col-md-12 fv-row">
                <!--begin::Input group-->
                <div class="input-group mb-5">
                    <span class="input-group-text" id="basic-addon1">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                    fill="black"></path>
                                <path opacity="0.3"
                                    d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                    fill="black"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <input type="hidden" id="idTareaEspera" value="${idTarea}">
                    <textarea placeholder="comentario Espera" id="comentarioEsperaSA" class="form-control valida1" aria-label="With textarea"
                        style="height: 97px;"></textarea>
                </div>
                <!--end::Input group-->
            </div>
        </div>`,
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-danger me-3'
    },
    didOpen: () => {
        Swal.getHtmlContainer().querySelector('.form-control').focus()
    },
    buttonsStyling: false,
    confirmButtonText: "Poner en espera",
    cancelButtonText: "Cancelar",
    showCancelButton: true,
    allowOutsideClick:false,
    showCloseButton: true,
    width:700,
    preConfirm: () => {
        $("#comentarioEsperaSA").removeClass("is-invalid");
        if($("#comentarioEsperaSA").val() === "" || $("#comentarioEsperaSA").val() === null){
            $("#comentarioEsperaSA").addClass("is-invalid");
            Swal.showValidationMessage('Debe ingresar un comentario')
        } else {
            let mensaje = '', icon = '';
            let form_data = {
                idTarea: $("#idTareaEspera").val(),
                comentarioEspera: $("#comentarioEsperaSA").val()
            };
            $.ajax({
                url: "enEsperaTarea",
                type: "POST",
                data: form_data,
                success: function (data) {
                    let obj = jQuery.parseJSON(data);
                    $.each(obj, function (i, key) {
                        mensaje = key["mensaje"];
                        icon = key["tipo"];
                    });
                    Swal.fire({
                        text: mensaje,
                        icon: icon,
                        allowOutsideClick: false
                    }).then((result) =>{
                        Tasks($("#txtIdArea").val(),$("#contadorClick").val());
                    });
                }
            });
        }
     }
  });
}

function atenderTarea(idTarea,idArea){
    //$("#modalVerTodos").modal("hide");
    Swal.fire({
        text: "¿Estas seguro que deseas atender esta tarea?",
        icon: 'question',
        showCancelButton: true,
        customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger"
            },
        confirmButtonText: "Atender",
        cancelButtonText: "Cancelar",
        allowOutsideClick: false
    }).then((result) => {
        if(result.isConfirmed){
            let mensaje = '', icon = '';
            let form_data = {
                idTarea: idTarea,
                idArea: idArea
            };
            $.ajax({
                url:"atenderSolicitud",
                type:"POST",
                data: form_data,
                success: function (data) {
                    let obj = jQuery.parseJSON(data);
                    $.each(obj, function (i, key) {
                        mensaje = key["mensaje"];
                        icon = key["tipo"];
                    });
                    if(icon != "success"){
                        Swal.fire({
                            text: mensaje,
                            icon: icon,
                            allowOutsideClick:false
                        }).then((result) => {
                            Tasks($("#txtIdArea").val(),$("#contadorClick").val());
                            $("#detTareas"+idTarea).trigger("click");
                            $("#detTareas1"+idTarea).trigger("click");
                        });
                    }else{
                        Tasks($("#txtIdArea").val(),$("#contadorClick").val());
                        $("#detTareas"+idTarea).trigger("click");
                        $("#detTareas1"+idTarea).trigger("click");
                    }
                }
            });
        }
    });
}

function cerrarTarea(idTarea){
    //$("#modalVerTodos").modal("hide");
    Swal.fire({
        text: "¿Estas seguro que deseas dar por finalizada esta tarea?",
        icon: 'question',
        showCancelButton: true,
        customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger"
            },
        confirmButtonText: "Cerrar",
        cancelButtonText: "Cancelar",
        allowOutsideClick: false
    }).then((result) => {
        if(result.isConfirmed){
            let mensaje = '', icon = '';
            let form_data = {
                idTarea: idTarea
            };
            $.ajax({
                url:"cerrarTarea",
                type:"POST",
                data: form_data,
                success: function (data) {
                    let obj = jQuery.parseJSON(data);
                    $.each(obj, function (i, key) {
                        mensaje = key["mensaje"];
                        icon = key["tipo"];
                    });
                    if(icon != "success"){
                        Swal.fire({
                            text: mensaje,
                            icon: icon,
                            allowOutsideClick:false
                        }).then((result) => {
                            Tasks($("#txtIdArea").val(),$("#contadorClick").val());
                        });
                    }else{
                        Tasks($("#txtIdArea").val(),$("#contadorClick").val());
                    }
                }
            });
        }
    });
}

function anularTarea(idTarea){
    //$("#modalVerTodos").modal("hide");
    Swal.fire({
        text: "¿Estas seguro que deseas anular esta tarea?. Esta funcion no se puede revertir",
        icon: 'question',
        showCancelButton: true,
        customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger"
            },
        confirmButtonText: "Anular",
        cancelButtonText: "Cancelar",
        allowOutsideClick: false
    }).then((result) => {
        if(result.isConfirmed){
            let mensaje = '', icon = '';
            let form_data = {
                idTarea: idTarea
            };
            $.ajax({
                url:"anularTarea",
                type:"POST",
                data: form_data,
                success: function (data) {
                    let obj = jQuery.parseJSON(data);
                    $.each(obj, function (i, key) {
                        mensaje = key["mensaje"];
                        icon = key["tipo"];
                    });
                    Swal.fire({
                        text: mensaje,
                        icon: icon,
                        allowOutsideClick:false
                    }).then((result) => {
                        Tasks($("#txtIdArea").val(),$("#contadorClick").val());
                    });
                }
            });
        }
    });
}

function agregarIncidencia(idTarea){
   // $("#modalVerTodos").modal("hide");

  Swal.fire({
    //title: '<label for="comentarioEspera" class="form-label ">Poner Tarea en espera </label>',
    title: '<span class="text-white"><i class="fas fa-comment fa-fw fa-2x"></i>Agregar observaciones</span>',
    html:
        `<div class="row col-md-12">
            <div class="col-md-12 fv-row">
                <!--begin::Input group-->
                <div class="input-group mb-5">
                    <span class="input-group-text" id="basic-addon1">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                    fill="black"></path>
                                <path opacity="0.3"
                                    d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                    fill="black"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <input type="hidden" id="idTareaIncidencia" value="${idTarea}">
                    <textarea rows="4" placeholder="Observaciones" id="comentarioIncidencia" class="form-control valida1"></textarea>
                </div>
                <!--end::Input group-->
            </div>
        </div>`,
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-danger me-3',
      title: 'modal-header bg-danger'
    },
    didOpen: () => {
        Swal.getHtmlContainer().querySelector('.form-control').focus()
    },
    buttonsStyling: false,
    confirmButtonText: "Agregar",
    cancelButtonText: "Cancelar",
    showCancelButton: true,
    allowOutsideClick:false,
    showCloseButton: true,
    width:700,
    preConfirm: () => {
        $("#comentarioIncidencia").removeClass("is-invalid");
        if($("#comentarioIncidencia").val() === "" || $("#comentarioIncidencia").val() === null){
            $("#comentarioIncidencia").addClass("is-invalid");
            $("#comentarioIncidencia").focus();
            Swal.showValidationMessage('Debe ingresar un comentario')
        } else {
            let mensaje = '', icon = '';
            let form_data = {
                idTarea: $("#idTareaIncidencia").val(),
                comentarioIncidencia: $("#comentarioIncidencia").val()
            };
            $.ajax({
                url: "agregarIncidencias",
                type: "POST",
                data: form_data,
                success: function (data) {
                    let obj = jQuery.parseJSON(data);
                    $.each(obj, function (i, key) {
                        mensaje = key["mensaje"];
                        icon = key["tipo"];
                    });
                    Swal.fire({
                        text: mensaje,
                        icon: icon,
                        allowOutsideClick: false
                    }).then((result) =>{
                        Tasks($("#txtIdArea").val(),$("#contadorClick").val());
                    });
                }
            });
        }
     }
  });
}

function verIncidencias(idTarea,orden){
    //$("#modalVerTodos").modal("hide");
    $("#timeline").html("");
    $("#spanOrdenIncidencia").text(orden);
    let e = 0;
    let colores = ["bg-info","bg-success","bg-danger","bg-warning","bg-primary"];
    $.ajax({
        url: "mostrarIncidencias/"+idTarea,
        type: "GET",
        async: false,
        success: function (data){
            if (data != "") {
               let obj = jQuery.parseJSON(data);
               $.each(obj, function (i, key) {
                $("#timeline").append(`<div class="timeline-item">
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
    $("#modalIncidencias").modal("show");
}

/********Observaciones treas*********** */
function contadorObservaciones(){
    $.ajax({
        url: "contadorIncidencias",
        type: "POST",
        async: false,
        success: function(data){
            let obj = jQuery.parseJSON(data);
            $.each(obj, function (i, key) {
                $(".recorrer").each(function(){
                    if(Number($(this).text()) === key.IdOrden){
                        $("#contadorObservaciones"+$(this).text()).text("");
                        $("#contadorObservacionesTodos"+$(this).text()).text("");
                        if(key.cantidad>0){
                            $("#contadorObservaciones"+$(this).text()).append(`
                            <span class="position-absolute top-0 start-100 translate-middle  badge badge-circle badge-danger">${key.cantidad}</span>
                        `);
                        $("#contadorObservacionesTodos"+$(this).text()).append(`
                            <span class="position-absolute top-0 start-100 translate-middle  badge badge-circle badge-danger">${key.cantidad}</span>
                        `);
                        }
                    }
                });

            });
        }
    });
}


function verTodos(dia) {
    let txtIdArea = $("#txtIdArea").val();
    let date = $("#fechaTask"+dia).text();
    let fecha = date.replace("Fecha: ", "");
    let detalle = '', button = '', button1 = '', checkTodo = '', checkParcial = '',
        btn = '', check = '', estilo ='';
    $("#diaVerTodos").text(dia);
    $("#fechaVerTodos").text(fecha);
    $("#tareasVerTodos").html("");
    $.ajax({
                    url: "<?php echo base_url("index.php/mostrarTaskSemanaTodos") ?>"+"/"+txtIdArea+"/"+fecha+"/"+$("#contadorClick").val(),
                    type: "POST",
                    async: false,
                    success: function (data) {
                        if (data != "") {
                            let obj = jQuery.parseJSON(data);
                            $.each(obj, function (i, key) {
                                //btn = `onclick="recepcionMaterialBtn('${key.Id}')" style="cursor:pointer;"`;
                                btn = "";
                                check = `onchange="recepcionMaterial('${key.Id}','${key.NotaParcial}')"`;
                                estilo = 'style="disaplay:block;"';
                                if(key.EstadoTareaChar === "A" || key.EstadoTareaChar === "E" || key.EstadoTareaChar === "P"){
                                    estilo = `style="display:block;"`;
                                }else{
                                    estilo = `style="display:none;"`;
                                }
                                switch (key.Prioridad) {
                                    case 1:
                                        prioridad = "border-success";
                                        title = "Prioridad Normal";
                                        break;
                                    case 2:
                                        prioridad = "border-warning";
                                        title = "Prioridad Alta";
                                        break;
                                    case 3:
                                        prioridad = "border-danger";
                                        title = "Prioridad Urgente";
                                        break;
                                    default:
                                        break;
                                }
                                if(key.TipoEntrega == 1){
                                    checkTodo = "checked";
                                    checkParcial = "";
                                }else if(key.TipoEntrega == 2){
                                    checkTodo = "";
                                    checkParcial = "checked";
                                }else{
                                    checkTodo = "";
                                    checkParcial = "";
                                }
                                if(key.EstadoTareaChar === "A" || key.EstadoTareaChar === "E"){
                                    detalle = '';
                                    button = `<div class="separator mt-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3 py-3">
                                                            <a onclick="atenderTarea('${key.Id}','${key.IdArea}')" class="btn btn-primary btn-sm px-4" href="javascript:void(0)"><i class="fas fa-lock fa-fw"></i> Atender tarea</a>
                                                        </div>
                                                    </div>`;
                                     button1 = `
                                                    <span class="badge badge-primary fw-bold ">
                                                        <a class="text-white" onclick="atenderTarea('${key.Id}','${key.IdArea}')" href="javascript:void(0)"><i class="fas fa-lock text-white fa-fw"></i> Atender</a>
                                                    </span>
                                                    <!--<div class="d-flex flex-stack">
                                                        <div class="me-3">
                                                            <br>
                                                            <span class="w-50px ms-n1 me-1 text-gray-800 text-hover-primary fw-bolder">

                                                            </span>
                                                        </div>
                                                    </div>-->`;
                                }else{
                                    detalle = '';
                                    let idUsuario = $("#txtIdUsuarioLog").val();
                                    if(key.IdUsuarioAtiende === Number(idUsuario) && key.EstadoTareaChar === "P"){
                                        button = `<div class="separator mt-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3 py-3">
                                                            <a onclick="cerrarTarea('${key.Id}')" class="btn btn-success btn-sm px-4" href="javascript:void(0)"><i class="fas fa-check-circle fa-fw"></i> Cerrar tarea</a>
                                                        </div>
                                                    </div>`;
                                                    button1 = `
                                                    <span class="badge badge-success fw-bold">
                                                        <a onclick="cerrarTarea('${key.Id}')" class="text-white" href="javascript:void(0)"><i class="fas fa-check-circle fa-fw text-white"></i> Cerrar</a>
                                                    </span>
                                                   <!--<div class="d-flex flex-stack">
                                                        <div class="me-3">
                                                            <br>
                                                            <span class="w-50px ms-n1 me-1 text-gray-800 text-hover-primary fw-bolder">

                                                            </span>
                                                        </div>
                                                    </div>-->`;
                                        detalle = ` <div class="menu-item px-3">
                                                                <a id="detTareas1${key.Id}" href="javascript:void(0)" onclick="detTareas('${key.Id}','${key.NoOrdenTrabajo}','${key.Fecha}','${key.FechaRealEntrega}','${key.Nombre}','${key.Cantidad}','${key.Descripcion}','${key.Prioridad}','${key.IdArea}','${key.NombreArea}','${key.Imagen}','${key.ContactoCliente}')" class="menu-link px-3"><i class="fas fa-exclamation-circle fa-fw"></i> Detalles de tarea</a>
                                                            </div>`;
                                    }else if( key.EstadoTareaChar === "F" || key.EstadoTareaChar === "P"){
                                        button = '';
                                        button1 = "";
                                        detalle = ` <div class="menu-item px-3">
                                                                <a id="detTareas1${key.Id}" href="javascript:void(0)" onclick="detTareas('${key.Id}','${key.NoOrdenTrabajo}','${key.Fecha}','${key.FechaRealEntrega}','${key.Nombre}','${key.Cantidad}','${key.Descripcion}','${key.Prioridad}','${key.IdArea}','${key.NombreArea}','${key.Imagen}','${key.ContactoCliente}')" class="menu-link px-3"><i class="fas fa-exclamation-circle fa-fw"></i> Detalles de tarea</a>
                                                            </div>`;
                                }else{
                                        button = "";
                                        button1 = "";
                                       // btn = 'style="cursor:not-allowed;"'
                                       btn = "";
                                        check = `disabled`;
                                    }
                                }
                                if(key.EstadoTareaChar != "R" && key.EstadoTareaChar != "I"){
                                    opciones = `<button  onclick="crearInstancia('${key.Dia}')" class="btn btn-icon btn-color-gray-400 btn-active-color-primary mt-n2 me-n3"
                                                    data-kt-menu-placement="top-start"  data-kt-menu-trigger="click"
                                                    data-kt-menu-overflow="true">
                                                    <span onclick="crearInstancia('${key.Dia}')" class="svg-icon svg-icon-3x">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="black"></rect>
                                                            <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="black">
                                                            </rect>
                                                            <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="black">
                                                            </rect>
                                                            <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="black"></rect>
                                                        </svg>
                                                    </span>
                                                </button>
                                                <div onmouseleave="ocultar('${key.Dia}')" id="kt_menu${key.Dia}" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-250px menuTask"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">
                                                           Acciones </div>
                                                    </div>
                                                    <div class="separator mb-3 opacity-75"></div>
                                                    <?php $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "17");if ($permiso) {?>
                                                        <div class="menu-item px-3">
                                                            <a onclick="reprogramarTarea('${key.Id}','${key.NoOrdenTrabajo}','${key.Fecha}','${key.FechaRealEntrega}','${key.Nombre}','${key.Cantidad}','${key.Descripcion}','${key.Prioridad}','${key.IdArea}','${key.NombreArea}','${key.ContactoCliente}')" href="javascript:void(0)" class="menu-link px-3"><i class="fas fa-calendar-plus fa-fw"></i> Reprogramar Tarea</a>
                                                        </div>
                                                    <?php }?>
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" onclick="enEspera('${key.Id}')" class="menu-link px-3"><i class="fas fa-hand-paper fa-fw"></i> Poner en espera</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                                <a href="javascript:void(0)" onclick="agregarIncidencia('${key.Id}')" class="menu-link px-3"><i class="fas fa-comment fa-fw"></i> Agregar observaciones</a>
                                                            </div>
                                                            <div class="menu-item px-3">
                                                                <a href="javascript:void(0)" onclick="verIncidencias('${key.Id}','${key.NoOrdenTrabajo}')" class="menu-link px-3"><i class="fas fa-comments fa-fw"></i> Ver observaciones</a>
                                                            </div>
                                                            <div class="menu-item px-3">
                                                                <a href="javascript:void(0)" onclick="verComentEspera('${key.Id}')" class="menu-link px-3"><i class="fas fa-hand-paper fa-fw"></i> Ver comentario espera</a>
                                                            </div>
                                                           ${detalle}
                                                     <?php $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "25");if ($permiso) {?>
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)" onclick="editTareas('${key.Id}','${key.NoOrdenTrabajo}','${key.Fecha}','${key.FechaRealEntrega}','${key.Nombre}','${key.Cantidad}','${key.Descripcion}','${key.Prioridad}','${key.IdArea}','${key.NombreArea}','${key.ContactoCliente}')" class="menu-link px-3 text-info"><i class="fas fa-pen fa-fw text-info"></i> Editar Tarea</a>
                                                        </div>
                                                    <?php }?>

                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" onclick="anularTarea('${key.Id}')" class="menu-link px-3 text-danger"><i class="fas fa-ban fa-fw text-danger"></i> Anular Tarea</a>
                                                    </div>
                                                    ${button}
                                                </div>`;
                                }else{
                                    opciones = '';
                                }
                                $("#tareasVerTodos").append(`
                                    <div class="overflow-hidden position-relative card px-7 pt-3 pb-2 border-dashed border-1 border-gray-300 mb-3" style="background:#F8F6F2;">
                                        <div data-bs-toggle="tooltip" title="${title}" data-bs-original-title="${title}"
                                            data-bs-placement="right" class="ribbon ribbon-triangle ribbon-top-end ${prioridad}">
                                            <!--begin::Ribbon icon-->
                                            <div class="ribbon-icon mt-n5 me-n6">
                                                <!--begin::Svg Icon | path: icons/duotune/electronics/elc006.svg-->
                                                <span style="display:none;" class="recorrer">${key.Id}</span>
                                                <span class="recorrer svg-icon svg-icon-2 svg-icon-white" id="contadorObservaciones${key.Id}">

                                                </span>
                                                <span class="recorrer svg-icon svg-icon-2 svg-icon-white" id="contadorObservacionesTodos${key.Id}">

                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Ribbon icon-->
                                        </div><br>
                                        <!--begin::Section-->
                                        <div class="d-flex flex-stack mb-2">
                                            <!--begin::Section-->
                                            <div class="me-3">
                                                <!--begin::Icon-->
                                                <span class="w-50px ms-n1 me-1 text-gray-800 text-hover-primary fw-bolder">Orden: </span>
                                                <span class="w-50px ms-n1 me-1">${key.NoOrdenTrabajo}</span>
                                                <!--end::Icon-->
                                                <br>
                                                <span class="w-50px ms-n1 me-1 text-gray-800 text-hover-primary fw-bolder">Pedido: </span>
                                                <span class="w-50px ms-n1 me-1">${key.Nombre}</span>
                                                <!--begin::Title-->
                                                <br>
                                                <span class="w-50px ms-n1 me-1 text-gray-800 text-hover-primary fw-bolder">Cantidad: </span>
                                                <span class="w-50px ms-n1 me-1">${key.Cantidad}</span>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Section-->
                                            <!--begin::Action-->
                                            <div class="m-0">
                                                <!--begin::Menu-->
                                                ${opciones}
                                                <!--begin::Menu 2-->

                                                <!--end::Menu 2-->
                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Content-->
                                        <div class="d-flex flex-stack fs-7 mb-2">
                                            <!--begin::Info-->
                                            <span class="text-gray-400 fw-bolder">Atiende:
                                                <span class="text-gray-800 fw-bolder">${key.Atiende}</span></span>
                                            <!--end::Info-->
                                            <!--begin::Label-->
                                            ${key.EstadoTarea}
                                            <!--end::Label-->
                                        </div>
                                        <div class="d-flex flex-stack fs-7 mb-2">
                                            <!--begin::Info-->
                                                <span class="text-gray-800 fw-bolder" ${estilo}>
                                                <?php $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "26");if ($permiso) {?>
                                                    <div class="input-group input-group-solid mb-2" >
                                                        <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                            <input ${check} ${checkTodo} name="rbMaterial${key.Id}" id="rbMaterial1${key.Id}" class="form-check-input" type="radio" style="background-color: #109620 !important;" value="1"/>
                                                            <label class="form-check-label" for="rbMaterial1${key.Id}">
                                                                Entrega completa
                                                            </label>
                                                        </div>

                                                       <div class="form-check form-check-custom form-check-solid form-check-sm ms-2">
                                                            <input ${check} ${checkParcial} name="rbMaterial${key.Id}" id="rbMaterial2${key.Id}" style="background-color:#f06445 !important;" class="form-check-input" type="radio" value="2" onclick="recepcionMaterial('${key.Id}','${key.NotaParcial}')"/>
                                                            <label class="form-check-label" for="rbMaterial2${key.Id}">
                                                                Entrega parcial
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php }?>
                                                </span></span>
                                            ${button1}
                                        </div>
                                        <div class="d-flex flex-stack fs-7 mb-2">
                                            <!--begin::Info-->
                                            <span class="text-gray-400 fw-bolder" id="divtextarea${key.Id}">
                                                <div class="input-group">
                                                <?php $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "26");if ($permiso) {?>
                                                    <span ${btn} id="enviarNota"  class="input-group-text bg-primary text-white"><i class="text-white text-bold fas fa-save fa-fw"></i></span>
                                                    <textarea readonly style="resize: none;" rows="3" class="form-control notaRecepcionMaterial" id="notaRecepcionMaterial${key.Id}" aria-label="With textarea">${key.NotaParcial}</textarea>
                                                <?php } else {?>
                                                    <span class="input-group-text bg-primary text-white disabled"><i class="text-white text-bold fas fa-sticky-note fa-fw"></i></span>
                                                    <textarea readonly style="resize: none;" rows="3" class="form-control" aria-label="With textarea">${key.NotaParcial}</textarea>
                                                 <?php }?>

                                                </div>
                                            <span class="text-gray-800 fw-bolder">
                                            </span></span>
                                        </div>
                                    </div>
                                `);
                            });
                        }
                        KTMenu.createInstances();
                    }
                });
         contadorObservaciones();
        $("#modalVerTodos").modal("show");

}

/*function recepcionMaterialBtn(idTarea){
    let valorRadio = '',
        comentarioParcial = '';
        valorRadio = $("#rbMaterial2"+idTarea).val();
        comentarioParcial = '';
        let mensaje = '', icon = '';
        let form_data = {
            idTarea: idTarea,
            valorRadio : valorRadio,
            comentarioParcial: $("#notaRecepcionMaterial"+idTarea).val()
        };
        $.ajax({
            url: "entregaMateriales",
            type: "POST",
            data: form_data,
            success: function (data) {
                let obj = jQuery.parseJSON(data);
                $.each(obj, function (i, key) {
                    mensaje = key["mensaje"];
                    icon = key["tipo"];
                });
                Swal.fire({
                    text: mensaje,
                    icon: icon,
                    allowOutsideClick: false
                }).then((result) =>{
                    Tasks($("#txtIdArea").val(),$("#contadorClick").val());
                });
            }
        });

}*/

function recepcionMaterial(idTarea,valor){
    let valorRadio = '',
        comentarioParcial = '';
    if($("#rbMaterial2"+idTarea).prop("checked") == true){
       //$("#divtextarea"+idTarea).show();
        Swal.fire({
    //title: '<label for="comentarioEspera" class="form-label ">Poner Tarea en espera </label>',
    title: '<span class="text-white"><i class="fas fa-comment fa-fw fa-2x"></i>Agregar nota</span>',
    html:
        `<div class="row col-md-12">
            <div class="col-md-12 fv-row">
                <!--begin::Input group-->
                <div class="input-group mb-5">
                    <span class="input-group-text" id="basic-addon1">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                    fill="black"></path>
                                <path opacity="0.3"
                                    d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                    fill="black"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <textarea rows="4" placeholder="Observaciones" id="notaRecepcionMaterial1${idTarea}" class="form-control valida1">${valor}</textarea>
                </div>
                <!--end::Input group-->
            </div>
        </div>`,
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-danger me-3',
      title: 'modal-header bg-danger'
    },
    didOpen: () => {
        Swal.getHtmlContainer().querySelector('.form-control').focus()
    },
    buttonsStyling: false,
    confirmButtonText: "Agregar",
    cancelButtonText: "Cancelar",
    showCancelButton: true,
    allowOutsideClick:false,
    showCloseButton: true,
    width:700,
    preConfirm: () => {
        $("#notaRecepcionMaterial1"+idTarea).removeClass("is-invalid");
        if($("#notaRecepcionMaterial1"+idTarea).val() === "" || $("#notaRecepcionMaterial1"+idTarea).val() === null){
            $("#notaRecepcionMaterial1"+idTarea).addClass("is-invalid");
            $("#notaRecepcionMaterial1"+idTarea).focus();
            Swal.showValidationMessage('Debe ingresar una nota')
        } else {
           let valorRadio = '',
                comentarioParcial = '';
                valorRadio = $("#rbMaterial2"+idTarea).val();
                comentarioParcial = '';
                let mensaje = '', icon = '';
                let form_data = {
                    idTarea: idTarea,
                    valorRadio : valorRadio,
                    comentarioParcial: $("#notaRecepcionMaterial1"+idTarea).val()
                };
                $.ajax({
                    url: "entregaMateriales",
                    type: "POST",
                    data: form_data,
                    success: function (data) {
                        let obj = jQuery.parseJSON(data);
                        $.each(obj, function (i, key) {
                            mensaje = key["mensaje"];
                            icon = key["tipo"];
                        });
                        Swal.fire({
                            text: mensaje,
                            icon: icon,
                            allowOutsideClick: false
                        }).then((result) =>{
                            Tasks($("#txtIdArea").val(),$("#contadorClick").val());
                        });
                    }
                });
        }
     }
  });
        //$("#notaRecepcionMaterial1"+idTarea).focus();
    }else{
       //$("#divtextarea"+idTarea).hide();
        valorRadio = $("#rbMaterial1"+idTarea).val();
        comentarioParcial = '';
        let mensaje = '', icon = '';
        let form_data = {
            idTarea: idTarea,
            valorRadio : valorRadio,
            comentarioParcial: comentarioParcial
        };
        $.ajax({
            url: "entregaMateriales",
            type: "POST",
            data: form_data,
            success: function (data) {
                let obj = jQuery.parseJSON(data);
                $.each(obj, function (i, key) {
                    mensaje = key["mensaje"];
                    icon = key["tipo"];
                });
                Swal.fire({
                    text: mensaje,
                    icon: icon,
                    allowOutsideClick: false
                }).then((result) =>{
                    Tasks($("#txtIdArea").val(),$("#contadorClick").val());
                });
            }
        });
    }
}

function verComentEspera(idTarea) {
    $("#modalEsperaTitle").empty().text("Detalle orden en espera");
    $.ajax({
        url: "<?php echo base_url("index.php/mostrarComentEspera/") ?>"+idTarea,
        type: "GET",
        success: function (data) {
            let obj = jQuery.parseJSON(data);
            $.each(obj, function (i, key) {
                if(key["ComentarioEspera"] != ""){
                    $("#numOrdenEspera").val(key["NoOrdenTrabajo"]);
                    $("#usuarioEspera").val(key["Usuario"]);
                    $("#nombreEspera").val(key["Nombre"]);
                    $("#cantidadEspera").val(key["Cantidad"]);
                    $("#descripcionEspera").val(key["Descripcion"]);
                    $("#comentarioEspera").val(key["ComentarioEspera"]);
                }else{
                    $("#numOrdenEspera").val("");
                    $("#usuarioEspera").val("");
                    $("#nombreEspera").val("");
                    $("#cantidadEspera").val("");
                    $("#descripcionEspera").val("");
                    $("#comentarioEspera").val("");
                    $("#comentarioEspera").val("Sin Comentarios");
                }
            });
        }
    });
    $("#modalComentEspera").modal("show");
}

function encodeImageFileAsURL(element) {
  $("#image").text("");
  var file = element.files[0];
  var reader = new FileReader();
  reader.onloadend = function() {
    $("#image").text(reader.result);
  }
  let base = reader.result;
  reader.readAsDataURL(file);
}

function editTareas(idTarea,orden,fecha,fechareal,tarea,cantidad,desc,prioridad,idarea,area,cliente){
    //$("#modalVerTodos").modal("hide");
    $(".imageuploadify-container").remove();
    $("#divImagen2").show();
    $("#divImagen").hide();
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
    $("#chkAlta,#chkNormal,#chkUrgente").removeClass("disabled");
    let campos = document.querySelectorAll("#campos input.valida1, textarea.form-control");
    /*[].slice.call(campos).forEach(function (campo) {
        $("#" + campo.id).attr("disabled",false);
     });*/
    $("#listAreas option:selected").val(idarea).attr("disabled",false);
     $("#fecha,#listAreas,#cliente").attr("disabled",false);
    $("#idTarea").val(idTarea);
    $("#numOrden").attr("disabled", true);
    $("#numOrden").val(orden.trim());
    $("#fecha").val(fecha);
    $("#fechareal").val(fechareal);
    $("#nombre").val(tarea.trim());
    $("#cantidad").val(cantidad);
    $("#descripcion").val(desc.trim());
    $("#listAreas option:selected").val(idarea)
    $("#select2-listAreas-container").text(area).trigger('change');
    $(".change_image").show();
   // $("#imagenTarea").css({'background-image':'url('+imagen+')'});
    //$("#image").text(imagen);
    $("#imgAdjunta3").hide();
    $("#imgAdjunta3").attr("src","");
    $("#modalTitle").text("Editar Tarea");
    switch (Number(prioridad)) {
        case 1:
              $("#chkNormal").addClass("active");
              $("#chkNormal").removeClass("disabled");
              $("#chkAlta,#chkUrgente").removeClass("active");
            break;
        case 2:
              $("#chkAlta").addClass("active");
              $("#chkAlta").removeClass("disabled");
              $("#chkNormal,#chkUrgente").removeClass("active");
            break;
        case 3:
              $("#chkUrgente").addClass("active");
              $("#chkUrgente").removeClass("disabled");
              $("#chkNormal,#chkAlta").removeClass("active");
            break;
        default:
              $("#chkNormal").addClass("active");
            break;
    }
    if(Number(idarea) === 5){
        $("#divCliente").show();
        $("#cliente").val(cliente);
        $("#cliente").addClass("valida1");
    }else{
        $("#divCliente").hide();
        $("#cliente").val("null");
        $("#cliente").removeClass("valida1");
    }
    $("#btnAppend").empty();
    $.ajax({
        url: "mostrarImagenes/"+idTarea,
        type: "GET",
        success: function(data){
            let obj = jQuery.parseJSON(data);
            $.each(obj, function(i,key){
                $("#btnAppend").append(`
                    <div class="imageuploadify-container" style="margin-left: 5px;">
                      <button type="button" onclick="$(this).parent().remove();" class="btn btn-danger"></button>
                        <div class="imageuploadify-details" style="opacity: 0;">
                        </div>
                        <img src="${key["Imagen"]}">
                     </div>`)
            });
        }
    });
    $("#btnReprogramar").hide();
    $("#btnActualizarTask").show();
    $("#modalTareas").modal("show");
}

$("#listAreas").change(function () {
    $("#cliente").removeClass('is-invalid');
    if(Number($("#listAreas").val()) === 7){
        $("#numOrden").val("");
    }
    if(Number($(this).val()) === 5){
        $("#divCliente").show();
        $("#cliente").addClass('valida1');
    }else{
        $("#divCliente").hide();
        $("#cliente").removeClass('valida1');
    }
});

$("#btnActualizarTask").click(function () {
    //$("#loading").modal("show");
    let lengthOrden = false;
    $("#numOrden").addClass("valida1");
    let campos, valido;
    campos = document.querySelectorAll("#campos .valida1, textarea .valida1");
    valido = true;

    [].slice.call(campos).forEach(function (campo) {
        $("#" + campo.id).removeClass("is-invalid");

        if (campo.value.trim() === '') {
            valido = false;
            $("#" + campo.id).addClass("is-invalid");
        }else{ valido = true;}

    });

    if($("#listAreas option:selected").val() == 7){
        $("#numOrden").removeClass("valida1");
        $("#numOrden").removeClass("is-invalid");
        lengthOrden = false;
    }else{
        /*$("#numOrden").addClass("valida");*/
        $("#numOrden").addClass("valida1");
        lengthOrden = true;
    }

    if (valido) {
        let bandera = true, valida = false;

        if(lengthOrden){
            if($("#numOrden").val().length >= 3){
                bandera = true;
            }else{
                $("#loading").modal("hide");
                bandera = false;
                Swal.fire({
                    text: "El número de orden debe tener como mínimo tres dígitos.",
                    icon: "warning",
                    buttonsStyling: false,
                    confirmButtonText: "Cerrar",
                    allowOutsideClick: false,
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        }

        if(bandera){
            let guardar = false;
            if(!$("#chkNormal").hasClass("active") && !$("#chkAlta").hasClass("active") && !$("#chkUrgente").hasClass("active")){
                $("#loading").modal("hide");//5555
                Swal.fire({
                    text: "Debe seleccionar un nivel de prioridad",
                    icon: "warning",
                    buttonsStyling: false,
                    confirmButtonText: "Cerrar",
                    allowOutsideClick: false,
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }else{
                guardar = true;
            }
            if(Number($("#listAreas option:selected").val()) < 1){
                $("#loading").modal("hide");
                guardar = false;
                Swal.fire({
                    allowOutsideClick: false,
                    icon: "warning",
                    text: "Debe seleccionar un área",
                    confirmButtonText: "cerrar",
                    customClass: {
                                confirmButton: "btn btn-primary"
                            }
                });
            }
           if(guardar){
            let mensaje = "", icon = "";
            let prioridad = 0;
            if($("#chkNormal").hasClass("active")){
                    prioridad = 1;
                }else if($("#chkAlta").hasClass("active")){
                    prioridad = 2;
                }else if($("#chkUrgente").hasClass("active")){
                    prioridad = 3;
                }

            let form_data = {
                idTarea : $("#idTarea").val(),
                nombre: $("#nombre").val(),
                cantidad: $("#cantidad").val(),
                descripcion: $("#descripcion").val(),
                numOrden: $("#numOrden").val(),
                prioridad: prioridad,
                idArea: $("#listAreas option:selected").val(),
                fecha: $("#fecha").val(),
                fechareal: $("#fechareal").val(),
                imagen: $("#image").text(),
                cliente: $("#cliente").val()
            };

            console.log(form_data);

            $.ajax({
                url: "actualizarTarea",
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
                        //$("#loading").modal("hide");
                        //$("#modalTareas").modal("hide")
                        subirMultiImagenes($("#numOrden").val(),$("#listAreas option:selected").val());
                       // cargarTareas();
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

function subirMultiImagenes(numOrden,idArea){
    
    let array = new Array(), i = 0, form_data = {}, mensaje = "", icon = "";
    //$("#loading").modal("hide");
    $(".imageuploadify-container img").each(function(){
        //console.log($(this).attr("src"));
        array[i] = [];
        array[i][0] = numOrden;
        array[i][1] = $(this).attr("src");
        array[i][2] = idArea;
        i++;
    });



    if(array.length != 0){
        /*Swal.fire({
           title: 'Procesando imágenes espere por favor !',
           html: `<div class="text-center">
                    <img width="100px" src="<?php echo base_url() ?>assets/img/loading.gif">
                </div>`,// add html attribute if you want or remove
           allowOutsideClick: false,
           showConfirmButton: false,
           //timer: 1500,
           onBeforeOpen: () => {
               Swal.showLoading()
           },
        });*/
        form_data.datos = JSON.stringify(array);
        $.ajax({
            url: "guardarMultiImagenes/"+numOrden+"/"+idArea,
            type: "POST",
            data: form_data,
            success: function(data){
                //$("#loading").modal("hide");
                        //$("#modalTareas").modal("hide")
                    cargarTareas();
                /*Swal.hideLoading()
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
                        //$("#modalTareas").modal("hide")
                    cargarTareas();
                });*/
            }
        });
        console.log(form_data);
    }
}
</script>