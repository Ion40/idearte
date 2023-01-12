<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ordencompra_controller extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Ordencompra_model");
    }
    

    public function index(){
        $this->load->view("header/bodyHeader");
        $this->load->view("menu/menu");
		$this->load->view('ordenescompra/ordenescompra');
		$this->load->view("footer/bodyFooter");	
        $this->load->view("jsview/ordenescompra/jsordenescompra");	   
    }

    public function nuevaOrden(){
        $this->load->view("header/bodyHeader");
        $this->load->view("menu/menu");
		$this->load->view('ordenescompra/nuevaOrden');
		$this->load->view("footer/bodyFooter");	
        $this->load->view("jsview/ordenescompra/jsnuevaOrden");	   
    }

    public function editOrden()
    {
        $this->load->view("header/bodyHeader");
		$this->load->view("menu/menu");
		$this->load->view('ordenescompra/editOrden');
		$this->load->view("footer/bodyFooter");
        $this->load->view("jsview/ordenescompra/jsEditOrden");
    }

    public function guardarOrden(){
        $this->Ordencompra_model->guardarOrden(
            $this->input->post("encabezado"),
            $this->input->post("detalles")
        );
    }

    public function getOrdenesAjax(){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Ordencompra_model->getOrdenesAjax($start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $estadoAct = ""; //anulada o activa

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            $array = array();
            switch($key["Estado"]){
                case 'A':
                    $estadoAct = '<span class="badge badge-success fs-7 fw-bold">Activa</span>';	
                    break;
                case 'I':
                    $estadoAct = '<span class="badge badge-danger fs-7 fw-bold">Inactiva</span>';	
                    break;
                default:
                    $estadoAct = '<span class="badge badge-secondary fs-7 fw-bold"></span>';	
                    break;
            }

            $array["IdOrden"] = $key["IdOrden"];
            $array["FechaOrden"] = $key["FechaOrden"];
            $array["DescripcionOrden"] = $key["DescripcionOrden"];
            $array["FechaCrea"] = date_format(new DateTime($key["FechaCrea"]), "Y-m-d H:i:s");
            $array["estadoAct"] = $estadoAct;

             if($key["Estado"] == "A"){
                $array["Opciones"] = "
                <div class='text-center'>
                <a href='javascript:void(0)' onclick='detalles(".'"'.$key["IdOrden"].'"'.")' class='btn btn-sm btn-hover-rise'>
                    <!--<span class='svg-icon svg-icon-3'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                            <path d='M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z' fill='black'/>
                            <path opacity='0.3' d='M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z' fill='black'/>
                        </svg>
                    </span>-->
                    <i class='fas fa-search text-warning'></i>
                </a>

                <a class='btn btn-sm btn-hover-rise' href='".base_url("index.php/editOrden/".$key["IdOrden"]."")."'>
                    <i class='fas fa-edit text-primary'></i>
                </a>

                <a href='javascript:void(0)' onclick='bajaOrden(".'"'.$key["IdOrden"].'"'.")' class='btn btn-icon btn-sm btn-hover-rise'>
                    <!--<span class='svg-icon svg-icon-3'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                            <path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black'/>
                            <path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black'/>
                            <path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black'/>
                        </svg>
                    </span>-->
                    <i class='fas fa-trash text-danger'></i>
                </a>
            </div>
                ";       //IdOrden,idUsuarioSolicita,comentarioSolic,anula,estado,estadoau   
            }else{
                $array["Opciones"] = "
                    <div class='text-center'>
                        <!--<a href='javascript:void(0)' onclick='detalles(".'"'.$key["IdOrden"].'"'.")' class='btn btn-sm btn-hover-rise'>
                            <span class='svg-icon svg-icon-3'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                    <path d='M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z' fill='black'/>
                                    <path opacity='0.3' d='M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z' fill='black'/>
                                </svg>
                            </span>
                        </a>-->
                        <a href='javascript:void(0)' onclick='detalles(".'"'.$key["IdOrden"].'"'.")' class='btn btn-sm btn-hover-rise'>
                            <i class='fas fa-search text-warning'></i>
                        </a>
                    </div>
                ";         
            }
            //onclick='baja(".'"'.$key["IdArea"].'","'.$key["Estado"].'"'.")'
            $datos[] = $array;
        }

        $totalDatosObtenidos = $resultado->num_rows(); //cantidad total de registros
        $json_data = array(
            "draw" => intval($this->input->get_post('draw')),
			"recordsTotal" => intval($totalDatosObtenidos),
			"recordsFiltered" => intval($totalDatos),
			"data" => $datos
        );

        echo json_encode($json_data);
    }

    public function getOrdenesDetAjax($IdOrden){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Ordencompra_model->getOrdenesDetAjax($IdOrden,$start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $estadoAut = ""; //autorizada o rechazada

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            $array = array();
          
            $array["IdDetalleOrden"] = $key["IdDetalleOrden"];
            $array["IdOrden"] = $key["IdOrden"];
            $array["Cantidad"] = $key["Cantidad"];
            $array["Articulo"] = $key["Articulo"];
            $array["DescripcionArticulo"] = $key["DescripcionArticulo"];
            //onclick='baja(".'"'.$key["IdArea"].'","'.$key["Estado"].'"'.")'
            $datos[] = $array;
        }

        $totalDatosObtenidos = $resultado->num_rows(); //cantidad total de registros
        $json_data = array(
            "draw" => intval($this->input->get_post('draw')),
			"recordsTotal" => intval($totalDatosObtenidos),
			"recordsFiltered" => intval($totalDatos),
			"data" => $datos
        );

        echo json_encode($json_data);
    }

    public function editOrdenAjax($idOrden){
        $this->Ordencompra_model->editOrdenAjax($idOrden);
    }

    public function actualizarOrden(){
        $this->Ordencompra_model->actualizarOrden(
            $this->input->post("encabezado"),
            $this->input->post("detalles")
        );
    }

    public function bajaOrden(){
        $idOrden = $this->input->get_post("idOrden");
        $this->Ordencompra_model->bajaOrden($idOrden);
    }
}

/* End of file Ordencompra_controller.php */

?>