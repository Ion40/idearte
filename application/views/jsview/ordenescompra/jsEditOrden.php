<script>
$(document).ready(function () { 
    showSolicitudData();
 });

 function showSolicitudData(){
      $("#loading").modal("show");
      $.ajax({
          url: "<?php echo base_url("index.php/editOrdenAjax/".$this->uri->segment(2)."")?>",
          type: "POST",
          async: false,
          success: function (data) { 
                $("#loading").modal("hide");
                let obj = $.parseJSON(data);
                //console.log(obj.det);
                $.each(obj.enc, function (i, key) {
                    $("#idSolicitud").val(key.IdOrden);
                    $("#area").val(key.NombreArea);
                    $("#fechaSol").val(key.FechaOrden);
                    //$("#descSol").val(key.DescripcionOrden);
                    $("#idarea").val(key.IdArea);
                  });

                $.each(obj.det, function (i, key) {
                    $("#tblArticulos tbody").append(`
                        <tr>
                            <td>${key.Cantidad}</td>
                            <td>${key.Articulo}</td>
                            <td>${key.DescripcionArticulo}</td>
                        </tr>
                    `);
                  });  
               $("#tblArticulos").DataTable({
                   "info": false,
                   "order": false,
                   "filter": false,
                   "paging": false,
                   "destroy": true
               });   
           }
      });
}

$("#btnAddArt").click(function () {
	let cantidad = 0,
        articulo = "",
		descArt = "";
	cantidad = $("#cantidad").val();
	articulo = $("#articulo").val();
	descArt = $("#descArt").val();

	if (cantidad == 0 || descArt == "" || articulo == "") {
		Swal.fire({
			text: "Los campos ''Cantidad Solicitada'', ''Descripcion del articulo'' y ''Articulo'' son obligatorios",
			icon: "warning",
			buttonsStyling: false,
			confirmButtonText: "Cerrar",
			allowOutsideClick: false,
			customClass: {
				confirmButton: "btn btn-primary"
			}
		});
	} else {
		let t = $("#tblArticulos").DataTable({
			"paging": false,
			"order": false,
			"info": false,
			"destroy": true,
			"scrollY": "300px",
			"scrollCollapse": true
		});

		t.row.add([
			Number(cantidad),
			articulo,
			descArt
		]).draw(false);

		$("#cantidad").focus();
		$("#cantidad").val("");
		$("#articulo").val("");
		$("#descArt").val("");
	}
});

$("body").on("click", "tr", function () {
	$(this).toggleClass("selected");
	if ($(this).hasClass("selected")) {
		$("#btnSaveSolic").hide();
	} else {
		$("#btnSaveSolic").show();
	}
});

$("#btnDelete").click(function () {
	let table = $("#tblArticulos").DataTable();
	table.row(".selected").remove().draw(false);
	$("#btnSaveSolic").show();
});

$("#btnSaveSolic").click(function () {
	let tipo = "",
		prioridad = 0,
		bandera = true,
		tipoText = "",
		save = false,
		array = new Array(),
		i = 0;
	let t = $("#tblArticulos").DataTable({
		"paging": false,
		"order": false,
		"info": false,
		"destroy": true,
		"scrollY": "100px",
		"scrollCollapse": true
	});
	/*if ($("#descSol").val() == "") {
			bandera = false;
			Swal.fire({
				text: "Debe ingresar una descripcion de la solicitud",
				icon: "warning",
				buttonsStyling: false,
				confirmButtonText: "Cerrar",
				allowOutsideClick: false,
				customClass: {
					confirmButton: "btn btn-primary"
				}
			});
		} else {
			bandera = true;
		}*/

	if (bandera) {
		if (!t.data().any()) {
			save = false;
			Swal.fire({
				text: "No ha agregado articulos a la solicitud",
				icon: "warning",
				buttonsStyling: false,
				confirmButtonText: "Cerrar",
				allowOutsideClick: false,
				customClass: {
					confirmButton: "btn btn-primary"
				}
			});
		} else {
			save = true;
		}
	}

	if (save) {
		let mensaje = "",
			icon = "",
			form_data = new Object();
		t.rows().eq(0).each(function (index) {
			let row = t.row(index);
			let datos = row.data();
			array[i] = [];
			array[i][0] = datos[0];
			array[i][1] = datos[1];
			array[i][2] = datos[2];
			i++;
		});
           form_data.encabezado = [$("#idorden").val()]; //$("#descSol").val()
		   form_data.detalles = JSON.stringify(array);
           console.log(form_data);
		   $.ajax({
		   	url: "<?php echo base_url("index.php/actualizarOrden")?>",
		   	type: "POST",
		   	data: form_data,
		   	success: function(data){
		   		$("#loading").modal("hide");
		   		let obj = jQuery.parseJSON(data);
		   		$.each(obj, function(i, key){
		   			mensaje = key["mensaje"];
		   			icon = key["tipo"];
		   		});
                     Swal.fire({
		   				text: mensaje,
		   				icon: icon,
		   				customClass: {
		   					confirmButton: "btn btn-primary"
		   				},
		   				confirmButtonText: "Cerrar",
		   				allowOutsideClick: false
		   			}).then((result) => {
		   				location.reload();
		   			});
		   	}
		   }); 
	}
});
</script>