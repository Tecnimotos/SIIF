    <?php
require_once ('Conexion.php');


class TipoRepuesto extends Conexion{
	
	private $idTipoRepuesto;  
	private $nombre;
	private $descripcion;
	private $estado;
	

	public function __construct($TipoRepuesto_data=array()){
        parent::__construct();
		if(count($TipoRepuesto_data)>1){
			foreach ($TipoRepuesto_data as $campo => $valor){
               $this->$campo = $valor;
			}
		}else {
			$this->idTipoRepuesto = "";
			$this->nombre = "";
			$this->descripcion="";
			$this->estado = "";
			
		}
    }
	function __destruct (){ }

	public function setIdTipoRepuesto ($idTipoRepuesto){
		$this->idTipoRepuesto = $idTipoRepuesto;
	}
	
	public function getIdTipoRepuesto (){
		return $this->idTipoRepuesto;
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
	
	public function setEstado ($estado){
		$this->estado = $estado;
	}

	public function getEstado (){
		return $this->estado;
	}

	public static function buscarForId($id){
		if ($id > 0){
			$per = new TipoRepuesto();
			$getrow = $per->getRow("SELECT * FROM TipoRepuesto WHERE idTipoRepuesto =?", array($id));
			$per->idTipoRepuesto = $getrow['idTipoRepuesto'];
			$per->nombre = $getrow['nombre'];	
			$per->descripcion = $getrow['descripcion'];				
			$per->estado = $getrow['estado'];
			
			return $per;
			
		}else{
			return NULL;
		}
		$this->Disconnect();
	}

	public static function buscarAll(){
		return TipoRepuesto::buscar("idTipoRepuesto");	
	}

	public static function buscar($campo, $valor=array()){
        $arrTipoRepuesto = array();
		$tmp = new TipoRepuesto();
		if (count($valor) > 0){
        	$getrows = $tmp->getRows("SELECT * FROM TipoRepuesto WHERE ".$campo." = ?", $valor);
		}else{
        	$getrows = $tmp->getRows("SELECT * FROM TipoRepuesto", $valor);
		}
        foreach ($getrows as $getrow) {
            $per = new TipoRepuesto();
			
			$per->idTipoRepuesto = $getrow['idTipoRepuesto'];
			$per->nombre = $getrow['nombre'];
			$per->descripcion = $getrow['descripcion'];
			$per->estado = $getrow['estado'];

            array_push($arrTipoRepuesto, $per);
			$per->Disconnect();
        }
        
        return $arrTipoRepuesto;
    }
    
	public function inactivar($id){
	
	}
	public function registrar (){
	     
		try {
			$this->insertRow("INSERT INTO tiporepuesto (idTipoRepuesto,nombre,descripcion, estado) VALUES ('NULL',?, ?,?)",        
			 array( 
			 		$this->nombre,
				    $this->descripcion,
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
			$this->getRow("UPDATE TipoRepuesto SET Nombre = ?, Descripcion = ?, Estado = ? WHERE idTipoRepuesto = ?", array( 
			        $this->nombre,
			        $this->descripcion,
					$this->estado,
					
				    $this->idTipoRepuesto

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