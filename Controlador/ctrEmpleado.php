<?php 

session_start();
require_once('../Modelo/Empleado.php');
if(!empty($_GET['action'])){
	
	ctrEmpleado::main($_GET['action']);
	
}
class ctrEmpleado{
	
	static function main($action){
		if ($action == "registrar"){
			ctrEmpleado::registrar();
		}else if ($action == "buscarID"){
			ctrEmpleado::buscarForId($_POST['idPersona']);
		}else if ($action == "Actualizar"){
			ctrEmpleado::actualizar($_POST['idPersona']);
		}
	     else if ($action == "BuscarAll"){
			ctrEmpleado::buscarAll($_POST['BuscarAll']);
		}else if ($action == "Buscar"){
			ctrEmpleado::buscar($_POST['Buscar']);
		}else if ($action == "Inactivar"){
			ctrEmpleado::inactivar($_POST['Inactivar']);
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
			$arrayPersonas['usuario'] = $_POST['usuario'];
			$arrayPersonas['contrasena'] = md5($_POST['contrasena']);
			$arrayPersonas['estado'] = "Activo";
			
			
			
			$Empleado = new Empleado ($arrayPersonas);
			$Empleado->registrar();
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
			$arrayPersonas['usuario'] = $_POST['usuario'];
			$arrayPersonas['contrasena'] = $_POST['contrasena'];
		    $arrayPersonas['estado'] = $_POST['estado'];
			$arrayPersonas['idPersona'] = $_POST['idPersona'];
			
			
			$Empleado = new Empleado ($arrayPersonas);
			$Empleado->actualizar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function buscarID ($id){
		try {
			return Empleado::buscarForId($id);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function buscarAll (){
		try {
			return Empleado::buscarAll();
		} catch (Exception $e) {
			//header("");
		}
	}

	static public function buscar ($campo, $parametro){
		try {
			return Empleado::buscar($campo, $parametro);
			//header("");
		} catch (Exception $e) {
			//header("");
		}
	}
	
	static public function getList ($name){
		try {
			$text = "<select name='".$name."' id='".$name."'>". "onchange = muestrarepuesto(this.value)";
			$arrEmpleado = ctrEmpleado::buscar("tipoUsuario", array("Vendedor"));
			$text .= "<option selected value='0'>Seleccione una opción</option>";
			foreach ($arrEmpleado as $Empleado){
				$text .= "<option value=".$Empleado->getIdEmpleado().">".$Empleado->getNombres()." ".$Empleado->getApellidos()."</option>";
			}
			$text .= "</select>";			
			return $text;
		} catch (Exception $e) {
			return "Error al cargar los datos";
		}
	
	}
	
}

?>