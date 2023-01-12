<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();   
        $this->load->model("Usuarios_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        } 
    }

    public function index()
    {
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "6");
        if($permiso){
            $this->load->view("header/bodyHeader");
            $this->load->view("menu/menu");
            $this->load->view('usuarios/usuarios');
            $this->load->view("footer/bodyFooter");	
            $this->load->view("jsview/usuarios/jsUsuarios");
        }else{
            
            redirect('Denegado','refresh');
            
        }	
    }

    public function perfil()
	{
        $this->load->library("modelonumero");
        //$data["prueba"] = $this->modelonumero->numtoletras("1555.50");
		//$data["roles"] = $this->Roles_model-> getRoles();
		$this->load->view("header/bodyHeader");
		$this->load->view("menu/menu_sol");
		$this->load->view('usuarios/perfil');
		$this->load->view("footer/bodyFooter");
		$this->load->view("jsview/usuarios/jsPerfil");
	}

    public function getUsuariosAjax(){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Usuarios_model->getUsuariosAjax($start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $estado = ""; 
        $datos = array();

        foreach ($resultado->result_array() as $key) {
            $array = array();
            switch($key["Estado"]){
                case "I":
                    $estado = '<span class="badge badge-danger fs-7 fw-bold">Inactivo</span>';	
                break;	
                case "A":
                    $estado = '<span class="badge badge-success fs-7 fw-bold">Activo</span>';	
                break;	
            }
            $array["Usuario"] = $key["NombreUsuario"];
            $array["Nombre"] = $key["Nombre"];
            $array["Area"] = $key["NombreArea"];
            $array["Telefono"] = $key["Telefono"];
            $array["Puesto"] = $key["Puesto"];
            $array["Estado"] = $estado;
            $array["FechaCrea"] = $key["FechaCrea"]; //iduser,user,nombre,puesto,correo
            if($key["Estado"] == "A"){
                $array["Opciones"] = "
                    <a href='javascript:void(0)' onclick='editar(".'"'.$key["IdUsuario"].'","'.$key["NombreUsuario"].'","'.$key["Nombre"].'"
                    ,"'.$key["Puesto"].'","'.$key["Telefono"].'","'.$key["Genero"].'","'.$key["IdArea"].'","'.$key["NombreArea"].'"'.")'
                      class='btn btn-icon btn-primary btn-sm btn-hover-rise me-5'>
                        <span class='svg-icon svg-icon-3'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                <path opacity='0.3' fill-rule='evenodd' clip-rule='evenodd' d='M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z' fill='black'/>
                                <path d='M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z' fill='black'/>
                                <path d='M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z' fill='black'/>
                            </svg>
                        </span>
                    </a>

                    <a href='javascript:void()' onclick='baja(".'"'.$key["IdUsuario"].'","'.$key["Estado"].'"'.")'
                     class='btn btn-icon btn-danger btn-sm btn-hover-rise me-5'>
                        <span class='svg-icon svg-icon-3'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                <path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black'/>
                                <path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black'/>
                                <path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black'/>
                            </svg>
                        </span>
                    </a>
                ";         
            }else{
                $array["Opciones"] = "
                    <a href='javascript:void()'  onclick='baja(".'"'.$key["IdUsuario"].'","'.$key["Estado"].'"'.")'
                     class='btn btn-icon btn-danger btn-sm btn-hover-rise me-5'>
                        <span class='svg-icon svg-icon-2'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                <path d='M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z' fill='black'/>
                                <path opacity='0.3' d='M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z' fill='black'/>
                            </svg>
                        </span>
                    </a>
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

    public function guardarUser(){
        $idArea = $this->input->get_post("idArea");
        $user = $this->input->get_post("user");
        $pass = $this->input->get_post("pass");
        $nombre = $this->input->get_post("nombre");
        $puesto = $this->input->get_post("puesto");
        $telefono = $this->input->get_post("telefono");
        $genero = $this->input->get_post("genero");
        $this->Usuarios_model->guardarUser($idArea,$user,$pass,$nombre,$puesto,$telefono,$genero);
    }

    public function actualizarUser(){
        $idUser = $this->input->get_post("idUser");
        $idArea = $this->input->get_post("idArea");
        $user = $this->input->get_post("user");
        $nombre = $this->input->get_post("nombre");
        $puesto = $this->input->get_post("puesto");
        $telefono = $this->input->get_post("telefono");
        $genero = $this->input->get_post("genero");
        $this->Usuarios_model->actualizarUser($idUser,$idArea,$user,$nombre,$puesto,$telefono,$genero);
    }

    public function bajaUser(){
        $estadoupd = "";
        $idUser = $this->input->get_post("iduser");
        $estado = $this->input->get_post("estado");
        if($estado == "A"){
            $estadoupd = "I";
        }else{
            $estadoupd = "A";
        }
        $this->Usuarios_model->bajaUser($idUser,$estadoupd); 
    }

    public function actualizarPass(){
        $pass = $this->input->get_post("pass");
        $newPass = $this->input->get_post("newPass");
        $this->Usuarios_model->actualizarPass(md5($pass),md5($newPass));
    }

    public function datosSolic(){
        $this->Usuarios_model->datosSolic();
    }

}

/* End of file Usuarios_controller.php */

?>