<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Autorizaciones_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }

    public function getModulosAjax($search){
        $qfilter = "";
        if(isset($search)){
            $qfilter = "AND Descripcion LIKE '%".$search."%' ";
        }else{
            $qfilter = "";
        }

        $query = $this->db->query("SELECT IdModuloAut, Descripcion FROM AutorizacionesModulos
                                    WHERE Estado = 'A' ".$qfilter." 
                                    ORDER BY IdModuloAut ASC ");
        $json = array();
        $i = 0;
        if($query->num_rows()>0){
            foreach ($query->result_array() as $key) {
                $json[$i]["IdModuloAut"] = $key["IdModuloAut"];
                $json[$i]["Descripcion"] = $key["Descripcion"];
                $i++;
            } 
            echo json_encode($json);
        }
    }

    //mostrar Autorizaciones por server side en datatable
    public function getAutorizacionesAjax($start,$length,$search){
        $srch = ""; 
        if($search){
            $srch = "where (
                      t1.IdAutorizacion like '%".$search."%' OR 
                      t3.Descripcion like '%".$search."%' OR 
                      t1.Modulo like '%".$search."%' OR 
                      t1.Descripcion like '%".$search."%' 
                    ) ";
        }

        $qnr = "select count(1) as Cantidad from
                (select t1.* from Autorizaciones t1
                inner join AutorizacionesModulos t3 on t1.IdModuloAut = t3.IdModuloAut 
                ".$srch." ) 
                as tabla";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if($length == -1){
			$q = $this->db->query("SELECT t1.*,t3.Descripcion as ModuloAut
                                    FROM Autorizaciones t1
                                    inner join AutorizacionesModulos t3 on t1.IdModuloAut = t3.IdModuloAut 
                                    ".$srch." 
                                    ORDER BY t1.IdAutorizacion desc");
		}else{
			$q = $this->db->query("SELECT t1.*,t3.Descripcion as ModuloAut
                                    FROM Autorizaciones t1
                                    inner join AutorizacionesModulos t3 on t1.IdModuloAut = t3.IdModuloAut 
                                    ".$srch." 
                                    ORDER BY t1.IdAutorizacion desc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

    public function guardarAut($idModulo,$modulo,$desc)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $idAut = $this->db->query("SELECT ISNULL(MAX(IdAutorizacion),0)+1 as IdAutorizacion FROM Autorizaciones");
            $data = array(
                "IdAutorizacion" => $idAut->result_array()[0]["IdAutorizacion"],
                "IdModuloAut" => $idModulo,
                "Modulo" => $modulo,
                "Descripcion" => $desc,
                "FechaCrea" => date("Y-m-d H:i:s") 
            );

            $save = $this->db->insert("Autorizaciones", $data);

            if($save){
                $mensaje[0]["mensaje"] = "Datos almacenados con éxito";
                $mensaje[0]["tipo"] = "success";
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
    
    public function getAutTreeView(){
		//$this->db->where("Estado",1);
		$this->db->order_by("IdModuloAut");
		$query = $this->db->get("cm_AutModulo");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return 0;
	}

    public function getUsuariosAjax($search){
        $qfilter = "";
        if(isset($search)){
            $qfilter = "AND NombreUsuario LIKE '%".$search."%' ";
        }else{
            $qfilter = "";
        }

        $query = $this->db->query("SELECT TOP 5 IdUsuario, NombreUsuario, Nombre FROM Usuarios
                                    WHERE Estado = 'A' ".$qfilter." 
                                    ORDER BY IdUsuario ASC ");
        $json = array();
        $i = 0;
        if($query->num_rows()>0){
            foreach ($query->result_array() as $key) {
                $json[$i]["IdUsuario"] = $key["IdUsuario"];
                $json[$i]["NombreUsuario"] = $key["Nombre"]." (".$key["NombreUsuario"].")";
                $i++;
            } 
            //echo $this->db->last_query();
            echo json_encode($json);
        }
       // echo $this->db->last_query();
    }

    public function getAutAsignados($idUsuario){
		$i = 0;
		$json = array();
		$query = $this->db->select("IdAutorizacion")
		       ->where("IdUsuario", $idUsuario)
		       ->get("AutorizacionesUsuario");
		if ($query->num_rows() > 0 ) {
			foreach ($query->result_array() as $key) {
		      $json[$i]["IdAutorizacion"] = $key["IdAutorizacion"];
		      $i++;  
		    }      
		} 
			echo json_encode($json);
	}
    
    public function asignarPermiso($iduser,$asig){
		$this->db->trans_begin();
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "5");
        if($permiso){
            $mensaje = array(); $bandera = false;
            $delete = $this->db->where("IdUsuario",$iduser)->delete("AutorizacionesUsuario");
            if($delete){
                for ($i=0; $i < count($asig); $i++) { 
                    $array = explode(",", $asig[$i]);
                    $data = array(
                        "IdUsuario" => $array[0],
                        "IdAutorizacion" => $array[1]
                    );
                    $save = $this->db->insert("AutorizacionesUsuario",$data);
                    if($save){
                        $bandera = true;
                    }
                }
                if($bandera){
                    $mensaje[0]["mensaje"] = "Autorizaciones asignadas con éxito";
                    $mensaje[0]["tipo"] = "success";
                    echo json_encode($mensaje);
                }
            }else{
                $mensaje[0]["mensaje"] = "Error durante el proceso de asignación COD:DEL";
                $mensaje[0]["tipo"] = "error";
                echo json_encode($mensaje);
            }
        }else{
            $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
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

    public function validarPermiso($idUsuario, $idPermiso){
		$query = $this->db->select("IdAutorizacion")
		       ->where("IdUsuario", $idUsuario)
		       ->where("IdAutorizacion", $idPermiso)
		       ->get("AutorizacionesUsuario");
		if($query->num_rows() > 0){
			return $query->result_array();
		}       
		return 0;
	}
}

/* End of file Autorizaciones_model.php */

?>