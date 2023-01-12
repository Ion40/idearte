<script>
$(document).ready(function () {
    $("#multiple").imageuploadify();
    cargarTareas();
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
});

$("#btnAddTask").click(function () {
    $("#modalTitle").text("Nueva Tarea");
    $("#btnAppend").empty();
    $(".imageuploadify-container").remove();
    //$("#divImagen2").hide();
    $("#btnGuardarTask").show();
    $("#listAreas,#fecha").attr("disabled", false);
    $("#cliente").val("");
    $("#btnActualizarTask").hide();
    $("#listAreas").val(null).trigger("change");
    //$("#select2-listAreas-container").text(null).trigger('change');
    let campos = document.querySelectorAll("#campos input.valida, textarea.form-control");
    [].slice.call(campos).forEach(function (campo) {
        $("#" + campo.id).attr("disabled",false);
        $("#" + campo.id).removeClass("is-invalid");
        campo.value = "";
     });
     $("#chkAlta,#chkNormal,#chkUrgente").removeClass("disabled");
    $("#modalTareas").modal("show");
});

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


$("#btnGuardarTask").click(function () {
    //$("#loading").modal("show");
    let lengthOrden = false;

    let campos, valido;
    campos = document.querySelectorAll("#campos .valida, textarea.form-control");
    valido = true;

    [].slice.call(campos).forEach(function (campo) {
        $("#" + campo.id).removeClass("is-invalid");

        if (campo.value.trim() === '') {
            valido = false;
            $("#" + campo.id).addClass("is-invalid");
        }else{ valido = true;}

    });

    if($("#listAreas option:selected").val() == 7){
        $("#numOrden").removeClass("valida");
        $("#numOrden").removeClass("is-invalid");
        lengthOrden = false;
    }else{
        /*$("#numOrden").addClass("valida");*/
        $("#numOrden").addClass("valida");
        lengthOrden = true;
    }

    if (valido) {
        let bandera = true, valida = false;

        if(lengthOrden){
            debugger;
            let numOrdenLength = $("#numOrden").val();
            if(numOrdenLength.length >= 3){
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
                $("#loading").modal("hide");
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
            }/*else if(Number($("#listAreas option:selected").val()) == 5){
                if($("#cliente").val() == ""){
                    $("#loading").modal("hide");
                    guardar = false;
                    Swal.fire({
                        allowOutsideClick: false,
                        icon: "warning",
                        text: "Debe la información del cliente",
                        confirmButtonText: "cerrar",
                        customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                    });
                }
            }*/
            
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
                nombre: $("#nombre").val(),
                cantidad: $("#cantidad").val(),
                descripcion: $("#descripcion").val(),
                numOrden: $("#numOrden").val(),
                prioridad: prioridad,
                idArea: $("#listAreas option:selected").val(),
                fecha: $("#fecha").val(),
                fechareal: $("#fechareal").val(),
               // imagen: $("#image").text(),
                cliente: $("#cliente").val()
            };

            console.log(form_data);

            $.ajax({
                url: "guardarTarea",
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
                       
                        $("#nombre").val("");
                        $("#cantidad").val("");
                        $("#descripcion").val("");
                        $("#numOrden").val("");
                        $("#chkNormal").removeClass("active");
                        $("#chkAlta").removeClass("active");
                        $("#chkUrgente").removeClass("active");
                        $("#cliente").val("");
                        $("#btnAppend").empty();
                        $(".imageuploadify-container").remove();
                        cargarTareas();
                        /*if($("#rbImagenes1").prop("checked") == true){
                            $("#loading").modal("hide");
                            //$("#modalTareas").modal("hide")
                            $("#nombre").val("");
                            $("#cantidad").val("");
                            $("#descripcion").val("");
                            $("#numOrden").val("");

                            $("#chkNormal").removeClass("active");
                            $("#chkAlta").removeClass("active");
                            $("#chkUrgente").removeClass("active");
                            cargarTareas();
                        }else if($("#rbImagenes2").prop("checked") == true){
                            subirMultiImagenes($("#numOrden").val(),$("#listAreas option:selected").val());
                        }*/
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

function cargarTareas(){
    let table = $("#tblTareas").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: true,
        destroy: true,
        "ajax": {
            "url": "getTareasAjax",
            "type": "POST"
        },
        columns: [
            {data: "NoOrdenTrabajo"},
            {data: "NombreArea"},
            {data: "Nombre"},
            {data: "Cantidad"},
            {data: "Descripcion"},
            {data: "Prioridad"},
            {data: "Estado"},
            {data: "FechaCrea"},
            {data: "Opciones"}
            ],
        "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "Todo"]
            ],
            "order": [
                [7, "desc"]
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
                "processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url() ?>assets/img/loading.gif'></i></div>",
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
                        cargarTareas();
                    });
                }
            });
        }
    });
}

function detTareas(idTarea,orden,fecha,fechareal,tarea,cantidad,desc,prioridad,idarea,area,imagen){
    //$("#modalVerTodos").modal("hide");
    $(".imageuploadify-container").remove();
    $("#idTarea").val(idTarea);
    $("#numOrden").val(orden.trim());
    $("#fecha").val(fecha);
    $("#nombre").val(tarea.trim());
    $("#cantidad").val(cantidad);
    $("#descripcion").val(desc.trim());
    $("#listAreas option:selected").val(idarea)
    $("#listAreas").attr("disabled", true);
    $("#select2-listAreas-container").text(area).trigger('change');
    $("#imagenTarea").css('background-image', imagen);
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
    $("#btnAppend").empty();
    $.ajax({
        url: "mostrarImagenes/"+idTarea,
        type: "GET",
        success: function(data){
            let obj = jQuery.parseJSON(data);
            $.each(obj, function(i,key){
                $("#btnAppend").append(`
                    <div class="imageuploadify-container" style="margin-left: 5px;">
                      <button onclick="$(this).parent().remove();" type="button" class="btn btn-danger removebtn"></button>
                        <div class="imageuploadify-details" style="opacity: 0;">
                        </div>
                        <img src="${key["Imagen"]}">
                     </div>`)
            });
        }
    });
    let campos = document.querySelectorAll("#campos input.valida, textarea.form-control");
    [].slice.call(campos).forEach(function (campo) {
        $("#" + campo.id).attr("disabled",true);
     });
     $("#fecha").attr("disabled", true);
    $("#campos").show();
    $("#btnGuardarTask").hide();
    $("#modalTareas").modal("show");
}

function editTareas(idTarea,orden,fecha,fechareal,tarea,cantidad,desc,prioridad,idarea,area,cliente){ //imagen
    //$("#modalVerTodos").modal("hide");
    $(".imageuploadify-container").remove();
    $("#chkAlta,#chkNormal,#chkUrgente").removeClass("disabled");
    let campos = document.querySelectorAll("#campos input.valida, textarea.form-control");
    [].slice.call(campos).forEach(function (campo) {
        $("#" + campo.id).attr("disabled",false);
     });
     $("#fecha").attr("disabled",false);
    $("#idTarea").val(idTarea);
    $("#numOrden").val(orden.trim());
    $("#fecha").val(fecha);
    $("#fechareal").val(fechareal);
    $("#nombre").val(tarea.trim());
    $("#cantidad").val(cantidad);
    $("#descripcion").val(desc.trim());
    $("#listAreas option:selected").val(idarea)
    $("#select2-listAreas-container").text(area).trigger('change');
    //$("#imagenTarea").css({'background-image':'url('+imagen+')'});
    //$("#image").text(imagen);
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
        $("#cliente").addClass("valida");
    }else{
        $("#divCliente").hide();
        $("#cliente").val("");
        $("#cliente").removeClass("valida");
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
                      <button onclick="$(this).parent().remove();" type="button" class="btn btn-danger removebtn"></button>
                        <div class="imageuploadify-details" style="opacity: 0;">
                        </div>
                        <img src="${key["Imagen"]}">
                     </div>`)
            });
        }
    });
    $("#btnGuardarTask").hide();
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
        $("#cliente").addClass('valida');
    }else{
        $("#divCliente").hide();
        $("#cliente").removeClass('valida');
    }
});

$("#btnActualizarTask").click(function () {
    //$("#loading").modal("show");
    let lengthOrden = false;
    $("#numOrden").addClass("valida");
    let campos, valido;
    campos = document.querySelectorAll("#campos .valida, textarea.form-control");
    valido = true;

    [].slice.call(campos).forEach(function (campo) {
        $("#" + campo.id).removeClass("is-invalid");

        if (campo.value.trim() === '') {
            valido = false;
            $("#" + campo.id).addClass("is-invalid");
        }else{ valido = true;}

    });

    if($("#listAreas option:selected").val() == 7){
        $("#numOrden").removeClass("valida");
        $("#numOrden").removeClass("is-invalid");
        lengthOrden = false;
    }else{
        /*$("#numOrden").addClass("valida");*/
        $("#numOrden").addClass("valida");
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
                        subirMultiImagenes($("#numOrden").val(),$("#listAreas option:selected").val());
                        /*$("#nombre").val("");
                        $("#cantidad").val("");
                        $("#descripcion").val("");
                        $("#numOrden").val("");
                        $("#chkNormal").removeClass("active");
                        $("#chkAlta").removeClass("active");
                        $("#chkUrgente").removeClass("active");*/
                        cargarTareas();
                        /*$("#loading").modal("hide");
                        $("#modalTareas").modal("hide")
                        cargarTareas();*/
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

/*function cambiarImagenes(val){
    if(val == 2){
        $("#divImagen1").hide();
        $("#divImagen2").show();
    }else{
        $("#divImagen1").show();
        $("#divImagen2").hide();
    }
}*/

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
                $("#loading").modal("hide");
                    //$("#modalTareas").modal("hide")
                    $("#nombre").val("");
                    $("#cantidad").val("");
                    $("#descripcion").val("");
                    $("#numOrden").val("");
                    $("#chkNormal").removeClass("active");
                    $("#chkAlta").removeClass("active");
                    $("#chkUrgente").removeClass("active");
                    cargarTareas();
                    
               /* Swal.hideLoading()
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
                    $("#nombre").val("");
                    $("#cantidad").val("");
                    $("#descripcion").val("");
                    $("#numOrden").val("");
                    $("#chkNormal").removeClass("active");
                    $("#chkAlta").removeClass("active");
                    $("#chkUrgente").removeClass("active");
                    cargarTareas();
                });*/
            }
        });
        console.log(form_data);
    }
}
</script>