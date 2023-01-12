<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Areas_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }
    
    public function getAreas()
    {     
        $query = $this->db->get("Areas");
            if($query->num_rows()> 0){
                return $query->result_array();
            }  
    }

    public function getAreasAjax($search){
        $qfilter = "";
        if(isset($search)){
            $qfilter = "AND NombreArea LIKE '%".$search."%' ";
        }else{
            $qfilter = "";
        }

        $query = $this->db->query("SELECT  IdArea, NombreArea, Siglas FROM Areas
                                    WHERE Estado = 'A' ".$qfilter." 
                                    ORDER BY IdArea ASC ");
        $json = array();
        $i = 0;
        if($query->num_rows()>0){
            foreach ($query->result_array() as $key) {
                $json[$i]["IdArea"] = $key["IdArea"];
                $json[$i]["NombreArea"] = $key["NombreArea"];
                $json[$i]["Siglas"] = $key["Siglas"];
                $i++;
            } 
            //echo $this->db->last_query();
            echo json_encode($json);
        }
       // echo $this->db->last_query();
    }

    public function guardarArea($nombre,$siglas)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "8");
            if($permiso){
                $idArea = $this->db->query("SELECT ISNULL(MAX(IdArea),0)+1 as IdArea FROM Areas");
                $data = array(
                    "IdArea" => $idArea->result_array()[0]["IdArea"],
                    "NombreArea" => $nombre,
                    "Siglas" => $siglas,
                    "Estado" => "A",
                    "FechaCrea" => date("Y-m-d H:i:s") 
                );
    
                $save = $this->db->insert("Areas", $data);
    
                if($save){
                    $mensaje[0]["mensaje"] = "Datos almacenados con éxito";
                    $mensaje[0]["tipo"] = "success";
                    echo json_encode($mensaje);
                }
            }else{
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"] = "error";
                echo json_encode($mensaje);
            }
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

    public function actualizarArea($idArea,$nombre,$siglas)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "9");
            if($permiso){
                $this->db->where("IdArea", $idArea);
                $data = array(
                    "NombreArea" => $nombre,
                    "Siglas" => $siglas,
                    "FechaActualiza" => date("Y-m-d H:i:s") 
                );
    
                $save = $this->db->update("Areas", $data);
    
                if($save){
                    $mensaje[0]["mensaje"] = "Datos actualizados con éxito";
                    $mensaje[0]["tipo"] = "success";
                    echo json_encode($mensaje);
                }
            }else{
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"] = "error";
                echo json_encode($mensaje);
            }
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

    public function actualizarEstado($idArea,$estado)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "9");
            if($permiso){
                $this->db->where("IdArea", $idArea);
                $data = array(
                    "Estado" => $estado,
                    "FechaBaja" => date("Y-m-d H:i:s")
                );
    
                $save = $this->db->update("Areas", $data);
    
                if($save){
                    $mensaje[0]["mensaje"] = "Datos actualizados con éxito";
                    $mensaje[0]["tipo"] = "success";
                    echo json_encode($mensaje);
                }
            }else{
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"] = "error";
                echo json_encode($mensaje);
            }
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

}

/* End of file Areas_model.php */
?>