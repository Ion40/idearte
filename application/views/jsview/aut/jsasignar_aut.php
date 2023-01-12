<script type="text/javascript">
$(document).ready(function(){
	$('#treeCheckbox').jstree({
		'core' : {
			'themes' : {
				'responsive': true
			}
		},
		'types' : {
			'default' : {
				'icon' : 'fa fa-folder text-warning'
			},
			'file' : {
				'icon' : 'fa fa-folder text-warning'
			}
		},
		'plugins': ["checkbox", "types"] //"wholerow", 
	});

	//TODO: mostrar usuarios en ddl
	$("#ddlUsuarios").select2({
			placeholder: '--- Seleccione un Usuario ---',
			allowClear: true,
			ajax: {
				url: 'getUsuariosAjax',
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
						res.push({id:data[i].IdUsuario, text:data[i].NombreUsuario});
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
	
$("#ddlUsuarios").on("change", function(){
	$("#treeCheckbox").jstree("refresh");
	if ($("#ddlUsuarios option:selected").val() != '') {
		$.ajax({
		url: "getAutAsignados/" + $(this).val(),
		type: "GET",
		dataType: "json",
		contentType: false,
		processData:false,
		success: function(datos){
		   $.each(datos, function(key, value){
			  $("#"+value.IdAutorizacion).find(".jstree-anchor").addClass("jstree-clicked");
			  $("#"+value.IdAutorizacion).find(".jstree-wholerow").addClass("jstree-wholerow-clicked");
		  });
		}
	});
  }
});

$("#btnSetAuth").on('click', function(){
	let ddlUser = $("#ddlUsuarios option:selected").val(),
	 i = 0,
	 array = new Array(),
	 mensaje,
	 tipo;
	$("#treeCheckbox li .jstree-leaf").each(function(){
		if ($(this).children().hasClass("jstree-clicked")) {
			array[i] = ddlUser+","+$(this).attr('id');
		 	i++;
		}
	});

	let form_data = {
		iduser: $("#ddlUsuarios option:selected").val(),
		datos: array
	};
	console.log(form_data);

	$.ajax({
		url: "asignarPermiso",
		type: "POST",
		data: form_data,
		beforeSend: function(){
			if ($("#ddlUsuarios option:selected").val() == '') {
				swal({
					text: "Debe Seleccionar Un Usuario",
					type: "error",
					allowOutsideClick: false
				});
				$.ajax.abort();
			}
		},
		success: function(data){
			var obj = jQuery.parseJSON(data);
			$.each(obj, function(key, value){
				mensaje = value["mensaje"];
				tipo = value["tipo"];
			});

			Swal.fire({
				icon: tipo,
				text: mensaje,
				allowOutsideClick: false
			}).then(result => {
				location.reload();
			});
		}
	});
});	
</script>