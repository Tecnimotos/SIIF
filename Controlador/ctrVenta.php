<?php

require_once('../Modelo/Venta.php');

if(!empty($_GET['action'])){
	ctrVenta::main($_GET['action']);
	
}

	class ctrVenta{
	
	static function main($action){
		if ($action == "registrar"){
			ctrVenta::registrar();
		}else if ($action == "buscarID"){
			ctrVenta::buscarID(1);
		}else if ($action == "actualizar"){
			ctrVenta::actualizar($_POST['idVenta']);
		}
		
	}
	static public function buscarID ($id){
		try {
			return Venta::buscarForId($id);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function buscarAll (){
		try {
			return Venta::buscarAll();
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function buscar ($campo, $parametro){
		try {
			return Venta::buscar($campo, $parametro);
		} catch (Exception $e) {
			header("");
		}
	}

    static public function inactivar($id){
	
	}
	
	static public function registrar (){
		try {
			$arrayVenta = array();
			$arrayVenta['fechaVenta'] = $_POST['fechaVenta'];
			$arrayVenta['descripcion'] = $_POST['descripcion'];
			$arrayVenta['referencia'] = $_POST['referencia'];
			$arrayVenta['estado'] = "Activo";
			$arrayVenta['vendedor'] = Persona::buscarForId($_POST['idEmpleado']);
			$arrayVenta['cliente'] = Persona::buscarForId($_POST['idPersona']);
			
			$Venta = new Venta ($arrayVenta);
			$Venta->registrar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	static public function actualizar (){
	try {
			$arrayVenta = array();
			$arrayVenta['fechaVenta'] = $_POST['fechaVenta'];
			$arrayVenta['descripcion'] = $_POST['descripcion'];
			$arrayVenta['referencia'] = $_POST['referencia'];
			$arrayVenta['estado'] = $_POST['estado'];
			$arrayPedido['vendedor'] = Persona::buscarForId($_POST['idPersona']);
			$arrayPedido['cliente'] = Persona::buscarForId($_POST['idPersona']);
			
			$Venta = new Venta ($arrayVenta);
			$Venta->registrar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function getList ($name){
		try {
			$text = "<select name='".$name."' id='".$name."'>". "onchange = muestrarepuesto(this.value)";
			$arrVenta = ctrVenta::buscarAll();
			$text .= "<option selected value='0'>Seleccione una opción</option>";
			foreach ($arrVenta as $Pedido){
				$text .= "<option value=".$Pedido->getIdVenta().">".$Pedido->getIdVenta()." ".$Pedido->getfechaVenta()."</option>";
			}
			$text .= "</select>";			
			return $text;
		} catch (Exception $e) {
			return "Error al cargar los datos";
		}
	}
	

	
}
?>