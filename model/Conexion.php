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
                return $resultado;
            }

            public function recuperarEspecialidadesFase2($id){
            
                $idCorregido  = (int)$id;
    
                $sql = "SELECT * FROM  especialidad WHERE id = $idCorregido;";
                $query = $this->conn->query($sql);
                $especialidad = [];
                $i=0;
                    while($row = $query->fetch_assoc()){
                        $especialidad[$i]=$row;
                        $i++;
                    }
                   
                    return $especialidad;
                }

            public function obtenerMedico($id_especialidad,$id_policlinica){
                $idCorregido  = (int)$id_especialidad;
                $idCorregido2  = (int)$id_policlinica;

                $sql = "SELECT * FROM  medico WHERE id_especialidad = $idCorregido and id_policlinica = $idCorregido2;";
                $query = $this->conn->query($sql);
                $medico = [];
                $i=0;
                    while($row = $query->fetch_assoc()){
                        $medico[$i]=$row;
                        $i++;
                    }
                   
                    return $medico;
            }

            public function obtenerMedicoFase2($id){
                $idCorregido  = (int)$id;
    
                $sql = "SELECT * FROM  medico WHERE id = $idCorregido;";
                $query = $this->conn->query($sql);
                $medico = [];
                $i=0;
                    while($row = $query->fetch_assoc()){
                        $medico[$i]=$row;
                        $i++;
                    }
                   
                    return $medico;
            }
            public function obtenerHorarios(){
                $sql = "SELECT * FROM  horario;";
                $query = $this->conn->query($sql);
                $horario = [];
                $i=0;
                    while($row = $query->fetch_assoc()){
                        $horario[$i]=$row;
                        $i++;
                    }
                   
                    return $horario;
            }

            public function obtenerIdPaciente($id){
                $id_arreglado = (int)$id;
                $sql = "SELECT * FROM paciente WHERE id_usuario = $id_arreglado";
        
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

            public function guardarCita($fecha,$id_medico,$id_paciente,$id_horario){


                $estado = 1;
                $rid_medico = (int)$id_medico;
                $rid_paciente = (int)$id_paciente;
                $rid_horario = (int)$id_horario;       
                $sql = "INSERT INTO citas VALUES (NULL,'$fecha',$estado,$rid_medico,$rid_paciente,$rid_horario);";

                if ($this->conn->query($sql)){ 
                    return true;
                } else{
                    return false;
                }

            }
            public function obtenerEmailPaciente($id){
                $id_arreglado = (int)$id;
                $sql = "SELECT * FROM usuario WHERE id = $id_arreglado";
        
                $query = $this->conn->query($sql);
                 $dato = [];
                 $respuesta = "";
                 $i=0;
                     while($row = $query->fetch_assoc()){
                         $dato[$i]=$row;
                         $i++;
                     }
                
             
                $respuesta = $dato[0]["email"];
        
                     
                return $respuesta;
            }

            public function obtenerCitas($id_paciente){
                $id_arreglado = (int)$id_paciente;
                $sql = "SELECT * FROM citas WHERE id_paciente = $id_arreglado";
        
                $query = $this->conn->query($sql);
                 $dato = [];
                 
                 $i=0;
                     while($row = $query->fetch_assoc()){
                         $dato[$i]=$row;
                         $i++;
                     }     
                return $dato;
            }
            public function obtenerNombreMedico($id_medico){
                $id_arreglado = (int)$id_medico;
                $sql = "SELECT nombre FROM medico WHERE id = $id_arreglado";
                $query = $this->conn->query($sql);
                 $dato = [];
                 
                 $i=0;
                     while($row = $query->fetch_assoc()){
                         $dato[$i]=$row;
                         $i++;
                     }     

                $resultado = $dato[0]['nombre'];
                return $resultado;

            }
            public function obtenerNombreHora($id_hora){
                $id_arreglado = (int)$id_hora;
                $sql = "SELECT franja_horaria FROM horario WHERE id = $id_hora";
                $query = $this->conn->query($sql);
                 $dato = [];
                 
                 $i=0;
                     while($row = $query->fetch_assoc()){
                         $dato[$i]=$row;
                         $i++;
                     }     

                $resultado = $dato[0]['franja_horaria'];
                return $resultado;

            }

            
    

    
    public function __destruct(){
        // se cierra la conexion establecida con la base de datos 
        $this->conn->close();
    }
}


?>