<script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
<script>
	$(document).ready(function () {  
		window.print();
		window.addEventListener('afterprint', (event) => {
			$.ajax({
				url:"<?php echo base_url("index.php/marcarImpreso/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$this->uri->segment(4)."")?>",
				type: "POST",
				success: function () { 
					console.log("Marcado como impreso");
				 }
			});
		});
	});
	
</script>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Container-->
	<BR>
	<div id="kt_content_container" class="container-fluid">
		<?php
//    echo $enc[0]["ConsecutivoOC"];
?>
		<div class="d-flex flex-column flex-xl-row">
			<!--begin::Content-->
			<div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
				<!--begin::Invoice 2 content-->
				<div class="mt-n1">
					<div class="d-flex flex-row">

						<div class="d-flex flex-column flex-row-fluid">
							<div class="d-flex flex-row flex-column-fluid">
								<div class="d-flex flex-row-auto w-200px flex-center">
									<table class="table table-sm table-sm text-center border table-row-bordered table-row-gray-300">
										<thead>
										<tr class="">
											<th style='border: 1px solid #DAD3C3 !important;'>Fecha Impresion</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<?php
echo "
												<td style='border: 1px solid #DAD3C3 !important;'>" . date("d-m-Y H:i A") . "</td>
												";
?>

										</tr>
										</tbody>
									</table>
								</div>
								<div class="d-flex flex-row-fluid flex-center">
									<table style="text-align: center" class="table table-sm">
										<thead>
										<tr >
											<th>

												<span class="h1">IDARTE</span><br>
												<p class="h4">Solicitud de Compra</p> <br>
											</th>
										</tr>
									</table>
								</div>

								<div class="d-flex flex-row-auto  flex-center symbol symbol-115px">
									<img class="" width="80px" alt="Logo" src="<?php echo base_url() ?>/assets/img/idearte.jpg">
								</div>
							</div>
						</div>

					</div>
					<!--<div class="d-flex flex-row">

						<div class="d-flex flex-column flex-row-fluid">
							<div class="d-flex flex-row flex-column-fluid">
								<div class="d-flex flex-row-auto w-300px flex-center">
									<table class="table table-sm  table-sm text-center  table-row-gray-300">
										<thead>
											<tr>
												<?php
echo "
												       <th style='font-size: 12pt;font-weight: bold' class='text-danger text-start'>Solicitud N° 3334</th>
											    	";
?>
											</tr>
											<tr>
												<?php

echo "
												       <th style='font-size: 10pt;font-weight: bold' class='text-start'>dddd</th>
											    	";
?>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="d-flex flex-row-fluid flex-center">
								</div>

								<div class="d-flex flex-row-auto w-200px flex-center">

								</div>
							</div>
						</div>


					</div>-->
					<!--begin::Wrapper-->
					<div class="m-0">

						<!--<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">

									<div class="d-flex flex-row-fluid flex-center">
										<table style="text-align: center" class="table table-sm">
											<thead>
											<tr>
												<th class="text-start" style="width: 540px;">
													Solicito tramitacion de las siguientes Compras y/o
													Servicios que serán usadas en:
												</th>
												<th class="text-start">

												</th>
											</tr>
										</table>
									</div>

									<div class="d-flex flex-row-auto w-200px flex-center">

									</div>
								</div>
							</div>
						</div>-->

						<!--<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-fluid flex-center">
										<table class="table table-sm">
											<thead>
											<tr>
												<th class="text-start">
													<div class="border-gray-300 border-bottom">
														<span class="bold">
															<?php
echo "DescripcionSolicitud";
?>
														</span>
													</div>
												</th>
											</tr>

										</table>
									</div>

								</div>
							</div>
						</div>-->

						<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-fluid flex-center">
										<table class="table table-sm text-center border table-row-bordered table-row-gray-300 ">
											<thead>
												<tr class="h4" style="font-weight: bold">

                                                    <tr>
                                                        <!--<th style='border: 1px solid #DAD3C3 !important;'>Realizado por</th>-->
                                                        <th style='border: 1px solid #DAD3C3 !important;'>Fecha de orden</th>
                                                        <th style='border: 1px solid #DAD3C3 !important;'>Cantidad Solicitada</th>
                                                        <th style='border: 1px solid #DAD3C3 !important;'>Artículo</th>
                                                        <th style='border: 1px solid #DAD3C3 !important;'>Descripcion</th>
                                                    </tr>
												</tr>
											</thead>
											<tbody>
												<?php
$resaltar = '';
$contador = 0;
$abc      = array();
$i        = 0;
for ($x = 'A'; $x < 'ZZ'; $x++) {
    $abc[] = $x . '';
}
/*echo "
<tr style='font-size: 8pt'>
<td style='font-weight: bold;border: 1px solid #DAD3C3 !important;'>".$abc[0]."</td>

</tr>
";*/
if (!$enc) {
} else {
	/*foreach($enc as $val){
		if ($val["Estado"] == "P") {
            $resaltar = "bg-light-warning";
        }else{
			$resaltar = "";
		}
	}*/
    foreach ($enc as $key => $value) {
        if ($enc[$key]["IdArea"] != @$enc[$key - 1]["IdArea"]) {
            echo "
                                                                            <tr>

                                                                                <td class='bg-light-primary text-start' colspan='5' style='padding-left:10px;font-weight: bold;border: 1px solid #DAD3C3 !important;'>Area: " . $enc[$key]["NombreArea"] . "
                                                                                <tr style='font-size: 8pt'>
                                                                                                <td class='bg-light-success text-start' colspan='5' style='padding-left:30px;font-weight: bold;border: 1px solid #DAD3C3 !important;'>Realizado por: " . $enc[$key]["Nombre"] . "
                                                                                ";
            /*foreach ($det as $key2 => $value) {
            if ($det[$key2]["IdUsuarioOrden"] != @$det[$key2 - 1]["IdUsuarioOrden"] && $enc[$key]["IdArea"] === $det[$key2]["IdArea"]) {
            echo "
            <tr style='font-size: 8pt'>
            <td class='bg-light-success text-start' colspan='5' style='padding-left:30px;font-weight: bold;border: 1px solid #DAD3C3 !important;'>Realizado por: " . $det[$key2]["Nombre"] . "";*/
            foreach ($det as $key3 => $value) {
				if ($det[$key3]["Estado"] == "P") {
					$resaltar = "bg-light-warning";
				}else{
					$resaltar = "";
				}
                if ($enc[$key]["IdUsuarioOrden"] === $det[$key3]["IdUsuarioOrden"]) {
                    echo "
            <tr style='font-size: 8pt;' class='".$resaltar."'>
            <td style='font-weight: bold;border: 1px solid #DAD3C3 !important;'>" . date_format(new DateTime($det[$key3]["FechaCrea"]), "Y-m-d H:i A") . "</td>
            <td style='font-weight: bold;border: 1px solid #DAD3C3 !important;'>" . $det[$key3]["Cantidad"] . "</td>
            <td style='font-weight: bold;border: 1px solid #DAD3C3 !important;'>" . $det[$key3]["Articulo"] . "</td>
            <td style='font-weight: bold;border: 1px solid #DAD3C3 !important;'>" . $det[$key3]["DescripcionArticulo"] . "</td>
            </tr>
            ";
                    $i++;
                }

            }
            echo "</td>
                                                                                         </tr>
                                                                                        ";

            //}
            echo "</td>
                                                                              <td colspan='5' class='text-start' style='padding-left:10px; font-weight: bold;border: 1px solid #DAD3C3 !important;'>Total de Artículos " . $enc[$key]["NombreArea"] . ": " . $i . "</td>
                                                                            </tr>
                                                                        ";
            $i = 0;
            /*echo "
        <li class='jstree-open' >".$enc[$key]["AutModulo"]."";
        foreach ($enc as $key2 => $value) {
        if ($enc[$key]["IdModuloAut"] == $enc[$key2]["IdModuloAut"]) {
        echo "
        <ul>
        <li id='".$enc[$key2]["IdAutorizacion"]."'>
        ".$enc[$key2]["Descripcion"]."
        </li>
        </ul>
        ";
        }
        }
        echo" </li>";*/
        }
    }
}
/*if($det){
foreach ($det as $item) {

$i++;
}
}*/
?>
											</tbody>
										</table>
									</div>

								</div>
							</div>
						</div>
						<br>
						<!--<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-auto w-300px flex-center border-bottom mb-9">
										<div class="">
											<?=$enc[0]["Nombre"]?>
										</div>
									</div>
									<div class="d-flex flex-row-fluid flex-center">

									</div>

									<div class="d-flex flex-row-auto w-300px flex-center border-bottom mb-9">
										<div class="">
											<?php
echo "Autoriza";
?>
										</div>
									</div>
								</div>
							</div>

						</div>-->

						<!--<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-auto w-300px flex-center" style="margin-top: -20px;">
										<div class="">
											Solicitante
										</div>
									</div>
									<div class="d-flex flex-row-fluid flex-center">

									</div>

									<div class="d-flex flex-row-auto w-300px flex-center" style="margin-top: -20px;">
										Autorizado por:
									</div>
								</div>
							</div>

						</div>-->

						<!--<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-auto w-400px flex-center" >
										<table>
											<tr>
												<th class="h6">NOTA IMPORTANTE:</th>
												<th>Compras locales deberán</th>
											</tr>
										</table>
									</div>
									<div class="d-flex flex-row-auto w-200px flex-center">

									</div>
								</div>
							</div>

						</div>-->

						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Invoice 2 content-->
			</div>
			<!--end::Content-->
		</div>
	</div>
	<!--end::Container-->
</div>
