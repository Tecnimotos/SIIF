<?php

require_once('../Modelo/Novedad.php');

if(!empty($_GET['action'])){
	ctrNovedad::main($_GET['action']);
	
	

	class ctrNovedad{
	
	static function main($action){
		if ($action == "registrar"){
			ctrNovedad::registrar();
		}else if ($action == "buscarID"){
			ctrNovedad::buscarID(1);
		}else if ($action == "actualizar"){
			ctrNovedad::actualizar($_POST['idNovedad']);
		}
		
	}
	static public function buscarID ($id){
		try {
			return Novedad::buscarForId($id);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function buscarAll (){
		try {
			return Novedad::buscarAll();
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function buscar ($campo, $parametro){
		try {
			return Novedad::buscar($campo, $parametro);
		} catch (Exception $e) {
			header("");
		}
	}

    static public function inactivar($id){
	
	}
	
	static public function registrar (){
		try {
			$arrayNovedad = array();
			$arrayNovedad[''] = $_POST['fechaVenta'];
			$arrayNovedad['descripcion'] = $_POST['descripcion'];
			$arrayNovedad['excedente'] = $_POST['excedente'];
			$arrayNovedad['reembolso'] = $_POST['estado'];
			$arrayNovedad['fechaNovedad'] = $_POST['fechaNovedad'];
			$arrayNovedad['tipoNovedad'] = $_POST['tipoNovedad'];
			$arrayNovedad['venta'] = Venta::buscarForId($_POST['idVenta']);
			$arrayNovedad['repuestoEntrante'] = Repuesto::buscarForId($_POST['idRepuesto']);
			$arrayNovedad['repuestoSalida'] = Repuesto::buscarForId($_POST['idRepuesto']);
			
			$Novedad = new Novedad ($arrayNovedad);
			$Novedad->registrar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	static public function actualizar (){
	try {
			$arrayVenta = array();
			$arrayNovedad[''] = $_POST['fechaVenta'];
			$arrayNovedad['descripcion'] = $_POST['descripcion'];
			$arrayNovedad['excedente'] = $_POST['excedente'];
			$arrayNovedad['reembolso'] = $_POST['estado'];
			$arrayNovedad['fechaNovedad'] = $_POST['fechaNovedad'];
			$arrayNovedad['tipoNovedad'] = $_POST['tipoNovedad'];
			$arrayNovedad['venta'] = Venta::buscarForId($_POST['idVenta']);
			$arrayNovedad['repuestoEntrante'] = Repuesto::buscarForId($_POST['idRepuesto']);
			$arrayNovedad['repuestoSalida'] = Repuesto::buscarForId($_POST['idRepuesto']);
			
			$Novedad = new Novedad ($arrayNovedad);
			$Novedad->registrar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function getList ($name){
		try {
			$text = "<select name='".$name."' id='".$name."'>". "onchange = muestrarepuesto(this.value)";
			$arrVenta = ctrNovedad::buscarAll();
			$text .= "<option selected value='0'>Seleccione una opción</option>";
			foreach ($arrVenta as $Pedido){
				$text .= "<option value=".$novedad->getIdNovedad().">".$novedad->getIdNovedad()." ".$novedad->getTipoNovedad()."</option>";
			}
			$text .= "</select>";			
			return $text;
		} catch (Exception $e) {
			return "Error al cargar los datos";
		}
	}
	
}
	
}
?>