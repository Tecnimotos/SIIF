<?php

require_once('../Modelo/TipoRepuesto.php');


if(!empty($_GET['action'])){
	ctrTipoRepuesto::main($_GET['action']);

}

class ctrTipoRepuesto{
	
	static function main($action){
		if ($action == "registrar"){
			ctrTipoRepuesto::registrar();
		}else if ($action == "buscarID"){
			ctrTipoRepuesto::buscarID(1);
		}else if ($action == "actualizar"){
			ctrTipoRepuesto::actualizar($_POST['idTipoRepuesto']);
		}else if ($action == "rowVehiculo"){
			ctrTipoRepuesto::rowVehiculo($_POST['idTipoRepuesto']);
		}
	}
	
	static public function buscarID ($id){
		try {
			return TipoRepuesto::buscarForId($id);
		} catch (Exception $e) {
			header("Location: ../Vista/registrarPersona.php?respuesta=error");
		}
	}
	
	static public function buscarAll (){
		try {
			return TipoRepuesto::buscarAll();
		} catch (Exception $e) {
			header("Location: ../Vista/administradorVehiculo.php?respuesta=error");
		}
	}

	static public function buscar ($campo, $parametro){
		try {
			return TipoRepuesto::buscar($campo, $parametro);
		} catch (Exception $e) {
			header("Location: ../registrarPersona.php?respuesta=error");
		}
	}
	
	static public function inactivar($id){
	
	}
	
	static public function registrar (){
		try {
			$arrayTipoRepuesto = array();
			$arrayTipoRepuesto['nombre'] = $_POST['nombre'];
			$arrayTipoRepuesto['descripcion'] = $_POST['descripcion'];
			$arrayTipoRepuesto['estado'] = "Activo";
			$tipoRepuesto = new TipoRepuesto ($arrayTipoRepuesto);
			$tipoRepuesto->registrar();
			header("Location: ../Vista/Index.php?respuesta=correcto");
		} catch (Exception $e) {
			header("Location: ../Vista/Index.php?respuesta=error");
		}
	}

	static public function actualizar (){
		try {
			$arrayTipoRepuesto = array();
			$arrayTipoRepuesto['nombre'] = $_POST['nombre'];
			$arrayTipoRepuesto['descripcion'] = $_POST['descripcion'];
			$arrayTipoRepuesto['estado'] = $_POST['estado'];
			
			$TipoRepuesto = new TipoRepuesto ($arrayTipoRepuesto);
			$TipoRepuesto->actualizar();
			header("Location: ../Vista/updateVehiculo.php?respuesta=correcto");
		} catch (Exception $e) {
			header("Location: ../Vista/updateVehiculo.php?respuesta=error");
		}
	}
	
	static public function getList ($name){
		try {
			$text = "<select name='".$name."' id='".$name."'>". "onchange = muestrarepuesto(this.value)";
			$arrTipoRepuesto = ctrTipoRepuesto::buscarAll();
			$text .= "<option selected value='0'>Seleccione una opción</option>";
			foreach ($arrTipoRepuesto as $TipoRepuesto){
				$text .= "<option value=".$TipoRepuesto->getIdTipoRepuesto().">".$TipoRepuesto->getIdTipoRepuesto()." ".$TipoRepuesto->getNombre()."</option>";
			}
			$text .= "</select>";			
			return $text;
		} catch (Exception $e) {
			return "Error al cargar los datos";
		}
	}
	
	/*static public function rowsVehiculo ($name){
		try {
			$arrVehiculos = ctrTipoRepuesto::buscarAll ();
			$text = "<table width='200' border='0'>";
			$text .= "  <tbody>";
			$text .= "    <tr align='center'>";
			$text .= "      <td width='30' nowrap='nowrap'><strong>Id</strong></td>";
			$text .= "      <td width='81' nowrap='nowrap'><strong>Marca</strong></td>";
			$text .= "      <td width='81' nowrap='nowrap'><strong>Modelo</strong></td>";
			$text .= "      <td width='81' nowrap='nowrap'><strong>Placa</strong></td>";
			$text .= "      <td width='81' nowrap='nowrap'><strong>Color</strong></td>";
			$text .= "      <td width='122' nowrap='nowrap'><strong>Fecha de Ingreso</strong></td>";
			$text .= "      <td width='122' nowrap='nowrap'><strong>Fecha de Entrega</strong></td>";
			$text .= "      <td width='122' nowrap='nowrap'><strong>Hora de Entrega</strong></td>";
			$text .= "      <td width='122' nowrap='nowrap'><strong>Persona</strong></td>";
			$text .= "    </tr>";
			foreach ($arrVehiculos as $vehiculo){
				$text .= "    <tr>";
				$text .= "      <td>".$vehiculo->getIdVehiculo()."</td>";
				$text .= "      <td>".$vehiculo->getMarca()."</td>";
				$text .= "      <td>".$vehiculo->getModelo()."</td>";
				$text .= "      <td>".$vehiculo->getPlaca()."</td>";
				$text .= "      <td>".$vehiculo->getColor()."</td>";
				$text .= "      <td>".$vehiculo->getFechaIngreso()."</td>";
				$text .= "      <td>".$vehiculo->getFechaEntrega()."</td>";
				$text .= "      <td>".$vehiculo->getHoraEntrega()."</td>";
				$text .= "      <td>".$vehiculo->getPersona()->getNombre()."</td>";
				$text .= "    </tr>";
			}
			$text .= "  </tbody>";
			$text .= "</table>";	
			return $text;
			
		} catch (Exception $e) {
			return "Error al cargar los datos";
		}
	}
	
	static public function rowVehiculo ($name){
		try {
			$arrVehiculos = ctrTipoRepuesto::buscarForId($vehiculo);
			
			$text = "<table width='200' border='0'>";
			$text .= "  <tbody>";
			$text .= "    <tr align='center'>";
			$text .= "      <td width='30' nowrap='nowrap'><strong>Id</strong></td>";
			$text .= "      <td width='81' nowrap='nowrap'><strong>Marca</strong></td>";
			$text .= "      <td width='81' nowrap='nowrap'><strong>Modelo</strong></td>";
			$text .= "      <td width='81' nowrap='nowrap'><strong>Placa</strong></td>";
			$text .= "      <td width='81' nowrap='nowrap'><strong>Color</strong></td>";
			$text .= "      <td width='122' nowrap='nowrap'><strong>Fecha de Ingreso</strong></td>";
			$text .= "      <td width='122' nowrap='nowrap'><strong>Fecha de Entrega</strong></td>";
			$text .= "      <td width='122' nowrap='nowrap'><strong>Hora de Entrega</strong></td>";
			$text .= "      <td width='122' nowrap='nowrap'><strong>Persona</strong></td>";
			$text .= "    </tr>";
			
			foreach ($arrVehiculos as $vehiculo){
				$text .= "    <tr>";
				$text .= "      <td>".$vehiculo->getIdVehiculo()."</td>";
				$text .= "      <td>".$vehiculo->getMarca()."</td>";
				$text .= "      <td>".$vehiculo->getModelo()."</td>";
				$text .= "      <td>".$vehiculo->getPlaca()."</td>";
				$text .= "      <td>".$vehiculo->getColor()."</td>";
				$text .= "      <td>".$vehiculo->getFechaIngreso()."</td>";
				$text .= "      <td>".$vehiculo->getFechaEntrega()."</td>";
				$text .= "      <td>".$vehiculo->getHoraEntrega()."</td>";
				$text .= "      <td>".$vehiculo->getPersona()->getNombre()."</td>";
				$text .= "    </tr>";
			}
			$text .= "  </tbody>";
			$text .= "</table>";	
			return $text;
			
		} catch (Exception $e) {
			return "Error al cargar los datos";
		}
	}*/
	
}
?>