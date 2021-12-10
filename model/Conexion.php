<?php

class Conexion{
    private $conn;
    private $error;

    public function __construct(){
        // Se establece una conexion con la base de datos ya creada
        $this->conn = new mysqli("localhost", "root", "root", "sigmed");
/*         $this->conn = new mysqli("localhost", "id15643424_root", "", "id15643424_mysql"); */
        if ($this->conn->connect_error) {
            die("La conexión falló: " . $this->conn->connect_error);
        }
    }

    //funciones para crear usuario 

    public function crearCuenta($cedula,$nombre,$apellido,$correo,$contrasenna){
        $validar1 = false;
        $validar2 = false;
        $validar1 = $this->CrearUsuario($cedula,$nombre,$apellido,$correo,$contrasenna);
        $validar2 = $this->CrearPaciente($cedula,$nombre,$apellido,$cedula);
        if($validar1 == true && $validar2 == true){
            return true;
        }else{
            return false;
        }

    }

    public function CrearUsuario($cedula,$nombre,$apellido,$correo,$contrasenna){
        $tipo_usuario = 1;
       
        $sql = "INSERT INTO usuario VALUES (NULL,'$correo','$contrasenna',$tipo_usuario);";

        if ($this->conn->query($sql)){ 
            return true;
           } else{
            return false;
           }
        
    }
    public function getIdUsuario(){
        $sql = "select MAX(id) AS max_id_user FROM usuario";

        $query = $this->conn->query($sql);
         $dato = [];
         $respuesta = "";
         $i=0;
             while($row = $query->fetch_assoc()){
                 $dato[$i]=$row;
                 $i++;
             }
        $respuesta = $dato[0];
             
        return $respuesta;
    }
    public function CrearPaciente($cedula,$nombre,$apellido){
        $id_usuario = $this->getIdUsuario();
    
        $sql = "INSERT INTO paciente  VALUES (NULL,'$nombre','$apellido','$cedula',{$id_usuario['max_id_user']});";
        if ($this->conn->query($sql)){
            return true;
           } else{
            return false;}
    }

    //iniciar sesion
    public function existeUsuario($correo,$contrasenna){
        $sql = "SELECT * FROM usuario WHERE email = '$correo' AND contrasenna = '$contrasenna'";
        
        $query = $this->conn->query($sql);
         $dato = [];
         $respuesta = "";
         $i=0;
             while($row = $query->fetch_assoc()){
                 $dato[$i]=$row;
                 $i++;
             }
        
            
        if($dato == []){
            return false;
        }else{
            return true;
        }
    }
            
    

    public function obtenerId($correo,$contrasenna){
        $sql = "SELECT * FROM usuario WHERE email = '$correo' AND contrasenna = '$contrasenna'";

        $query = $this->conn->query($sql);
         $dato = [];
         $respuesta = "";
         $i=0;
             while($row = $query->fetch_assoc()){
                 $dato[$i]=$row;
                 $i++;
             }
        
     
        $respuesta = $dato[0]["id"];

             
        return $respuesta;
    }

//escalera del terror
    public function RecuperarPoliclinicas(){
       
        
        $sql = "SELECT * FROM  policlinica;";
        $query = $this->conn->query($sql);
        $policlinicas = [];
        $i=0;
            while($row = $query->fetch_assoc()){
                $policlinicas[$i]=$row;
                $i++;
            }
           
            return $policlinicas;
        }
        public function RecuperarPoliclinicaFase2($id){
            
            $idCorregido  = (int)$id;

            $sql = "SELECT * FROM  policlinica WHERE id = $idCorregido;";
            $query = $this->conn->query($sql);
            $policlinicas = [];
            $i=0;
                while($row = $query->fetch_assoc()){
                    $policlinicas[$i]=$row;
                    $i++;
                }
               
                return $policlinicas;
            }
            public function encotrarEspecialdades($id){
            
                $idreal  = $id[0]["id"];
                $idCorregido = (int)$idreal;
                echo($idCorregido);
                $sql = "SELECT id_especialidad FROM medico WHERE id_policlinica = $idCorregido;";
                $query = $this->conn->query($sql);
                $especialidades = [];
                $i=0;
                    while($row = $query->fetch_assoc()){
                        $especialidades[$i]=$row;
                        $i++;
                    }
                   
                    return $especialidades;
            }
            public function obtenerNombreEspecialidad($ids){
                $resultado  = [];
                foreach($ids as $id){
                    $realid = (int)$id;
                    $sql = "SELECT * FROM especialidad WHERE id = $realid;";
                    $query = $this->conn->query($sql);
                    $i=0;
                    while($row = $query->fetch_assoc()){
                        $resultado[$i]=$row;
                        $i++;
                    }
                }
                var_dump($resultado);
                return $resultado;
            }

    /*         
    public function Guardar_Proyectos($fecha,$proponente,$tipo_proyecto,$nombre,$objetivo,$descripcion,$nivel_proyecto,$modalidad,$lugar_actividad,$descripcion_lugar,$perfil_estudiante,$cantidad_es,$total_horas){
        Se guarda la informacion del formulario a la tabla de proyectos por medio de un procedimiento insert de mySQL
        El estado del proyecto es pendiente por aprobacion por defecto por eso no se pide
        $estado = 'pendiente por aprobacion';
        $sql = "call insertar_proyectos('$fecha','$proponente','$tipo_proyecto','$nombre','$objetivo','$descripcion','$nivel_proyecto','$modalidad','$lugar_actividad','$descripcion_lugar','$perfil_estudiante',$cantidad_es,$total_horas,'$estado');";
               
        if ($this->conn->query($sql)){
         return true;
        } else{
         return false;
     }
 
     }
 
     public function Guardar_Responsables($nombre,$apellido,$cedula,$telefono_of,$telefono_mov){
       // Se guarda la informacion del formulario a la tabla de responsable por medio de un procedimiento insert de mySQL
         $sql = "CALL insertar_responsables('$nombre','$apellido','$cedula','$telefono_of','$telefono_mov');";
         if ($this->conn->query($sql)){
             return true;
            } else{
             return false;
         }
 
     }
 
     public function Guardar_Supervisores($nombre,$apellido,$cedula,$telefono_of,$telelfono_mov){
         // Se guarda la informacion del formulario a la tabla de supervisor
         $sql = "call insertar_supervisores('$nombre','$apellido','$cedula','$telefono_of','$telelfono_mov');";
         if ($this->conn->query($sql)){
             return true;
            }     else{
             return false;
         }
     }
 
     public function Guardar_facul_proyectos($id_facultad){
        // Se guarda la informacion del formulario a la tabla de facul_proyectos por medio de un procedimiento insert de mySQL
         $sql = "call insertar_facul_proyectos($id_facultad);";
         if ($this->conn->query($sql)){
             return true;
            } else{
             return false;
         }
 
         
     }
 
     public function Guardar_Actividades($n_actividad,$nombre,$tiempo){
         // Se guarda la informacion del formulario en la tabla de actividades por medio de un procedimiento insert de mySQL
         $sql = "call insertar_actividades($n_actividad,'$nombre',$tiempo);";
         if ($this->conn->query($sql)){
             return true;
            } else{
             return false;
         }
 
         
     }
 
     public function Guardar_Participantes($nombre,$cedula,$apellido,$telefono_m,$telefono_r){
         //Se guarda la informacion del formulario en la table de participantes por medio de un procedimiento insert de mySQL
         $sql = "call insertar_participates('$nombre','$cedula','$apellido','$telefono_m','$telefono_r');";
         if ($this->conn->query($sql)){
             return true;
            } else{
                return false;
            }
 
         
     }
     public function Recuperar_Proyectos($id){
         //Utilizando una variable que proviene de una interaccion del usuario con la interfaz del sistema se extrae la data de la tabla proyevtos
         $id_proy = (int)$id;
         $sql = "SELECT * FROM proyectos where id_proyectos = $id_proy; ";
         $query = $this->conn->query($sql);
         $datosProy = [];
         $i=0;
             while($row = $query->fetch_assoc()){
                 $datosProy[$i]=$row;
                 $i++;
             }
            
             return $datosProy;
         }
     
 
    
         public function Recuperar_Responsables($id){
          //Utilizando una variable que proviene de una interaccion del usuario con la interfaz del sistema se extrae la data de la tabla responsables
         $sql = "SELECT id_responsable FROM proyectos where id_proyectos = $id; ";
         $query = $this->conn->query($sql);
         $datosResp = [];
         $datos = [];
         $i=0;
             while($row = $query->fetch_assoc()){
                 $datosResp[$i]=$row;
                 $i++;
             }
             $entrada = $datosResp[0]['id_responsable'];
         $sql2 = "SELECT * FROM responsables where id_res = $entrada; ";
         $query = $this->conn->query($sql2);
         $i=0;
             while($row2 = $query->fetch_assoc()){
                 $datos[$i]=$row2;
                 $i++;
             }    
         return $datos;  
     }
 
     public function Recuperar_Supervisores($id){
         //Utilizando una variable que proviene de una interaccion del usuario con la interfaz del sistema se extrae la data de la tabla supervisores
         $sql = "SELECT id_supervisor FROM proyectos where id_proyectos = $id; ";
         $query = $this->conn->query($sql);
         $datosSuper = [];
         $datos = [];
         $i=0;
             while($row = $query->fetch_assoc()){
                 $datosSuper[$i]=$row;
                 $i++;
             }
             $entrada = $datosSuper[0]['id_supervisor'];
         $sql2 = "SELECT * FROM supervisores where id_super = $entrada; ";
         $query = $this->conn->query($sql2);
         $i=0;
             while($row2 = $query->fetch_assoc()){
                 $datos[$i]=$row2;
                 $i++;
             }    
         return $datos;
     }
 
     public function Recuperar_facul_proyectos($id){
         //Utilizando una variable que proviene de una interaccion del usuario con la interfaz del sistema se extrae la data de la tabla facul_proyectos
         $sql = "SELECT * FROM facul_proyectos where id_proyectos =  $id;";
         $query = $this->conn->query($sql);
         $datosFacuProy = [];
         $i=0;
             while($row = $query->fetch_assoc()){
                 $datosFacuProy[$i]=$row;
                 $i++;
             }
         return $datosFacuProy;
     }
 
     public function Recuperar_Actividades($id){
         //Utilizando una variable que proviene de una interaccion del usuario con la interfaz del sistema se extrae la data de la tabla actividades
         $sql = "SELECT * FROM actividades where id_proyectos = $id; ";
         $query = $this->conn->query($sql);
         $datosActiv = [];
         $i=0;
        
             while($row = $query->fetch_assoc()){
                 $datosActiv[$i]=$row;
                 $i++;
             }
         return $datosActiv;
     }
 
     public function Recuperar_Participantes($id){
         //Utilizando una variable que proviene de una interaccion del usuario con la interfaz del sistema se extrae la data de la tabla participantes
         $sql = "SELECT * FROM participantes where id_proyectos = $id; ";
         $query = $this->conn->query($sql);
         $datosParti = [];
         $i=0;
             while($row = $query->fetch_assoc()){
                 $datosParti[$i]=$row;
                 $i++;
             }
         
         return $datosParti;
     }
 
     public function Recuperar_lista_proyectos(){
         //Se extraen datos de la tabla proyectos por medio de una procecedimiento view de mySQL
         $sql = "SELECT * FROM lista_proyectos";
         $query = $this->conn->query($sql);
         $resultado = [];
         $i=0;
         while ( $fila = $query->fetch_assoc()) { 
             $resultado[$i] = $fila;
             $i++;
         }
         return $resultado;
     }
     public function Recuperar_lista_proyectosp2(){
          //Se extraen datos de la tabla proyectos por medio de una procecedimiento view de mySQL
         $sql = "SELECT * FROM lista_proyectos_user";
         $query = $this->conn->query($sql);
         $resultado = [];
         $i=0;
         while ( $fila = $query->fetch_assoc()) { 
             $resultado[$i] = $fila;
             $i++;
         }
         return $resultado;
     }
     public function Modificar_Estado($id,$cambio){
         // Por medio de la interfaz el usuario realiza un UPDATE a la tabla de proyectos sobre un proyecto existente
         $sql = "UPDATE proyectos SET estado = '$cambio' WHERE id_proyectos = $id;";
         if ($this->conn->query($sql)){
             return true;
            }
     
     }  
    
    */

    
    public function __destruct(){
        // se cierra la conexion establecida con la base de datos 
        $this->conn->close();
    }
}


?>