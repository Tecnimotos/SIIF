<?php

require_once('../Modelo/Pedido.php');

if(!empty($_GET['action'])){
	ctrPedido::main($_GET['action']);
	
}

	class ctrPedido{
	
	static function main($action){
		if ($action == "registrar"){
			ctrPedido::registrar();
		}else if ($action == "buscarID"){
			ctrPedido::buscarID(1);
		}else if ($action == "actualizar"){
			ctrPedido::actualizar($_POST['idPedido']);
		}
		
	}
	static public function buscarID ($id){
		try {
			return Pedido::buscarForId($id);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function buscarAll (){
		try {
			return Pedido::buscarAll();
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function buscar ($campo, $parametro){
		try {
			return Pedido::buscar($campo, $parametro);
		} catch (Exception $e) {
			header("");
		}
	}

    static public function inactivar($id){
	
	}
	
	static public function registrar (){
		try {
			$arrayPedido = array();
			$arrayPedido['fecha'] = $_POST['fecha'];
			$arrayPedido['referencia'] = $_POST['referencia'];
			
			
			$arrayPedido['proveedor'] = Proveedor::buscarForId($_POST['idProveedor']);
			$arrayPedido['persona'] = Persona::buscarForId($_POST['idPersona']);
			
			$Pedido = new Pedido ($arrayPedido);
			$Pedido->registrar();
			header("Location: ../Vista/Index.php?respuesta=correcto");
		} catch (Exception $e) {
			header("");
		}
	}
	static public function actualizar (){
		try {
			$arrayPedido = array();
			$arrayPedido['fecha'] = $_POST['fecha'];
			$arrayPedido['referencia'] = $_POST['referencia'];
			$arrayPedido['estado'] = $_POST['estado'];
			$arrayPedido['proveedor'] = Proveedor::buscarForId($_POST['idProveedor']);
			$arrayPedido['persona'] = Persona::buscarForId($_POST['idPersona']);
			
			$Pedido = new Pedido ($arrayPedido);
			$Pedido->actualizar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	static public function getList ($name){
		try {
			$text = "<select name='".$name."' id='".$name."'>". "onchange = muestrarepuesto(this.value)";
			$arrPedido = ctrPedido::buscarAll();
			$text .= "<option selected value='0'>Seleccione una opción</option>";
			foreach ($arrPedido as $Pedido){
				$text .= "<option value=".$Pedido->getIdPedido().">".$Pedido->getIdPedido()." ".$Pedido->getReferencia()."</option>";
			}
			$text .= "</select>";			
			return $text;
		} catch (Exception $e) {
			return "Error al cargar los datos";
		}
	}
	
}
	

?>