<?php

require_once('../Modelo/DescripcionPedido.php');

if(!empty($_GET['action'])){
	ctrDescripcionPedido::main($_GET['action']);
	
	

	class ctrDescripcionPedido{
	
	static function main($action){
		if ($action == "registrar"){
			ctrDescripcionPedido::registrar();
		}else if ($action == "buscarID"){
			ctrDescripcionPedido::buscarID(1);
		}else if ($action == "actualizar"){
			ctrDescripcionPedido::actualizar($_POST['idDescripcionPedido']);
		}
	}
	 static public function buscarID ($id){
		try {
			return DescripcionPedido::buscarForId($id);
		} catch (Exception $e) {
			header("");
		}
		
	}
	static public function buscarAll (){
		try {
			return DescripcionPedido::buscarAll();
		} catch (Exception $e) {
			header("");
		}
	}
	static public function buscar ($campo, $parametro){
		try {
			return DescripcionPedido::buscar($campo, $parametro);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function inactivar($id){
	
	}
	
	static public function registrar (){
		try {
			$arrayDescripcionPedido = array();
			$arrayDescripcionPedido['cantidad'] = $_POST['cantidad'];
			$arrayDescripcionPedido['porcentaje'] = $_POST['porcentaje'];
			$arrayDescripcionPedido['ubicacion'] = $_POST['ubicacion'];
			$arrayDescripcionPedido['valorUnitario'] = $_POST['valorUnitario'];
			$arrayDescripcionPedido['estado'] = $_POST['estado'];
			$arrayDescripcionPedido['repuesto'] = Repuesto::buscarForId($_POST['idRepuesto']);
			$arrayDescripcionPedido['pedido'] = Pedido::buscarForId($_POST['idPedido']);
			
			$DescripcionPedido = new DescripcionPedido ($arrayDescripcionPedido);
			$DescripcionPedido->registrar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function actualizar (){
		try {
			$arrayDescripcionPedido = array();
			$arrayDescripcionPedido['cantidad'] = $_POST['cantidad'];
			$arrayDescripcionPedido['porcentaje'] = $_POST['porcentaje'];
			$arrayDescripcionPedido['ubicacion'] = $_POST['ubicacion'];
			$arrayDescripcionPedido['valorUnitario'] = $_POST['valorUnitario'];
			$arrayDescripcionPedido['estado'] = $_POST['estado'];
			$arrayDescripcionPedido['repuesto'] = Repuesto::buscarForId($_POST['idRepuesto']);
			$arrayDescripcionPedido['pedido'] = Pedido::buscarForId($_POST['idPedido']);
			
			
			$DescripcionPedido = new DescripcionPedido ($arrayDescripcionPedido);
			$DescripcionPedido->actualizar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function getList ($name){
		try {
			$text = "<select name='".$name."' id='".$name."'>". "onchange = muestrarepuesto(this.value)";
			$arrDescripcionPedido = ctrDescripcionPedido::buscarAll();
			$text .= "<option selected value='0'>Seleccione una opción</option>";
			foreach ($arrDescripcionPedido as $DescripcionPedido){
				$text .= "<option value=".$DescripcionPedido->getIdDescripcionPedido().">".$DescripcionPedido->getIdDescripcionPedido()." ".$DescripcionPedido->getCantidad()."</option>";
			}
			$text .= "</select>";			
			return $text;
		} catch (Exception $e) {
			return "Error al cargar los datos";
		}
	}
	}
}