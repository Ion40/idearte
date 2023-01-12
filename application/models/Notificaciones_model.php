<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notificaciones_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function mostrarConectados(){
        $json = array(); $i = 0; $tiempo = "";
        $query = $this->db->query("select DATEDIFF(SECOND, FechaConectado, getdate()) segundos,
                                    DATEDIFF(minute, FechaConectado, getdate()) minutos,
                                    DATEDIFF(HOUR, FechaConectado, getdate()) Horas,
                                    DATEDIFF(DAY, FechaConectado, getdate()) Dias,
                                    * from Usuarios where Conectado = 'true'
                                    and IdUsuario <> '".$this->session->userdata("id")."' ");

        $query2 = $this->db->query("select count(*) Conectados from Usuarios 
                                    where Conectado = 'true' and IdUsuario <> '".$this->session->userdata("id")."' ");
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
                $json[$i]["Conectados"] = $query2->result_array()[0]["Conectados"];
                $json[$i]["TiempoActivo"] = $tiempo;
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

    /*****************Observaciones tareas*********************** */
    public function contadorIncidencias(){
        $json = array(); $i = 0;
        $query = $this->db->query("select COUNT(1) as cantidad,IdOrden from TareaIncidencia
                                    where Estado = 'A'
                                    group by IdOrden");
        foreach ($query->result_array() as $key) {
            $json[$i]["cantidad"]= $key["cantidad"];
            $json[$i]["IdOrden"]= $key["IdOrden"];
            $i++;
        }                            
        echo json_encode($json);  
    }

    public function incidenciaNueva()
    {
        $json = array(); $i = 0;
        $query = $this->db->query("SELECT t0.IdIncidencia, t1.Nombre,t1.NoOrdenTrabajo, t1.Fecha,t0.FechaIncidencia, t1.Id
                                FROM dbo.TareaIncidencia AS t0 
                                INNER JOIN dbo.Tareas AS t1 ON t0.IdOrden = t1.Id
                                LEFT JOIN (SELECT IdAutorizacion,IdUsuario  from AutorizacionesUsuario where IdUsuario = ".$this->session->userdata("id")." and IdAutorizacion = 22) T3 ON T3.IdUsuario = ".$this->session->userdata("id")." --SESION
                                where-- t1.fecha >= dateadd(week, datediff(week, 0, getdate()), 0) 
                               -- and t1.fecha <= dateadd(week, datediff(week, 0, getdate()), + 6) and
                                 t0.Visto = 0 and t1.IdArea = ".$this->session->userdata("idArea")."
                                or (t3.IdUsuario is not null 
                                --and t1.fecha >= dateadd(week, datediff(week, 0, getdate()), 0)
                                --and t1.fecha <= dateadd(week, datediff(week, 0, getdate()), + 6)
                                and t0.Visto = 0
                                )");
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                $json[$i]["IdIncidencia"] = $key["IdIncidencia"];
                $json[$i]["NoOrdenTrabajo"] = $key["NoOrdenTrabajo"];
                $json[$i]["Nombre"] = $key["Nombre"];
                $json[$i]["Fecha"] = date_format(new DateTime($key["Fecha"]),"d-m-Y");
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function vistoIncidencias($IdIncidencia)
    {
        $this->db->where("IdIncidencia",$IdIncidencia);
        $data = array(
            "Visto" => 1
        );
        $this->db->update("TareaIncidencia",$data);
    }
/************************************************************************* */
    public function atencionNueva()
    {
        $json = array(); $i = 0; $type = ''; $mensaje='';
        
        $query = $this->db->query("SELECT t1.*,t0.Nombre as Atiende, t2.NombreArea
        FROM Tareas AS t1 
        left join Usuarios t0 on t1.IdUsuarioAtiende = t0.IdUsuario
        inner join Areas t2 on t1.IdArea = t2.IdArea
		LEFT JOIN (SELECT IdAutorizacion,IdUsuario  from AutorizacionesUsuario where IdUsuario = ".$this->session->userdata("id")." and IdAutorizacion = 21) T3 ON T3.IdUsuario = ".$this->session->userdata("id")." --SESION
        where --t1.fecha >= dateadd(week, datediff(week, 0, getdate()), 0)
        --and t1.fecha <= dateadd(week, datediff(week, 0, getdate()), + 6) and
         t1.Visto = 0 
        --and EstadoTarea = '' 
        and t1.IdArea = ".$this->session->userdata("idArea")."
		or (t3.IdUsuario is not null and
		--t1.fecha >= dateadd(week, datediff(week, 0, getdate()), 0)
         --and t1.fecha <= dateadd(week, datediff(week, 0, getdate()), + 6) and
         t1.Visto = 0 
        --and EstadoTarea = ''
		)");
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                $json[$i]["Id"] = $key["Id"];
                $json[$i]["IdUsuarioAtiende"] = $key["IdUsuarioAtiende"];
                $json[$i]["NoOrdenTrabajo"] = $key["NoOrdenTrabajo"];
                $json[$i]["Nombre"] = $key["Nombre"];
                $json[$i]["Atiende"] = $key["Atiende"];
                $json[$i]["NombreArea"] = $key["NombreArea"];
                $json[$i]["EstadoTarea"] = $key["EstadoTarea"];
                $json[$i]["Fecha"] = $key["Fecha"];
                switch ($key["EstadoTarea"]) {
                    case 'I':
                        $mensaje = "La tarea con orden n° ".$key["NoOrdenTrabajo"]." del dia ".date_format(new DateTime($key["Fecha"]),"d-m-Y")." correspondiente al área ".$key["NombreArea"]." fué anulada ";
                        $type = "error";
                        break;
                    case 'R':
                            $mensaje = "La tarea con orden n° ".$key["NoOrdenTrabajo"]." del dia ".date_format(new DateTime($key["Fecha"]),"d-m-Y")." correspondiente al área ".$key["NombreArea"]." fué reprogramada ";
                            $type = "info";
                            break;
                    case 'E':
                         $mensaje = "La tarea con orden n° ".$key["NoOrdenTrabajo"]." del dia ".date_format(new DateTime($key["Fecha"]),"d-m-Y")." correspondiente al área ".$key["NombreArea"]." está en espera ";
                         $type = "warning";
                            break;
                    case 'F':
                           $mensaje = "".$key["Atiende"]." finalizó la tarea con orden n° ".$key["NoOrdenTrabajo"]." del dia ".date_format(new DateTime($key["Fecha"]),"d-m-Y")." correspondiente al área ".$key["NombreArea"]." ";
                           $type = "success";
                             break;
                    case 'P':
                           $mensaje = " ".$key["Atiende"]." está atendiendo la tarea con orden n° ".$key["NoOrdenTrabajo"]." del dia ".date_format(new DateTime($key["Fecha"]),"d-m-Y")." correspondiente al área ".$key["NombreArea"]." ";
                            $type = "success";
                           break;
                    case 'A':
                           $mensaje = "Se ha agregado una nueva tarea con orden n° ".$key["NoOrdenTrabajo"]." del dia ".date_format(new DateTime($key["Fecha"]),"d-m-Y")." correspondiente al área ".$key["NombreArea"]." ";
                            $type = "success";
                           break;
                    default:
                        # code...
                        break;
                }
                $json[$i]["mensaje"] = $mensaje;
                $json[$i]["type"] = $type;
                //${key.Atiende} está atendiendo la tarea con orden n° ${key["NoOrdenTrabajo"]} correspondiente al área ${key.NombreArea}
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function vistoTareas($Id)
    {
        $this->db->where("Id",$Id);
        $data = array(
            "Visto" => 1
        );
        $this->db->update("Tareas",$data);
    }

    public function tareasNotifList()
    {
        $json = array(); $i = 0; $estadoAct = ''; $clase = '';
        $query = $this->db->query("SELECT t1.*,t0.Nombre as Atiende, t2.NombreArea
        FROM Tareas AS t1 
        left join Usuarios t0 on t1.IdUsuarioAtiende = t0.IdUsuario
        inner join Areas t2 on t1.IdArea = t2.IdArea
        where t1.fecha >= dateadd(week, datediff(week, 0, getdate()), 0)
        and t1.fecha <= dateadd(week, datediff(week, 0, getdate()), + 6)
        order by t1.FechaEdita desc");

        $queryCant = $this->db->query("SELECT count(1) as Cantidad
        FROM Tareas AS t1 
        left join Usuarios t0 on t1.IdUsuarioAtiende = t0.IdUsuario
        inner join Areas t2 on t1.IdArea = t2.IdArea
        where t1.fecha >= dateadd(week, datediff(week, 0, getdate()), 0)
        and t1.fecha <= dateadd(week, datediff(week, 0, getdate()), + 6)");

        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                switch($key["EstadoTarea"]){
                    case "A":
                        $estadoAct = '<span class="badge badge-secondary bg-hover-secondary text-hover-white fw-bold fs-8 px-2 ms-2">Abierta</span>';
                        $clase = "secondary";	
                        break;
                    case 'P':
                        $estadoAct = '<span class="badge badge-primary bg-hover-primary text-hover-white fw-bold fs-8 px-2 ms-2">En proceso</span>';	
                        $clase = "primary";
                        break;
                    case 'I':
                        $estadoAct = '<span class="badge badge-danger bg-hover-danger text-hover-white fw-bold fs-8 px-2 ms-2">Anulada</span>';	
                        $clase = "danger";
                        break;
                    case 'R':
                        $estadoAct = '<span class="badge badge-info bg-hover-info text-hover-white fw-bold fs-8 px-2 ms-2">Reprogramada</span>';	
                        $clase = "info";
                        break;
                    case 'F':
                        $estadoAct = '<span class="badge badge-success bg-hover-success text-hover-white fw-bold fs-8 px-2 ms-2">Finalizada</span>';	
                        $clase = "success";
                        break;
                    case 'E':
                        $estadoAct = '<span class="badge badge-warning bg-hover-warning text-hover-white fw-bold fs-8 px-2 ms-2">En espera</span>';	
                        $clase = "warning";
                        break;
                    default:
                        $estadoAct = '<span class="badge badge-white bg-hover-while text-hover-white fw-bold fs-8 px-2 ms-2"></span>';	
                        break;
                }
                $json[$i]["Id"] = $key["Id"];
                $json[$i]["Cantidad"] = $key["Cantidad"];
                $json[$i]["Nombre"] = $key["Nombre"];
                $json[$i]["Descripcion"] = $key["Descripcion"];
                $json[$i]["IdUsuarioAtiende"] = $key["IdUsuarioAtiende"];
                $json[$i]["NoOrdenTrabajo"] = $key["NoOrdenTrabajo"];
                $json[$i]["Atiende"] = ($key["Atiende"] != "") ? "Atiende: ".$key["Atiende"] : "Sin atender";
                $json[$i]["NombreArea"] = $key["NombreArea"];
                $json[$i]["Imagen"] = $key["Imagen"];
                $json[$i]["FechaFinaliza"] = $key["FechaFinaliza"];
                $json[$i]["FechaEntrega"] = $key["Fecha"];
                $json[$i]["Estado"] = $estadoAct;
                $json[$i]["Prioridad"] = $key["Prioridad"];
                $json[$i]["Contador"] = $queryCant->result_array()[0]["Cantidad"];
                $json[$i]["Clase"] = $clase;
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function incidenciasNotifList()
    {
        $json = array(); $i = 0;
        $query = $this->db->query("select t0.*,t1.NoOrdenTrabajo,t2.Nombre
        from TareaIncidencia t0
        inner join Tareas t1 on t1.Id = t0.IdOrden
        inner join Usuarios t2 on t0.IdUsuarioCrea = t2.IdUsuario
        where t1.fecha >= dateadd(week, datediff(week, 0, getdate()), 0)
        and t1.fecha <= dateadd(week, datediff(week, 0, getdate()), + 6)
        order by t0.IdIncidencia desc");

        $queryCant = $this->db->query("select count(1) as Cantidad
        from TareaIncidencia t0
        inner join Tareas t1 on t1.Id = t0.IdOrden
        inner join Usuarios t2 on t0.IdUsuarioCrea = t2.IdUsuario
        where t1.fecha >= dateadd(week, datediff(week, 0, getdate()), 0)
        and t1.fecha <= dateadd(week, datediff(week, 0, getdate()), + 6)");

        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                $json[$i]["IdOrden"] = $key["IdOrden"];
                $json[$i]["Nombre"] = $key["Nombre"];
                $json[$i]["NoOrdenTrabajo"] = $key["NoOrdenTrabajo"];
                $json[$i]["FechaIncidencia"] = date_format(new DateTime($key["FechaIncidencia"]), "Y-m-d H:i");
                $json[$i]["Contador"] = $queryCant->result_array()[0]["Cantidad"];
                $i++;
            }
            echo json_encode($json);
        }
    }
}

/* End of file Notificaiones_model.php */

?>