<?php
require_once('../modelo/Conexion.php');

require_once('../modelo/Persona.php');



class Venta extends Conexion {
	
	private $idventa;
	private $fechaVenta;
	private $descripcion;
	private $referencia;
	private $cliente;
	private $vendedor;
	private $estado;
	
    
		
	public function __construct($venta_data=array()){
        parent::__construct();
		if(count($venta_data)>1){
			foreach ($venta_data as $campo => $valor){
               $this->$campo = $valor;
			}
		}else {
			$this->idventa = "";
			$this->fechaVenta = "";
			$this->descripcion = "";
			$this->referencia = "";
			$this->cliente = new Persona ();
			$this->vendedor = new Persona ();
			$this->estado = "";

		}
    }
	
	function __destruct (){ }
	
	public function setIdVenta ($idventa){
		$this->idventa = $idventa;
	}
	
	public function getIdVenta (){
		return $this->idventa;
	}	
	
	public function setFechaVenta ($fechaVenta){
		$this->fechaVenta = $fechaVenta;
	}
	
	public function getFechaVenta (){
		return $this->fechaVenta;
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
	
	public function setEstado ($idventa){
		$this->estado = $idventa;
	}
	
	public function getEstado (){
		return $this->estado;
	}
	
	public function setCliente ($cliente){
		$this->cliente = $cliente;
	}
	
	public function getCliente (){
		return $this->cliente;
	}
	
	public function setVendedor ($vendedor){
		$this->vendedor = $vendedor;
	}
	
	public function getVendedor (){
		return $this->vendedor;
	}
	
    public static function buscarForId($id){
		if ($id > 0){
			$vent = new venta();
			$getrow = $ins->getRow("SELECT * FROM Venta WHERE idVenta =?", array($id));
			$ins->idVenta = $getrow['idVenta'];
			$ins->fechaVenta = $getrow['fechaVenta'];
			$ins->descripcion = $getrow['descripcion'];
			$ins->referencia = $getrow['referencia'];
			$ins->estado = $getrow['estado'];
			$ins->vendedor = Persona::buscarForId($getrow['vendedor']);
			$ins->cliente = Persona::buscarForId($getrow['cliente']);

			$ins->Disconnect();
			return $ins;
		}else{
			return NULL;
		}
		$this->Disconnect();
	}
	
	public static function buscarAll(){
		return venta::buscar("idVenta");
	}
	
	public static function buscar($campo, $valor=array()){
        $arrVenta = array();
		if (count($valor) > 0){
        	$getrows = $tmp->getRows("SELECT * FROM Venta WHERE ".$campo." = ?", array($valor));
		}else{
        	$getrows = $tmp->getRows("SELECT * FROM Venta", $valor);
		}
        foreach ($getrows as $valor) {
            $ins->idVenta = $getrow['idVenta'];
			$ins->fechaVenta = $getrow['fechaVenta'];
			$ins->descripcion = $getrow['descripcion'];
			$ins->referencia = $getrow['referencia'];
			$ins->estado = $getrow['estado'];
			$ins->vendedor = Persona::buscarForId($getrow['vendedor']);
			$ins->cliente = Persona::buscarForId($getrow['cliente']);

			array_push($arrVenta, $ins);
        }
        $ins->Disconnect();
        return $arrVenta;
	}
    
	public function inactivar($id){
	
	}
	
	public function registrar (){
		
		try {
			//var_dump($this);
			$this->insertRow("INSERT INTO venta (idVenta, fechaVenta, descripcion, referencia, vendedor, cliente, estado) VALUES ('NULL', ?, ?, ?, ?, ?, ?)",
				 array( 
					$this->fechaVenta,
					$this->descripcion,
					$this->referencia,
					$this->vendedor->getIdPersona(),
					$this->cliente->getIdPersona(),
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
			$this->getRow("UPDATE venta SET fechaVenta = ?, descripcion = ?, referencia = ?, estado = ?, vendedor = ?, cliente = ?, WHERE idVenta = ?", array( 
				 	$this->fechaVenta,
					$this->descripcion,
					$this->referencia,
					$this->estado,
					$this->vendedor,
					$this->cliente -> getIdPersona(),
					$this->vendedor -> getIdPersona(),
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
