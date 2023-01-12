<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   = 'Login_controller';
$route['404_override']         = '';
$route['translate_uri_dashes'] = false;

$route['Login']    = 'Login_controller/Acreditar';
$route['Logout']   = 'Login_controller/Salir';
$route['Denegado'] = 'Login_controller/accessDenied';

$route['Usuarios']          = 'Usuarios_controller';
$route['getUsuariosAjaxDt'] = 'Usuarios_controller/getUsuariosAjax';
$route['guardarUser']       = 'Usuarios_controller/guardarUser';
$route['actualizarUser']    = 'Usuarios_controller/actualizarUser';
$route['bajaUser']          = 'Usuarios_controller/bajaUser';

$route['Areas']                = 'Areas_controller';
$route['guardarArea']          = 'Areas_controller/guardarArea';
$route['actualizarArea']       = 'Areas_controller/actualizarArea';
$route['actualizarEstadoArea'] = 'Areas_controller/actualizarEstadoArea';
$route['getAreasAjax']         = 'Areas_controller/getAreasAjax';

$route['AdminAut']               = 'Autorizaciones_controller';
$route['getModulosAjax']         = 'Autorizaciones_controller/getModulosAjax';
$route['getAutorizacionesAjax']  = 'Autorizaciones_controller/getAutorizacionesAjax';
$route['asignarAut']             = 'Autorizaciones_controller/asignarAutorizaciones';
$route['getUsuariosAjax']        = 'Autorizaciones_controller/getUsuariosAjax';
$route['getAutAsignados/(:any)'] = 'Autorizaciones_controller/getAutAsignados/$1';
$route['guardarAut']             = 'Autorizaciones_controller/guardarAut';
$route['asignarPermiso']         = 'Autorizaciones_controller/asignarPermiso';

$route['Programacion']                                = 'Dashboard_controller';
$route['mostrarTaskSemana/(:any)/(:any)']             = 'Dashboard_controller/mostrarTaskSemana/$1/$2';
$route['reprogramarTarea']                            = 'Dashboard_controller/reprogramarTarea';
$route['enEsperaTarea']                               = 'Dashboard_controller/enEsperaTarea';
$route['atenderSolicitud']                            = 'Dashboard_controller/atenderSolicitud';
$route['cerrarTarea']                                 = 'Dashboard_controller/cerrarTarea';
$route['anularTarea']                                 = 'Dashboard_controller/anularTarea';
$route['agregarIncidencias']                          = 'Dashboard_controller/agregarIncidencias';
$route['mostrarIncidencias/(:any)']                   = 'Dashboard_controller/mostrarIncidencias/$1';
$route['mostrarTaskSemanaTodos/(:any)/(:any)/(:any)'] = 'Dashboard_controller/mostrarTaskSemanaTodos/$1/$2/$3';
$route['mostrarComentEspera/(:any)']                  = 'Dashboard_controller/mostrarComentEspera/$1';
$route['entregaMateriales']                           = 'Dashboard_controller/entregaMateriales';

$route['Ordencompra']              = 'Ordencompra_controller';
$route['nuevaOrden']               = 'Ordencompra_controller/nuevaOrden';
$route['guardarOrden']             = 'Ordencompra_controller/guardarOrden';
$route['getOrdenesAjax']           = 'Ordencompra_controller/getOrdenesAjax';
$route['getOrdenesDetAjax/(:any)'] = 'Ordencompra_controller/getOrdenesDetAjax/$1';
$route['editOrden/(:any)']         = 'Ordencompra_controller/editOrden/$1';
$route['editOrdenAjax/(:any)']     = 'Ordencompra_controller/editOrdenAjax/$1';
$route['actualizarOrden']          = 'Ordencompra_controller/actualizarOrden';
$route['bajaOrden']                = 'Ordencompra_controller/bajaOrden';

$route['Tareas']                             = 'Tareas_controller';
$route['guardarTarea']                       = 'Tareas_controller/guardarTarea';
$route['getTareasAjax']                      = 'Tareas_controller/getTareasAjax';
$route['actualizarTarea']                    = 'Tareas_controller/actualizarTarea';
$route['guardarMultiImagenes/(:any)/(:any)'] = 'Tareas_controller/guardarMultiImagenes/$1/$2';
$route['mostrarImagenes/(:any)']             = 'Tareas_controller/mostrarImagenes/$1';

$route['mensajes']               = 'Mensajes_controller';
$route['guardarMensaje']         = 'Mensajes_controller/guardarMensaje';
$route['userListChat']           = 'Mensajes_controller/userListChat';
$route['mostrarMensajesSinLeer'] = 'Mensajes_controller/mostrarMensajesSinLeer';
$route['mostrarMensajes/(:any)'] = 'Mensajes_controller/mostrarMensajes/$1';
$route['chatVisto/(:any)']       = 'Mensajes_controller/chatVisto/$1';

$route['RptTareas']                               = 'Reportes_controller';
$route['rptOrdenes']                              = 'Reportes_controller/rptOrdenes';
$route['mostrarTareaRpt']                         = 'Reportes_controller/mostrarTareaRpt';
$route['mostrarOrdenesRpt']                       = 'Reportes_controller/mostrarOrdenesRpt';
$route['imprimirRptOrdenes/(:any)/(:any)/(:any)'] = 'Reportes_controller/imprimirRptOrdenes/$1/$2/$3';
$route['marcarImpreso/(:any)/(:any)/(:any)'] = 'Reportes_controller/marcarImpreso/$1/$2/$3';

$route['mostrarConectados']       = 'Notificaciones_controller/mostrarConectados';
$route['contadorIncidencias']     = 'Notificaciones_controller/contadorIncidencias';
$route['incidenciaNueva']         = 'Notificaciones_controller/incidenciaNueva';
$route['vistoIncidencias/(:any)'] = 'Notificaciones_controller/vistoIncidencias/$1';
//$route['atencionNueva/(:any)'] = 'Notificaciones_controller/atencionNueva/$1';
$route['atencionNueva']        = 'Notificaciones_controller/atencionNueva';
$route['vistoTareas/(:any)']   = 'Notificaciones_controller/vistoTareas/$1';
$route['tareasNotifList']      = 'Notificaciones_controller/tareasNotifList';
$route['incidenciasNotifList'] = 'Notificaciones_controller/incidenciasNotifList';

$route['reprogramarAutoTareas'] = 'Tareas_controller/reprogramarAutoTareas';
