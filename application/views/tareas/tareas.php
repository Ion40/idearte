					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Container-->
						<div id="kt_content_container" class="container-fluid">
							<!--begin::Row-->
							<div class="row g-5">
								<!-- mb-xl-10 -->

								<!--begin::Col-->
								<div class="col-lg-12 col-xl-12">
									<!--begin::Chart widget 3-->
									<div class="card card-flush overflow-hidden h-md-100">
										<!--begin::Header-->
										<div class="card-header py-5">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bolder text-dark">Lista de Tareas</span>
												<!--<span class="text-gray-400 mt-1 fw-bold fs-6">Users from all channels</span>-->
											</h3>
											<!--end::Title-->
											<!--begin::Toolbar-->
											<div class="card-toolbar">
												<button id="btnAddTask" class="btn btn-primary" data-bs-toggle="modal">
													<!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen041.svg-->
													<span class="svg-icon svg-icon-muted svg-icon-2">
														<svg xmlns="http://www.w3.org/2000/svg" class="h-20px w-20px" width="24"
															height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
																fill="black" />
															<rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
																transform="rotate(-90 10.8891 17.8033)" fill="black" />
															<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
														</svg></span>
													<!--end::Svg Icon-->
													Nueva Tarea
												</button>
											</div>
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Card body-->
										<div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
											<!--begin::Statistics-->
											<div class="px-9 mb-5">
												<table id="tblTareas"
													class="table table-striped table-row-bordered table-responsive gy-5 gs-7">
													<thead class="">
														<tr class="fw-bold fs-6 text-muted">
															<th>N° Orden</th>
															<th>Area</th>
															<th>Tarea</th>
															<th>Cantidad</th>
															<th>Descripcion</th>
															<th>Prioridad</th>
															<th>Estado</th>
															<th>FechaCrea</th>
															<th class="text-center">Opciones</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Chart widget 3-->
								</div>
								<!--end::Col-->
							</div>
							<!--end::Row-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted fw-bold me-1">2022 &copy;</span>
								<a href="https://keenthemes.com/" target="_blank"
									class="text-gray-800 text-hover-primary"><?php echo strtoupper(basename(FCPATH)) ?></a>
							</div>
							<!--end::Copyright-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
					</div>
					<!--end::Wrapper-->
					</div>
					<!--end::Page-->
					</div>
					<!--end::Root-->

					<!--begin::Modals-->
					<!--begin::Modal - New Card-->
					<div class="modal fade" id="modalTareas" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-dialog-centered mw-850px">
							<!--begin::Modal content-->
							<div class="modal-content">
								<!--begin::Modal header-->
								<div class="modal-header">
									<!--begin::Modal title-->
									<h2>
										<span class="svg-icon svg-icon-info svg-icon-2hx">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
												fill="none">
												<path opacity="0.3"
													d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z"
													fill="black" />
												<path
													d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z"
													fill="black" />
											</svg>
										</span>
										<span id="modalTitle"></span>
									</h2>
									<!--end::Modal title-->
									<!--begin::Close-->
									<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
										<span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
												fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
													transform="rotate(-45 6 17.3137)" fill="black" />
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
													fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</div>
									<!--end::Close-->
								</div>
								<!--end::Modal header-->
								<!--begin::Modal body-->
								<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
									<!--begin::Form-->
									<div class="form" id="campos">
										<div class="row g-9 mb-8">
										<div class="col-md-6 fv-row">
												<label for="listAreas" class="form-label required">Seleccione un Area</label>
												<!--begin::Default example-->
												<div class="input-group flex-nowrap">
													<span class="input-group-text">
														<span class="svg-icon svg-icon-muted svg-icon-2"><svg
																xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																viewBox="0 0 24 24" fill="none">
																<path opacity="0.3"
																	d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z"
																	fill="black" />
																<path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="black" />
															</svg>
														</span>
													</span>
													<div class="overflow-hidden flex-grow-1">
														<select id="listAreas" class="form-select rounded-start-0 js-data-example-ajax"
															data-dropdown-parent="#modalTareas">
															<option selected value=""></option>
														</select>
													</div>
												</div>
												<!--end::Default example-->
											</div>
											<div class="col-md-6 fv-row">
												<label for="numOrden" class="form-label required">Número Orden</label>
												<div class="input-group mb-5">
													<span class="input-group-text" id="basic-addon1">
														<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																viewBox="0 0 24 24" fill="none">
																<path
																	d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
																	fill="black" />
																<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
																	fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
													<input type="hidden" id="idTarea" class="" />
													<input type="number" id="numOrden" class="form-control valida" placeholder="Numero orden"
														aria-label="N° Orden" aria-describedby="basic-addon1" autocomplete="off" />
												</div>
												<!--end::Input-->
											</div>
											<!--end::Col-->
											<!--begin::Col-->

											<!--end::Col-->
										</div>
										<!--begin::Input group-->
										<!--begin::Col-->
										<!--<div class="row g-9 mb-8">
											<div class="col-md-6 fv-row">
												<div class="d-flex align-items-center">
															<label class="form-check form-check-custom form-check-solid me-10 form-check-inline">
																<input class="form-check-input" checked type="radio" name="inlineRadioOptions" id="rbtnUnArea" value="1">
																<span class="form-check-label fw-bold">Asignar un área</span>
															</label>
															<label class="form-check form-check-custom form-check-solid form-check-inline">
																<input class="form-check-input" type="radio" name="inlineRadioOptions" id="rbtnAreas" value="2">
																<span class="form-check-label fw-bold">Asignar varias áreas</span>
															</label>
												 </div>
											</div>
										</div>
										<div class="row g-9 mb-8">
											<div class="col-md-12 fv-row">

											</div>
										</div>-->
										<div id="divCliente" class="row g-12 mb-8" style="display: none;">
											<div class="col-md-12 fv-row">
												<label for="cliente" class="form-label required">Contacto cliente</label>
												<div class="input-group mb-5">
													<span class="input-group-text" id="basic-addon1">
														<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																viewBox="0 0 24 24" fill="none">
																<path
																	d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z"
																	fill="black" />
																<path opacity="0.3"
																	d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z"
																	fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
													<input type="text" id="cliente" class="form-control"
														placeholder="Ingresa el nombre del cliente" aria-label="cliente"
														aria-describedby="basic-addon1" autocomplete="off" />
												</div>
											</div>
										</div>
										<div class="row g-9 mb-8">
											<?php
$fechareal = "";
$col       = '';
$permiso   = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "24");
if ($permiso) {
    $col       = "4";
    $fechareal = '<div class="col-md-' . $col . ' fv-row">
	                                            <label for="fechareal" class="form-label required">Fecha real de entrega</label>
                                                                    <div class="input-group mb-5">
                                                                        <span class="input-group-text" id="basic-addon1">
                                                                            <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                                            <span class="svg-icon  svg-icon-3">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none">
                                                                                    <path opacity="0.3"
                                                                                        d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                                                        fill="black"></path>
                                                                                    <path
                                                                                        d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                                                        fill="black"></path>
                                                                                    <path
                                                                                        d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                                                        fill="black"></path>
                                                                                </svg>
                                                                            </span>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                        <input id="fechareal" class="form-control " value="" />
                                                                    </div>
											</div>';
} else {
    $col = "6";
}
echo '
										<div class="col-md-' . $col . ' fv-row">

                                            <label for="fechaSol" class="form-label required">Fecha de entrega</label>
                                                                    <div class="input-group mb-5">
                                                                        <span class="input-group-text" id="basic-addon1">
                                                                            <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                                            <span class="svg-icon  svg-icon-3">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none">
                                                                                    <path opacity="0.3"
                                                                                        d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                                                        fill="black"></path>
                                                                                    <path
                                                                                        d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                                                        fill="black"></path>
                                                                                    <path
                                                                                        d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                                                        fill="black"></path>
                                                                                </svg>
                                                                            </span>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                        <input id="fecha" class="form-control " value="" />
                                                                    </div>
											</div>
											' . $fechareal . '
											<div class="col-md-' . $col . ' fv-row">
												<label for="" class="form-label required">Prioridad</label><br>
												<div class="btn-group w-50 w-lg-25 " data-kt-buttons="true"
													data-kt-buttons-target="[data-kt-button]">
													<!--begin::Radio-->
													<label id="chkNormal"
														class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success btn-sm"
														data-kt-button="true">
														<!--begin::Input-->
														<input class="btn-check" type="radio" checked="true" name="Prioridad"
															value="1">
														<!--end::Input-->
														Normal
													</label>
													<!--end::Radio-->
													<!--begin::Radio-->
													<label id="chkAlta"
														class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-warning btn-sm"
														data-kt-button="true">
														<!--begin::Input-->
														<input class="btn-check" type="radio" name="Prioridad" value="2">
														<!--end::Input-->
														Alta
													</label>
													<label id="chkUrgente"
														class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-danger btn-sm"
														data-kt-button="true">
														<!--begin::Input-->
														<input class="btn-check" type="radio" name="Prioridad" value="3">
														<!--end::Input-->
														Urgente
													</label>
													<!--end::Radio-->
												</div>
											</div>';?>
										</div>
										<div class="row g-12 mb-8">
                                            <div class="col-md-6 fv-row">
												<label for="nombre" class="form-label required">Nombre Tarea</label>
												<div class="input-group mb-5">
													<span class="input-group-text" id="basic-addon1">
														<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
														<span class="svg-icon svg-icon-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																viewBox="0 0 24 24" fill="none">
																<path opacity="0.3"
																	d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
																	fill="black" />
																<path
																	d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z"
																	fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
													<input type="text" id="nombre" class="form-control valida" placeholder="Nombre Tarea"
														aria-label="Tarea" aria-describedby="basic-addon1" autocomplete="off" />
												</div>
												<!--end::Input-->
											</div>
											<!--end::Col-->
											<!--begin::Col-->
											<div class="col-md-6 fv-row">
												<label for="cantidad" class="form-label required">Cantidad</label>
												<div class="input-group mb-5">
													<span class="input-group-text" id="basic-addon1">
														<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																viewBox="0 0 24 24" fill="none">
																<path
																	d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z"
																	fill="black" />
																<path opacity="0.3"
																	d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z"
																	fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
													<input type="number" id="cantidad" class="form-control valida"
														placeholder="Ingresa la cantidad" aria-label="cantidad"
														aria-describedby="basic-addon1" autocomplete="off" />
												</div>
												<!--end::Input-->
											</div>
											<!--end::Col-->
										</div>
										<div class="row g-12 mb-8">
											<div class="col-md-12 fv-row">
												<!--begin::Input group-->
												<label for="descripcion" class="form-label required">Descripcion</label>
												<div class="input-group mb-5">
													<span class="input-group-text" id="basic-addon1">
														<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
														<span class="svg-icon svg-icon-muted svg-icon-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black"></path>
																			<path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black"></path>
																		</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
													<textarea id="descripcion" class="form-control valida" aria-label="With textarea" style="height: 97px;"></textarea>
												</div>
												<!--end::Input group-->
											</div>
											<!--<div class="col-lg-12">
												<div class="input-group  mb-2">
                                                        <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                            <input onchange="cambiarImagenes('1')" checked name="rbImagenes" id="rbImagenes1" class="form-check-input" type="radio" value="1"/>
                                                            <label class="form-check-label" for="rbImagenes1">
                                                                Subir una imágen
                                                            </label>
                                                        </div>

                                                       <div class="form-check form-check-custom form-check-solid form-check-sm ms-2">
                                                            <input onchange="cambiarImagenes('2')" name="rbImagenes" id="rbImagenes2" class="form-check-input" type="radio" value="2"/>
                                                            <label class="form-check-label" for="rbImagenes2">
                                                               Subir varias imágenes
                                                            </label>
                                                        </div>
                                                    </div>
											</div>-->
										</div>
										<!--<div class="row g-12 mb-8 text-center" id="divImagen1">
											<div class="col-md-12 fv-rows">
												<div class="image-input image-input-outline" data-kt-image-input="true"
													style="background-size: contain; background-image: url('data:image/png;base64,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')">

													<div id="imagenTarea"  class="image-input-wrapper w-500px h-500px" style="width: cover; background-size: contain;background-image: url('data:image/png;base64,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')">
													</div>

													<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
														data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cambiar imagen">
														<i class="fas fa-pen fa-fw text-primary"></i>

														<input type="file" onchange="encodeImageFileAsURL(this)" name="avatar" accept=".png, .jpg, .jpeg" />
														<input type="hidden" name="avatar_remove" />
														<span style="display:none;" id="image"></span>
													</label>

													<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
														data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancelar">
														<i class="fas fa-trash fa-fw text-danger"></i>
													</span>

													<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
														data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Quitar imagen">
														<i class="fas fa-trash fa-fw text-danger"></i>
													</span>
												</div>
											</div>
										</div>-->
										<div class="row g-12 mb-8 text-center" id="divImagen2">
											<div class="col-md-12 fv-rows">
												<div class="container">
												    <form>
												       <input id="multiple" type="file" accept="image/*" multiple>
												    </form>
												  </div>
											</div>
										</div>
										<div class="text-center">
											<button data-bs-dismiss="modal" type="button" id="modalRol"
												class="btn btn-danger me-3">Cancelar</button>
											<button type="button" id="btnGuardarTask" class="btn btn-primary">Guardar</button>
											<button style="display: none;" type="button" id="btnActualizarTask"
												class="btn btn-primary">Actualizar</button>
										</div>
										<!--end::Actions-->
									</div>
									<!--end::Form-->
								</div>
								<!--end::Modal body-->
							</div>
							<!--end::Modal content-->
						</div>
						<!--end::Modal dialog-->
					</div>
					<!--end::Modal - New Card-->
					<!--end::Modals-->
					<!--begin::Scrolltop-->
					<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
						<span class="svg-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
									fill="black" />
								<path
									d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
									fill="black" />
							</svg>
						</span>
						<!--end::Svg Icon-->
					</div>
					<!--end::Scrolltop-->
					<!--end::Main-->
