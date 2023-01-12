<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reportes_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }

    public function mostrarTarea($fechainicio, $fechaFin, $idArea, $start, $length, $search)
    {
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "12");
        if ($permiso) {
            $srch = "";
            $area = "";
            if ($idArea) {
                $area = "AND t0.IdArea = '" . $idArea . "' ";
            } else {
                $area = "";
            }
            if ($search) {
                $srch = "AND (
                          t0.NoOrdenTrabajo like '%" . $search . "%' OR
                          t0.Nombre like '%" . $search . "%' OR
                          t0.Cantidad like '%" . $search . "%' OR
                          t0.Descripcion like '%" . $search . "%' OR
                          t2.NombreArea like '%" . $search . "%' OR
                          t0.Fecha like '%" . $search . "%' OR
                          cast(t0.FechaFinaliza as date) like '%" . $search . "%' OR
                          t1.Nombre like '%" . $search . "%'
                        ) ";
            }

            $qnr = "SELECT COUNT(1) as Cantidad FROM  Tareas t0
                    left join Usuarios t1 on t0.IdUsuarioAtiende = t1.IdUsuario
                    inner join Areas t2 on t0.IdArea = t2.IdArea
                    where t0.Fecha >= '" . $fechainicio . "' and t0.Fecha <= '" . $fechaFin . "' " . $area . " " . $srch . " ";
            $qnr = $this->db->query($qnr);
            $qnr = $qnr->result_array()[0]["Cantidad"];

            if ($length == -1) {
                $q = $this->db->query("SELECT t0.* ,t1.Nombre as Atiende,t2.NombreArea FROM Tareas t0
                                        left join Usuarios t1 on t0.IdUsuarioAtiende = t1.IdUsuario
                                        inner join Areas t2 on t0.IdArea = t2.IdArea
                                        where t0.Fecha >= '" . $fechainicio . "' and t0.Fecha <= '" . $fechaFin . "'
                                        " . $area . "
                                        " . $srch . "
                                        ORDER BY t2.NombreArea,t0.Id asc");
            } else {
                $q = $this->db->query("SELECT t0.* ,t1.Nombre as Atiende,t2.NombreArea FROM Tareas t0
                                        left join Usuarios t1 on t0.IdUsuarioAtiende = t1.IdUsuario
                                        inner join Areas t2 on t0.IdArea = t2.IdArea
                                        where t0.Fecha >= '" . $fechainicio . "' and t0.Fecha <= '" . $fechaFin . "'
                                        " . $area . "
                                        " . $srch . "
                                        ORDER BY t2.NombreArea,t0.Id asc
                                        offset " . $start . " rows fetch next " . $length . " rows only;");
            }

            $retornar = array(
                "numDataTotal" => $qnr,
                "datos"        => $q,
            );
            return $retornar;
        } else {
            $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
    }

    public function mostrarOrdenesRpt($fechainicio, $fechaFin, $idArea, $start, $length, $search)
    {
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "13");
        if ($permiso) {
            $srch = "";
            $area = "";
            if ($idArea) {
                $area = "AND t0.IdArea = '" . $idArea . "' ";
            } else {
                $area = "";
            }
            if ($search) {
                $srch = "AND (
                          t0.IdOrden like '%" . $search . "%' OR
                          t0.DescripcionOrden like '%" . $search . "%' OR
                          t1.Nombre like '%" . $search . "%' OR
                          t2.NombreArea like '%" . $search . "%' OR
                          t0.FechaOrden like '%" . $search . "%'
                        ) ";
            }

            $qnr = "SELECT COUNT(1) as Cantidad from OrdenesCompra t0
            inner join Usuarios t1 on t0.IdUsuarioOrden = t1.IdUsuario
            inner join Areas t2 on t0.IdArea = t2.IdArea
            where t0.FechaOrden >= '" . $fechainicio . "' and t0.FechaOrden <= '" . $fechaFin . "'
            " . $area . "
            " . $srch . "";
            $qnr = $this->db->query($qnr);
            $qnr = $qnr->result_array()[0]["Cantidad"];

            if ($length == -1) {
                $q = $this->db->query("SELECT t0.*,t1.Nombre,t2.NombreArea
                                        from OrdenesCompra t0
                                        inner join Usuarios t1 on t0.IdUsuarioOrden = t1.IdUsuario
                                        inner join Areas t2 on t0.IdArea = t2.IdArea
                                        where t0.FechaOrden >= '" . $fechainicio . "' and t0.FechaOrden <= '" . $fechaFin . "'
                                        " . $area . "
                                        " . $srch . "
                                        ORDER BY t2.NombreArea,t0.IdOrden asc");
            } else {
                $q = $this->db->query("SELECT t0.*,t1.Nombre,t2.NombreArea
                                        from OrdenesCompra t0
                                        inner join Usuarios t1 on t0.IdUsuarioOrden = t1.IdUsuario
                                        inner join Areas t2 on t0.IdArea = t2.IdArea
                                        where t0.FechaOrden >= '" . $fechainicio . "' and t0.FechaOrden <= '" . $fechaFin . "'
                                        " . $area . "
                                        " . $srch . "
                                        ORDER BY t2.NombreArea,t0.IdOrden asc
                                        offset " . $start . " rows fetch next " . $length . " rows only;");
            }

            $retornar = array(
                "numDataTotal" => $qnr,
                "datos"        => $q,
            );
            return $retornar;
        } else {
            $mensaje[0]["mensaje"] = "No tienes permiso para realizar esta acción";
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
    }

    public function imprimirRptOrden($fechainicio, $fechaFin, $idarea)
    {
        $area = "";
        if ($idarea != 0) {
            $area = "AND t0.IdArea = '" . $idarea . "' ";
        } else {
            $area = "";
        }
        $query = $this->db->query("SELECT t1.NombreArea, t0.IdArea, t2.Nombre, t0.IdUsuarioOrden,t0.Estado
                                 FROM dbo.OrdenesCompra AS t0 INNER JOIN
                                 dbo.Areas AS t1 ON t0.IdArea = t1.IdArea INNER JOIN
                                 dbo.Usuarios AS t2 ON t0.IdUsuarioOrden = t2.IdUsuario
                                 where t0.Estado in ('A','P') and
                                  t0.FechaOrden >= '" . $fechainicio . "' and t0.FechaOrden <= '" . $fechaFin . "' " . $area . "
                                  group by t1.NombreArea,  t0.IdArea, t2.Nombre, t0.IdUsuarioOrden,t0.Estado");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    public function imprimirRptOrdenDet($fechainicio, $fechaFin, $idarea)
    {
        $area = "";
        if ($idarea != 0) {
            $area = "AND t0.IdArea = '" . $idarea . "' ";
        } else {
            $area = "";
        }
        $query = $this->db->query("SELECT t0.IdArea, t0.IdUsuarioOrden, t1.IdOrden, t0.FechaOrden, t0.FechaCrea,t1.IdDetalleOrden,t1.Cantidad, t1.Articulo, t1.DescripcionArticulo, t2.Nombre,t0.Estado
        FROM      dbo.OrdenesCompra AS t0 INNER JOIN
                                 dbo.DetalleOrdenCompra AS t1 ON t0.IdOrden = t1.IdOrden INNER JOIN
                                 dbo.Usuarios AS t2 ON t0.IdUsuarioOrden = t2.IdUsuario
                                 where t0.Estado IN ('A','P') and
                                  t0.FechaOrden >= '" . $fechainicio . "' and t0.FechaOrden <= '" . $fechaFin . "' " . $area . " ");
        if ($query->num_rows() > 0) {
            /*foreach ($query->result_array() as $key) {
                $this->db->where("IdOrden", $key["IdOrden"]);
                $data = array(
                    "Estado" => "P",
                );
                $this->db->update("OrdenesCompra", $data);
            }*/
            return $query->result_array();
        }
        return 0;
    }

    public function marcarImpreso($fechainicio, $fechaFin, $idarea)
    {
        $area = "";
        if ($idarea != 0) {
            $area = "AND t0.IdArea = '" . $idarea . "' ";
        } else {
            $area = "";
        }
        $query = $this->db->query("SELECT t0.IdArea, t0.IdUsuarioOrden, t1.IdOrden, t0.FechaOrden, t0.FechaCrea,t1.IdDetalleOrden,t1.Cantidad, t1.Articulo, t1.DescripcionArticulo, t2.Nombre
        FROM      dbo.OrdenesCompra AS t0 INNER JOIN
                                 dbo.DetalleOrdenCompra AS t1 ON t0.IdOrden = t1.IdOrden INNER JOIN
                                 dbo.Usuarios AS t2 ON t0.IdUsuarioOrden = t2.IdUsuario
                                 where t0.Estado IN ('A','P') and
                                  t0.FechaOrden >= '" . $fechainicio . "' and t0.FechaOrden <= '" . $fechaFin . "' " . $area . " ");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $this->db->where("IdOrden", $key["IdOrden"]);
                $data = array(
                    "Estado" => "P",
                );
                $this->db->update("OrdenesCompra", $data);

                $this->db->where("IdOrden", $key["IdOrden"]);
                $data = array(
                    "Estado" => "P",
                );
                $this->db->update("DetalleOrdenCompra", $data);
            }
            //return $query->result_array();
        }
        //return 0;
    }
}

/* End of file Reportes_model.php */
