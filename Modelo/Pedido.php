<?php
require_once ('Conexion.php');
require_once('Proveedor.php');
require_once('Persona.php');

class Pedido extends Conexion{
	
	private $idPedido;  
	private $fecha;
	private $referencia;
	private $estado;
	private $proveedor;
	private $persona;

	public function __construct($Pedido_data=array()){
        parent::__construct();
		if(count($Pedido_data)>1){
			foreach ($Pedido_data as $campo => $valor){
               $this->$campo = $valor;
			}
		}else {
			$this->idPedido = "";
			$this->fecha = "";
			$this->referencia="";
			
			$this->proveedor = new Proveedor();
			$this->persona = new Persona();
			
		}
		}
		function __destruct (){ }
		
        
		public function setIdPedido ($idPedido){
		$this->idPedido = $idPedido;
	    }
	
	    public function getIdPedido (){
		return $this->idPedido;
	    }
		
		public function setFecha ($fecha){
		$this->fecha = $fecha;
	    }
	
	    public function getFecha (){
		return $this->fecha;
	    }
		public function setReferencia ($referencia){
		$this->referencia = $referencia;
	    }
	
	    public function getReferencia (){
		return $this->referencia;
	    }
		
		
		
		 public function setProveedor ($proveedor){
		$this->proveedor = $proveedor;
	    }
	
	    public function getProveedor (){
		return $this->proveedor;
	    }
		
	    public function setPersona ($persona){
		$this->persona = $persona;
	    }
	
	    public function getPersona (){
		return $this->persona;
	    } 
		
		
		
		public static function buscarForId($id){
		if ($id > 0){
			$ped = new Pedido();
			$getrow = $ped->getRow("SELECT * FROM Pedido WHERE idPedido = ?", array($id));
			$ped->idPedido = $getrow['idPedido'];
			$ped->fecha = $getrow['fecha'];
			$ped->referencia = $getrow['referencia'];
			$ped->estado = $getrow['estado'];
			$ped->proveedor = Proveedor::buscarForId($getrow['proveedor']);
			$ped->persona = Persona::buscarForId($getrow['persona']);
			
			return $ped;
			
		}else{
			return NULL;
		}
		$this->Disconnect();
	}
	
	public static function buscarAll(){
		return Repuesto::buscar("idPedido");	
	}
	public static function buscar($campo, $valor=array()){
        $arrPedido = array();
		$tmp = new Pedido();
		if (count($valor) > 0){
        	$getrows = $tmp->getRows("SELECT * FROM Pedido WHERE ".$campo." = ?", $valor);
		}else{
        	$getrows = $tmp->getRows("SELECT * FROM Pedido", $valor);
		}
        foreach ($getrows as $getrow) {
            $ped = new Pedido();
			
			$ped->idPedido = $getrow['idPedido'];
			$ped->fecha = $getrow['fecha'];
			$ped->referencia = $getrow['referencia'];
			$ped->estado = $getrow['estado'];
			$ped->proveedor = Proveedor::buscarForId($getrow['proveedor']);
			$ped->persona = Persona::buscarForId($getrow['persona']);
            
            array_push($arrPedido, $ped);
			$ped->Disconnect();
        }
        
        return $arrPedido;
    }
	
	
	
	public function actualizar (){
		
		try {
			$this->getRow("UPDATE Pedido SET fecha = ?,  referencia = ?, estado = ?, proveedor = ?, persona = ?  WHERE idPedido = ?", array( 
					$this->fecha,
					$this->referencia,
					$this->estado,
					$this->proveedor-> getIdProveedor(),
					$this->persona->getIdPersona()
					
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
	public function registrar (){
	     
		try {
			$this->insertRow("INSERT INTO Pedido (idPedido,fecha,referencia,proveedor,persona) VALUES ('NULL',?, ?, ?, ?)",        
			 array( 
				    $this->fecha,
					$this->referencia,
					
					$this->proveedor->getIdProveedor(),
					$this->persona->getIdPersona()
						
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