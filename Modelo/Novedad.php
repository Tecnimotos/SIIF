<?php
require_once('Conexion.php');
require_once('../modelo/Venta.php');
require_once('../modelo/Repuesto.php');





class Novedad extends Conexion {
	
	private $idNovedad;
	private $tipoNovedad;
	private $repuestoEntrante;
	private $repuestoSalida;
	private $fechaNovedad;
	private $descripcion;
	private $excedente;
	private $reembolso;
	private $venta;
    
		
	public function __construct($Novedad_data=array()){
        parent::__construct();
		if(count($Novedad_data)>1){
			foreach ($Novedad_data as $campo => $valor){
               $this->$campo = $valor;
			}
		}else {
			$this->idNovedad = "";
			$this->tipoNovedad = "";
			$this->repuestoEntrante = new Repuesto;
			$this->repuestoSalida= new Repuesto;
			$this->fechaNovedad="";
			$this->descripcion="";
			$this->excedente = "";
			$this->reembolso = "";
			$this->venta = new Venta;
			
			      

		}
    }
	
	function __destruct (){ }
	
	public function setIdNovedad ($idNovedad){
		$this->idNovedad = $idNovedad;
	}
	
	public function getIdNovedad (){
		return $this->idNovedad;
	}	
	
	public function setRepuestoEntrante ($repuestoEntrante){
		$this->repuestoEntrante = $repuestoEntrante;
	}
	
	public function getRepuestoEntrante (){
		return $this->repuestoEntrante;
	}
	
		
	public function setRepuestoSalida ($repuestoSalida){
		$this->repuestoSalida = $repuestoSalida;
	}
	
	public function getRepuestoSalida (){
		return $this->repuestoSalida;
	}
	
	public function setFechaNovedad ($fechaNovedad){
		$this->fechaNovedad = $fechaNovedad;
	}
	
	public function getFechaNovedad (){
		return $this->fechaNovedad;
	}
	
	public function setDescripcion ($descripcion){
		$this->descripcion = $descripcion;
	}
	
	public function getDescripcion (){
		return $this->descripcion;
	}
		public function setExcedente ($excedente){
		$this->excedente = $excedente;
	}
	
	public function getExcedente (){
		return $this->excedente;
	}
	
	public function setReembolso ($reembolso){
		$this->reembolso = $reembolso;
	}
	
	public function getReembolso (){
		return $this->reembolso;
	}
	public function setTipoNovedad ($tipoNovedad){
		$this->tipoNovedad = $tipoNovedad;
	}
	
	public function getTipoNovedad (){
		return $this->tipoNovedad;
	}
	public function setVenta ($venta){
		$this->venta = $venta;
	}
	
	public function getVenta (){
		return $this->venta;
	}
	
	
	
    public static function buscarForId($id){
		if ($id > 0){
			$provent = new productoventa();
			$getrow = $ins->getRow("SELECT * FROM Novedad WHERE idNovedad =?", array($id));
			$ins->idNovedad = $getrow['idNovedad'];
			$ins->repuestoSaliente = $getrow['repuestoSaliente'];
			$ins->fechaNovedad = $getrow['fechaNovedad'];
			$ins->descripcion = $getrow['descripcion'];
			$ins->excedente = $getrow['excedente'];
			$ins->rembolso = $getrow['rembolso'];
			$ins->tipodenovedad = $getrow['tipodenovedad'];
			$ins->repuestoEntrante = repuestoEntrante::buscarForId($getrow['repuestoEntrante']);
			$ins->repuestoSalida = repuestoSalida::buscarForId($getrow['repuestoSalida']);
			$ins->venta = venta::buscarForId($getrow['venta']);
			
			

			$ins->Disconnect();
			return $ins;
		}else{
			return NULL;
		}
		$this->Disconnect();
	}
	
	public static function buscarAll(){
		return pedido::buscar("idNovedad");
	}
	
	public static function buscar($campo, $valor=array()){
        $arrpedido = array();
		if (count($valor) > 0){
        	$getrows = $tmp->getRows("SELECT * FROM Novedad WHERE ".$campo." = ?", array($valor));
		}else{
        	$getrows = $tmp->getRows("SELECT * FROM Novedad", $valor);
		}
        foreach ($getrows as $valor) {
           	$ins->idNovedad = $getrow['idNovedad'];
			$ins->repuestoSaliente = $getrow['repuestoSaliente'];
			$ins->fechaNovedad = $getrow['fechaNovedad'];
			$ins->descripcion = $getrow['descripcion'];
			$ins->excedente = $getrow['excedente'];
			$ins->rembolso = $getrow['rembolso'];
			$ins->tipoNovedad = $getrow['tipoNovedad'];
			$ins->repuestoEntrante = Repuesto::buscarForId($getrow['repuestoEntrante']);
			$ins->repuestoSalida = Repuesto::buscarForId($getrow['repuestoSalida']);
			$ins->venta = Venta::buscarForId($getrow['venta']);
			
			array_push($arrnovedad, $ins);
        }
        $ins->Disconnect();
        return $arrnovedad;
	}
    
	public function inactivar($id){
	
	}
	
	public function registrar (){
		var_dump($this);
		try {
			$this->insertRow("INSERT INTO Novedad (idNovedad, repuestoEntrante, repuestoSalida, rechaNovedad, descripcion, excedente, reembolso,venta,tipoNovedad
				VALUES ('NULL', ?, ?, ?, ?, ?, ?, ?, ? )",
				
				 array( 
				    $this->tipoNovedad,
					$this->fechaNovedad,
					$this->descripcion,
					$this->excedente,
					$this->reembolso,
					$this->venta -> getIdVenta(),
					$this->repuestoEntrante -> getIdRepuesto(),
					$this->repuestoSalida -> getIdRepuesto
					
									
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
			$this->getRow("UPDATE Novedad SET repuestoEntrante = ?, repuestoSalida = ?, fechaNovedad = ?, descripcion = ?, excedente = ?, reembolso = ?, venta =?,   WHERE idPedido = ?", array( 
			        $this->tipoNovedad,
				   
					$this->fechaNovedad,
					$this->descripcion,
					$this->excedente,
					$this->reembolso,
				
					
					$this->venta -> getIdVenta(),
					$this->repuestoEntrante -> getIdRepuesto(),
					$this->repuestoSalida -> getIdRepuesto
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
