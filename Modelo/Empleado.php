<?php

require_once('Conexion.php');
require_once('Persona.php');

class Empleado extends Persona {
	
	private $idEmpleado;
	private $usuario;
	private $contrasena;
	private $estado;
	
	
	public function __construct($empleado_data=array()){
		
        parent::__construct();
		
		if(count($empleado_data)>1){
			foreach ($empleado_data as $campo => $valor){
               $this->$campo = $valor;
			}
		}else {
			$this->usuario="";
			$this->contrasena="";
			$this->estado="";
			
		}
	}
	function __destruct (){ }
	
	public function setIdEmpleado ($idEmpleado){
		$this->idEmpleado = $idEmpleado;
	}
	public function getIdEmpleado (){
		return $this->idEmpleado;
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
	public function setUsuario ($usuario){
		$this->usuario = $usuario;
	}
	public function getUsuario (){
		$this->usuario;
	}
	
	public function setContrasena($contrasena){
		$this->contrasena = $contrasena;
	}
	public function getContrasena(){
		return $this->contrasena;
	}
	public function setEstado ($estado){
		$this->estado = $estado;
	}
	public function getEstado (){
		return $this->estado = $estado;
	}
	public static function buscarForId($id){
		if ($id > 0){
			$emp = new Empleado();
			$getrow = $per->getRow("SELECT * FROM Persona WHERE idPersona =?", array($id));
			$emp->idEmpleado = $getrow['idPersona'];
			$emp->identificacion = $getrow['identificacion'];
			$emp->nombres = $getrow['nombres'];
			$emp->apellidos = $getrow['apellidos'];
			$emp->direccion = $getrow['direccion'];
			$emp->telefono = $getrow['telefono'];
			$emp->email = $getrow['email'];
			$emp->usuario = $getrow['usuario'];
			$emp->contrasena = $getrow['contrasena'];
			$emp->estado = $getrow['estado'];
			
			
			return $emp;
		}else{
			return NULL;
		}
		$this->Disconnect();
	}
	public static function buscarAll(){
		return Persona::buscar("idPersona");	
	}
	public static function buscar($campo, $valor=array()){
        $arrEmpleado = array();
		$tmp = new Empleado();
		if (count($valor) > 0){
        	$getrows = $tmp->getRows("SELECT * FROM Persona WHERE ".$campo." = ?", $valor);
		}else{
        	$getrows = $tmp->getRows("SELECT * FROM Persona", $valor);
		}
        foreach ($getrows as $getrow) {
            $emp = new Empleado();
			$emp->idEmpleado = $getrow['idPersona'];
			$emp->identificacion = $getrow['identificacion'];
			$emp->nombres = $getrow['nombres'];
			$emp->apellidos = $getrow['apellidos'];
			$emp->direccion = $getrow['direccion'];
			$emp->telefono = $getrow['telefono'];
			$emp->email = $getrow['email'];
			$emp->usuario = $getrow['usuario'];
			$emp->contrasena = $getrow['contrasena'];
			$emp->estado = $getrow['estado'];
            array_push($arrEmpleado, $emp);
			$emp->Disconnect();
        }
        
        return $arrEmpleado;
    }
    public function inactivar($id){
	
	}
	
	public function registrar (){
	
	try {
			$this->insertRow(" INSERT INTO persona (idPersona, tipoUsuario, identificacion, nombres, apellidos, direccion, telefono,email, usuario, contrasena,estado) VALUES ('NULL',?, ?, ?, ?, ?, ?, ?, ?,?,?)",         array( 
				    $this->tipoUsuario,
					$this->identificacion,
					$this->nombres,
					$this->apellidos,
					$this->direccion,
					$this->telefono,
					$this->email,
					$this->usuario,
			        $this->contrasena,
					$this->estado
					)
			);
			$this->Disconnect();
			return true;
		}catch(Exception $e) {
		throw new Exception($e->getMessage());
			return false;
		}
	}
	
	public function actualizar (){
		
		try {
			$this->getRow("UPDATE Persona SET identificacion = ?,nombre = ?, apellido = ?, direccion = ?, telefono = ?,email = ?, usuario = ?, contrasena = ?,estado = ? WHERE idPersona = ?", array( 
			        $this->tipoPersona,
					$this->identificacion,
					$this->nombre,
					$this->apellido,
					$this->direccion,
					$this->telefono,
					$this->email,
					$this->usuario,
			        $this->contrasena,
					$this->estado,
				    


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
?>


			
		 
		
		
  