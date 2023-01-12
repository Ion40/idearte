<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }
    
    public function login($name,$pass){
        if ($name != FALSE && $pass != FALSE) {

            $query = $this->db->query("SELECT t1.*,t2.IdArea,t2.NombreArea
                                        FROM Usuarios t1 
                                        INNER JOIN Areas t2 ON t1.IdArea= t2.IdArea
                                       WHERE t1.Estado = 'A' AND t1.NombreUsuario = '".$name."' AND t1.Password = '".$pass."' ");
            if ($query->num_rows() == 1) {
                return $query->result_array();
            }    
            return 0;
        }
    }
    
    public function conectadoLogin($idusuario,$activo){
        $this->db->where("IdUsuario",$idusuario);
        $data = array(
            "Conectado" => $activo,
            "FechaConectado" => date("Y-m-d H:i:s") 
        );
        $this->db->update("Usuarios", $data);
    }

}

/* End of file Login_model.php */

?>