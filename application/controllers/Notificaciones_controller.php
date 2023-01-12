<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notificaciones_controller extends CI_Controller {

   
   public function __construct()
   {
       parent::__construct();
       $this->load->model("Notificaciones_model");
   }

   public function mostrarConectados(){
	$this->Notificaciones_model->mostrarConectados();
}
   
   public function mostrarMensajesSinLeer(){
	$this->Notificaciones_model->mostrarMensajesSinLeer();
   }

   /*****************Observaciones tareas*********************** */
   public function contadorIncidencias(){
	$this->Notificaciones_model->contadorIncidencias();  
}

public function incidenciaNueva(){
   $this->Notificaciones_model->incidenciaNueva();  
}

public function vistoIncidencias($IdIncidencia){
   $this->Notificaciones_model->vistoIncidencias($IdIncidencia);
}

public function atencionNueva(){
   //$this->Notificaciones_model->atencionNueva($estado);
   $this->Notificaciones_model->atencionNueva();
}

public function vistoTareas($Id){
   $this->Notificaciones_model->vistoTareas($Id);
}

public function tareasNotifList()      
{
   $this->Notificaciones_model->tareasNotifList();
}

public function incidenciasNotifList()
{
   $this->Notificaciones_model->incidenciasNotifList();
}

}

/* End of file Notificaciones_controller.php */

?>
