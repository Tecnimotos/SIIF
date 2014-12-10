<?php

require_once('../Modelo/UnidadMedida.php');


if(!empty($_GET['action'])){
	ctrUnidadMedida::main($_GET['action']);

}

class ctrUnidadMedida{
	
	static function main($action){
		if ($action == "registrar"){
			ctrUnidadMedida::registrar();
		}else if ($action == "buscarID"){
			ctrUnidadMedida::buscarID(1);
		}else if ($action == "actualizar"){
			ctrUnidadMedida::actualizar($_POST['idUnidadMedida']);
		}
	}
	
	static public function buscarID ($id){
		try {
			return UnidadMedida::buscarForId($id);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function buscarAll (){
		try {
			return UnidadMedida::buscarAll();
		} catch (Exception $e) {
			header("");
		}
	}

	static public function buscar ($campo, $parametro){
		try {
			return UnidadMedida::buscar($campo, $parametro);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function inactivar($id){
	
	}
	
	static public function registrar (){
		try {
			$arrayUnidadMedida = array();
			$arrayUnidadMedida['nombre'] = $_POST['nombre'];
			$arrayUnidadMedida['descripcion'] = $_POST['descripcion'];
			$arrayUnidadMedida['tipo'] = $_POST['tipo'];
			$arrayUnidadMedida['estado'] = "Activo";
			
			$UnidadMedida = new UnidadMedida ($arrayUnidadMedida);
			$UnidadMedida->registrar();
			header("Location: ../Vista/Index.php?respuesta=correcto");
		} catch (Exception $e) {
			header("Location: ../Vista/Index.php?respuesta=error");
		}
	}

	static public function actualizar (){
		try {
			$arrayUnidadMedida = array();
			$arrayUnidadMedida['nombre'] = $_POST['nombre'];
			$arrayUnidadMedida['descrpcion'] = $_POST['descrpcion'];
			$arrayUnidadMedida['tipo'] = $_POST['tipo'];
			$arrayUnidadMedida['estado'] = $_POST['estado'];
			
			$UnidadMedida = new UnidadMedida ($arrayUnidadMedida);
			$UnidadMedida->actualizar();
			header("Location: ../Vista/updateVehiculo.php?respuesta=correcto");
		} catch (Exception $e) {
			header("Location: ../Vista/updateVehiculo.php?respuesta=error");
		}
	}
	
	static public function getList ($name){
		try {
			$text = "<select name='".$name."' id='".$name."'>". "onchange = muestraunidadmedida(this.value)";
			$arrUnidadMedida = ctrUnidadMedida::buscarAll();
			$text .= "<option selected value='0'>Seleccione una opción</option>";
			foreach ($arrUnidadMedida as $UnidadMedida){
				$text .= "<option value=".$UnidadMedida->getIdUnidadMedida().">".$UnidadMedida->getNombre()." ".$UnidadMedida->getDescripcion()."</option>";
			}
			$text .= "</select>";			
			return $text;
		} catch (Exception $e) {
			return "Error al cargar los datos";
		}
	}
	
	
	
}
?>