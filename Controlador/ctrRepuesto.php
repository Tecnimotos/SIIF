<?php

require_once('../Modelo/Repuesto.php');


if(!empty($_GET['action'])){
	ctrRepuesto::main($_GET['action']);
	
}

	class ctrRepuesto{
	
	static function main($action){
		if ($action == "registrar"){
			ctrRepuesto::registrar();
		}else if ($action == "buscarID"){
			ctrRepuesto::buscarID(1);
		}else if ($action == "actualizar"){
			ctrRepuesto::actualizar($_POST['idRepuesto']);
		}
	

}
        static public function buscarID ($id){
		try {
			return Repuesto::buscarForId("idRepuesto");
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function buscarAll (){
		try {
			return Repuesto::buscarAll();
		} catch (Exception $e) {
			header("");
		}
	}

	static public function buscar ($campo, $parametro){
		try {
			return Repuesto::buscar($campo, $parametro);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function inactivar($id){
	
	}
	
	static public function registrar (){
		//try {
			$arrayRepuesto = array();
			$arrayRepuesto['marca'] = $_POST['marca'];
			$arrayRepuesto['descripcion'] = $_POST['descripcion'];
			$arrayRepuesto['referencia'] = $_POST['referencia'];
			$arrayRepuesto['stockMinimo'] = $_POST['stockMinimo'];
			$arrayRepuesto['garantia'] = $_POST['garantia'];
			$arrayRepuesto['valorBase'] = $_POST['valorBase'];
			$arrayRepuesto['stockActual'] = $_POST['stockActual'];
			
			$arrayRepuesto['estado'] = "Activo";
			$arrayRepuesto['tipoRepuesto'] = TipoRepuesto::buscarForId($_POST['idTipoRepuesto']);
			$arrayRepuesto['unidadMedida'] = UnidadMedida::buscarForId($_POST['idUnidadMedida']);
			$arrayRepuesto['fechaVencimiento'] = $_POST['fechaVencimiento'];
			
			$Repuesto = new Repuesto ($arrayRepuesto);
			$Repuesto->registrar();
			header("Location: ../Vista/Index.php?respuesta=correcto");
		//} catch (Exception $e) {
			header("Location: ../Vista/Index.php?respuesta=error");
		}
	//}
	static public function actualizar (){
		try {
			$arrayRepuesto = array();
			$arrayRepuesto['marca'] = $_POST['marca'];
			$arrayRepuesto['descripcion'] = $_POST['descripcion'];
			$arrayRepuesto['referencia'] = $_POST['referencia'];
			$arrayRepuesto['stockMinimo'] = $_POST['stockMinimo'];
			$arrayRepuesto['garantia'] = $_POST['garantia'];
			$arrayRepuesto['valorBase'] = $_POST['valorBase'];
			$arrayRepuesto['stockActual'] = $_POST['stockActual'];
			$arrayRepuesto['fechaVencimiento'] = $_POST['fechaVencimiento'];
			$arrayRepuesto['estado'] = $_POST['estado'];
			$arrayRepuesto['tipoRepuesto'] = TipoRepuesto::buscarForId($_POST['idTipoRepuesto']);
			$arrayRepuesto['unidadMedida'] = UnidadMedida::buscarForId($_POST['idUnidadMedida']);
			
			$Repuesto = new Repuesto ($arrayRepuesto);
			$Repuesto->actualizar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	static public function getList ($name){
		try {
			$text = "<select name='".$name."' id='".$name."'>". "onchange = muestrarepuesto(this.value)";
			$arrRepuesto = ctrRepuesto::buscarAll();
			$text .= "<option selected value='0'>Seleccione una opción</option>";
			foreach ($arrRepuesto as $Repuesto){
				$text .= "<option value=".$Repuesto->getIdRepuesto().">".$Repuesto->getMarca()." ".$Repuesto->getDescripcion()."</option>";
			}
			$text .= "</select>";			
			return $text;
		} catch (Exception $e) {
			return "Error al cargar los datos";
		}
	}
	
	}
	

?>