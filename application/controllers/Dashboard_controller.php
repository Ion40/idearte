<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Dashboard_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        }
    }

    public function index()
    {
        $data["areas"] = $this->Dashboard_model->getAreasTabs();
        $this->load->view("header/bodyHeader");
        $this->load->view("jsview/tareas/imageuploadifycss");
        $this->load->view("menu/menu");
        $this->load->view('dashboard/dashboard', $data);
        $this->load->view("footer/bodyFooter");
        $this->load->view("jsview/tareas/imageuploadify");
        $this->load->view("jsview/dashboard/jsdashboard");
    }

    public function mostrarTaskSemana($idArea, $num)
    {
        $this->Dashboard_model->mostrarTaskSemana($idArea, $num);
    }

    public function reprogramarTarea()
    {
        $idtarea   = $this->input->get_post("idtarea");
        $tarea     = $this->input->get_post("nombre");
        $cantidad  = $this->input->get_post("cantidad");
        $desc      = $this->input->get_post("descripcion");
        $orden     = $this->input->get_post("numOrden");
        $prioridad = $this->input->get_post("prioridad");
        $idArea    = $this->input->get_post("idArea");
        $fecha     = $this->input->get_post("fecha");
        $fechareal = $this->input->get_post("fechareal");
        $cliente   = $this->input->get_post("cliente");
        $this->Dashboard_model->reprogramarTarea($idtarea, $tarea, $cantidad, $desc, $orden, $prioridad, $idArea, $fecha, $fechareal, $cliente);
    }

    public function enEsperaTarea()
    {
        $idTarea          = $this->input->get_post("idTarea");
        $comentarioEspera = $this->input->get_post("comentarioEspera");
        $this->Dashboard_model->enEsperaTarea($idTarea, $comentarioEspera);
    }

    public function atenderSolicitud()
    {
        $idTarea = $this->input->get_post("idTarea");
        $idArea  = $this->input->get_post("idArea");
        $this->Dashboard_model->atenderSolicitud($idTarea, $idArea);
    }

    public function cerrarTarea()
    {
        $idTarea = $this->input->get_post("idTarea");
        $this->Dashboard_model->cerrarTarea($idTarea);
    }

    public function anularTarea()
    {
        $idTarea = $this->input->get_post("idTarea");
        $this->Dashboard_model->anularTarea($idTarea);
    }

    public function agregarIncidencias()
    {
        $idTarea     = $this->input->get_post("idTarea");
        $Descripcion = $this->input->get_post("comentarioIncidencia");
        $this->Dashboard_model->agregarIncidencias($idTarea, $Descripcion);
    }

    public function mostrarIncidencias($idTarea)
    {
        $this->Dashboard_model->mostrarIncidencias($idTarea);
    }

    public function mostrarTaskSemanaTodos($idArea, $fecha, $num)
    {
        $this->Dashboard_model->mostrarTaskSemanaTodos($idArea, $fecha, $num);
    }

    public function mostrarComentEspera($idTarea)
    {
        $this->Dashboard_model->mostrarComentEspera($idTarea);
    }

    public function entregaMateriales()
    {
        $idTarea = $this->input->get_post("idTarea");
        $tipo    = $this->input->get_post("valorRadio");
        $nota    = $this->input->get_post("comentarioParcial");
        $this->Dashboard_model->entregaMateriales($idTarea, $tipo, $nota);
    }

}

/* End of file Dashboard_controller.php */
