<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tareas_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Tareas_model");
    }

    public function index()
    {
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "14");
        if ($permiso) {
            $this->load->view("header/bodyHeader");
            $this->load->view("jsview/tareas/imageuploadifycss");
            $this->load->view("menu/menu");
            $this->load->view('tareas/tareas');
            $this->load->view("footer/bodyFooter");
            $this->load->view("jsview/tareas/imageuploadify");
            $this->load->view("jsview/tareas/jstareas");
        } else {
            redirect('Denegado');
        }
    }

    public function guardarTarea()
    {
        $tarea     = $this->input->get_post("nombre");
        $cantidad  = $this->input->get_post("cantidad");
        $desc      = $this->input->get_post("descripcion");
        $orden     = $this->input->get_post("numOrden");
        $prioridad = $this->input->get_post("prioridad");
        $idArea    = $this->input->get_post("idArea");
        $fecha     = $this->input->get_post("fecha");
        $fechareal = $this->input->get_post("fechareal");
        //$imagen    = $this->input->get_post("imagen");
        $cliente = $this->input->get_post("cliente");
        $this->Tareas_model->guardarTarea($tarea, $cantidad, $desc, $orden, $prioridad, $idArea, $fecha, $fechareal, $cliente);
        //$imagen,
    }

    public function actualizarTarea()
    {
        $idTarea   = $this->input->get_post("idTarea");
        $tarea     = $this->input->get_post("nombre");
        $cantidad  = $this->input->get_post("cantidad");
        $desc      = $this->input->get_post("descripcion");
        $orden     = $this->input->get_post("numOrden");
        $prioridad = $this->input->get_post("prioridad");
        $idArea    = $this->input->get_post("idArea");
        $fecha     = $this->input->get_post("fecha");
        $fechareal = $this->input->get_post("fechareal");
        $imagen    = $this->input->get_post("imagen");
        $cliente   = $this->input->get_post("cliente");
        $this->Tareas_model->actualizarTarea($idTarea, $tarea, $cantidad, $desc, $orden, $prioridad, $idArea, $fecha, $fechareal, $imagen, $cliente);
    }

    public function getTareasAjax()
    {
        $start  = $this->input->get_post('start');
        $length = $this->input->get_post('length');
        $search = $this->input->get_post('search')['value'];

        $result     = $this->Tareas_model->getTareasAjax($start, $length, $search);
        $resultado  = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $estadoAct = "";
        $prioridad = ""; //anulada o activa

        $datos = array();

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

            $fechareal               = ($key["FechaRealEntrega"] != "") ? date_format(new DateTime($key["FechaRealEntrega"]), "Y-m-d") : "";
            $array["NoOrdenTrabajo"] = $key["NoOrdenTrabajo"];
            $array["NombreArea"]     = $key["NombreArea"];
            $array["Nombre"]         = $key["Nombre"];
            $array["Cantidad"]       = $key["Cantidad"];
            $array["Descripcion"]    = $key["Descripcion"];
            $array["Prioridad"]      = $prioridad;
            $array["Estado"]         = $estadoAct;
            $array["FechaCrea"]      = date_format(new DateTime($key["FechaCrea"]), "Y-m-d H:i:s");
            if ($key["EstadoTarea"] != "I") {
                $array["Opciones"] = "
                <div class='text-center'>
                <a href='javascript:void(0)' onclick='editTareas(" . '"' . $key["Id"] . '","' . $key["NoOrdenTrabajo"] . '","' . $key["Fecha"] . '","' . $fechareal . '","' . str_replace("\n", "\\n", $key["Nombre"]) . '","' . $key["Cantidad"] . '","' . str_replace("\n", "\\n", $key["Descripcion"]) . '","' . $key["Prioridad"] . '","' . $key["IdArea"] . '","' . $key["NombreArea"] . '","' . $key["ContactoCliente"] . '"' . ")' class='btn btn-icon btn-primary btn-sm btn-hover-rise me-5'>
                        <span class='svg-icon svg-icon-3'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                <path opacity='0.3' fill-rule='evenodd' clip-rule='evenodd' d='M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z' fill='black'/>
                                <path d='M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z' fill='black'/>
                                <path d='M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z' fill='black'/>
                            </svg>
                        </span>
                    </a>

                    <a href='javascript:void()' onclick='anularTarea(" . '"' . $key["Id"] . '"' . ")' class='btn btn-icon btn-danger btn-sm btn-hover-rise me-5'>
                        <span class='svg-icon svg-icon-3'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                <path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black'/>
                                <path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black'/>
                                <path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black'/>
                            </svg>
                        </span>
                    </a>
                </a>
            </div>
                "; //IdOrden,idUsuarioSolicita,comentarioSolic,anula,estado,estadoau
            } else {
                $array["Opciones"] = "
                    <div class='text-center'>
                        <!--<a href='javascript:void(0)' class='btn btn-sm btn-hover-rise'>
                            <span class='svg-icon svg-icon-3'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                    <path d='M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z' fill='black'/>
                                    <path opacity='0.3' d='M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z' fill='black'/>
                                </svg>
                            </span>
                        </a>-->
                        <a href='javascript:void(0)' onclick='detTareas(" . '"' . $key["Id"] . '","' . $key["NoOrdenTrabajo"] . '","' . $key["Fecha"] . '","' . $key["FechaRealEntrega"] . '","' . str_replace("\n", "\\n", $key["Nombre"]) . '","' . $key["Cantidad"] . '","' . str_replace("\n", "\\n", $key["Descripcion"]) . '","' . $key["Prioridad"] . '","' . $key["IdArea"] . '","' . $key["NombreArea"] . '","' . $key["Imagen"] . '"' . ")' class='btn btn-sm btn-hover-rise'>
                            <i class='fas fa-search text-warning'></i>
                        </a>
                    </div>
                ";
            }
            //onclick='baja(".'"'.$key["IdArea"].'","'.$key["Estado"].'"'.")'
            $datos[] = $array;
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

    public function guardarMultiImagenes($numOrden, $idArea)
    {
        $this->Tareas_model->guardarMultiImagenes(
            $numOrden,
            $idArea,
            $this->input->post("datos")
        );
    }

    public function mostrarImagenes($idTarea)
    {
        $this->Tareas_model->mostrarImagenes($idTarea);
    }

    public function reprogramarAutoTareas()
    {
        $this->Tareas_model->reprogramarAutoTareas();
    }
}

/* End of file Tareas_controller.php */
