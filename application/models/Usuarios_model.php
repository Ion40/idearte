<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }

    //mostrar usuarios por server side en datatable
    public function getUsuariosAjax($start,$length,$search){
        $srch = ""; 
        if($search){
            $srch = "where (
                      t1.NombreUsuario like '%".$search."%' OR 
                      t1.Nombre like '%".$search."%' OR 
                      t3.NombreArea like '%".$search."%' OR 
                      t1.Puesto like '%".$search."%' OR 
                      t1.Telefono like '%".$search."%' 
                    ) ";
        }

        $qnr = "select count(1) as Cantidad from
                (select t1.* from Usuarios t1
                inner join Areas t3 on t1.IdArea= t3.IdArea 
                ".$srch." ) 
                as tabla";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if($length == -1){
			$q = $this->db->query("SELECT t1.*,t3.NombreArea
                                    from Usuarios t1
                                    inner join Areas t3 on t1.IdArea= t3.IdArea 
                                    ".$srch." 
                                    ORDER BY t1.IdUsuario desc");
		}else{
			$q = $this->db->query("SELECT t1.*,t3.NombreArea
                                    from Usuarios t1
                                    inner join Areas t3 on t1.IdArea= t3.IdArea 
                                    ".$srch." 
                                    ORDER BY t1.IdUsuario desc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

    public function guardarUser($idArea,$user,$pass,$nombre,$puesto,$telefono,$genero){
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "6");
            if($permiso){
                $idUser = $this->db->query("SELECT ISNULL(MAX(IdUsuario),0)+1 as IdUsuario FROM Usuarios");
                $data = array(
                    "IdUsuario" => $idUser->result_array()[0]["IdUsuario"],
                    "IdArea" => $idArea,
                    "NombreUsuario" => $user,
                    "Password" => md5($pass),
                    "Nombre" => $nombre,
                    "Puesto" => $puesto,
                    "Telefono" => $telefono,
                    "Genero" => $genero,
                    "Estado" => "A",
                    "Conectado" => FALSE,
                    "FechaCrea" => date("Y-m-d H:i:s")
                );

                $save = $this->db->insert("Usuarios", $data);

                if($save){
                $mensaje[0]["mensaje"] = "Datos almacenados con éxito";
                $mensaje[0]["tipo"] = "success";
                echo json_encode($mensaje);
                }else{
                    $mensaje[0]["mensaje"] = "Error al insertar los datos. Póngase en contácto con el administrador";
                    $mensaje[0]["tipo"] = "error";
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

    public function actualizarUser($idUser,$idArea,$user,$nombre,$puesto,$telefono,$genero){
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "7");
            if($permiso){
                $this->db->where("IdUsuario", $idUser);
                $data = array(
                    "IdArea" => $idArea,
                    "NombreUsuario" => $user,
                    "Nombre" => $nombre,
                    "Puesto" => $puesto,
                    "Telefono" => $telefono,
                    "Genero" => $genero,
                    "FechaActualiza" => date("Y-m-d H:i:s")
                );
    
                $save = $this->db->update("Usuarios", $data);
    
                if($save){
                    $mensaje[0]["mensaje"] = "Datos actualizados con éxito";
                    $mensaje[0]["tipo"] = "success";
                    echo json_encode($mensaje);
                }else{
                    $mensaje[0]["mensaje"] = "Error al actualizar los datos. Póngase en contácto con el administrador";
                    $mensaje[0]["tipo"] = "error";
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

    public function bajaUser($idUser,$estado){
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "7");
            if($permiso){
                $this->db->where("IdUsuario", $idUser);
                $data = array(
                    "Estado" => $estado,
                    "FechaBaja" => date("Y-m-d H:i:s")
                );
    
                $save = $this->db->update("Usuarios", $data);
    
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

    public function actualizarPass($pass,$newPass){
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $confirmPass = $this->db->query("select Password from Usuarios 
                                            where IdUsuario = '".$this->session->userdata("id")."'
                                            and Password = '".$pass."' "); 

            if($confirmPass->num_rows() > 0){
                $this->db->where("IdUsuario", $this->session->userdata("id"));
                $data = array(
                    "Password" => $newPass,
                );
    
                $save = $this->db->update("Usuarios", $data);
    
                if($save){
                    $mensaje[0]["mensaje"] = "Datos actualizados con éxito";
                    $mensaje[0]["tipo"] = "success";
                    echo json_encode($mensaje);
                }
            }else{
                $mensaje[0]["mensaje"] = "La contraseña que intenta modificar no existe. Verifique que esté escrita correctamente";
                $mensaje[0]["tipo"] = "warning";
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

/* End of file Usuarios_model.php */

?>