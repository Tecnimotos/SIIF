<?php
require_once ('Conexion.php');


class Proveedor extends Conexion {
	private $idProveedor;
	private $tipoProveedor;
	private $razonSocial;
	private $nit;
	private $telefono;
	private $ciudad;
	private $direccion;
	private $email;
	private $contacto;
	private $telefonoContacto;
	private $estado;
	
	public function __construct($Proveedor_data=array()){
        parent::__construct();
		if(count($Proveedor_data)>1){
			foreach ($Proveedor_data as $campo => $valor){
               $this->$campo = $valor;
			}
		}else {
			$this->idProveedor = "";
			$this->tipoProveedor="";
			$this->razonSocial = "";
			$this->nit = "";
			$this->telefono = "";
			$this->ciudad = "";
			$this->direccion = "";
			$this->email = "";
			$this->contacto = "";
			$this->telefonoContacto = "";
			$this->estado = "";
			
			
		}
    }
	function __destruct (){ }
	public function setIdProveedor ($idProveedor){
		$this->idProveedor = $idProveedor;
	}
	
	public function getIdProveedor (){
		return $this->idProveedor;
	}
	public function setTipoProveedor ($tipoProveedor){
		$this->tipoProveedor = $tipoProveedor;
	}
	
	public function getTipoProveedor (){
		return $this->tipoProveedor;
	}
	public function setRazonSocial ($razonSocial){
		$this->razonSocial = $razonSocial;
	}
	
	public function getRazonSocial (){
		return $this->razonSocial;
	}
	public function setNit ($nit){
		$this->nit = $nit;
	}
	
	public function getNit (){
		return $this->nit;
	}
	public function setTelefono ($Telefono){
		$this->telefono = $telefono;
	}
	
	public function getTelefono (){
		return $this->telefono;
	}
	public function setCiudad ($ciudad){
		$this->ciudad = $ciudad;
	}
	
	public function getCiudad (){
		return $this->ciudad;
	}
	public function setDireccion ($direccion){
		$this->Direccion = $direccion;
	}
	
	public function getDireccion (){
		return $this->direccion;
	}
	public function setEmail ($email){
		$this->email = $email;
	}
	
	public function getEmail (){
		return $this->email;
	}
	public function setContacto ($contacto){
		$this->contacto = $contacto;
	}
	
	public function getContacto (){
		return $this->contacto;
	}
	public function setTelefonoContacto ($telefonoContacto){
		$this->telefonoContacto = $telefonoContacto;
	}
	
	public function getTelefonoContacto (){
		return $this->telefonoContacto;
	}
	public function setEstado ($estado){
		$this->estado = $estado;
	}
	
	public function getEstado (){
		return $this->estado;
	}
	
	
	public static function buscarForId($id){
		if ($id > 0){
			$pro = new Proveedor();
			$getrow = $pro->getRow("SELECT * FROM Proveedor WHERE idProveedor =?", array($id));
			$pro->idProveedor = $getrow['idProveedor'];
			$pro->razonSocial = $getrow['razonSocial'];
			$pro->nit = $getrow['nit'];
			$pro->telefono = $getrow['telefono'];
			$pro->ciudad = $getrow['ciudad'];
			$pro->direccion = $getrow['direccion'];
		    $pro->email = $getrow['email'];
			$pro->contacto = $getrow['contacto'];
			$pro->telefonoContacto = $getrow['telefonoContacto'];
			$pro->estado = $getrow['estado'];
			return $pro;
			
		}else{
			return NULL;
		}
		$this->Disconnect();
	}
	public static function buscarAll(){
		return Proveedor::buscar("idProveedor");	
	}
	
	public static function buscar($campo, $valor=array()){
        $arrProveedor = array();
		$tmp = new Proveedor();
		if (count($valor) > 0){
        	$getrows = $tmp->getRows("SELECT * FROM Proveedor WHERE ".$campo." = ?", $valor);
		}else{
        	$getrows = $tmp->getRows("SELECT * FROM Proveedor", $valor);
		}
        foreach ($getrows as $getrow) {
            $pro = new Proveedor();
			
			$pro->idProveedor = $getrow['idProveedor'];
			$pro->tipoProveedor = $getrow['tipoProveedor'];
			$pro->razonSocial = $getrow['razonSocial'];
			$pro->nit = $getrow['nit'];
			$pro->telefono = $getrow['telefono'];
			$pro->ciudad = $getrow['ciudad'];
			$pro->direccion = $getrow['direccion'];
			$pro->email = $getrow['email'];
			$pro->contacto = $getrow['contacto'];
			$pro->telefonoContacto = $getrow['telefonoContacto'];
			$pro->estado = $getrow['estado'];
            
            array_push($arrProveedor, $pro);
			$pro->Disconnect();
        }
        
        return $arrProveedor;
    }
    
	
	public function registrar (){
	     
		try {
			$this->insertRow("INSERT INTO Proveedor (idProveedor,tipoProveedor,razonSocial, nit, telefono,ciudad,  direccion,email,contacto, telefonoContacto,estado) VALUES ('NULL',?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",        
			 array( 
				    $this->tipoProveedor,
					$this->razonSocial,
					$this->nit,
					$this->telefono,
					$this->ciudad,
					$this->direccion,
					$this->email,
					$this->contacto,
					$this->telefonoContacto,
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
			$this->getRow("UPDATE Proveedor SET tipoProveedor = ?, razonSocial = ?, nit = ?, telefono = ?, ciudad = ? , direccion = ? , email = ? , contacto = ?, telefonoContacto = ? , estado = ?  WHERE idProveedor = ?", array( 
			        $this->tipoProveedor,
					$this->razonSocial,
					$this->nit,
					$this->telefono,
					$this->ciudad,
					$this->direccion,
					$this->email,
					$this->contacto,
					$this->telefonoContacto,
					$this->estado,
					
				    $this->idProveedor

				)
			);
			$this->Disconnect();
			return true;
		}catch(Exception $e) {
			throw new Exception($e->getMessage());
			return false;
		}
	}
	
	
    public function inactivar($id){
	
	}
	
}
