					
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
												<span class="card-label fw-bolder text-dark">Lista de Areas</span>
												<!--<span class="text-gray-400 mt-1 fw-bold fs-6">Users from all channels</span>-->
											</h3>
											<!--end::Title-->
											<!--begin::Toolbar-->
											<div class="card-toolbar">
												<button id="btnAddArea" class="btn btn-primary" data-bs-toggle="modal">
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
													Nueva Area
												</button>
											</div>
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Card body-->
										<div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
											<!--begin::Statistics-->
											<div class="px-9 mb-5">
												<table id="tblAreas" class="table table-striped table-row-bordered table-responsive gy-5 gs-7">
													<thead class="">
														<tr class="fw-bold fs-6 text-muted">
                                                            <th>Area</th>
															<th>Siglas</th>
															<th>Fecha Crea</th>
                                                            <th>Estado</th>
															<th class="text-center">Opciones</th>
														</tr>
													</thead>
													<tbody>
														<?php
                                                            $estado = "";
                                                            if($areas){
                                                                foreach ($areas as $key) {
                                                                    switch ($key["Estado"]) {
                                                                        case 'A':
                                                                            $estado = '<span class="badge badge-success fs-7 fw-bold">Activo</span>';
                                                                            break;
                                                                        
                                                                        default:
                                                                            $estado = '<span class="badge badge-danger fs-7 fw-bold">Inactivo</span>';
                                                                            break;
                                                                    }
                                                                    echo "
                                                                        <tr>
                                                                            <td>".$key["NombreArea"]."</td>
																			<td>".$key["Siglas"]."</td>
                                                                            <td>".$key["FechaCrea"]."</td>
                                                                            <td>".$estado."</td>";
                                                                            if($key["Estado"] == "A"){
                                                                                echo "
                                                                                <td class='text-center'>
                                                                                    <a href='javascript:void(0)' onclick='editar(".'"'.$key["IdArea"].'","'.$key["NombreArea"].'","'.$key["Siglas"].'"'.")' class='btn btn-icon btn-primary btn-sm btn-hover-rise me-5'>
                                                                                        <span class='svg-icon svg-icon-3'>
                                                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                                                                                <path opacity='0.3' fill-rule='evenodd' clip-rule='evenodd' d='M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z' fill='black'/>
                                                                                                <path d='M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z' fill='black'/>
                                                                                                <path d='M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z' fill='black'/>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </a>

                                                                                    <a href='javascript:void()' onclick='baja(".'"'.$key["IdArea"].'","'.$key["Estado"].'"'.")'
																					 class='btn btn-icon btn-danger btn-sm btn-hover-rise me-5'>
                                                                                        <span class='svg-icon svg-icon-3'>
                                                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                                                                                <path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black'/>
                                                                                                <path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black'/>
                                                                                                <path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black'/>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </a>
                                                                                </td>
                                                                                ";         
                                                                            }else{
                                                                                echo "
																				<td class='text-center'>
                                                                                    <a href='javascript:void()' onclick='baja(".'"'.$key["IdArea"].'","'.$key["Estado"].'"'.")'
																					 class='btn btn-icon btn-danger btn-sm btn-hover-rise me-5'>
                                                                                        <span class='svg-icon svg-icon-2'>
																							<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
																								<path d='M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z' fill='black'/>
																								<path opacity='0.3' d='M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z' fill='black'/>
																							</svg>
                                                                                        </span>
                                                                                    </a>
                                                                                </td>
                                                                                ";         
                                                                            }
                                                                            
                                                                        echo"</tr>
                                                                    ";
                                                                }
                                                            }
                                                        ?>
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
								<span class="text-muted fw-bold me-1"><?php echo date("Y")?>&copy;</span>
								<a href="https://keenthemes.com/" target="_blank" class="text-gray-800 text-hover-primary"><?php echo basename(FCPATH)?></a>
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
					<div class="modal fade" id="modalAreas" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-dialog-centered mw-650px">
							<!--begin::Modal content-->
							<div class="modal-content">
								<!--begin::Modal header-->
								<div class="modal-header">
									<!--begin::Modal title-->
									<h2>
										<span class="svg-icon svg-icon-info svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z" fill="black"/>
                                            <path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="black"/>
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
									<div class="form">
										<div class="row g-12 mb-8">
											<!--begin::Input group-->
										<!--begin::Col-->
										<div class="col-md-7 fv-row">
											<!--begin::Input group-->
                                            <label for="nombreRol" class="form-label">Nombre Area</label>
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
                                                <input type="hidden" id="idArea" class="form-control"/>
												<input type="text" id="nombreArea" class="form-control" placeholder="Ingresa el nombre del area" aria-label="Nombre"
													aria-describedby="basic-addon1" autocomplete="off"/>
											</div>
											<!--end::Input group-->
										</div>
										<div class="col-md-5 fv-row">
											<!--begin::Input group-->
                                            <label for="nombreRol" class="form-label">Siglas Area</label>
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
												<input type="text" id="siglas" class="form-control" placeholder="Siglas" aria-label="Nombre"
													aria-describedby="basic-addon1" autocomplete="off"/>
											</div>
											<!--end::Input group-->
										</div>
										<!--end::Col-->
										<!--end::Input group-->
										<!--begin::Input group-->				
										</div>
										<!--<div class="row mb-10">
													<div class="col-md-8 fv-row">
														<label class="required fs-6 fw-bold form-label mb-2">Expiration Date</label>
														
														<div class="row fv-row">
															<div class="col-6">
																<select name="card_expiry_month" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Month">
																	<option></option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																	<option value="6">6</option>
																	<option value="7">7</option>
																	<option value="8">8</option>
																	<option value="9">9</option>
																	<option value="10">10</option>
																	<option value="11">11</option>
																	<option value="12">12</option>
																</select>
															</div>
															<div class="col-6">
																<select name="card_expiry_year" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Year">
																	<option></option>
																	<option value="2022">2022</option>
																	<option value="2023">2023</option>
																	<option value="2024">2024</option>
																	<option value="2025">2025</option>
																	<option value="2026">2026</option>
																	<option value="2027">2027</option>
																	<option value="2028">2028</option>
																	<option value="2029">2029</option>
																	<option value="2030">2030</option>
																	<option value="2031">2031</option>
																	<option value="2032">2032</option>
																</select>
															</div>
														</div>
													</div>
												</div>-->
										<!--end::Input group-->
										<!--begin::Input group-->
										<!--<div class="d-flex flex-stack">-->
										<!--begin::Label-->
										<!--<div class="me-5">
														<label class="fs-6 fw-bold form-label">Save Card for further billing?</label>
														<div class="fs-7 fw-bold text-muted">If you need more info, please check budget planning</div>
													</div>-->
										<!--end::Label-->
										<!--begin::Switch-->
										<!--<label class="form-check form-switch form-check-custom form-check-solid">
														<input class="form-check-input" type="checkbox" value="1" checked="checked" />
														<span class="form-check-label fw-bold text-muted">Save Card</span>
													</label>-->
										<!--end::Switch-->
										<!--</div>-->
										<!--end::Input group-->
										<!--begin::Actions-->
										<div class="text-center">
											<button data-bs-dismiss="modal" type="button" id="modalRol"
												class="btn btn-danger me-3">Cancelar</button>
											<button type="button" id="btnGuardarArea"
												class="btn btn-primary">Guardar</button>
                                                <button style="display: none;" type="button" id="btnActualizarArea"
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
