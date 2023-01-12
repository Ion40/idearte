<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }

    public function getAreasTabs()
    {
        $query = $this->db->where("Estado", "A")->get("Areas");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    public function mostrarTaskSemana($idArea, $num)
    {
        $primerDia = '';
        $ultimoDia = '';
        $semana    = "and t0.fecha >= dateadd(week, datediff(week, 0, getdate()), 0)
                   and t0.fecha <= dateadd(week, datediff(week, 0, getdate()), + 6)";
        if ($num < 0) {
            $primerDia = "dateadd(week," . $num . ",dateadd(week, datediff(week, 0, getdate()), 0))";
            $ultimoDia = "DATEADD(WEEK," . $num . ",dateadd(week, datediff(week, 0, getdate()), + 6))";
            $semana    = "and t0.fecha >= dateadd(week," . $num . ",dateadd(week, datediff(week, 0, getdate()), 0))
                       and t0.fecha <= DATEADD(WEEK," . $num . ",dateadd(week, datediff(week, 0, getdate()), + 6))";
        } else if ($num > 0) {
            $primerDia = "dateadd(week," . $num . ",dateadd(week, datediff(week, 0, getdate()), 0))";
            $ultimoDia = "DATEADD(WEEK," . $num . ",dateadd(week, datediff(week, 0, getdate()), + 6))";
            $semana    = "and t0.fecha >= dateadd(week," . $num . ",dateadd(week, datediff(week, 0, getdate()), 0))
                       and t0.fecha <= DATEADD(WEEK," . $num . ",dateadd(week, datediff(week, 0, getdate()), + 6))";
        } else {
            $semana = "and t0.fecha >= dateadd(week, datediff(week, 0, getdate()), 0)
                   and t0.fecha <= dateadd(week, datediff(week, 0, getdate()), + 6)";
            $primerDia = "dateadd(week, datediff(week, 0, getdate()), 0)";
            $ultimoDia = "dateadd(week, datediff(week, 0, getdate()), + 6)";
        }

        $json  = array();
        $i     = 0;
        $query = $this->db->query("
                                    select DATEPART(dw, t0.fecha) as DiaNum,
                                    " . $primerDia . " as PrimerDia,
                                    " . $ultimoDia . " as UltimoDia,
                                    case DATEPART(dw, t0.fecha)
                                    when 2 then 'Lunes'
                                    when 3 then 'Martes'
                                    when 4 then 'Miércoles'
                                    when 5 then 'Jueves'
                                    when 6 then 'Viernes'
                                    when 7 then 'Sábado'
                                    when 1 then 'Domingo' end as Dia,t0.*,t1.NombreArea,t2.Nombre as Atiende
                                    from tareas t0
                                    inner join Areas t1 on t1.IdArea = t0.IdArea
                                    left join Usuarios t2 on t0.IdUsuarioAtiende = t2.IdUsuario
                                    where t0.idarea = '" . $idArea . "'
                                    " . $semana . "
                                    order by t0.Prioridad desc,t0.Reprogramada desc");

        /*--and t0.fecha >= CAST(GETDATE() AS DATETIME) - (DATEPART(dw, CAST(GETDATE() AS DATETIME))-2)
        --and t0.fecha <= CAST(GETDATE() AS DATETIME) + (7-DATEPART(dw, CAST(GETDATE() AS DATETIME))+1) */

        if ($query->num_rows() > 0) {
            $estadoAct = "";
            foreach ($query->result_array() as $key) {
                $json[$i]["DiaNum"]           = $key["DiaNum"];
                $json[$i]["Dia"]              = $key["Dia"];
                $json[$i]["Id"]               = $key["Id"];
                $json[$i]["NoOrdenTrabajo"]   = $key["NoOrdenTrabajo"];
                $json[$i]["Nombre"]           = str_replace(["\n","\""], ["\\n","\'"], $key["Nombre"]);
                $json[$i]["Cantidad"]         = $key["Cantidad"];
                $json[$i]["Descripcion"]      = str_replace(["\n","\""], ["\\n","\'"], $key["Descripcion"]);
                $json[$i]["IdArea"]           = $key["IdArea"];
                $json[$i]["NombreArea"]       = $key["NombreArea"];
                $json[$i]["IdUsuarioAtiende"] = $key["IdUsuarioAtiende"];
                $json[$i]["PrimerDia"]        = date_format(new DateTime($key["PrimerDia"]), "d-m-Y");
                $json[$i]["UltimoDia"]        = date_format(new DateTime($key["UltimoDia"]), "d-m-Y");
                $json[$i]["ContactoCliente"]  = $key["ContactoCliente"];
                if ($key["Imagen"] == "") {
                    $json[$i]["Imagen"] = "data:image/png;base64,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";
                } else {
                    $json[$i]["Imagen"] = $key["Imagen"];
                }
                if ($key["Atiende"] === null) {
                    $json[$i]["Atiende"] = "Sin atender";
                } else {
                    $json[$i]["Atiende"] = $key["Atiende"];
                }
                switch ($key["EstadoTarea"]) {
                    case "A":
                        $estadoAct = '<span class="badge badge-secondary bg-hover-secondary text-hover-white fw-bold fs-9 px-2 ms-2">Abierta</span>';
                        break;
                    case 'P':
                        $estadoAct = '<span class="badge badge-primary bg-hover-primary text-hover-white fw-bold fs-9 px-2 ms-2">En proceso</span>';
                        break;
                    case 'I':
                        $estadoAct = '<span class="badge badge-danger bg-hover-danger text-hover-white fw-bold fs-9 px-2 ms-2">Anulada</span>';
                        break;
                    case 'R':
                        $estadoAct = '<span class="badge badge-info bg-hover-info text-hover-white fw-bold fs-9 px-2 ms-2">Reprogramada</span>';
                        break;
                    case 'F':
                        $estadoAct = '<span class="badge badge-success bg-hover-success text-hover-white fw-bold fs-9 px-2 ms-2">Finalizada</span>';
                        break;
                    case 'E':
                        $estadoAct = '<span class="badge badge-warning bg-hover-warning text-hover-white fw-bold fs-9 px-2 ms-2">En espera</span>';
                        break;
                    default:
                        $estadoAct = '<span class="badge badge-white bg-hover-while text-hover-white fw-bold fs-9 px-2 ms-2"></span>';
                        break;
                }
                $retVal = ($key["FechaRealEntrega"]) ? date_format(new DateTime($key["FechaRealEntrega"]), "Y-m-d") : "";
                $key["FechaRealEntrega"];
                $json[$i]["EstadoTarea"]      = $estadoAct;
                $json[$i]["EstadoTareaChar"]  = $key["EstadoTarea"];
                $json[$i]["Prioridad"]        = $key["Prioridad"];
                $json[$i]["Fecha"]            = $key["Fecha"];
                $json[$i]["FechaRealEntrega"] = $retVal;
                /*$json[$i]["Opciones"] = '
                <div class="text-center d-flex gap-2 mb-2">
                <div class="dropdown dropend">
                <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary mt-n2 me-n3 dropdown-toggle"
                id="dropdownMenuButton1" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                aria-expanded="false" data-target="#">
                <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                <span class="svg-icon svg-icon-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="black"></rect>
                <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="black">
                </rect>
                <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="black">
                </rect>
                <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="black"></rect>
                </svg>
                </span>
                <!--end::Svg Icon-->
                </button>

                <ul class="dropdown-menu" style="position: relative !important;" aria-labelledby="dropdownMenuButton1" role="menu">
                <li><a class="dropdown-item disabled" tabindex="-1" aria-disabled="true" href="#"> Desglose</a></li>
                <li><hr class="dropdown-divider"></li>

                <li>
                <a class="dropdown-item" href="#">
                <span class="svg-icon svg-icon-info svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3" d="M3 3V17H7V21H15V9H20V3H3Z" fill="black"/>
                <path d="M20 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H20C20.6 2 21 2.4 21 3V21C21 21.6 20.6 22 20 22ZM19 4H4V8H19V4ZM6 18H4V20H6V18ZM6 14H4V16H6V14ZM6 10H4V12H6V10ZM10 18H8V20H10V18ZM10 14H8V16H10V14ZM10 10H8V12H10V10ZM14 18H12V20H14V18ZM14 14H12V16H14V14ZM14 10H12V12H14V10ZM19 14H17V20H19V14ZM19 10H17V12H19V10Z" fill="black"/>
                </svg>
                </span>
                Orden de compra
                </a>
                </li>
                <li>
                <a class="dropdown-item" href="#">
                <span class="svg-icon svg-icon-info svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="black"/>
                <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="black"/>
                <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="black"/>
                </svg>
                </span>
                Orden de pago</a>
                </li>
                <li>
                <a class="dropdown-item" href="#">
                <span class="svg-icon svg-icon-info svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M6 20C6 20.6 5.6 21 5 21C4.4 21 4 20.6 4 20H6ZM18 20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20H18Z" fill="black"/>
                <path opacity="0.3" d="M21 20H3C2.4 20 2 19.6 2 19V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V19C22 19.6 21.6 20 21 20ZM12 10H10.7C10.5 9.7 10.3 9.50005 10 9.30005V8C10 7.4 9.6 7 9 7C8.4 7 8 7.4 8 8V9.30005C7.7 9.50005 7.5 9.7 7.3 10H6C5.4 10 5 10.4 5 11C5 11.6 5.4 12 6 12H7.3C7.5 12.3 7.7 12.5 8 12.7V14C8 14.6 8.4 15 9 15C9.6 15 10 14.6 10 14V12.7C10.3 12.5 10.5 12.3 10.7 12H12C12.6 12 13 11.6 13 11C13 10.4 12.6 10 12 10Z" fill="black"/>
                <path d="M18.5 11C18.5 10.2 17.8 9.5 17 9.5C16.2 9.5 15.5 10.2 15.5 11C15.5 11.4 15.7 11.8 16 12.1V13C16 13.6 16.4 14 17 14C17.6 14 18 13.6 18 13V12.1C18.3 11.8 18.5 11.4 18.5 11Z" fill="black"/>
                </svg>
                </span>
                Caja Chica</a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><a  class="dropdown-item" href="javascript:void(0)">
                <span class="svg-icon svg-icon-info svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"/>
                <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"/>
                </svg>
                </span>
                Detalle Solicitud</a></li>

                </ul>
                </div>
                </div>
                ';*/
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function mostrarTaskSemanaTodos($idArea, $fecha, $num)
    {
        $primerDia = '';
        $ultimoDia = '';
        $semana    = "and t0.fecha >= dateadd(week, datediff(week, 0, getdate()), 0)
                   and t0.fecha <= dateadd(week, datediff(week, 0, getdate()), + 6)";
        if ($num < 0) {
            $primerDia = "dateadd(week," . $num . ",dateadd(week, datediff(week, 0, getdate()), 0))";
            $ultimoDia = "DATEADD(WEEK," . $num . ",dateadd(week, datediff(week, 0, getdate()), + 6))";
            $semana    = "and t0.fecha >= dateadd(week," . $num . ",dateadd(week, datediff(week, 0, getdate()), 0))
                       and t0.fecha <= DATEADD(WEEK," . $num . ",dateadd(week, datediff(week, 0, getdate()), + 6))";
        } else if ($num > 0) {
            $primerDia = "dateadd(week," . $num . ",dateadd(week, datediff(week, 0, getdate()), 0))";
            $ultimoDia = "DATEADD(WEEK," . $num . ",dateadd(week, datediff(week, 0, getdate()), + 6))";
            $semana    = "and t0.fecha >= dateadd(week," . $num . ",dateadd(week, datediff(week, 0, getdate()), 0))
                       and t0.fecha <= DATEADD(WEEK," . $num . ",dateadd(week, datediff(week, 0, getdate()), + 6))";
        } else {
            $semana = "and t0.fecha >= dateadd(week, datediff(week, 0, getdate()), 0)
                   and t0.fecha <= dateadd(week, datediff(week, 0, getdate()), + 6)";
            $primerDia = "dateadd(week, datediff(week, 0, getdate()), 0)";
            $ultimoDia = "dateadd(week, datediff(week, 0, getdate()), + 6)";
        }

        $json  = array();
        $i     = 0;
        $query = $this->db->query("
                                    select DATEPART(dw, t0.fecha) as DiaNum,
                                    " . $primerDia . " as PrimerDia,
                                    " . $ultimoDia . " as UltimoDia,
                                    case DATEPART(dw, t0.fecha)
                                    when 2 then 'Lunes'
                                    when 3 then 'Martes'
                                    when 4 then 'Miércoles'
                                    when 5 then 'Jueves'
                                    when 6 then 'Viernes'
                                    when 7 then 'Sábado'
                                    when 1 then 'Domingo' end as Dia,t0.*,t1.NombreArea,t2.Nombre as Atiende
                                    from tareas t0
                                    inner join Areas t1 on t1.IdArea = t0.IdArea
                                    left join Usuarios t2 on t0.IdUsuarioAtiende = t2.IdUsuario
                                    where t0.idarea = '" . $idArea . "'
                                    " . $semana . "
                                    and t0.Fecha = '" . $fecha . "'
                                    order by t0.Prioridad desc");

        if ($query->num_rows() > 0) {
            $estadoAct = "";
            foreach ($query->result_array() as $key) {
                $json[$i]["DiaNum"]           = $key["DiaNum"];
                $json[$i]["Dia"]              = $key["Dia"];
                $json[$i]["Id"]               = $key["Id"];
                $json[$i]["NoOrdenTrabajo"]   = $key["NoOrdenTrabajo"];
                $json[$i]["Nombre"]           = $key["Nombre"];
                $json[$i]["Cantidad"]         = $key["Cantidad"];
                $json[$i]["Descripcion"]      = str_replace(["\n","\""], ["\\n","\'"], $key["Descripcion"]);
                $json[$i]["IdArea"]           = $key["IdArea"];
                $json[$i]["NombreArea"]       = $key["NombreArea"];
                $json[$i]["IdUsuarioAtiende"] = $key["IdUsuarioAtiende"];
                $json[$i]["PrimerDia"]        = date_format(new DateTime($key["PrimerDia"]), "d-m-Y");
                $json[$i]["UltimoDia"]        = date_format(new DateTime($key["UltimoDia"]), "d-m-Y");
                if ($key["Imagen"] == "") {
                    $json[$i]["Imagen"] = "data:image/png;base64,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";
                } else {
                    $json[$i]["Imagen"] = $key["Imagen"];
                }
                if ($key["Atiende"] === null) {
                    $json[$i]["Atiende"] = "Sin atender";
                } else {
                    $json[$i]["Atiende"] = $key["Atiende"];
                }
                switch ($key["EstadoTarea"]) {
                    case "A":
                        $estadoAct = '<span class="badge badge-secondary bg-hover-secondary text-hover-white fw-bold fs-9 px-2 ms-2">Abierta</span>';
                        break;
                    case 'P':
                        $estadoAct = '<span class="badge badge-primary bg-hover-primary text-hover-white fw-bold fs-9 px-2 ms-2">En proceso</span>';
                        break;
                    case 'I':
                        $estadoAct = '<span class="badge badge-danger bg-hover-danger text-hover-white fw-bold fs-9 px-2 ms-2">Anulada</span>';
                        break;
                    case 'R':
                        $estadoAct = '<span class="badge badge-info bg-hover-info text-hover-white fw-bold fs-9 px-2 ms-2">Reprogramada</span>';
                        break;
                    case 'F':
                        $estadoAct = '<span class="badge badge-success bg-hover-success text-hover-white fw-bold fs-9 px-2 ms-2">Finalizada</span>';
                        break;
                    case 'E':
                        $estadoAct = '<span class="badge badge-warning bg-hover-warning text-hover-white fw-bold fs-9 px-2 ms-2">En espera</span>';
                        break;
                    default:
                        $estadoAct = '<span class="badge badge-white bg-hover-while text-hover-white fw-bold fs-9 px-2 ms-2"></span>';
                        break;
                }
                $retVal                       = ($key["FechaRealEntrega"]) ? date_format(new DateTime($key["FechaRealEntrega"]), "Y-m-d") : "";
                $json[$i]["EstadoTarea"]      = $estadoAct;
                $json[$i]["EstadoTareaChar"]  = $key["EstadoTarea"];
                $json[$i]["Prioridad"]        = $key["Prioridad"];
                $json[$i]["Fecha"]            = $key["Fecha"];
                $json[$i]["FechaRealEntrega"] = $retVal;
                $json[$i]["ContactoCliente"]  = $key["ContactoCliente"];
                $json[$i]["NotaParcial"]      = str_replace(["\n","\""], ["\\n","\'"], $key["NotaParcial"]);
                $json[$i]["TipoEntrega"]      = $key["TipoEntrega"];
                /*$json[$i]["Opciones"] = '
                <div class="text-center d-flex gap-2 mb-2">
                <div class="dropdown dropend">
                <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary mt-n2 me-n3 dropdown-toggle"
                id="dropdownMenuButton1" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                aria-expanded="false" data-target="#">
                <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                <span class="svg-icon svg-icon-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="black"></rect>
                <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="black">
                </rect>
                <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="black">
                </rect>
                <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="black"></rect>
                </svg>
                </span>
                <!--end::Svg Icon-->
                </button>

                <ul class="dropdown-menu" style="position: relative !important;" aria-labelledby="dropdownMenuButton1" role="menu">
                <li><a class="dropdown-item disabled" tabindex="-1" aria-disabled="true" href="#"> Desglose</a></li>
                <li><hr class="dropdown-divider"></li>

                <li>
                <a class="dropdown-item" href="#">
                <span class="svg-icon svg-icon-info svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3" d="M3 3V17H7V21H15V9H20V3H3Z" fill="black"/>
                <path d="M20 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H20C20.6 2 21 2.4 21 3V21C21 21.6 20.6 22 20 22ZM19 4H4V8H19V4ZM6 18H4V20H6V18ZM6 14H4V16H6V14ZM6 10H4V12H6V10ZM10 18H8V20H10V18ZM10 14H8V16H10V14ZM10 10H8V12H10V10ZM14 18H12V20H14V18ZM14 14H12V16H14V14ZM14 10H12V12H14V10ZM19 14H17V20H19V14ZM19 10H17V12H19V10Z" fill="black"/>
                </svg>
                </span>
                Orden de compra
                </a>
                </li>
                <li>
                <a class="dropdown-item" href="#">
                <span class="svg-icon svg-icon-info svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="black"/>
                <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="black"/>
                <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="black"/>
                </svg>
                </span>
                Orden de pago</a>
                </li>
                <li>
                <a class="dropdown-item" href="#">
                <span class="svg-icon svg-icon-info svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M6 20C6 20.6 5.6 21 5 21C4.4 21 4 20.6 4 20H6ZM18 20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20H18Z" fill="black"/>
                <path opacity="0.3" d="M21 20H3C2.4 20 2 19.6 2 19V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V19C22 19.6 21.6 20 21 20ZM12 10H10.7C10.5 9.7 10.3 9.50005 10 9.30005V8C10 7.4 9.6 7 9 7C8.4 7 8 7.4 8 8V9.30005C7.7 9.50005 7.5 9.7 7.3 10H6C5.4 10 5 10.4 5 11C5 11.6 5.4 12 6 12H7.3C7.5 12.3 7.7 12.5 8 12.7V14C8 14.6 8.4 15 9 15C9.6 15 10 14.6 10 14V12.7C10.3 12.5 10.5 12.3 10.7 12H12C12.6 12 13 11.6 13 11C13 10.4 12.6 10 12 10Z" fill="black"/>
                <path d="M18.5 11C18.5 10.2 17.8 9.5 17 9.5C16.2 9.5 15.5 10.2 15.5 11C15.5 11.4 15.7 11.8 16 12.1V13C16 13.6 16.4 14 17 14C17.6 14 18 13.6 18 13V12.1C18.3 11.8 18.5 11.4 18.5 11Z" fill="black"/>
                </svg>
                </span>
                Caja Chica</a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><a  class="dropdown-item" href="javascript:void(0)">
                <span class="svg-icon svg-icon-info svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"/>
                <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"/>
                </svg>
                </span>
                Detalle Solicitud</a></li>

                </ul>
                </div>
                </div>
                ';*/
                $i++;
            }
            echo json_encode($json);
        }
    }
    //Atender Tarea
    public function atenderSolicitud($idTarea, $idArea)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "15");
            if ($permiso) {
                /*$valida = $this->db->query("select count(1) as cantTareas from Tareas
                where EstadoTarea = 'P'
                and idarea = '".$idArea."'
                and IdUsuarioAtiende = '".$this->session->userdata("id")."'
                and fecha >= CAST(GETDATE() AS DATETIME) - (DATEPART(dw, CAST(GETDATE() AS DATETIME))-1)
                and fecha <= CAST(GETDATE() AS DATETIME) + (7-DATEPART(dw, CAST(GETDATE() AS DATETIME)))");

                if($valida->result_array()[0]["cantTareas"] > 0){
                $mensaje[0]["mensaje"] = "Ya tienes una tarea en proceso. No puedes atender más de una tarea al mismo tiempo";
                $mensaje[0]["tipo"] = "info";
                echo json_encode($mensaje);
                }else{*/
                $validarDia = $this->db->query("select fecha from Tareas where Id = '" . $idTarea . "' ");
                if (strtotime($validarDia->result_array()[0]["fecha"]) >= strtotime(date("Y-m-d"))) {
                    $otroUser = $this->db->query("select t0.IdUsuarioAtiende,t1.Nombre from tareas t0 inner join Usuarios t1 on t1.IdUsuario = t0.IdUsuarioAtiende where Id = '" . $idTarea . "' ");
                    if (@$otroUser->result_array()[0]["IdUsuarioAtiende"] == 0 || @$otroUser->result_array()[0]["IdUsuarioAtiende"] == "") {
                        $this->db->where("Id", $idTarea);
                        $data = array(
                            "EstadoTarea"      => "P",
                            "IdUsuarioAtiende" => $this->session->userdata("id"),
                            "Visto"            => 0,
                            "FechaEdita"       => date("Y-m-d H:i:s"),
                            "IdUsuarioEdita"   => $this->session->userdata("id"),
                        );
                        $update = $this->db->update("Tareas", $data);
                        if ($update) {
                            $mensaje[0]["mensaje"] = "Datos actualizados! Tarea en proceso";
                            $mensaje[0]["tipo"]    = "success";
                            echo json_encode($mensaje);
                        } else {
                            $mensaje[0]["mensaje"] = "Error al tratar de actualizar los datos de la tarea";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                        }
                    } else {
                        $mensaje[0]["mensaje"] = "Esta tarea ya está siendo atendida por " . $otroUser->result_array()[0]["Nombre"];
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }
                } else {
                    $mensaje[0]["mensaje"] = "No puedes atender tareas del dia anterior." . date("Y-m-d");
                    $mensaje[0]["tipo"]    = "info";
                    echo json_encode($mensaje);
                }
                //}
            } else {
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function cerrarTarea($idTarea)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "16");
            if ($permiso) {
                $this->db->where("Id", $idTarea);
                //$this->db->where("IdUsuarioAtiende",$this->session->userdata("id"));
                $data = array(
                    "EstadoTarea"    => "F",
                    "FechaFinaliza"  => date("Y-m-d H:i:s"),
                    "Visto"          => 0,
                    "FechaEdita"     => date("Y-m-d H:i:s"),
                    "IdUsuarioEdita" => $this->session->userdata("id"),
                );
                $update = $this->db->update("Tareas", $data);
                if ($update) {
                    $mensaje[0]["mensaje"] = "Tarea cerrada!";
                    $mensaje[0]["tipo"]    = "success";
                    echo json_encode($mensaje);
                } else {
                    $mensaje[0]["mensaje"] = "Error al tratar de actualizar los datos de la tarea";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }
            } else {
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function reprogramarTarea($idTarea, $tarea, $cantidad, $desc, $orden, $prioridad, $idArea, $fecha, $fechareal, $cliente)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "17");
            if ($permiso) {
                $valida = $this->db->query("select EstadoTarea from Tareas where Id = '" . $idTarea . "' ");
                if ($valida->result_array()[0]["EstadoTarea"] == "F" || $valida->result_array()[0]["EstadoTarea"] == "I" || $valida->result_array()[0]["EstadoTarea"] == "R") {
                    switch ($valida->result_array()[0]["EstadoTarea"]) {
                        case "F":
                            $mensaje[0]["mensaje"] = "No se puede reprogramar esta tarea por que ya está finalizada";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                            break;
                        case "R":
                            $mensaje[0]["mensaje"] = "No se puede reprogramar esta tarea por que ya fue reprogramada";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                            break;
                        case "I":
                            $mensaje[0]["mensaje"] = "No se puede reprogramar esta tarea por que ya está anulada";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                            break;
                            /*case "E":
                    $mensaje[0]["mensaje"] = "No se puede reprogramar esta tarea por que está en espera";
                    $mensaje[0]["tipo"] = "error";
                    echo json_encode($mensaje);
                    break;  */
                    }
                } else {
                    $fechaValida = $this->db->query("select Fecha from tareas where Id = '" . $idTarea . "' ");
                    if ($fecha < date("Y-m-d")) {
                        $mensaje[0]["mensaje"] = "No se puede reprogramar una tarea con fecha anterior a la fecha actual.";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    } else if ($fecha === $fechaValida->result_array()[0]["Fecha"]) {
                        $mensaje[0]["mensaje"] = "No se puede reprogramar una tarea con fecha igual a la fecha actual.";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    } else {
                        $imagen = $this->db->query("select Imagen from tareas where Id = '" . $idTarea . "' ");
                        $this->db->where("Id", $idTarea);
                        $update = array(
                            "EstadoTarea"    => "R",
                            "IdUsuarioEdita" => $this->session->userdata("id"),
                            "FechaEdita"     => date("Y-m-d H:i:s"),
                            "Visto"          => 0,
                        );
                        $reprog = $this->db->update("Tareas", $update);
                        if ($reprog) {
                            $idUser = $this->db->query("SELECT ISNULL(MAX(Id),0)+1 as Id FROM Tareas");
                            $data   = array(
                                "Id"               => $idUser->result_array()[0]["Id"],
                                "Nombre"           => $tarea,
                                "Cantidad"         => $cantidad,
                                "Descripcion"      => $desc,
                                "NoOrdenTrabajo"   => $orden,
                                "Prioridad"        => $prioridad,
                                "EstadoTarea"      => "A",
                                "IdArea"           => $idArea,
                                "Fecha"            => $fecha,
                                "IdUsuarioCrea"    => $this->session->userdata("id"),
                                "FechaCrea"        => date("Y-m-d H:i:s"),
                                "Visto"            => 0,
                                "Imagen"           => $imagen->result_array()[0]["Imagen"],
                                "Reprogramada"     => 1,
                                "FechaRealEntrega" => $fechareal,
                                "ContactoCliente"  => $cliente,
                            );

                            $save = $this->db->insert("Tareas", $data);

                            if ($save) {
                                $mensaje[0]["mensaje"] = "Datos almacenados con éxito";
                                $mensaje[0]["tipo"]    = "success";
                                echo json_encode($mensaje);
                            } else {
                                $mensaje[0]["mensaje"] = "Error al insertar los datos. Póngase en contácto con el administrador";
                                $mensaje[0]["tipo"]    = "error";
                                echo json_encode($mensaje);
                            }
                        } else {
                            $mensaje[0]["mensaje"] = "Error al intentar reprogramar la tarea. Si el problema persiste contáctece con el personal de soporte";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                        }
                    }
                }
            } else {
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }

        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function enEsperaTarea($idTarea, $comentarioEspera)
    {
        $this->db->trans_begin();
        $mensaje = array();
        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "18");
            if ($permiso) {
                $valida = $this->db->query("select EstadoTarea from Tareas where Id = '" . $idTarea . "' ");
                if ($valida->result_array()[0]["EstadoTarea"] == "F" || $valida->result_array()[0]["EstadoTarea"] == "I" || $valida->result_array()[0]["EstadoTarea"] == "E") {
                    switch ($valida->result_array()[0]["EstadoTarea"]) {
                        case "F":
                            $mensaje[0]["mensaje"] = "No se puede poner en espera esta tarea por que ya está finalizada";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                            break;
                        case "I":
                            $mensaje[0]["mensaje"] = "No se puede poner en espera esta tarea por que ya está anulada";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                            break;
                        case "E":
                            $mensaje[0]["mensaje"] = "No se puede poner en espera esta tarea por que ya está en espera";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                            break;
                            /*case "P":
                    $mensaje[0]["mensaje"] = "No se puede poner en espera esta tarea por que ya está siendo atendida";
                    $mensaje[0]["tipo"] = "error";
                    echo json_encode($mensaje);
                    break;  */
                    }
                } else {
                    $this->db->where("Id", $idTarea);
                    $data = array(
                        "EstadoTarea"      => "E",
                        "ComentarioEspera" => $comentarioEspera,
                        "Visto"            => 0,
                        "IdUsuarioAtiende" => 0,
                        "FechaEdita"       => date("Y-m-d H:i:s"),
                        "IdUsuarioEdita"   => $this->session->userdata("id"),
                    );
                    $update = $this->db->update("Tareas", $data);
                    if ($update) {
                        $mensaje[0]["mensaje"] = "Datos actualizados! La tarea está en espera";
                        $mensaje[0]["tipo"]    = "success";
                        echo json_encode($mensaje);
                    } else {
                        $mensaje[0]["mensaje"] = "Error al tratar de actualizar los datos de la tarea";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }
                }
            } else {
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function anularTarea($idTarea)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "19");
            if ($permiso) {
                $valida = $this->db->query("select EstadoTarea from Tareas where Id = '" . $idTarea . "' ");
                if ($valida->result_array()[0]["EstadoTarea"] == "R" || $valida->result_array()[0]["EstadoTarea"] == "I" || $valida->result_array()[0]["EstadoTarea"] == "F") {
                    switch ($valida->result_array()[0]["EstadoTarea"]) {
                        case "R":
                            $mensaje[0]["mensaje"] = "No se puede anular esta tarea por que ya está reprogramada";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                            break;
                        case "I":
                            $mensaje[0]["mensaje"] = "No se puede anular esta tarea por que ya está anulada";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                            break;
                        case "F":
                            $mensaje[0]["mensaje"] = "No se puede anular esta tarea por que ya está finalizada";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                            break;
                    }
                } else {
                    $this->db->where("Id", $idTarea);
                    //$this->db->where("IdUsuarioAtiende",$this->session->userdata("id"));
                    $data = array(
                        "EstadoTarea"    => "I",
                        "Visto"          => 0,
                        "FechaEdita"     => date("Y-m-d H:i:s"),
                        "IdUsuarioEdita" => $this->session->userdata("id"),
                    );
                    $update = $this->db->update("Tareas", $data);
                    if ($update) {
                        $mensaje[0]["mensaje"] = "Tarea anulada!";
                        $mensaje[0]["tipo"]    = "success";
                        echo json_encode($mensaje);
                    } else {
                        $mensaje[0]["mensaje"] = "Error al tratar de actualizar los datos de la tarea";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }
                }
            } else {
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function agregarIncidencias($idTarea, $Descripcion)
    {
        $this->db->trans_begin();
        $mensaje = array();
        $sms     = "";
        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "20");
            if ($permiso) {
                $otroUser = $this->db->query("select t0.IdUsuarioAtiende,t0.EstadoTarea from tareas t0 where Id = '" . $idTarea . "' ");
                if ($otroUser->result_array()[0]["EstadoTarea"] == "A" || $otroUser->result_array()[0]["EstadoTarea"] == "E" || $otroUser->result_array()[0]["EstadoTarea"] == "P") {

                    $IdIncidencia = $this->db->query("SELECT ISNULL(MAX(IdIncidencia),0)+1 as IdIncidencia FROM TareaIncidencia");
                    $data         = array(
                        "IdIncidencia"    => $IdIncidencia->result_array()[0]["IdIncidencia"],
                        "IdOrden"         => $idTarea,
                        "Descripcion"     => $Descripcion,
                        "FechaIncidencia" => date("Y-m-d H:i:s"),
                        "Estado"          => "A",
                        "IdUsuarioCrea"   => $this->session->userdata("id"),
                        "FechaCrea"       => date("Y-m-d H:i:s"),
                        "Visto"           => 0,
                    );

                    $save = $this->db->insert("TareaIncidencia", $data);

                    if ($save) {
                        $mensaje[0]["mensaje"] = "Incidencia agregada con éxito";
                        $mensaje[0]["tipo"]    = "success";
                        echo json_encode($mensaje);
                    } else {
                        $mensaje[0]["mensaje"] = "Error al insertar los datos. Póngase en contácto con el administrador";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }
                } else {

                    switch ($otroUser->result_array()[0]["EstadoTarea"]) {
                        case 'R':
                            $sms = "No puedes agregar observaciones a una tarea Reprogramada.";
                            break;
                        case 'F':
                            $sms = "No puedes agregar observaciones a una tarea Finalizada.";
                            break;
                        case 'I':
                            $sms = "No puedes agregar observaciones a una tarea Anulada.";
                            break;
                        default:
                            # code...
                            break;
                    }
                    $mensaje[0]["mensaje"] = $sms;
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }
            } else {
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function mostrarIncidencias($idTarea)
    {
        $json  = array();
        $i     = 0;
        $query = $this->db->query("SELECT t0.*,t1.Nombre
        FROM TareaIncidencia t0
        inner join Usuarios t1 on t0.IdUsuarioCrea = t1.IdUsuario
        where t0.IdOrden = '" . $idTarea . "'
        order by FechaIncidencia desc");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $json[$i]["IdIncidencia"]    = $key["IdIncidencia"];
                $json[$i]["IdOrden"]         = $key["IdOrden"];
                $json[$i]["Descripcion"]     = $key["Descripcion"];
                $json[$i]["FechaIncidencia"] = date_format(new DateTime($key["FechaIncidencia"]), "Y-m-d");
                $json[$i]["FechaCrea"]       = date_format(new DateTime($key["FechaCrea"]), "Y-m-d H:i:s");
                $json[$i]["Nombre"]          = $key["Nombre"];
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function mostrarComentEspera($idTarea)
    {
        $json  = array();
        $i     = 0;
        $query = $this->db->query("SELECT t0.*,t1.Nombre as Usuario
        FROM Tareas t0
        inner join Usuarios t1 on t0.IdUsuarioEdita = t1.IdUsuario
        where t0.Id = '" . $idTarea . "'
       -- order by FechaIncidencia desc");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $json[$i]["Id"]               = $key["Id"];
                $json[$i]["Nombre"]           = $key["Nombre"];
                $json[$i]["Cantidad"]         = $key["Cantidad"];
                $json[$i]["Descripcion"]      = str_replace(["\n","\""], ["\\n","\'"], $key["Descripcion"]);
                $json[$i]["ComentarioEspera"] = str_replace(["\n","\""], ["\\n","\'"], $key["ComentarioEspera"]);
                $json[$i]["NoOrdenTrabajo"]   = $key["NoOrdenTrabajo"];
                // $json[$i]["FechaEdita"] = date_format(new DateTime($key["FechaEdita"]),"Y-m-d H:i:s");
                $json[$i]["Usuario"] = $key["Usuario"];
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function entregaMateriales($idTarea, $tipo, $nota)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "26");
            if ($permiso) {
                $fechaValida = $this->db->query("select Fecha from tareas where Id = '" . $idTarea . "' ");
                if (date_format(new DateTime($fechaValida->result_array()[0]["Fecha"]),"Y-m-d") < date("Y-m-d")) {
                    $mensaje[0]["mensaje"] = "No se puede reprogramar una tarea con fecha anterior a la fecha actual.";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }else{
                    $this->db->where("Id", $idTarea);
                    if ($nota != "") {
                        $data = array(
                            "TipoEntrega" => $tipo,
                            "NotaParcial" => $nota,
                        );
                        $this->db->update("Tareas", $data);
                    } else {
                        $data = array(
                            "TipoEntrega" => $tipo,
                        );
                        $this->db->update("Tareas", $data);
                    }
                }
            } else {
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
}

/* End of file Dashboard_model.php */
