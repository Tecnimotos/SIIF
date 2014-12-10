<?php
require_once ('Conexion.php');


class UnidadMedida extends Conexion {
	
	private $idUnidadMedida;  
	private $nombre;
	private $descripcion;
	private $Tipo;
	private $estado;
	

	public function __construct($UnidadMedida_data=array()){
        parent::__construct();
		if(count($UnidadMedida_data)>1){
			foreach ($UnidadMedida_data as $campo => $valor){
               $this->$campo = $valor;
			}
		}else {
			$this->idUnidadMedida = "";
			$this->nombre = "";
			$this->descripcion="";
			$this->Tipo="";
			$this->estado = "";
			
		}
    }

	function __destruct (){ }

	public function setIdUnidadMedida ($idUnidadMedida){
		$this->idUnidadMedida = $idUnidadMedida;
	}
	
	public function getIdUnidadMedida (){
		return $this->idUnidadMedida;
	}

	public function setNombre ($nombre){
		$this->nombre = $nombre;
	}

	public function getNombre (){
		return $this->nombre;
	}

	public function setDescripcion ($descripcion){
		$this->descripcion = $descripcion;
	}
	
	public function getDescripcion (){
		return $this->descripcion;
	}

	public function setTipo ($tipo){
		$this->tipo = $tipo;
	}

	public function getTipo (){
		return $this->tipo;
	}
	
	public function setEstado ($estado){
		$this->estado = $estado;
	}

	public function getEstado (){
		return $this->estado;
	}

	public static function buscarForId($id){
		if ($id > 0){
			$per = new UnidadMedida();
			$getrow = $per->getRow("SELECT * FROM unidadmedida WHERE idUnidadMedida =?", array($id));
			$per->idUnidadMedida = $getrow['idUnidadMedida'];
			$per->nombre = $getrow['nombre'];	
			$per->descripcion = $getrow['descripcion'];	
			$per->tipo = $getrow['tipo'];			
			$per->estado = $getrow['estado'];
			
			return $per;
			
		}else{
			return NULL;
		}
		$this->Disconnect();
	}

	public static function buscarAll(){
		return UnidadMedida::buscar("idUnidadMedida");	
	}

	public static function buscar($campo, $valor=array()){
        $arrUnidadMedida = array();
		$tmp = new UnidadMedida();
		if (count($valor) > 0){
        	$getrows = $tmp->getRows("SELECT * FROM unidadmedida WHERE ".$campo." = ?", $valor);
		}else{
        	$getrows = $tmp->getRows("SELECT * FROM unidadmedida", $valor);
		}
        foreach ($getrows as $getrow) {
            $per = new UnidadMedida();
			
			$per->idUnidadMedida = $getrow['idUnidadMedida'];
			$per->nombre = $getrow['nombre'];
			$per->descripcion = $getrow['descripcion'];
			$per->tipo = $getrow['tipo'];
			$per->estado = $getrow['estado'];

            array_push($arrUnidadMedida, $per);
			$per->Disconnect();
        }
        
        return $arrUnidadMedida;
    }
    
	public function inactivar($id){
	
	}
	public function registrar (){
	     
		try {
			$this->insertRow("INSERT INTO unidadmedida (idUnidadMedida,nombre,descripcion,tipo, estado) VALUES ('NULL',?,?,?,?)",        
			 array( 
			 		$this->nombre,
				    $this->descripcion,
				    $this->tipo,
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
			$this->getRow("UPDATE TipoRepuesto SET Nombre = ?, Descripcion = ?, Tipo = ?, Estado = ? WHERE idUnidadMedida = ?", array( 
			        $this->nombre,
			        $this->descripcion,
			        $this->tipo,
					$this->estado,
					
				    $this->idUnidadMedida

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