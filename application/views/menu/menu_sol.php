	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="aside-enabled">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
					<!--begin::Aside toolbar-->
					
					<!--end::Aside toolbar-->
					<!--begin::Aside menu-->
					<div class="aside-menu flex-column-fluid">
						<!--begin::Aside Menu-->
						<div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-offset="0">
							<!--begin::Menu-->
							<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
                            <div class="menu-item">
									<a class="menu-link" href="<?= base_url("index.php/perfil")?>">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Perfil</span>
									</a>
								</div>
								<?php
									if($this->session->userdata("idArea") == 11 && $this->session->userdata("Autoriza") == 1){
										echo'
									<div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black"></path>
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black"></path>
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Monitoreo Compras</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg" kt-hidden-height="156" style="display: none; overflow: hidden;">
										<div class="menu-item">
											<a class="menu-link"  href="'.base_url("index.php/Compras").'">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Solicitudes compras</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link" href="'.base_url("index.php/Documentos").'">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Documentos</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link" href="'.base_url("index.php/bodega").'">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Bodega</span>
											</a>
										</div>
									</div>
								</div>
								
								<div class="menu-item">
										<a class="menu-link" href="'.base_url("index.php/DashboardSol").'">
											<span class="menu-icon">
	
												<span class="svg-icon svg-icon-5">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
														<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
													</svg>
												</span>
											</span>
											<span class="menu-title">Dashboard</span>
										</a>
									</div>';
									}
								?>
                                <div class="menu-item">
									<a class="menu-link" href="<?= base_url("index.php/Solicitudes");?>">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Mis Solicitudes</span>
									</a>
								</div>
								<?php
									if($this->session->userdata("idArea") == 13){
										echo '
										<div class="menu-item">
											<a class="menu-link" href="'.base_url("index.php/bodega").'">
												<span class="menu-icon">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
													<span class="svg-icon svg-icon-5">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
															<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<span class="menu-title">Bodega</span>
											</a>
										</div>';
									}
									if($this->session->userdata("Autoriza") == 1){
										echo '
										<div class="menu-item">
											<a class="menu-link" href="'.base_url("index.php/autSolicitudes").'">
												<span class="menu-icon">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
													<span class="svg-icon svg-icon-5">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
															<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<span class="menu-title">Autorizar Solicitud</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link" href="'.base_url("index.php/anularSolic").'">
												<span class="menu-icon">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
													<span class="svg-icon svg-icon-5">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
															<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<span class="menu-title">Anular Solicitud</span>
												<span style="display:none;" id="badgemenucant" class="badge badge-circle badge-danger"></span>
											</a>
										</div>

										<div class="menu-item">
											<a class="menu-link" href="'.base_url("index.php/historial").'">
												<span class="menu-icon">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
													<span class="svg-icon svg-icon-5">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
															<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<span class="menu-title">Historial Solicitud</span>
												<span class="badge  badge-success">Nuevo</span>
											</a>
										</div>
										';
									}
										switch ($this->session->userdata("IdRol")){
											case 2:
												echo '
												<div class="menu-item">
													<a class="menu-link" href="'.base_url("index.php/Areas").'">
														<span class="menu-icon">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
															<span class="svg-icon svg-icon-5">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
																	<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
																</svg>
															</span>
															<!--end::Svg Icon-->
														</span>
														<span class="menu-title">Areas</span>
													</a>
												</div>
													<div class="menu-item">
														<a class="menu-link" href="'.base_url("index.php/Compras").'">
															<span class="menu-icon">
																<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
																<span class="svg-icon svg-icon-5">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
																		<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</span>
															<span class="menu-title">Solicitudes compras</span>
														</a>
													</div>
													<div class="menu-item">
														<a class="menu-link" href="'.base_url("index.php/Documentos").'">
															<span class="menu-icon">
																<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
																<span class="svg-icon svg-icon-5">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
																		<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</span>
															<span class="menu-title">Adjuntar Documentos</span>
														</a>
													</div>
													<!--<div class="menu-item">
														<a class="menu-link" href="'.base_url("index.php/anularSolic").'">
															<span class="menu-icon">
																<span class="svg-icon svg-icon-5">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
																		<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
																	</svg>
																</span>
															</span>
															<span class="menu-title">Anular Solicitud</span>
															<span style="display:none;" id="badgemenucant" class="badge badge-circle badge-danger"></span>
														</a>
													</div>-->
												';
												break;
											case 4:
												echo '
													<div class="menu-item">
														<a class="menu-link" href="'.base_url("index.php/Documentos").'">
															<span class="menu-icon">
																<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
																<span class="svg-icon svg-icon-5">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
																		<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</span>
															<span class="menu-title">Documentos Adjuntos</span>
														</a>
													</div>
										        ';
												break;
										}
								?>
								<div class="menu-item">
									<a class="menu-link" href="<?= base_url("index.php/rechazadas")?>">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Solicitudes rechazadas</span>
									</a>
								</div>
                                <div class="menu-item">
									<a class="menu-link" href="<?= base_url("index.php/reportes")?>">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
													<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Reportes</span>
									</a>
								</div>
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Aside Menu-->
					</div>
					<!--end::Aside menu-->
					<!--begin::Footer-->
					<div class="aside-footer flex-column-auto pb-5" id="kt_aside_footer">
						<!--begin::Aside user-->
						<div class="aside-user">
							<!--begin::User-->
							<div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
								<!--begin::User image-->
								<div class="me-5">
									<!--begin::Symbol-->
									<div class="symbol symbol-40px cursor-pointer" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
										<img src="<?php
										if($this->session->userdata("Genero") == 1){
											echo base_url().'/assets/img/user2.png"';
										}else{
											echo base_url().'/assets/img/female.jpg" ';
										}
										?> alt="" />
									</div>
									<!--end::Symbol-->
									<!--begin::Menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-8SolicitudesJefe0 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<!--begin::Avatar-->
												<div class="symbol symbol-50px me-5">
													<img src="<?php
													if($this->session->userdata("Genero") == 1){
														echo base_url().'/assets/img/user2.png"';
													}else{
														echo base_url().'/assets/img/female.jpg" ';
													}
													?>" />
												</div>
												<!--end::Avatar-->
												<!--begin::Username-->
												<div class="d-flex flex-column">
													<div class="fw-bolder d-flex align-items-center fs-5"> <?= $this->session->userdata("User")?> 
													<!--<span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">--></div>
													<a href="#" class="fw-bold text-muted text-hover-primary fs-7">	
														<?= $this->session->userdata("Area")?>
													</a>
													<a href="#" class="fw-bold text-muted text-hover-primary fs-7">
														<?= $this->session->userdata("Correo")?>
													</a>
												</div>
												<!--end::Username-->
											</div>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="<?php echo base_url("index.php/perfil")?>" class="menu-link px-5">Mi Pefil</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="javascript:void(0)" class="menu-link px-5">
												<span class="menu-text">Solicitudes atentidas </span>
												<span class="menu-badge">
													<span class="badge badge-light-danger badge-circle fw-bolder fs-7">0</span>
												</span>
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="<?= base_url("index.php/Logout")?>" class="menu-link px-5">Cerrar Sesion</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu separator-->
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<!--<div class="menu-item px-5">
											<div class="menu-content px-5">
												<label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="kt_user_menu_dark_mode_toggle">
													<input class="form-check-input w-30px h-20px" type="checkbox" value="1" name="mode" id="kt_user_menu_dark_mode_toggle" data-kt-url="/good/dark/index.html" />
													<span class="pulse-ring ms-n1"></span>
													<span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
												</label>
											</div>
										</div>-->
										<!--end::Menu item-->
									</div>
									<!--end::Menu-->
								</div>
								<!--end::User image-->
								<!--begin::Wrapper-->
								<div class="flex-row-fluid flex-wrap">
									<!--begin::Section-->
									<div class="d-flex align-items-center flex-stack">
										<!--begin::Info-->
										<div class="me-2">
											<!--begin::Username-->
											<a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold lh-0">
												<?= $this->session->userdata("Name"); ?>
											</a>
											<!--end::Username-->
											<!--begin::Description-->
											<span class="text-gray-400 fw-bold d-block fs-8">
												<?= $this->session->userdata("Puesto"); ?>
											</span>
											<!--end::Description-->
										</div>
										<!--end::Info-->
										<!--begin::Action-->
										<a href="<?= base_url("index.php/Logout")?>" class="btn btn-icon btn-active-color-primary me-n4" 
                                        data-bs-toggle="tooltip" title="Cerrar sesión">
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr076.svg-->
											<span class="svg-icon svg-icon-2 svg-icon-gray-400">
												<svg  width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(-1 0 0 1 15.5 11)" fill="black" />
													<path d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z" fill="black" />
													<path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</a>
										<!--end::Action-->
									</div>
									<!--end::Section-->
								</div>
								<!--end::Wrapper-->
							</div>
							<!--end::User-->
						</div>
						<!--end::Aside user-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header align-items-stretch">
						<!--begin::Brand-->
						<div class="header-brand">
							<!--begin::Logo-->
							<a href="">
								<img alt="Logo" src="<?php echo base_url()?>/assets/img/LOGO.png" class="h-70px" />
							</a>
							<!--end::Logo-->
							<!--begin::Aside action-->
							
							<!--end::Aside action-->
							<!--begin::Aside toggle-->
							<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
								<div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
									<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
									<span class="svg-icon svg-icon-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</div>
							</div>
							<!--end::Aside toggle-->
						</div>
						<!--end::Brand-->
						<div class="toolbar">
							<!--begin::Toolbar-->
							<div class="container-fluid py-6 py-lg-0 d-flex flex-column flex-sm-row align-items-lg-stretch justify-content-sm-between">
								<!--begin::Page title-->
								<div class="page-title d-flex flex-column me-5">
									<!--begin::Title-->
									<h1 class="d-flex flex-column text-dark fw-bolder fs-2 mb-0">
										<?= $this->session->userdata("Name")?>
									</h1>
									<!--end::Title-->
									<!--begin::Breadcrumb-->
									<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">
											<a href="../index-2.html" class="text-muted text-hover-primary"><?php echo basename(FCPATH)?></a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										
										<!--end::Item-->
										<!--begin::Item-->
										<!--<li class="breadcrumb-item text-muted">Usuarios ></li>-->
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item">
											<span class="bullet bg-gray-300 w-5px h-2px"></span>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item text-dark"><?php echo $this->uri->segment(1)?></li>
										<!--end::Item-->
									</ul>
									<!--end::Breadcrumb-->
								</div>
								<!--end::Page title-->
								<!--begin::Action group-->
								<div class="d-flex align-items-center pt-3 pt-sm-0"> <!-- overflow-auto -->
									<!--begin::Action wrapper-->
									
									<!--end::Action wrapper-->
									<!--begin::Actions-->
									<div class="d-flex">
										<!--begin::Notifications-->
										<div class="d-flex align-items-center me-4">
											<!--begin::Menu- wrapper-->
											<!--<a href="#" class="position-relative me-1 btn btn-icon btn-active-light btn-outline btn-outline-default btn-icon-gray-700 btn-active-icon-primary" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">

												<span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="black"/>
														<path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="black"/>
													</svg>
												</span>
												 <span id="" class="position-absolute top-100 start-0 translate-middle  badge badge-circle badge-sm badge-danger">
														123 TODO: ver notificaciones para despues
												 </span>
											</a>-->
											<!--begin::Menu-->
											<div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
												<!--begin::Heading-->
												<div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url('<?= base_url()?>/assets/media/misc/header-dropdown.png')">
													<!--begin::Title-->
													<h3 class="text-white fw-bold mb-3">Quick Links</h3>
													<!--end::Title-->
													<!--begin::Status-->
													<span class="badge bg-primary py-2 px-3">25 pending tasks</span>
													<!--end::Status-->
												</div>
												<!--end::Heading-->
												<!--begin:Nav-->
												<div class="row g-0">
													<!--begin:Item-->
													<div class="col-6">
														<a href="../pages/projects/budget.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
															<!--begin::Svg Icon | path: icons/duotune/finance/fin009.svg-->
															<span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path opacity="0.3" d="M15.8 11.4H6C5.4 11.4 5 11 5 10.4C5 9.80002 5.4 9.40002 6 9.40002H15.8C16.4 9.40002 16.8 9.80002 16.8 10.4C16.8 11 16.3 11.4 15.8 11.4ZM15.7 13.7999C15.7 13.1999 15.3 12.7999 14.7 12.7999H6C5.4 12.7999 5 13.1999 5 13.7999C5 14.3999 5.4 14.7999 6 14.7999H14.8C15.3 14.7999 15.7 14.2999 15.7 13.7999Z" fill="black" />
																	<path d="M18.8 15.5C18.9 15.7 19 15.9 19.1 16.1C19.2 16.7 18.7 17.2 18.4 17.6C17.9 18.1 17.3 18.4999 16.6 18.7999C15.9 19.0999 15 19.2999 14.1 19.2999C13.4 19.2999 12.7 19.2 12.1 19.1C11.5 19 11 18.7 10.5 18.5C10 18.2 9.60001 17.7999 9.20001 17.2999C8.80001 16.8999 8.49999 16.3999 8.29999 15.7999C8.09999 15.1999 7.80001 14.7 7.70001 14.1C7.60001 13.5 7.5 12.8 7.5 12.2C7.5 11.1 7.7 10.1 8 9.19995C8.3 8.29995 8.79999 7.60002 9.39999 6.90002C9.99999 6.30002 10.7 5.8 11.5 5.5C12.3 5.2 13.2 5 14.1 5C15.2 5 16.2 5.19995 17.1 5.69995C17.8 6.09995 18.7 6.6 18.8 7.5C18.8 7.9 18.6 8.29998 18.3 8.59998C18.2 8.69998 18.1 8.69993 18 8.79993C17.7 8.89993 17.4 8.79995 17.2 8.69995C16.7 8.49995 16.5 7.99995 16 7.69995C15.5 7.39995 14.9 7.19995 14.2 7.19995C13.1 7.19995 12.1 7.6 11.5 8.5C10.9 9.4 10.5 10.6 10.5 12.2C10.5 13.3 10.7 14.2 11 14.9C11.3 15.6 11.7 16.1 12.3 16.5C12.9 16.9 13.5 17 14.2 17C15 17 15.7 16.8 16.2 16.4C16.8 16 17.2 15.2 17.9 15.1C18 15 18.5 15.2 18.8 15.5Z" fill="black" />
																</svg>
															</span>
															<!--end::Svg Icon-->
															<span class="fs-5 fw-bold text-gray-800 mb-0">Accounting</span>
															<span class="fs-7 text-gray-400">eCommerce</span>
														</a>
													</div>
													<!--end:Item-->
													<!--begin:Item-->
													<div class="col-6">
														<a href="../pages/projects/settings.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">
															<!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
															<span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black" />
																	<path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="black" />
																</svg>
															</span>
															<!--end::Svg Icon-->
															<span class="fs-5 fw-bold text-gray-800 mb-0">Administration</span>
															<span class="fs-7 text-gray-400">Console</span>
														</a>
													</div>
													<!--end:Item-->
													<!--begin:Item-->
													<div class="col-6">
														<a href="../pages/projects/list.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
															<span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z" fill="black" />
																	<path opacity="0.3" d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z" fill="black" />
																</svg>
															</span>
															<!--end::Svg Icon-->
															<span class="fs-5 fw-bold text-gray-800 mb-0">Projects</span>
															<span class="fs-7 text-gray-400">Pending Tasks</span>
														</a>
													</div>
													<!--end:Item-->
													<!--begin:Item-->
													<div class="col-6">
														<a href="../pages/projects/users.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light">
															<!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
															<span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
																	<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
																</svg>
															</span>
															<!--end::Svg Icon-->
															<span class="fs-5 fw-bold text-gray-800 mb-0">Customers</span>
															<span class="fs-7 text-gray-400">Latest cases</span>
														</a>
													</div>
													<!--end:Item-->
												</div>
												<!--end:Nav-->
												<!--begin::View more-->
												<div class="py-2 text-center border-top">
													<a href="../pages/profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All 
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
													<span class="svg-icon svg-icon-5">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
															<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon--></a>
												</div>
												<!--end::View more-->
											</div>
											<!--end::Menu-->
											<!--end::Menu wrapper-->
										</div>
										<!--end::Notifications-->
										<!--begin::Chat-->
										 <?php
										 	if($this->session->userdata("Autoriza") == 1){
												echo '
												<div class="d-flex align-items-center me-4">
													<a href="#" id="" class="position-relative me-1 btn btn-icon btn-sm btn-active-light btn-outline btn-outline-default btn-icon-gray-700 btn-active-icon-primary"" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
														<!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
														<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black"/>
															<path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<span id="solicRN" class="position-absolute top-100 start-0 translate-middle  badge badge-circle badge-sm badge-danger">
															0
														</span>
													</a>
													<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
														<!--begin::Heading-->
														<div class="d-flex flex-column bgi-no-repeat rounded-top background-notif">
															<!--begin::Title-->
															<h3 class="text-white fw-bold px-9 mt-10 mb-6"> Solicitudes rechazadas
															<span class="fs-8 opacity-75 ps-3"></span> <span id="jsolicitudesr">0</span></h3>
															<!--end::Title-->
															<!--begin::Tabs-->
															<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
																<li class="nav-item">
																	<a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_r" >
																	
																	</a>
																</li>
															</ul>
															<!--end::Tabs-->
														</div>
														<!--end::Heading-->
														<!--begin::Tab content-->
														<div class="tab-content">
															<!--begin::Tab panel-->
															<div class="tab-pane fade show active" id="kt_topbar_notifications_r" role="tabpanel">
																<!--begin::Items-->
																<div class="scroll-y mh-325px my-5 px-8" id="listaRechaz">
																	<!--begin::Item-->
																	
																		<!--begin::Section-->
																		
																		<!--end::Section-->
																		<!--begin::Label-->
																		
																		<!--end::Label-->
																	<!--end::Item-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Tab panel-->
															<!--end::Tab panel-->
														</div>
														<!--end::Tab content-->
													</div>
												</div>

												<div class="d-flex align-items-center me-4">
												
													<a href="#" id="" class="position-relative me-1 btn btn-icon btn-sm btn-active-light btn-outline btn-outline-default btn-icon-gray-700 btn-active-icon-primary"" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
														<!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
														<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
															<path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF"/>
															<path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<span id="solicR" class="position-absolute top-100 start-0 translate-middle  badge badge-circle badge-sm badge-danger">
															0
														</span>
													</a>
													<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
														<!--begin::Heading-->
														<div class="d-flex flex-column bgi-no-repeat rounded-top background-notif">
															<!--begin::Title-->
															<h3 class="text-white fw-bold px-9 mt-10 mb-6"> Solicitudes en proceso
															<span class="fs-8 opacity-75 ps-3"></span> <span id="jsolicitudes">0</span></h3>
															<!--end::Title-->
															<!--begin::Tabs-->
															<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
																<li class="nav-item">
																	<a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_1" >
																	
																	</a>
																</li>
															</ul>
															<!--end::Tabs-->
														</div>
														<!--end::Heading-->
														<!--begin::Tab content-->
														<div class="tab-content">
															<!--begin::Tab panel-->
															<div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
																<!--begin::Items-->
																<div class="scroll-y mh-325px my-5 px-8" id="listaAprob">
																	<!--begin::Item-->
																	
																		<!--begin::Section-->
																		
																		<!--end::Section-->
																		<!--begin::Label-->
																		
																		<!--end::Label-->
																	<!--end::Item-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Tab panel-->
															<!--end::Tab panel-->
														</div>
														<!--end::Tab content-->
													</div>
													
												</div>
												
												<div class="d-flex align-items-center me-4">
												
													<a href="#" id="" class="position-relative me-1 btn btn-icon btn-sm btn-active-light btn-outline btn-outline-default btn-icon-gray-700 btn-active-icon-primary"" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
														<!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
														<span class="svg-icon svg-icon-1">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M18.041 22.041C18.5932 22.041 19.041 21.5932 19.041 21.041C19.041 20.4887 18.5932 20.041 18.041 20.041C17.4887 20.041 17.041 20.4887 17.041 21.041C17.041 21.5932 17.4887 22.041 18.041 22.041Z" fill="black"/>
																<path opacity="0.3" d="M6.04095 22.041C6.59324 22.041 7.04095 21.5932 7.04095 21.041C7.04095 20.4887 6.59324 20.041 6.04095 20.041C5.48867 20.041 5.04095 20.4887 5.04095 21.041C5.04095 21.5932 5.48867 22.041 6.04095 22.041Z" fill="black"/>
																<path opacity="0.3" d="M7.04095 16.041L19.1409 15.1409C19.7409 15.1409 20.141 14.7409 20.341 14.1409L21.7409 8.34094C21.9409 7.64094 21.4409 7.04095 20.7409 7.04095H5.44095L7.04095 16.041Z" fill="black"/>
																<path d="M19.041 20.041H5.04096C4.74096 20.041 4.34095 19.841 4.14095 19.541C3.94095 19.241 3.94095 18.841 4.14095 18.541L6.04096 14.841L4.14095 4.64095L2.54096 3.84096C2.04096 3.64096 1.84095 3.04097 2.14095 2.54097C2.34095 2.04097 2.94096 1.84095 3.44096 2.14095L5.44096 3.14095C5.74096 3.24095 5.94096 3.54096 5.94096 3.84096L7.94096 14.841C7.94096 15.041 7.94095 15.241 7.84095 15.441L6.54096 18.041H19.041C19.641 18.041 20.041 18.441 20.041 19.041C20.041 19.641 19.641 20.041 19.041 20.041Z" fill="black"/>
															</svg>
														</span>
														<!--end::Svg Icon-->
														<span id="badgesolicJefes" class="position-absolute top-100 start-0 translate-middle  badge badge-circle badge-sm badge-danger">
															0
														</span>
													</a>
													<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
														<!--begin::Heading-->
														<div class="d-flex flex-column bgi-no-repeat rounded-top background-notif" >
															<!--begin::Title-->
															<h6 class="text-white fw-bold px-9 mt-10 mb-6"> Solicitudes pendientes de autorizar
															<span class="fs-8 opacity-75 ps-3"></span> <span id="solicitudes">0</span></h6>
															<!--end::Title-->
															<!--begin::Tabs-->
															<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
																<li class="nav-item">
																	<a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_1" >
																	
																	</a>
																</li>
															</ul>
															<!--end::Tabs-->
														</div>
														<!--end::Heading-->
														<!--begin::Tab content-->
														<div class="tab-content">
															<!--begin::Tab panel-->
															<div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
																<!--begin::Items-->
																<div class="scroll-y mh-325px my-5 px-8" id="listaSolic">
																	<!--begin::Item-->
																	
																		<!--begin::Section-->
																		
																		<!--end::Section-->
																		<!--begin::Label-->
																		
																		<!--end::Label-->
																	<!--end::Item-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Tab panel-->
															<!--end::Tab panel-->
														</div>
														<!--end::Tab content-->
													</div>
												</div>
												';
											 }else if($this->session->userdata("IdRol") == 2){
												echo '
												<div class="d-flex align-items-center me-4">
												<a href="#" id="" class="position-relative me-1 btn btn-icon btn-sm btn-active-light btn-outline btn-outline-default btn-icon-gray-700 btn-active-icon-primary"" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
													<!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
													<span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black"/>
														<path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black"/>
													</svg>
													</span>
													<!--end::Svg Icon-->
													<span id="solicR" class="position-absolute top-100 start-0 translate-middle  badge badge-circle badge-sm badge-danger">
														0
													</span>
												</a>
												<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
														<!--begin::Heading-->
														<div class="d-flex flex-column bgi-no-repeat rounded-top background-notif">
															<!--begin::Title-->
															<h3 class="text-white fw-bold px-9 mt-10 mb-6"> Solicitudes rechazadas
															<span class="fs-8 opacity-75 ps-3"></span> <span id="jsolicitudesr">0</span></h3>
															<!--end::Title-->
															<!--begin::Tabs-->
															<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
																<li class="nav-item">
																	<a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_r" >
																	
																	</a>
																</li>
															</ul>
															<!--end::Tabs-->
														</div>
														<!--end::Heading-->
														<!--begin::Tab content-->
														<div class="tab-content">
															<!--begin::Tab panel-->
															<div class="tab-pane fade show active" id="kt_topbar_notifications_r" role="tabpanel">
																<!--begin::Items-->
																<div class="scroll-y mh-325px my-5 px-8" id="listaRechaz">
																	<!--begin::Item-->
																	
																		<!--begin::Section-->
																		
																		<!--end::Section-->
																		<!--begin::Label-->
																		
																		<!--end::Label-->
																	<!--end::Item-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Tab panel-->
															<!--end::Tab panel-->
														</div>
														<!--end::Tab content-->
													</div>
												</div>
												
												<div class="d-flex align-items-center me-4">
													<a href="#" id="" class="position-relative me-1 btn btn-icon btn-sm btn-active-light btn-outline btn-outline-default btn-icon-gray-700 btn-active-icon-primary"" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
														<!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
														<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
															<path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF"/>
															<path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<span id="solic" class="position-absolute top-100 start-0 translate-middle  badge badge-circle badge-sm badge-danger">
															0
														</span>
													</a>
													<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
														<!--begin::Heading-->
														<div class="d-flex flex-column bgi-no-repeat rounded-top background-notif">
															<!--begin::Title-->
															<h3 class="text-white fw-bold px-9 mt-10 mb-6"> Nuevas Solicitudes
															<span class="fs-8 opacity-75 ps-3"></span> <span id="jsolicitudes">0</span></h3>
															<!--end::Title-->
															<!--begin::Tabs-->
															<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
																<li class="nav-item">
																	<a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_1" >
																	
																	</a>
																</li>
															</ul>
															<!--end::Tabs-->
														</div>
														<!--end::Heading-->
														<!--begin::Tab content-->
														<div class="tab-content">
															<!--begin::Tab panel-->
															<div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
																<!--begin::Items-->
																<div class="scroll-y mh-325px my-5 px-8" id="listaAprob">
																	<!--begin::Item-->
																	
																		<!--begin::Section-->
																		
																		<!--end::Section-->
																		<!--begin::Label-->
																		
																		<!--end::Label-->
																	<!--end::Item-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Tab panel-->
															<!--end::Tab panel-->
														</div>
														<!--end::Tab content-->
													</div>
												</div>';
											 }else{
												echo '
												<div class="d-flex align-items-center me-4">
													<a href="#" id="" class="position-relative me-1 btn btn-icon btn-sm btn-active-light btn-outline btn-outline-default btn-icon-gray-700 btn-active-icon-primary"" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
														<!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
														<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black"/>
															<path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<span id="solicRN" class="position-absolute top-100 start-0 translate-middle  badge badge-circle badge-sm badge-danger">
															0
														</span>
													</a>
													<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
														<!--begin::Heading-->
														<div class="d-flex flex-column bgi-no-repeat rounded-top background-notif">
															<!--begin::Title-->
															<h3 class="text-white fw-bold px-9 mt-10 mb-6"> Solicitudes rechazadas
															<span class="fs-8 opacity-75 ps-3"></span> <span id="jsolicitudesr">0</span></h3>
															<!--end::Title-->
															<!--begin::Tabs-->
															<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
																<li class="nav-item">
																	<a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_r" >
																	
																	</a>
																</li>
															</ul>
															<!--end::Tabs-->
														</div>
														<!--end::Heading-->
														<!--begin::Tab content-->
														<div class="tab-content">
															<!--begin::Tab panel-->
															<div class="tab-pane fade show active" id="kt_topbar_notifications_r" role="tabpanel">
																<!--begin::Items-->
																<div class="scroll-y mh-325px my-5 px-8" id="listaRechaz">
																	<!--begin::Item-->
																	
																		<!--begin::Section-->
																		
																		<!--end::Section-->
																		<!--begin::Label-->
																		
																		<!--end::Label-->
																	<!--end::Item-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Tab panel-->
															<!--end::Tab panel-->
														</div>
														<!--end::Tab content-->
													</div>
												</div>
												<div class="d-flex align-items-center me-4">
													<a href="#" id="" class="position-relative me-1 btn btn-icon btn-sm btn-active-light btn-outline btn-outline-default btn-icon-gray-700 btn-active-icon-primary"" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
														<!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
														<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
															<path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF"/>
															<path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<span id="solic" class="position-absolute top-100 start-0 translate-middle  badge badge-circle badge-sm badge-danger">
															0
														</span>
													</a>
													<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
														<!--begin::Heading-->
														<div class="d-flex flex-column bgi-no-repeat rounded-top background-notif">
															<!--begin::Title-->
															<h3 class="text-white fw-bold px-9 mt-10 mb-6"> Solicitudes autorizadas
															<span class="fs-8 opacity-75 ps-3"></span> <span id="jsolicitudes">0</span></h3>
															<!--end::Title-->
															<!--begin::Tabs-->
															<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
																<li class="nav-item">
																	<a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_1" >
																	
																	</a>
																</li>
															</ul>
															<!--end::Tabs-->
														</div>
														<!--end::Heading-->
														<!--begin::Tab content-->
														<div class="tab-content">
															<!--begin::Tab panel-->
															<div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
																<!--begin::Items-->
																<div class="scroll-y mh-325px my-5 px-8" id="listaAprob">
																	<!--begin::Item-->
																	
																		<!--begin::Section-->
																		
																		<!--end::Section-->
																		<!--begin::Label-->
																		
																		<!--end::Label-->
																	<!--end::Item-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Tab panel-->
															<!--end::Tab panel-->
														</div>
														<!--end::Tab content-->
													</div>
												</div>';
											 }
										 ?>
										<!--end::Chat-->
										<!--begin::Quick links-->
										<div class="d-flex align-items-center">
											
											<!--begin::Menu wrapper-->
											<!--Notificaciones usuarios conectaods numero-->
											<a href="#" class="position-relative me-1 btn btn-icon btn-sm btn-active-light btn-outline btn-outline-default btn-icon-gray-700 btn-active-icon-primary"" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
											   <span class="svg-icon svg-icon-1">
											   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="black"/>
														<rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="black"/>
														<path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="black"/>
														<rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="black"/>
													</svg>
												</span>
											    <span id="uconectadosBagde" class="position-absolute top-100 start-0 translate-middle badge badge-circle badge-sm badge-danger">
													0
												</span>
											</a>
											<!--begin::Menu-->
											<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
												<!--begin::Heading-->
												<div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('<?=base_url()?>/assets/media/misc/header-dropdown.png')">
													<!--begin::Title-->
													<h3 class="text-white fw-bold px-9 mt-10 mb-6"> Usuarios conectados
													<span class="fs-8 opacity-75 ps-3"></span> <span id="uconectados">0</span></h3>
													<!--end::Title-->
													<!--begin::Tabs-->
													<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
														<li class="nav-item">
															<a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_1" >
															  
															</a>
														</li>
													</ul>
													<!--end::Tabs-->
												</div>
												<!--end::Heading-->
												<!--begin::Tab content-->
												<div class="tab-content">
													<!--begin::Tab panel-->
													<div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
														<!--begin::Items-->
														<div class="scroll-y mh-325px my-5 px-8" id="listaConect">
															<!--begin::Item-->
															
																<!--begin::Section-->
																
																<!--end::Section-->
																<!--begin::Label-->
																
																<!--end::Label-->
															<!--end::Item-->
														</div>
														<!--end::Items-->
													</div>
													<!--end::Tab panel-->
													<!--end::Tab panel-->
												</div>
												<!--end::Tab content-->
											</div>
											<!--end::Menu-->
											<!--end::Menu wrapper-->
										</div>
										<!--end::Quick links-->
									</div>
									<!--end::Actions-->
								</div>
								<!--end::Action group-->
							</div>
							<!--end::Toolbar-->
						</div>
					</div>
					<!--end::Header-->
