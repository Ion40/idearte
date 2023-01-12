<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tareas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }

    public function guardarTarea($tarea, $cantidad, $desc, $orden, $prioridad, $idArea, $fecha, $fechareal, $cliente) //$imagen,

    {
        $this->db->trans_begin();
        $mensaje = array();
        $fechaReal = $fechareal . " " . date("H:i:s");
        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "14");
            if ($permiso) {
                if ($fecha < date("Y-m-d")) {
                    $mensaje[0]["mensaje"] = "No puedes crear una tarea con fecha anterior a la fecha actual";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                } else {
                    /*if($fechaReal != ""){
                        $fechaReal = $fechareal . " " . date("H:i:s");
                    }else{
                        $fechaReal = "";
                    }*/
                    $mismaOrden = $this->db->query("Select NoOrdenTrabajo from Tareas where NoOrdenTrabajo = '" . $orden . "' and IdArea = '" . $idArea . "' ");
                    if (@$mismaOrden->result_array()[0]["NoOrdenTrabajo"] == "") {
                        $idUser = $this->db->query("SELECT ISNULL(MAX(Id),0)+1 as Id FROM Tareas");
                        $data   = array(
                            "Id"               => $idUser->result_array()[0]["Id"],
                            "Nombre"           => $tarea,
                            "Cantidad"         => $cantidad,
                            "Descripcion"      => $desc,
                            "NoOrdenTrabajo"   => $orden,
                            "Prioridad"        => $prioridad,
                            "EstadoTarea"      => "A",
                            "IdArea"           => $idArea,
                            "Fecha"            => $fecha,
                            "FechaRealEntrega" => $fechaReal,
                            "IdUsuarioCrea"    => $this->session->userdata("id"),
                            "FechaCrea"        => date("Y-m-d H:i:s"),
                            //"Imagen"           => $imagen,
                            "Visto"            => 0,
                            "ContactoCliente"  => $cliente,
                        );

                        $save = $this->db->insert("Tareas", $data);

                        if ($save) {
                            $mensaje[0]["mensaje"] = "Datos almacenados con éxito";
                            $mensaje[0]["tipo"]    = "success";
                            echo json_encode($mensaje);
                        } else {
                            $mensaje[0]["mensaje"] = "Error al insertar los datos. Póngase en contácto con el administrador";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                        }
                    } else {
                        $mensaje[0]["mensaje"] = "Ya existe una tarea con el número de orden " . $orden . " para esta área";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }
                }
            } else {
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function getTareasAjax($start, $length, $search)
    {
        $srch = "";
        if ($search) {
            $srch = "where (
                      t0.Nombre like '%" . $search . "%' OR
                      t0.NoOrdenTrabajo like '%" . $search . "%' OR
                      t0.Cantidad like '%" . $search . "%' OR
                      t0.Descripcion like '%" . $search . "%' OR
                      t0.Fecha like '%" . $search . "%' OR
                      t1.NombreArea like '%" . $search . "%'
                    ) ";
        }

        $qnr = "select count(1) as Cantidad from Tareas t0
                inner join Areas t1 on t1.IdArea = t0.IdArea " . $srch . " ";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if ($length == -1) {
            $q = $this->db->query("select t0.*,t1.NombreArea from Tareas t0
                                   inner join Areas t1 on t1.IdArea = t0.IdArea
                                   " . $srch . "
                                   ORDER BY t0.Id desc");
        } else {
            $q = $this->db->query("select t0.*,t1.NombreArea from Tareas t0
                                    inner join Areas t1 on t1.IdArea = t0.IdArea
                                    " . $srch . "
                                    ORDER BY t0.Id desc
                                    offset " . $start . " rows fetch next " . $length . " rows only;");
        }

        $retornar = array(
            "numDataTotal" => $qnr,
            "datos"        => $q,
        );
        return $retornar;
    }

    public function actualizarTarea($idTarea, $tarea, $cantidad, $desc, $orden, $prioridad, $idArea, $fecha, $fechareal, $imagen, $cliente)
    {
        $this->db->trans_begin();
        $mensaje = array();
        $fechaReal = $fechareal . " " . date("H:i:s");
        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "23");
            if ($permiso) {
                /*if ($fecha < date("Y-m-d")) {
                $mensaje[0]["mensaje"] = "No puedes crear una tarea con fecha anterior a la fecha actual";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);*/
                // } else {
                //$mismaOrden = $this->db->query("Select NoOrdenTrabajo from Tareas where NoOrdenTrabajo = '".$orden."' and IdArea = '".$idArea."' ");
                //if(@$mismaOrden->result_array()[0]["NoOrdenTrabajo"] == ""){
                    /*if($fechaReal != ""){
                        $fechaReal = $fechareal . " " . date("H:i:s");
                    }else{
                        $fechaReal = "";
                    }*/
                $this->db->where("Id", $idTarea);
                $data = array(
                    "Nombre"           => $tarea,
                    "Cantidad"         => $cantidad,
                    "Descripcion"      => $desc,
                    "NoOrdenTrabajo"   => $orden,
                    "Prioridad"        => $prioridad,
                    "IdArea"           => $idArea,
                    "Fecha"            => $fecha,
                    "FechaRealEntrega" => $fechaReal,
                    "IdUsuarioEdita"   => $this->session->userdata("id"),
                    "FechaEdita"       => date("Y-m-d H:i:s"),
                    "Imagen"           => $imagen,
                    "ContactoCliente"  => $cliente,
                );

                $save = $this->db->update("Tareas", $data);

                if ($save) {
                    $mensaje[0]["mensaje"] = "Datos almacenados con éxito";
                    $mensaje[0]["tipo"]    = "success";
                    echo json_encode($mensaje);
                } else {
                    $mensaje[0]["mensaje"] = "Error al insertar los datos. Póngase en contácto con el administrador";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }
                /*}else{
                $mensaje[0]["mensaje"] = "Ya existe una tarea con el número de orden ".$orden." para esta área";
                $mensaje[0]["tipo"] = "error";
                echo json_encode($mensaje);
                }*/
                //}
            } else {
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function guardarMultiImagenes($numOrden, $idArea, $datos)
    {
        $this->db->trans_begin();
        $mensaje = array();
        $bandera = false;

        try {
            $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "14");
            if ($permiso) {
                $traerId = $this->db->query("select Id from Tareas where NoOrdenTrabajo = '" . $numOrden . "'
                    and IdArea = '" . $idArea . "' and EstadoTarea in ('A','P','E') ");
                $dat = json_decode($datos, true);

                //$delete =
                $this->db->where("IdTarea", $traerId->result_array()[0]["Id"])->delete("Imagenes");

                //if ($delete) {
                foreach ($dat as $obj) {
                    $idImagen = $this->db->query("SELECT ISNULL(MAX(IdImagen),0)+1 AS IdImagen FROM Imagenes");
                    $insert   = array(
                        "IdImagen"       => $idImagen->result_array()[0]["IdImagen"],
                        "IdTarea"        => $traerId->result_array()[0]["Id"],
                        "NoOrdenTrabajo" => $obj[0],
                        "Imagen"         => $obj[1],
                        "IdArea"         => $obj[2],
                        "FechaGuarda"    => date("Y-m-d H:i:s"),
                    );
                    $guardarImages = $this->db->insert("Imagenes", $insert);
                    if ($guardarImages) {
                        $bandera = true;
                    }
                }
                // }

                if ($bandera) {
                    $mensaje[0]["mensaje"] = "Datos almacenados con éxito";
                    $mensaje[0]["tipo"]    = "success";
                    echo json_encode($mensaje);
                }
            } else {
                $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function mostrarImagenes($idTarea)
    {
        $json  = array();
        $i     = 0;
        $query = $this->db->query("select Imagen from Imagenes where idTarea = '" . $idTarea . "' ");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $json[$i]["Imagen"] = $key["Imagen"];
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function reprogramarAutoTareas()
    {
        $this->db->trans_begin();
        try {
            /*$verificarAnterior = $this->db->query("
                    SELECT * FROM Tareas
                    WHERE EstadoTarea in ('A','P','E')
                    AND Fecha = (select top 1 Fecha from Tareas
                            where
                            EstadoTarea in ('A','P','E') and
                            Fecha < CAST(GETDATE() AS DATE)
                            order by Fecha desc)
                ");*/
                $verificarAnterior = $this->db->query("
                SELECT * FROM Tareas
                WHERE EstadoTarea in ('A','P','E')
                AND Fecha < CAST(GETDATE() AS DATE) 
                AND Fecha >= DATEADD(DAY, -3, GETDATE())
                order by Fecha desc 
                ");
            if($verificarAnterior->num_rows() > 0) {
                foreach ($verificarAnterior->result_array() as $key) {
                    $Id = $this->db->query("SELECT ISNULL(MAX(Id),0)+1 as Id FROM Tareas");
                    //sumar uno a la fecha
                    $insert = array(
                        "Id"               => $Id->result_array()[0]["Id"],
                        "Nombre"           => $key["Nombre"],
                        "Cantidad"         => $key["Cantidad"],
                        "Descripcion"      => $key["Descripcion"],
                        "NoOrdenTrabajo"   => $key["NoOrdenTrabajo"],
                        "Prioridad"        => 3,//$key["Prioridad"],
                        "EstadoTarea"      => "A",
                        "IdArea"           => $key["IdArea"],
                        "Fecha"            => date("Y-m-d"),
                        "IdUsuarioCrea"    => $key["IdUsuarioCrea"],
                        "FechaCrea"        => date("Y-m-d H:i:s"),
                        "Visto"            => 1,
                        //"Imagen"           => $imagen->result_array()[0]["Imagen"],
                        "Reprogramada"     => 1,
                        "FechaRealEntrega" => $key["FechaRealEntrega"],
                        "ContactoCliente"  => $key["ContactoCliente"],
                    );

                    $save = $this->db->insert("Tareas", $insert);
                    if ($save) {
                        $this->db->where("Id", $key["Id"]);
                        $update = array(
                            "EstadoTarea" => "R",
                            "FechaEdita"  => date("Y-m-d H:i:s"),
                            "Visto"       => 0,
                        );
                        $reprog = $this->db->update("Tareas", $update);
                        if ($reprog) {
                            $traerImagen = $this->db->query("select Imagen FROM Imagenes where IdTarea = " . $key["Id"] . " ");
                            if ($traerImagen->num_rows() > 0) {
                                foreach ($traerImagen->result_array() as $obj) {
                                    $idImagen = $this->db->query("SELECT ISNULL(MAX(IdImagen),0)+1 AS IdImagen FROM Imagenes");
                                    $insert   = array(
                                        "IdImagen"       => $idImagen->result_array()[0]["IdImagen"],
                                        "IdTarea"        => $Id->result_array()[0]["Id"],
                                        "NoOrdenTrabajo" => $key["NoOrdenTrabajo"],
                                        "Imagen"         => $obj["Imagen"],
                                        "IdArea"         => $key["IdArea"],
                                        "FechaGuarda"    => date("Y-m-d H:i:s"),
                                    );
                                    $guardarImages = $this->db->insert("Imagenes", $insert);
                                }
                            }
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

}

/* End of file Tareas_model.php */
