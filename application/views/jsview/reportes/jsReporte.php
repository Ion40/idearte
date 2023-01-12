<script>
$(document).ready(function () {  
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

    $("#fechaInicio,#fechaFin").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        //parentEl: "#modalTareas .modal-body",
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

function mostrarOrdenesRpt() {
    //
    let form_data = {
        fechainicio: $("#fechaInicio").val(),
        fechaFin: $("#fechaFin").val(),
        idArea: $("#listAreas option:selected").val()
    };
    let table = $("#tblHistorial").DataTable({
			searchDelay: 500,
			processing: true,
			serverSide: true,
			stateSave: false,
            scrollX: true,
			destroy: true,
			"ajax": {
				"url": "mostrarOrdenesRpt",
				"type": "POST",
                "data": form_data
			},
			columns: [
            {data: "IdOrden"},
            {data: "FechaOrden"},
            {data: "DescripcionOrden"},
            {data: "NombreArea"},
            {data: "Nombre"},
            {data: "FechaCrea"},
            {data: "estadoAct"}
			],order: [[3,"asc"]],
            rowGroup:{
                dataSrc:"NombreArea"
            },columnDefs: [ {
                targets: [3],
                visible: false
            } ],
			"lengthMenu": [
				[5,10, 25, 50, 100, -1],
				[5,10, 25, 50, 100, "Todo"]
			],
			/*"order": [
				[0, "asc"]
			],*/
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
			"rowCallback": function( row, data, index ) {
				switch (data.estado){
					case "P":
						$(row).addClass("bg-warning");
						break;
					default:
						$(row).removeClass("bg-warning");
						break;
				}
			},
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"

		});
}

$("#btnHistory").click(function () {
    mostrarOrdenesRpt();
});

function imprimirOrdenes(){
    let t = $("#tblHistorial").DataTable();
    if (!t.data().any()) {
			Swal.fire({
				text: "No ha filtrado ninguna información para poder imprimir",
				icon: "warning",
				buttonsStyling: false,
				confirmButtonText: "Cerrar",
				allowOutsideClick: false,
				customClass: {
					confirmButton: "btn btn-primary"
				}
			});
		}else{
            let idArea = 0;
            if($("#listAreas option:selected").val() != ""){
                idArea=  $("#listAreas option:selected").val();
            }else{
                idArea=  0;
            }
            window.open("imprimirRptOrdenes/"+$("#fechaInicio").val()+"/"+$("#fechaFin").val()+"/"+idArea, '_blank');
        }
}
</script>