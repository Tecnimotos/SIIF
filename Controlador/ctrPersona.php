<?php
session_start();
require_once('../Modelo/Persona.php');
if(!empty($_GET['action'])){
	ctrPersona::main($_GET['action']);
	
}
class ctrPersona{
	
	static function main($action){
		if ($action == "registrar"){
			ctrPersona::registrar();
		}else if ($action == "buscarID"){
			ctrPersona::buscarForId($_POST['idPersona']);
		}else if ($action == "Actualizar"){
			ctrPersona::actualizar($_POST['idPersona']);
			
		}else if ($action == "BuscarAll"){
			ctrPersona::buscarAll($_POST['BuscarAll']);
		}else if ($action == "Buscar"){
			ctrPersona::buscar($_POST['Buscar']);
		}else if ($action == "Inactivar"){
			ctrPersona::inactivar($_POST['Inactivar']);
			
		}else if ($action == "login"){
			ctrPersona::login($_POST['idPersona']);
		}
	}
	static public function registrar (){
	try {
			$arrayPersonas = array();
			$arrayPersonas['tipoUsuario'] = $_POST['tipoUsuario'];
			$arrayPersonas['identificacion'] = $_POST['identificacion'];
			$arrayPersonas['nombres'] = $_POST['nombres'];
			$arrayPersonas['apellidos'] = $_POST['apellidos'];
			$arrayPersonas['direccion'] = $_POST['direccion'];
			$arrayPersonas['telefono'] = $_POST['telefono'];
			$arrayPersonas['email'] = $_POST['email'];
			
			
			$Persona = new Persona ($arrayPersonas);
			$Persona->registrar();
		header("Location: ../registrarAdministrador.php?respuesta=correcto");
		} catch (Exception $e) {
			header("Location: ../registrarAdministrador.php?respuesta=error");
	}
	}
	static public function actualizar (){
		try {
			$arrayPersonas = array();
			
			$arrayPersonas = array();
			$arrayPersonas['tipoUsuario'] = $_POST['tipoUsuario'];
			$arrayPersonas['identificacion'] = $_POST['identificacion'];
			$arrayPersonas['nombre'] = $_POST['nombre'];
			$arrayPersonas['apellido'] = $_POST['apellido'];
			$arrayPersonas['direccion'] = $_POST['direccion'];
			$arrayPersonas['telefono'] = $_POST['telefono'];
			$arrayPersonas['email'] = $_POST['email'];
			$arrayPersonas['idPersona'] = $_POST['idPersona'];
			
			
			$Persona = new Persona ($arrayPersonas);
			$Persona->actualizar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	static public function login (){
		$usuario = $_POST['usuario'];
		$contrasena = $_POST['contrasena'];
                
		$persona= new Persona ();
		$state = $persona->login($usuario,$contrasena);
		if ($state == 2 || $state == 3){
			if($state == 2){
				header("Location: ../Vista/Index.php?respuesta=correcto");
			}else{
				header("Location: ../Vista/Login.php?respuesta=error");
			}
		}else{
             $_SESSION ['usuario'] = $state[0]->getUsuario();
              $_SESSION ['idPersona'] = $state[0]->getIdPersona();
               header("Location: ../Vista/Index.php?respuesta=correcto");
			
		}
	}
	static public function buscarID ($id){
		try {
			return Persona::buscarForId($id);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function buscarAll (){
		//try {
			return Persona::buscarAll();
		//} catch (Exception $e) {
			header("");
		//}
	}

	static public function buscar ($campo, $parametro){
		try {
			return Persona::buscar($campo, $parametro);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function getList ($name){
		try {
			$text = "<select name='".$name."' id='".$name."'>";
			$arrPersonas = ctrPersona::buscar("tipoUsuario", array("Cliente"));
			$text .= "<option selected value='0'>Seleccione una opción</option>";
			foreach ($arrPersonas as $persona){
				$text .= "<option value=".$persona->getIdPersona().">".$persona->getNombres()." ".$persona->getApellidos()."</option>";
			}
			$text .= "</select>";			
			return $text;
		} catch (Exception $e) {
			return "Error al cargar los datos";
		}
	}
	}



 ?>