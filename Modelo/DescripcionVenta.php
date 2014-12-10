<?php 
require_once ('Conexion.php');
require_once('../modelo/Persona.php');
require_once('../modelo/Repuesto.php');

class DescripcionVenta extends Conexion {
	
	private $idDescripcionVenta;
	private $cantidad;
	private $valorVenta;
	private $descripcion;
	private $valorTotal;
	private $venta;
	private $repuesto;
	private $estado;
	
    
		
	public function __construct($DescripcionVenta_data=array()){
        parent::__construct();
		if(count($DescripcionVenta_data)>1){
			foreach ($DescripcionVenta_data as $campo => $valor){
               $this->$campo = $valor;
			}
		}else {
			$this->idDescripcionVenta = "";
			$this->cantidad = "";
			$this->valorVenta = "";
			$this->descripcion = "";
			$this->valorTotal = "";
			$this->venta = new Venta ();
			$this->repuesto = new Repuesto ();
		    $this->estado = "";
		}
    }
	
	function __destruct (){ }
	
	public function setIdDescripcionVenta ($idDescripcionVenta){
		$this->idDescripcionVenta = $idDescripcionVenta;
	}
	
	public function getIdDescripcionVenta (){
		return $this->idDescripcionVenta;
	}	
	
	public function setCantidad ($cantidad){
		$this->cantidad = $cantidad;
	}
	
	public function getCantidad (){
		return $this->cantidad;
	}
	
	public function setValorVenta($valorVenta){
		$this->valorVenta = $valorVenta;
	}
	
	public function getValorVenta (){
		return $this->valorVenta;
	}
	
		
	
	public function setDescripcion ($descripcion){
		$this->descripcion = $descripcion;
	}
	
	public function getDescripcion (){
		return $this->descripcion;
	}
	
	public function setValorTotal ($valorTotal ){
		$this->valorTotal  = $valorTotal ;
	}
	
	public function getValorTotal  (){
		return $this->valorTotal ;
	}
	public function setRepuesto ($repuesto){
		$this->repuesto = $repuesto;
	}
	
	public function getRepuesto (){
		return $this->repuesto;
	}
	
	public function setVenta ($venta){
		$this->venta = $venta;
	}
	
	public function getVenta (){
		return $this->venta;
	}
	public function setEstado ($estado){
		$this->estado = $estado;
	}
	
	public function getEstado (){
		return $this->estado;
	}
	
	
	
    public static function buscarForId($id){
		if ($id > 0){
			$descP = new venta();
			$getrow = $ins->getRow("SELECT * FROM Venta WHERE idDescripcionVenta =?", array($id));
			$ins->idDescripcionVenta = $getrow['idDescripcionVenta'];
			$ins->cantidad = $getrow['cantidad'];
			$ins->valorVenta = $getrow['valorTotal'];
			$ins->descripcionVenta = DescripcionVenta::buscarForId($getrow['descripcionVenta']);

			$ins->Disconnect();
			return $ins;
		}else{
			return NULL;
		}
		$this->Disconnect();
	}
	
	public static function buscarAll(){
		return venta::buscar("idDescripcionVenta");
	}
	
	public static function buscar($campo, $valor=array()){
        $arrDescripcionVenta = array();
		if (count($valor) > 0){
        	$getrows = $tmp->getRows("SELECT * FROM DescripcionVenta WHERE ".$campo." = ?", array($valor));
		}else{
        	$getrows = $tmp->getRows("SELECT * FROM DescripcionVenta", $valor);
		}
        foreach ($getrows as $valor) {
            $ins = new DescripcionVenta();
			$ins->idDescripcionVenta = $getrow['idDescripcionVenta'];
			$ins->cantidad = $getrow['cantidad'];
			$ins->valorVenta = $getrow['valorVenta'];
			$ins->descripcion = $getrow['descripcion'];
			$ins->valorTotal = $getrow['valorTotal'];
			$ins->estado = $getrow['estado'];
			$ins->venta = Venta::buscarForId($getrow['venta']);
			$ins->repuesto = Repuesto::buscarForId($getrow['repuesto']);

			array_push($arrDescripcionVenta, $ins);
        }
        $ins->Disconnect();
        return $arrDescripcionVenta;
	}
    
	public function inactivar($id){
	
	}
	
	public function registrar (){
		var_dump($this);
		try {
			$this->insertRow("INSERT INTO DescripcionVenta (idDescripcionVenta, cantidad, valorVenta, descripcion, valorTotal, venta, repuesto, estado 
				VALUES ('NULL', ?, ?, ?, ?, ?, ?, ?)",
				
				 array( 
					$this->cantidad,
					$this->valorVenta,
					$this->descripcion,
					$this->valorTotal,
					$this->estado,
					$this->venta -> getIdVenta(),
					$this->repuesto -> getIdRepuesto(),
					
					
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
			$this->getRow("UPDATE DescripcionVenta SET cantidad = ?,  valorVenta= ?, descripcion = ?, valorTotal = ?, venta = ?, repuesto = ?, estado = ?, WHERE idDescripcionVenta = ?", array( 
				 	$this->cantidad,
					$this->valorVenta,
					$this->descripcion,
					$this->valorTotal,
					$this-> estado,
					$this->venta -> getIdVenta(),
					$this->repuesto -> getIdRepuesto(),
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