<?php
require_once ('Conexion.php');
require_once('Repuesto.php');
require_once('Pedido.php');

class DescripcionPedido extends Conexion{
	
	private $idDescripcionPedido;  
	private $cantidad;
	private $porcentaje;
	private $ubicacion;
	private $valorUnitario;
	private $estado;
	private $repuesto;
	private $pedido;
	
	public function __construct($Repuesto_data=array()){
        parent::__construct();
		if(count($Repuesto_data)>1){
			foreach ($Repuesto_data as $campo => $valor){
               $this->$campo = $valor;
			}
		}else {
			$this->idDescripcionPedido = "";
			$this->cantidad = "";
			$this->porcentaje ="";
			$this->ubicacion = "";
			$this->valorUnitario = "";
			$this->estado = "";
			$this->repuesto = new Repuesto();
			$this->pedido = new Pedido();
    }
	
	function __destruct (){ }
		
        }
	
	public function setIdDescripcionPedido ($idDescripcionPedido){
		$this->idDescripcionPedido = $idDescripcionPedido;
	    }
	
	    public function getIdDescripcionPedido (){
		return $this->idDescripcionPedido;
	    }
		
	    public function seCantidad ($cantidad){
		$this->cantidad = $cantidad;
	    }
	
	    public function getCantidad (){
		return $this->cantidad;
	    }
		
	    public function setPorcentaje ($porcentaje){
		$this->porcentaje = $porcentaje;
	    }
	
	    public function getPorcentaje (){
		return $this->porcentaje;
	    }
		
	    public function setUbicacion ($ubicacion){
		$this->ubicacion = $ubicacion;
	    }
	
	    public function getUbicacion (){
		return $this->ubicacion;
	    }
		
	    public function setValorUnitario ($valorUnitario){
		$this->valorUnitario = $valorUnitario;
	    }
	
	    public function getValorUnitario (){
		return $this->valorUnitario;
	    }
	
	    public function setEstado ($estado){
		$this->estado = $estado;
	    }
	
	    public function getEstado (){
		return $this->estado;
	    }
		
	    public function setRepuesto ($repuesto){
		$this->repuesto = $repuesto;
	    }
	
	    public function getRepuesto (){
		return $this->repuesto;
	    }
		
	    public function setPedido ($pedido){
		$this->pedido = $pedido;
	    }
	
	    public function getPedido (){
		return $this->pedido;
	    } 
		
		public static function buscarForId($id){
		if ($id > 0){
			$des = new DescripcionPedido();
			$getrow = $rep->getRow("SELECT * FROM DescripcionPedido WHERE idDescripcionPedido =?", array($id));
			
			$des->idDescripcionPedido = $getrow['idDescripcionPedido'];
			$des->cantidad = $getrow['cantidad'];
			$des->porcentaje = $getrow['porcentaje'];
			$des->ubicacion = $getrow['ubicacion'];
			$des->valorUnitario = $getrow['valorUnitario'];
			$des->estado = $getrow['estado'];
			$des->repuesto = Repuesto::buscarForId($getrow['repuesto']);
			$des->pedido = Pedido::buscarForId($getrow['pedido']);
			
			return $des;
			
		}else{
			return NULL;
		}
		$this->Disconnect();
	}
	
		public static function buscarAll(){
		return Repuesto::buscar("idDescripcionPedido");	
	}
	
	public static function buscar($campo, $valor=array()){
        $arrDescripcionPedido = array();
		$tmp = new DescripcionPedido();
		if (count($valor) > 0){
        	$getrows = $tmp->getRows("SELECT * FROM DescripcionPedido WHERE ".$campo." = ?", $valor);
		}else{
        	$getrows = $tmp->getRows("SELECT * FROM DescripcionPedido", $valor);
		}
        foreach ($getrows as $getrow) {
            $des = new DescripcionPedido();
			
			$des->idDescripcionPedido = $getrow['idDescripcionPedido'];
			$des->cantidad = $getrow['cantidad'];
			$des->porcentaje = $getrow['porcentaje'];
			$des->ubicacion = $getrow['ubicacion'];
			$des->valorUnitario = $getrow['valorUnitario'];
			$des->estado = $getrow['estado'];
			$des->repuesto = Repuesto::buscarForId($getrow['repuesto']);
			$des->pedido = Pedido::buscarForId($getrow['pedido']);
            
            array_push($arrDescripcionPedido, $des);
			$des->Disconnect();
        }
        
        return $arrDescripcionPedido;
    }
	public function registrar (){
	     
		try {
			$this->insertRow("INSERT INTO DescripcionPedido (idDescripcionPedido,cantidad,porcentaje, ubicacion, valorUnitario,estado,repuesto,pedido) VALUES ('NULL',?, ?, ?, ?, ?, ?, ?)",        
			 array( 
				    $this->cantidad,
					$this->porcentaje,
					$this->ubicacion,
					$this->valorUnitario,
					$this->estado,
					$this->repuesto-> getIdRepuesto(),
					$this->pedido->getIdPedido()
					
					
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
			$this->getRow("UPDATE DescripcionPedido SET cantidad = ?,porcentaje = ?, ubicacion = ?, valorUnitario = ?, estado = ? , repuesto = ? , pedido = ? WHERE idDescripcionPedido = ?", array( 
			
					$this->cantidad,
					$this->porcentaje,
					$this->ubicacion,
					$this->valorUnitario,
					$this->estado,
					$this->repuesto-> getIdRepuesto(),
					$this->pedido->getIdPedido()
					
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

