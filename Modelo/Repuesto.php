<?php
require_once ('Conexion.php');
require_once('UnidadMedida.php');
require_once('TipoRepuesto.php');


class Repuesto extends Conexion{
	private $idRepuesto;  
	private $marca;
	private $descripcion;
	private $referencia;
	private $stockMinimo;
	private $garantia;
	private $valorBase;
	private $stockActual;
	private $fechaVencimiento;
	private $estado;
	private $tipoRepuesto;
	private $unidadMedida;
	
	public function __construct($Repuesto_data=array()){
        parent::__construct();
		if(count($Repuesto_data)>1){
			foreach ($Repuesto_data as $campo => $valor){
               $this->$campo = $valor;
			}
		}else {
			$this->idRepuesto = "";
			$this->marca = "";
			$this->descripcion="";
			$this->referencia = "";
			$this->stockMinimo = "";
			$this->garantia = "";
			$this->valorBase = "";
			$this->stockActual = "";
			$this->fechaVencimiento = "";
			$this->estado = "";
			$this->tipoRepuesto = new TipoRepuesto();
			$this->unidadMedida = new UnidadMedida();
			
		}
	}
	
		function __destruct (){ }
		
        
		public function setIdRepuesto ($idRepuesto){
		$this->idRepuesto = $idRepuesto;
	    }
	
	    public function getIdRepuesto (){
		return $this->idRepuesto;
	    }
		
	    public function setMarca ($marca){
		$this->marca = $marca;
	    }
	
	    public function getMarca (){
		return $this->marca;
	    }
		
	    public function setDescripcion ($descripcion){
		$this->descripcion = $descripcion;
	    }
	
	    public function getDescripcion (){
		return $this->descripcion;
	    }
		
	    public function setReferencia ($referencia){
		$this->referencia = $referencia;
	    }
	
	    public function getReferencia (){
		return $this->referencia;
	    }
		
	    public function setStockMinimo ($stockMinimo){
		$this->stockMinimo = $stockMinimo;
	    }
	
	    public function getStockMinimo (){
		return $this->stockMinimo;
	    }
	    public function setGarantia ($garantia){
		$this->ciudad = $garantia;
	    }
	
	    public function getGarantia (){
		return $this->garantia;
	    }
		
	    public function setValorBase ($valorBase){
		$this->valorBase = $valorBase;
	    }
	
	    public function getValorBase (){
		return $this->valorBase;
	    }
		
	    public function setStockActual ($stockActual){
		$this->stockActual = $stockActual;
	    }
	
	    public function getStockActual (){
		return $this->stockActual;
	    }
		
	    public function setFechaVencimiento ($fechaVencimiento){
		$this->fechaVencimiento = $fechaVencimiento;
	    }
	
	    public function getFechaVencimiento (){
		return $this->fechaVencimiento;
	    }
	
	    public function setEstado ($estado){
		$this->estado = $estado;
	    }
	
	    public function getEstado (){
		return $this->estado;
	    }
		
	    public function setTipoRepuesto ($tipoRepuesto){
		$this->tipoRepuesto = $tipoRepuesto;
	    }
	
	    public function getTipoRepuesto (){
		return $this->tipoRepuesto;
	    }
		
	    public function setUnidadMedida ($unidadMedida){
		$this->unidadMedida = $unidadMedida;
	    }
	
	    public function getUnidadMedida (){
		return $this->unidadMedida;
	    } 
		
		
		public static function buscarForId($id){
		if ($id > 0){
			$rep = new Repuesto();
			$getrow = $rep->getRow("SELECT * FROM Repuesto WHERE idRepuesto =?", array($id));
			$rep->idRepuesto = $getrow['idRepuesto'];
			$rep->marca = $getrow['marca'];
			$rep->descripcion = $getrow['descripcion'];
			$rep->referencia = $getrow['referencia'];
			$rep->stockMinimo = $getrow['stockMinimo'];
			$rep->garantia = $getrow['garantia'];
		    $rep->valorBase = $getrow['valorBase'];
			$rep->stockActual = $getrow['stockActual'];
			$rep->fechaVencimiento = $getrow['fechaVencimiento'];
			$rep->estado = $getrow['estado'];
			$rep->tipoRepuesto = TipoRepuesto::buscarForId($getrow['tipoRepuesto']);
			$rep->unidadMedida = UnidadMedida::buscarForId($getrow['unidadMedida']);
			
			return $rep;
			
		}else{
			return NULL;
		}
		$this->Disconnect();
	}
	
	public static function buscarAll(){
		return Repuesto::buscar("idRepuesto");	
	}
	
	public static function buscar($campo, $valor=array()){
        $arrRepuesto = array();
		$tmp = new Repuesto();
		if (count($valor) > 0){
        	$getrows = $tmp->getRows("SELECT * FROM Repuesto WHERE ".$campo." = ?", $valor);
		}else{
        	$getrows = $tmp->getRows("SELECT * FROM Repuesto", $valor);
		}
        foreach ($getrows as $getrow) {
            $rep = new Repuesto();
			
			$rep->idRepuesto = $getrow['idRepuesto'];
			$rep->marca = $getrow['marca'];
			$rep->descripcion = $getrow['descripcion'];
			$rep->referencia = $getrow['referencia'];
			$rep->stockMinimo = $getrow['stockMinimo'];
			$rep->garantia = $getrow['garantia'];
			$rep->valorBase = $getrow['valorBase'];
			$rep->stockActual = $getrow['stockActual'];
			$rep->fechaVencimiento = $getrow['fechaVencimiento'];
			$rep->estado = $getrow['estado'];
			$rep->tipoRepuesto = TipoRepuesto::buscarForId($getrow['tipoRepuesto']);
			$rep->unidadMedida = UnidadMedida::buscarForId($getrow['unidadMedida']);
            
            array_push($arrRepuesto, $rep);
			$rep->Disconnect();
        }
        
        return $arrRepuesto;
    }
    public function registrar (){
	     
		try {
			$this->insertRow("INSERT INTO repuesto (idRepuesto,marca,descripcion, referencia, stockMinimo,garantia,valorBase,tipoRepuesto,unidadMedida,stockActual,fechaVencimiento,estado) VALUES ('NULL',?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",        
			 array( 
				    $this->marca,
					$this->descripcion,
					$this->referencia,
					$this->stockMinimo,
					$this->garantia,
					$this->valorBase,
					$this->stockActual,
					$this->fechaVencimiento,
					$this->estado,
					$this->tipoRepuesto-> getIdTipoRepuesto(),
					$this->unidadMedida->getIdUnidadMedida()
					
					
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
			$this->getRow("UPDATE Repuesto SET marca = ?, descripcion = ?, referencia = ?, stockMinimo = ?, garantia = ?, valorBase = ? , stockActual = ?, fechaVencimiento =?, estado = ? , tipoRepuesto = ? , unidadMedida = ? WHERE idRepuesto = ?", array( 
					$this->marca,
					$this->descripcion,
					$this->referencia,
					$this->stockMinimo,
					$this->garantia,
					$this->valorBase,
					$this->stockActual,
					$this->fechaVencimiento,
					$this->estado,
					$this->tipoRepuesto->  getIdTipoRepuesto(),
					$this->unidadMedida->getIdUnidadMedida()
					
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