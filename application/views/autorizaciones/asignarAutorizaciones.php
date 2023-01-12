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
											<div class="col-md-8 fv-row">
												<label for="ddlUsuarios" class="form-label required">Seleccione un Usuario</label>
												<!--begin::Default example-->
												<div class="input-group flex-nowrap">
													<span class="input-group-text">
														<span class="svg-icon svg-icon-info svg-icon-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																viewBox="0 0 24 24" fill="none">
																<path opacity="0.3"
																	d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
																	fill="black" />
																<path
																	d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
																	fill="black" />
															</svg>
														</span>
													</span>
													<div class="overflow-hidden flex-grow-1">
														<select id="ddlUsuarios"
															class="form-select rounded-start-0 js-data-example-ajax">
															<option selected value=""></option>
														</select>
													</div>
												</div>
											</div>
											<!--end::Title-->
											<!--begin::Toolbar-->
											<div class="card-toolbar">
												<button id="btnSetAuth" class="btn btn-primary" data-bs-toggle="modal">
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
													Asignar Autorizaciones
												</button>
											</div>
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Card body-->
										<div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
											<!--begin::Statistics-->
											<div class="px-9 mb-5">

												<section class="panel"
													style="overflow-x: auto; height: 800px; transform: translate(0px, 0px);">
													<header class="panel-heading">
														<div class="panel-actions">
														</div>
														<h2 class="panel-title">Asignar Permisos</h2>
														<p class="panel-subtitle"></p>
													</header>
													<div class="panel-body">
														<div id="treeCheckbox">
															<ul class="recorrer">
																<?php 
                                                                    if (!$list) {
                                                                    }else{
                                                                        foreach ($list as $key => $value) {
                                                                            if ($list[$key]["IdModuloAut"] != @$list[$key-1]["IdModuloAut"]) {
                                                                                echo "
                                                                                    <li class='jstree-open' >".$list[$key]["AutModulo"]."";
                                                                                        foreach ($list as $key2 => $value) {
                                                                                        if ($list[$key]["IdModuloAut"] == $list[$key2]["IdModuloAut"]) {
                                                                                            echo "
                                                                                                <ul>
                                                                                                    <li id='".$list[$key2]["IdAutorizacion"]."'>
                                                                                                    ".$list[$key2]["Descripcion"]."
                                                                                                    </li>
                                                                                                </ul>
                                                                                        ";
                                                                                        }
                                                                                        }
                                                                                echo" </li>";
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
															</ul>
														</div>
													</div>
												</section>

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
									class="text-gray-800 text-hover-primary"><?php echo strtoupper(basename(FCPATH))?></a>
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
