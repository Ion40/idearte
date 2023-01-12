<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mensajes_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Mensajes_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        } 
    }
    

    public function index()
    {
        $this->load->view("header/bodyHeader");
		$this->load->view("menu/menu");
		$this->load->view('mensajes/mensajes');
		$this->load->view("footer/bodyFooter");	
        $this->load->view("jsview/mensajes/jsmensajes");
    }

    public function userListChat(){
        $this->Mensajes_model->userListChat();
    }

    public function guardarMensaje(){
        $idEnvia = $this->input->get_post("idEnvia");
        $idRecive = $this->input->get_post("idRecive");
        $mensaje = $this->input->get_post("mensaje");
        $this->Mensajes_model->guardarMensaje($idEnvia,$idRecive,$mensaje);
    }

    public function mostrarMensajes($idUsuario){
        $this->Mensajes_model->mostrarMensajes($idUsuario);
    }

    public function mostrarMensajesSinLeer(){
        $this->Mensajes_model->mostrarMensajesSinLeer();
    }

    public function chatVisto($id){
        $this->Mensajes_model->visto($id);
    }


}

/* End of file Mensajes_controller.php */

?>