<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Areas_controller extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Areas_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        } 
    }

    public function index()
    {
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "8");
        if($permiso){
            $data["areas"] = $this->Areas_model->getAreas();
            $this->load->view("header/bodyHeader");
            $this->load->view("menu/menu");
            $this->load->view('areas/areas', $data);
            $this->load->view("footer/bodyFooter");	
            $this->load->view("jsview/areas/jsAreas");	   
        }else{
            redirect('Denegado');
        }
    }

    public function guardarArea()
    {
        $nombre = $this->input->get_post("area");
        $siglas = $this->input->get_post("siglas");
        $this->Areas_model->guardarArea($nombre,$siglas);
    }

    public function actualizarArea()
    {
        $idArea = $this->input->get_post("idarea");
        $nombre = $this->input->get_post("area");
        $siglas = $this->input->get_post("siglas");
        $this->Areas_model->actualizarArea($idArea,$nombre,$siglas);
    }

    public function actualizarEstadoArea(){
        $estadoupd = "";
        $idArea = $this->input->get_post("idArea");
        $estado = $this->input->get_post("estado");
        if($estado == "A"){
            $estadoupd = "I";
        }else{
            $estadoupd = "A";
        }
        $this->Areas_model->actualizarEstado($idArea,$estadoupd); 
    }

    public function getAreasAjax(){
        $var = $this->input->post("q"); 
        $this->Areas_model->getAreasAjax($var);
    }

}

/* End of file Areas_controller.php */

?>