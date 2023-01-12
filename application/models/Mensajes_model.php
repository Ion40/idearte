<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mensajes_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }

    public function userListChat(){
        $json = array(); $i = 0; $tiempo = "";
        $query = $this->db->query("select t0.*,DATEDIFF(SECOND, t0.FechaConectado, 
        getdate()) segundos,DATEDIFF(minute, t0.FechaConectado, getdate()) minutos,
        DATEDIFF(HOUR, t0.FechaConectado, getdate()) Horas,
        DATEDIFF(DAY, t0.FechaConectado, getdate()) Dias,
        t1.NombreArea from Usuarios t0
        inner join Areas t1 on t0.IdArea = t1.IdArea
        where IdUsuario <> '".$this->session->userdata("id")."'");

        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                if($key["segundos"] < 60){
                    $tiempo = $key["segundos"]." seg";
                }else if($key["segundos"] >= 60 && $key["minutos"] < 60){
                    $tiempo = $key["minutos"]." min";
                }else if($key["Horas"]<24){
                    $tiempo = $key["Horas"]." hrs";
                }else{
                    $tiempo = $key["Dias"]." dia(s)";
                }
                $json[$i]["IdUsuario"] = $key["IdUsuario"];
                $json[$i]["NombreUsuario"] = $key["NombreUsuario"];
                $json[$i]["Nombre"] = $key["Nombre"];        
                $json[$i]["Puesto"] = $key["Puesto"];
                $json[$i]["Genero"] = intval($key["Genero"]);     
                $json[$i]["NombreArea"] = $key["NombreArea"];
                $json[$i]["Conectado"] = intval($key["Conectado"]);
                if($key["Genero"] === 1){
                    $json[$i]["fotoUser"] = base_url()."assets/img/user2.png";
                }else{
                    $json[$i]["fotoUser"] = base_url()."assets/img/female.jpg";
                }
                   
                $json[$i]["TiempoActivo"] = $tiempo;
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function guardarMensaje($idEnvia,$idRecive,$chat)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $id = $this->db->query("SELECT ISNULL(MAX(Id),0)+1 as Id FROM Mensajes");
            $data = array(
                "Id" => $id->result_array()[0]["Id"],
                "IdUsuarioEnvia" => $idEnvia,
                "IdUsuarioRecibe" => $idRecive, 
                "Mensaje" => $chat,
                "FechaMensaje" => date("Y-m-d H:i:s"),
                "Visto" => false
            );

            $this->db->insert("Mensajes", $data);

        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage(). "... Código ".$ex->getCode();
            $mensaje[0]["tipo"] = "error";
            echo json_encode($mensaje);
        }

        if ($this->db->trans_status() === FALSE)
       {
               $this->db->trans_rollback();
       }
       else
       {
               $this->db->trans_commit();
       }
    }

    public function mostrarMensajes($idUsuario){
        $json = array(); $i = 0; $mensaje = ""; $justify=""; $aling="";
        $query = $this->db->query("select top 200 t0.*,t1.Nombre,t1.Genero from Mensajes t0
        inner join Usuarios t1 on t1.IdUsuario = t0.IdUsuarioEnvia
        where (t0.IdUsuarioEnvia = ".$this->session->userdata("id")." and t0.IdUsuarioRecibe = '".$idUsuario."' 
        or
        t0.IdUsuarioEnvia = '".$idUsuario."' and t0.IdUsuarioRecibe = '".$this->session->userdata("id")."')
        ORDER BY Id ASC");
        

        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                if($key["Genero"] === 1){
                    $json[$i]["fotoUser"] = base_url()."assets/img/user2.png";
                }else{
                    $json[$i]["fotoUser"] = base_url()."assets/img/female.jpg";
                }
                if($key["IdUsuarioEnvia"] === $this->session->userdata("id")){
                    $json[$i]["Nombre"] = "Tú";
                     $mensaje = "bg-light-success text-end";
                     $justify = "justify-content-end";
                     $aling = "align-items-end";
                }else{
                    $json[$i]["Nombre"] = $key["Nombre"];
                    $mensaje = "bg-light-info text-start";
                    $justify = "justify-content-start";
                    $aling = "align-items-start";
                }
                $json[$i]["Id"] = $key["Id"];
                $json[$i]["Mensaje"] = $key["Mensaje"];
                $json[$i]["FechaMensaje"] = date_format(new DateTime($key["FechaMensaje"]), "d-m-Y H:i");
                $json[$i]["clase"] = $mensaje;
                $json[$i]["justify"] = $justify;
                $json[$i]["aling"] = $aling;
                //$json[$i]["TiempoActivo"] = $tiempo;
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function mostrarMensajesSinLeer(){
        $json = array(); $i = 0;
        $query = $this->db->query("select COUNT(1) as cantidad,IdUsuarioEnvia from mensajes
                                    where IdUsuarioEnvia <> ".$this->session->userdata("id")."
                                    and IdUsuarioRecibe = ".$this->session->userdata("id")."
                                    and Visto = 0
                                    group by IdUsuarioEnvia");
        foreach ($query->result_array() as $key) {
            $json[$i]["cantidad"]= $key["cantidad"];
            $json[$i]["IdUsuarioEnvia"]= $key["IdUsuarioEnvia"];
            $i++;
        }                            
        echo json_encode($json);  
    }

    public function visto($id)
    {
        $this->db->where("Id", $id);
        $this->db->where("IdUsuarioRecibe", $this->session->userdata("id"));
        $data = array(
            "Visto" => 1
        );
        $this->db->update("Mensajes",$data);
    }
}

/* End of file Mensajes_model.php */

?>