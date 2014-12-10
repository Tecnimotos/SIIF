<?php
require_once ('Conexion.php');


class Persona extends Conexion {
	
	private $idPersona;
	
	private $tipoUsuario;
	private $identificacion;
	private $nombres;
	private $apellidos;
	private $direccion;
	private $telefono;
	private $email;
	
	public function __construct($persona_data=array()){
        parent::__construct();
		if(count($persona_data)>1){
			foreach ($persona_data as $campo => $valor){
               $this->$campo = $valor;
			}
		}else {
			$this->idPersona = "";
			$this->tipoUsuario="";
			$this->identificacion = "";
			$this->nombres = "";
			$this->apellidos = "";
			$this->direccion = "";
			$this->telefono = "";
			$this->email = "";
			
			
		}
    }
	
	function __destruct (){ }
	
	public function setIdPersona ($idPersona){
		$this->idPersona = $idPersona;
	}
	
	public function getIdPersona (){
		return $this->idPersona;
	}
	public function setTipoUsuario ($tipoUsuario){
		$this->tipoUsuario = $tipoUsuario;
	}
	
	public function getTipoUsuario (){
		return $this->tipoUsuario;
	}
	
	public function setIdentificacion ($identificacion){
		$this->identificacion = $identificacion;
	}
	
	public function getIdentificacion (){
		return $this->identificacion;
	}
	
	public function setNombres ($nombres){
		$this->nombres = $nombres;
	}
	
	public function getNombres (){
		return $this->nombres;
	}
	
	public function setApellidos ($apellidos){
		$this->apellidos = $apellidos;
	}
	
	public function getApellidos (){
		return $this->apellidos;
	}
	
	
	
	public function setDireccion ($direccion){
		$this->direccion = $direccion;
	}
	
	public function getDireccion (){
		return $this->direccion;
	}
	
	public function setTelefono ($telefono){
		$this->telefono = $telefono;
	}
	
	public function getTelefono (){
		return $this->telefono;
	}
	public function setEmail ($email){
		$this->cedula = $cedula;
	}
	
	public function getEmail (){
		return $this->email;
	}
	public static function buscarForId($id){
		if ($id > 0){
			$per = new Persona();
			$getrow = $per->getRow("SELECT * FROM Persona WHERE idPersona =?", array($id));
			$per->idPersona = $getrow['idPersona'];
			$per->identificacion = $getrow['identificacion'];
			$per->nombres = $getrow['nombres'];
			$per->apellidos = $getrow['apellidos'];
			$per->direccion = $getrow['direccion'];
			$per->telefono = $getrow['telefono'];
		    $per->email = $getrow['email'];
			return $per;
			
		}else{
			return NULL;
		}
		$this->Disconnect();
	}
	public static function buscarAll(){
		return Persona::buscar("idPersona");	
	}
	public static function buscar($campo, $valor=array()){
        $arrPersona = array();
		$tmp = new Persona();
		if (count($valor) > 0){
        	$getrows = $tmp->getRows("SELECT * FROM Persona WHERE ".$campo." = ?", $valor);
		}else{
        	$getrows = $tmp->getRows("SELECT * FROM Persona", $valor);
		}
        foreach ($getrows as $getrow) {
            $per = new Persona();
			
			$per->idPersona = $getrow['idPersona'];
			$per->tipoUsuario = $getrow['tipoUsuario'];
			$per->identificacion = $getrow['identificacion'];
			$per->nombres = $getrow['nombres'];
			$per->apellidos = $getrow['apellidos'];
			$per->direccion = $getrow['direccion'];
			$per->telefono = $getrow['telefono'];
			$per->email = $getrow['email'];
            
            array_push($arrPersona, $per);
			$per->Disconnect();
        }
        
        return $arrPersona;
    }
    
	public function inactivar($id){
	
	}
	public function registrar (){
	     
		try {
			$this->insertRow("INSERT INTO persona (idPersona,tipoUsuario,identificacion, nombres, apellidos,  direccion, telefono,email) VALUES ('NULL',?, ?, ?, ?, ?, ?,?)",        
			 array( 
				    $this->tipoUsuario,
					$this->idetificacion,
					$this->nombres,
					$this->apellidos,
					$this->direccion,
					$this->telefono,
					$this->email
					
					
					
				)
			);
			$this->Disconnect();
			return true;
		}catch(Exception $e) {
			throw new Exception($e->getMessage());
			return false;
		}
	}
	
	public  function login($usuario , $contrasena){
            
		$tmp = new Persona();	
        $getrows = $tmp->getRows("SELECT * FROM persona WHERE usuario = ? AND contrasena = ?", array($usuario, $contrasena));
			
        if (count($getrows) > 0){
            if($result[0]->contrasena == $contrasena){
				foreach ($getrows as $getrow) {
					$per = new Persona();
					$per->idPersona = $getrow['idPersona'];
					$per->tipoUsuario = $getrow['tipoUsuario'];
					$per->identificacion = $getrow['identificacion'];
					$per->nombres = $getrow['nombres'];
					$per->apellidos = $getrow['apellidos'];
					
					$per->direccion = $getrow['direccion'];
					$per->telefono = $getrow['telefono'];
					$per->email = $getrow['email'];
					$per->Disconnect();
					return $per;
				}                
            }else{
                return 2;
            }
        }else{
            return 3;
        }
    }
	public function actualizar (){
		
		try {
			$this->getRow("UPDATE Persona SET identificacion = ?, nombre = ?, apellido = ?, direccion = ?, telefono = ? , email = ? WHERE idPersona = ?", array( 
			        $this->identificacion,
					$this->nombre,
					$this->apellido,
					$this->direccion,
					$this->telefono,
					$this->email,
					
				    $this->idPersona

				)
			);
			$this->Disconnect();
			return true;
		}catch(Exception $e) {
			throw new Exception($e->getMessage());
			return false;
		}
	}
}