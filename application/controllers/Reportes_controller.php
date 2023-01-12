<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reportes_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Reportes_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        }
    }

    public function index()
    {
        $this->load->view("header/bodyHeader");
        $this->load->view("menu/menu");
        $this->load->view('Reportes/reporteTareas');
        $this->load->view("footer/bodyFooter");
        $this->load->view('jsview/reportes/jsReporteTarea');
    }

    public function rptOrdenes()
    {
        $this->load->view("header/bodyHeader");
        $this->load->view("menu/menu");
        $this->load->view('Reportes/reportes');
        $this->load->view("footer/bodyFooter");
        $this->load->view('jsview/reportes/jsReporte');
    }

    public function mostrarTareaRpt()
    {
        $estadoAct   = "";
        $datos       = array();
        $fechainicio = $this->input->get_post("fechainicio");
        $fechaFin    = $this->input->get_post("fechaFin");
        $idArea      = $this->input->get_post("idArea");
        $start       = $this->input->get_post('start');
        $length      = $this->input->get_post('length');
        $search      = $this->input->get_post('search')['value'];
        $result      = $this->Reportes_model->mostrarTarea($fechainicio, $fechaFin, $idArea, $start, $length, $search);
        $resultado   = $result["datos"];
        $totalDatos  = $result["numDataTotal"];
        $estadoAct   = "";
        $prioridad   = ""; //anulada o activa

        foreach ($resultado->result_array() as $key) {
            $array = array();
            switch ($key["EstadoTarea"]) {
                case "A":
                    $estadoAct = '<span class="badge badge-secondary fs-7 fw-bold">Abierta</span>';
                    break;
                case 'P':
                    $estadoAct = '<span class="badge badge-primary fs-7 fw-bold">En proceso</span>';
                    break;
                case 'I':
                    $estadoAct = '<span class="badge badge-danger fs-7 fw-bold">Anulada</span>';
                    break;
                case 'R':
                    $estadoAct = '<span class="badge badge-info fs-7 fw-bold">Reprogramada</span>';
                    break;
                case 'F':
                    $estadoAct = '<span class="badge badge-success fs-7 fw-bold">Finalizada</span>';
                    break;
                case 'E':
                    $estadoAct = '<span class="badge badge-warning fs-7 fw-bold">En espera</span>';
                    break;
                default:
                    $estadoAct = '<span class="badge badge-white fs-7 fw-bold"></span>';
                    break;
            }

            switch ($key["Prioridad"]) {
                case 1:
                    $prioridad = '<span class="badge badge-success fs-7 fw-bold">Normal</span>';
                    break;
                case 2:
                    $prioridad = '<span class="badge badge-warning fs-7 fw-bold">Alta</span>';
                    break;
                case 3:
                    $prioridad = '<span class="badge badge-danger fs-7 fw-bold">Urgente</span>';
                    break;
                default:
                    $prioridad = '<span class="badge badge-success fs-7 fw-bold">Normal</span>';
                    break;
            }
            $array["NoOrdenTrabajo"] = $key["NoOrdenTrabajo"];
            $array["Nombre"]         = $key["Nombre"];
            $array["Cantidad"]       = $key["Cantidad"];
            $array["Descripcion"]    = $key["Descripcion"];
            $array["Prioridad"]      = $prioridad;
            $array["Estado"]         = $estadoAct;
            $array["NombreArea"]     = $key["NombreArea"];
            $array["Fecha"]          = $key["Fecha"];
            $array["FechaFinaliza"]  = ($key["FechaFinaliza"] != "") ? date_format(new DateTime($key["FechaFinaliza"]), "Y-m-d") : "";
            $array["Atiende"]        = $key["Atiende"];
            $datos[]                 = $array;
        }

        $totalDatosObtenidos = $resultado->num_rows(); //cantidad total de registros
        $json_data           = array(
            "draw"            => intval($this->input->get_post('draw')),
            "recordsTotal"    => intval($totalDatosObtenidos),
            "recordsFiltered" => intval($totalDatos),
            "data"            => $datos,
        );

        echo json_encode($json_data);
    }

    public function mostrarOrdenesRpt()
    {
        $estadoAct   = "";
        $datos       = array();
        $fechainicio = $this->input->get_post("fechainicio");
        $fechaFin    = $this->input->get_post("fechaFin");
        $idArea      = $this->input->get_post("idArea");
        $start       = $this->input->get_post('start');
        $length      = $this->input->get_post('length');
        $search      = $this->input->get_post('search')['value'];
        $result      = $this->Reportes_model->mostrarOrdenesRpt($fechainicio, $fechaFin, $idArea, $start, $length, $search);
        $resultado   = $result["datos"];
        $totalDatos  = $result["numDataTotal"];
        $estadoAct   = "";
        $estado = "";

        foreach ($resultado->result_array() as $key) {
            $array = array();
            switch ($key["Estado"]) {
                case 'A':
                    $estado = "A";
                    $estadoAct = '<span class="badge badge-success fs-7 fw-bold">Activa</span>';
                    break;
                case 'P':
                    $estado = "P";
                    $estadoAct = '<span class="badge badge-primary fs-7 fw-bold">Impreso</span>';
                    break;
                case 'I':
                    $estado = "I";
                    $estadoAct = '<span class="badge badge-danger fs-7 fw-bold">Inactiva</span>';
                    break;
                default:
                $estado = "";
                    $estadoAct = '<span class="badge badge-secondary fs-7 fw-bold"></span>';
                    break;
            }

            $array["IdOrden"]          = $key["IdOrden"];
            $array["FechaOrden"]       = $key["FechaOrden"];
            $array["DescripcionOrden"] = $key["DescripcionOrden"];
            $array["FechaCrea"]        = date_format(new DateTime($key["FechaCrea"]), "Y-m-d H:i:s");
            $array["estadoAct"]        = $estadoAct;
            $array["estado"]        = $estado;
            $array["Nombre"]           = $key["Nombre"];
            $array["NombreArea"]       = $key["NombreArea"];
            $datos[]                   = $array;
        }

        $totalDatosObtenidos = $resultado->num_rows(); //cantidad total de registros
        $json_data           = array(
            "draw"            => intval($this->input->get_post('draw')),
            "recordsTotal"    => intval($totalDatosObtenidos),
            "recordsFiltered" => intval($totalDatos),
            "data"            => $datos,
        );

        echo json_encode($json_data);
    }

    public function imprimirRptOrdenes($fechainicio, $fechafin, $idarea)
    {
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "13");
        if ($permiso) {
            $data["enc"] = $this->Reportes_model->imprimirRptOrden($fechainicio, $fechafin, $idarea);
            $data["det"] = $this->Reportes_model->imprimirRptOrdenDet($fechainicio, $fechafin, $idarea);
            $this->load->view("header/bodyHeader");
            $this->load->view('Reportes/imprimirRptOrdenes', $data);
            $this->load->view("footer/bodyFooter");
        }
    }

    public function marcarImpreso($fechainicio, $fechaFin, $idarea){
        $this->Reportes_model->marcarImpreso($fechainicio, $fechaFin, $idarea);
    }
    //
}

/* End of file Reportes_controller.php */
