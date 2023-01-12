<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordencompra_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }
    

    public function guardarOrden($enc, $detalle)
    {
        $this->db->trans_begin();
		$mensaje = array();
        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "10");
            if($permiso){
                $idSolicitud = $this->db->query("SELECT ISNULL(MAX(IdOrden),0)+1 as IdOrden FROM OrdenesCompra");
                $encabezado = array(
                    "IdOrden" => $idSolicitud->result_array()[0]["IdOrden"],
                    "IdUsuarioOrden" => $this->session->userdata("id"),
                    "IdArea" => $enc[0],
                    "FechaOrden" => date("Y-m-d"),
                    //"DescripcionOrden" => $enc[1],
                    "Estado" => "A",
                    "FechaCrea" => date("Y-m-d H:i:s")
                );
                $guardarEnc = $this->db->insert("OrdenesCompra", $encabezado);
                if($guardarEnc){
                    $bandera = true;
                }else{
                    $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-1(ENC)";
                    $mensaje[0]["tipo"] = "error";
                    echo json_encode($mensaje);
                }
    
                if($bandera){
                        $bandera1 = false;
                        $idEnc = $idSolicitud->result_array()[0]["IdOrden"];
                        $det = json_decode($detalle, true);
                        foreach ($det as $obj) {
                            $idDet = $this->db->query("SELECT ISNULL(MAX(IdDetalleOrden),0)+1 AS IdDetalleOrden FROM DetalleOrdenCompra");
                            $insertDet = array(
                                "IdDetalleOrden" => $idDet->result_array()[0]["IdDetalleOrden"],
                                "IdOrden" => $idEnc,
                                "Cantidad" => $obj[0],
                                "Articulo" => $obj[1],
                                "DescripcionArticulo" => $obj[2],
                                "Estado" => "A",
                            );
                            $guardarDet = $this->db->insert("DetalleOrdenCompra", $insertDet);
                            if ($guardarDet) {
                                $bandera1 = true;
                            }
                        }
    
                        if ($bandera1) {
                            $mensaje[0]["mensaje"] = "Orden Compra generada con éxito.";
                            $mensaje[0]["tipo"] = "success";
                            echo json_encode($mensaje);
                        } else {
                            $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                            $mensaje[0]["tipo"] = "error";
                            echo json_encode($mensaje);
                        }
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

        if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
        }else{
                $this->db->trans_commit();
        }
    }

    public function getOrdenesAjax($start,$length,$search){
        $srch = ""; 
        if($search){
            $srch = "AND (
                      FechaOrden like '%".$search."%' 
                    ) "; //OR DescripcionOrden like '%".$search."%'
        }

        $qnr = "select count(1) as Cantidad from OrdenesCompra where IdUsuarioOrden = '".$this->session->userdata("id")."'  ".$srch." ";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if($length == -1){
			$q = $this->db->query("select * from OrdenesCompra where IdUsuarioOrden = '".$this->session->userdata("id")."'  ".$srch." ORDER BY IdOrden desc");
		}else{
			$q = $this->db->query("select * from OrdenesCompra where IdUsuarioOrden = '".$this->session->userdata("id")."'  ".$srch."
                                    ORDER BY IdOrden desc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

     //mostrar detalle de articulos segun id orden de compra
     public function getOrdenesDetAjax($IdOrden,$start,$length,$search){
        $srch = ""; 
        if($search){
            $srch = "AND (
                      Cantidad like '%".$search."%' OR 
                      Articulo like '%".$search."%' OR
                      DescripcionArticulo like '%".$search."%'
                    ) ";
        }

        $qnr = "select count(1) as Cantidad from DetalleOrdenCompra where 
                IdOrden = '".$IdOrden."' ".$srch." ";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if($length == -1){
			$q = $this->db->query("select * from DetalleOrdenCompra where  IdOrden = '".$IdOrden."' ".$srch." ORDER BY IdDetalleOrden asc");
		}else{
			$q = $this->db->query("select * from DetalleOrdenCompra where IdOrden = '".$IdOrden."' ".$srch."
                                    ORDER BY IdDetalleOrden asc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

    public function editOrdenAjax($idOrden){
        $json = array(); $i = 0;
        $jsondet = array(); $idet = 0;
        $encabezado = $this->db->query("SELECT t0.IdOrden,t0.IdArea,t0.IdUsuarioOrden,t0.FechaOrden,t0.DescripcionOrden
                                        ,t0.FechaCrea,t1.NombreArea FROM OrdenesCompra t0 
                                        INNER JOIN Areas t1 on t0.IdArea = t1.IdArea
                                        WHERE t0.IdOrden = '".$idOrden."' ");

        $detalle = $this->db->query("SELECT IdDetalleOrden,IdOrden,Cantidad,Articulo,DescripcionArticulo 
                                    FROM DetalleOrdenCompra WHERE IdOrden = '".$idOrden."' ");

        if($encabezado->num_rows()>0){
            foreach ($encabezado->result_array() as $key) {
                $json[$i]["IdOrden"] = $key["IdOrden"];
                $json[$i]["IdArea"] = $key["IdArea"];
                $json[$i]["IdUsuarioOrden"] = $key["IdUsuarioOrden"];
                $json[$i]["NombreArea"] = $key["NombreArea"];
                $json[$i]["FechaOrden"] = $key["FechaOrden"];
                $json[$i]["DescripcionOrden"] = $key["DescripcionOrden"];
                $json[$i]["FechaCrea"] = $key["FechaCrea"];
                $i++;
            }
            if($detalle->num_rows()>0){
                foreach ($detalle->result_array() as $key) {
                    $jsondet[$idet]["IdDetalleOrden"] = $key["IdDetalleOrden"];
                    $jsondet[$idet]["IdOrden"] = $key["IdOrden"];
                    $jsondet[$idet]["Cantidad"] = $key["Cantidad"];
                    $jsondet[$idet]["Articulo"] = $key["Articulo"];
                    $jsondet[$idet]["DescripcionArticulo"] = $key["DescripcionArticulo"];
                    $idet++;
                }
            }
        }

        $return = array(
            "enc" => $json,
            "det" => $jsondet
        );

        echo json_encode($return);
    }

    public function actualizarOrden($idSolicitud,$detalle){
        $this->db->trans_begin();
        $mensaje = array();
        /*if(date("H") >= 17){
            $mensaje[0]["mensaje"] = "No se permite modificar solicitudes despues de la 5:00 P.M.";
            $mensaje[0]["tipo"] = "error";
            echo json_encode($mensaje);
        }else{
            
        }*/
        try{
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "11");
            if($permiso){
                $delete = $this->db->where("IdOrden",$idSolicitud[0])->delete("DetalleOrdenCompra");   
                if($delete){
                    $bandera1 = false;
                    $det = json_decode($detalle, true);
                    $this->db->where("IdOrden",$idSolicitud[0]);
                    $update = array(
                        "FechaActualiza" => date("Y-m-d H:i:s")
                    );//"DescripcionOrden" => $idSolicitud[1],
                    $this->db->update("OrdenesCompra", $update);
                }
                foreach ($det as $obj) {
                    $idDet = $this->db->query("SELECT ISNULL(MAX(IdDetalleOrden),0)+1 AS IdDetalleOrden FROM DetalleOrdenCompra");
                    $insertDet = array(
                        "IdDetalleOrden" => $idDet->result_array()[0]["IdDetalleOrden"],
                        "IdOrden" => $idSolicitud[0],
                        "Cantidad" => $obj[0],
                        "Articulo" => $obj[1],
                        "DescripcionArticulo" => $obj[2],
                        "Estado" => "A",
                    );
                    $guardarDet = $this->db->insert("DetalleOrdenCompra", $insertDet);
                    if ($guardarDet) {
                        $bandera1 = true;
                    }
                }
                if($bandera1){
                    $mensaje[0]["mensaje"] = "Datos de orden actualizados con éxito";
                    $mensaje[0]["tipo"] = "success";
                    echo json_encode($mensaje);
                }   
            }else{
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"] = "error";
                echo json_encode($mensaje);
            }

        }catch (Exception $ex) {
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

    public function bajaOrden($idSolicitud){
        $this->db->trans_begin();
        $mensaje = array();
        $bandera = false;
        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "11");
            if($permiso){
                $this->db->where("IdOrden", $idSolicitud);
                $data = array(
                    "Estado" => "I",
                    "FechaBaja" => date("Y-m-d H:i:s")
                );
                $baja = $this->db->update("OrdenesCompra",$data);

                if($baja){
                    $this->db->where("IdOrden", $idSolicitud);
                    $dataDet = array(
                        "Estado" => "I"
                    );
                    $bajaDet = $this->db->update("DetalleOrdenCompra",$dataDet);
                    if($bajaDet){
                        $bandera = true;
                    }
                }
                if ($bandera) {
                    $mensaje[0]["mensaje"] = "Orden de compra anulada con éxito";
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

/* End of file Ordencompra_model.php */

?>