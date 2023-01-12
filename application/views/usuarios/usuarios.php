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
												<span class="card-label fw-bolder text-dark">Lista de Usuarios</span>
												<!--<span class="text-gray-400 mt-1 fw-bold fs-6">Users from all channels</span>-->
											</h3>
											<!--end::Title-->
											<!--begin::Toolbar-->
											<div class="card-toolbar">
												<button id="btnAddUser" class="btn btn-primary" data-bs-toggle="modal">
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
													Nuevo Usuario
												</button>
											</div>
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Card body-->
										<div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
											<!--begin::Statistics-->
											<div class="px-9 mb-5">
												<table id="tblUsuarios"
													class="table table-striped table-row-bordered table-responsive gy-5 gs-7">
													<thead class="">
														<tr class="fw-bold fs-6 text-muted">
															<th>Usuario</th>
															<th>Nombre</th>
															<th>Puesto</th>
                                                            <th>Teléfono</th>
															<th>Area</th>
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
								<a href="https://keenthemes.com/" target="_blank" class="text-gray-800 text-hover-primary"><?php echo strtoupper(basename(FCPATH))?></a>
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
					<div class="modal fade" id="modalUser" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
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
													d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
													fill="black" />
												<path
													d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
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
												<label for="nombreuser" class="form-label required">Nombre Usuario</label>
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
													<input type="hidden" id="iduser" class="" />
													<input type="text" id="nombreuser" class="form-control"
														placeholder="Nombre de usuario" aria-label="Nombre"
														aria-describedby="basic-addon1" autocomplete="off" />
												</div>
												<!--end::Input-->
											</div>
											<!--end::Col-->
											<!--begin::Col-->
											<div class="col-md-6 fv-row">
												<label for="password" class="form-label required">Contraseña</label>
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
													<input type="password" id="password" class="form-control"
														placeholder="Ingresa una contraseña" aria-label="Nombre"
														aria-describedby="basic-addon1" autocomplete="off" />
												</div>
												<!--end::Input-->
											</div>
											<!--end::Col-->
										</div>
										<!--begin::Input group-->
										<!--begin::Col-->
										<div class="row g-9 mb-8">
										<div class="col-md-6 fv-row">
												<label for="Confirmpassword" class="form-label required">Confirmar contraseña</label>
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
													<input type="password" id="Confirmpassword" class="form-control"
														placeholder="Ingresa una contraseña" aria-label="Nombre"
														aria-describedby="basic-addon1" autocomplete="off" />
												</div>
												<!--end::Input-->
											</div>
										<div class="col-md-6 fv-row">
											<!--begin::Input group-->
											<label for="nombre" class="form-label required">Nombre y Apellido</label>
											<div class="input-group mb-5">
												<span class="input-group-text" id="basic-addon1">
													<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
													<span class="svg-icon svg-icon-3">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
															viewBox="0 0 24 24" fill="none">
															<path opacity="0.3"
																d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
																fill="black" />
															<path
																d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
																fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<input type="text" id="nombre" class="form-control"
													placeholder="Ingresa el nombre y apellido" aria-label="Nombre"
													aria-describedby="basic-addon1" autocomplete="off" />
											</div>
											<!--end::Input group-->
										</div>
										</div>
										<div class="row g-12 mb-8">
											<div class="col-md-6 fv-row">
												<label for="nombreuser" class="form-label required">Puesto</label>
												<div class="input-group mb-5">
													<span class="input-group-text" id="basic-addon1">
														<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																viewBox="0 0 24 24" fill="none">
																<path
																	d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
																	fill="black" />
																<path opacity="0.3"
																	d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
																	fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
													<input type="text" id="puesto" class="form-control" placeholder="ingresa un puesto"
														aria-label="Nombre" aria-describedby="basic-addon1" autocomplete="off" />
												</div>
												<!--end::Input-->
											</div>
											<!--end::Col-->
											<!--begin::Col-->
											<div class="col-md-6 fv-row">
												<label for="telefono" class="form-label required">Teléfono</label>
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
													<input type="number" id="telefono" class="form-control"
														placeholder="Ingresa un teléfono valido" aria-label="telefono"
														aria-describedby="basic-addon1" autocomplete="off" />
												</div>
												<!--end::Input-->
											</div>
											<!--end::Col-->
										</div>
										<div class="row g-12 mb-8">
											<!--end::Col-->
											<!--begin::Col-->
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
															data-dropdown-parent="#modalUser">
															<option selected value=""></option>
														</select>
													</div>
												</div>
												<!--end::Default example-->
											</div>
                                            <div class="col-lg-6 mb-10 mb-lg-0">
												<label for="" class="form-label required">Seleccione un Genero</label>
												<!--begin::Tabs-->
												<div class="nav flex-column">
													<!--begin::Tab link-->
													<div id="btnMas" class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 active mb-6"
														data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_startup">
														<!--end::Description-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Radio-->
															<div
																class="form-check form-check-custom form-check-solid form-check-success me-6">
																<input id="chkmasculino" class="form-check-input" type="radio"
																	name="genero" checked="checked" value="1" />
															</div>
															<!--end::Radio-->
															<!--begin::Info-->
															<div class="flex-grow-1">
																<h6 class="d-flex align-items-center flex-wrap">Masculino
																</h6>
															</div>
															<!--end::Info-->
														</div>
													</div>
													<!--end::Tab link-->
													<!--begin::Tab link-->
													<div id="btnFem" class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6"
														data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_advanced">
														<!--end::Description-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Radio-->
															<div
																class="form-check form-check-custom form-check-solid form-check-success me-6">
																<input id="chkfemenino" class="form-check-input" type="radio"
																	name="genero" value="2" />
															</div>
															<!--end::Radio-->
															<!--begin::Info-->
															<div class="flex-grow-1">
																<h6 class="d-flex align-items-center flex-wrap">Femenino
																</h6>
															</div>
															<!--end::Info-->
														</div>
													</div>
													<!--end::Tab link-->
												</div>
												<!--end::Tabs-->
											</div>
											<!--end::Col-->
										</div>
										<div class="text-center">
											<button data-bs-dismiss="modal" type="button" id="modalRol"
												class="btn btn-danger me-3">Cancelar</button>
											<button type="button" id="btnGuardarUser" class="btn btn-primary">Guardar</button>
											<button style="display: none;" type="button" id="btnActualizarUser"
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
