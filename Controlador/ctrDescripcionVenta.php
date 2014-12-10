<?php

require_once('../Modelo/DescripcionVenta.php');

if(!empty($_GET['action'])){
	ctrDescripcionVenta::main($_GET['action']);
	
	

	class ctrDescripcionVenta{
	
	static function main($action){
		if ($action == "registrar"){
			ctrDescripcionVenta::registrar();
		}else if ($action == "buscarID"){
			ctrDescripcionVenta::buscarID(1);
		}else if ($action == "actualizar"){
			ctrDescripcionVenta::actualizar($_POST['idDescripcionVenta']);
		}
	}
	 static public function buscarID ($id){
		try {
			return DescripcionVenta::buscarForId($id);
		} catch (Exception $e) {
			header("");
		}
		
	}
	static public function buscarAll (){
		try {
			return DescripcionVenta::buscarAll();
		} catch (Exception $e) {
			header("");
		}
	}
	static public function buscar ($campo, $parametro){
		try {
			return DescripcionVenta::buscar($campo, $parametro);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function inactivar($id){
	
	}
	
	static public function registrar (){
		try {
			$arrayDescripcionVenta = array();
			$arrayDescripcionVenta['cantidad'] = $_POST['cantidad'];
			$arrayDescripcionVenta['valorVenta'] = $_POST['valorVenta'];
			$arrayDescripcionVenta['descripcion'] = $_POST['descripcion'];
			$arrayDescripcionVenta['valorTotal'] = $_POST['valorTotal'];
			$arrayDescripcionVenta['estado'] = $_POST['estado'];
			$arrayDescripcionVenta['venta'] = Venta::buscarForId($_POST['idVenta']);
			$arrayDescripcionVenta['repuesto'] = Repuesto::buscarForId($_POST['idRepuesto']);
			
			$DescripcionVenta = new DescripcionVenta ($arrayDescripcionVenta);
			$DescripcionVenta->registrar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function actualizar (){
			try {
			$arrayDescripcionVenta = array();
			$arrayDescripcionVenta['cantidad'] = $_POST['cantidad'];
			$arrayDescripcionVenta['valorVenta'] = $_POST['valorVenta'];
			$arrayDescripcionVenta['descripcion'] = $_POST['descripcion'];
			$arrayDescripcionVenta['valorTotal'] = $_POST['valorTotal'];
			$arrayDescripcionVenta['estado'] = $_POST['estado'];
			$arrayDescripcionVenta['venta'] = Venta::buscarForId($_POST['idVenta']);
			$arrayDescripcionVenta['repuesto'] = Repuesto::buscarForId($_POST['idRepuesto']);
			
			$DescripcionVenta = new DescripcionVenta ($arrayDescripcionVenta);
			$DescripcionVenta->registrar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function getList ($name){
		try {
			$text = "<select name='".$name."' id='".$name."'>". "onchange = muestrarepuesto(this.value)";
			$arrDescripcionVenta = ctrDescripcionVenta::buscarAll();
			$text .= "<option selected value='0'>Seleccione una opción</option>";
			foreach ($arrDescripcionVenta as $DescripcionVenta){
				$text .= "<option value=".$DescripcionVenta->getIdDescripcionVenta().">".$DescripcionVenta->getIdDescripcionVenta()." ".$DescripcionVenta->getCantidad()."</option>";
			}
			$text .= "</select>";			
			return $text;
		} catch (Exception $e) {
			return "Error al cargar los datos";
		}
	}
	}
}