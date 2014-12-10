<?php

require_once('../Modelo/Proveedor.php');


if(!empty($_GET['action'])){
	ctrProveedor::main($_GET['action']);

}

class ctrProveedor{
	
	static function main($action){
		if ($action == "registrar"){
			ctrProveedor::registrar();
		}else if ($action == "buscarID"){
			ctrProveedor::buscarID(1);
		}else if ($action == "actualizar"){
			ctrProveedor::actualizar($_POST['idProveedor']);
		}
	}
	
	static public function buscarID ($id){
		try {
			return Proveedor::buscarForId($id);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function buscarAll (){
		try {
			return Proveedor::buscarAll();
		} catch (Exception $e) {
			header("");
		}
	}

	static public function buscar ($campo, $parametro){
		try {
			return Proveedor::buscar($campo, $parametro);
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function inactivar($id){
	
	}
	
	static public function registrar (){
		try {
			$arrayProveedor = array();
			$arrayProveedor['tipoProveedor'] = $_POST['tipoProveedor'];
			$arrayProveedor['razonSocial'] = $_POST['razonSocial'];
			$arrayProveedor['nit'] = $_POST['nit'];
			$arrayProveedor['telefono'] = $_POST['telefono'];
			$arrayProveedor['ciudad'] = $_POST['ciudad'];
			$arrayProveedor['direccion'] = $_POST['direccion'];
			$arrayProveedor['email'] = $_POST['email'];
			$arrayProveedor['contacto'] = $_POST['contacto'];
			$arrayProveedor['telefonoContacto'] = $_POST['telefonoContacto'];
			$arrayProveedor['estado'] = "Activo";
			
			$Proveedor = new Proveedor ($arrayProveedor);
			$Proveedor->registrar();
			header("");
		} catch (Exception $e) {
			//Location: ../Vista/registrarVehiculo.php?respuesta=error
			header("");
		}
	}

	static public function actualizar (){
		try {
			$arrayProveedor = array();
			$arrayProveedor['tipoProveedor'] = $_POST['tipoProveedor'];
			$arrayProveedor['razonSocial'] = $_POST['razonSocial'];
			$arrayProveedor['nit'] = $_POST['nit'];
			$arrayProveedor['telefono'] = $_POST['telefono'];
			$arrayProveedor['ciudad'] = $_POST['ciudad'];
			$arrayProveedor['direccion'] = $_POST['direccion'];
			$arrayProveedor['email'] = $_POST['email'];
			$arrayProveedor['contacto'] = $_POST['contacto'];
			$arrayProveedor['telefonoContacto'] = $_POST['telefonoContacto'];
			$arrayProveedor['estado'] = "Activo";
						
			$Proveedor = new Proveedor ($arrayProveedor);
			$Proveedor->actualizar();
			header("");
		} catch (Exception $e) {
			header("");
		}
	}
	
	static public function getList ($name){
		try {
			$text = "<select name='".$name."' id='".$name."'>". "onchange = muestrarepuesto(this.value)";
			$arrProveedor = ctrProveedor::buscarAll();
			$text .= "<option selected value='0'>Seleccione una opción</option>";
			foreach ($arrProveedor as $Proveedor){
				$text .= "<option value=".$Proveedor->getIdProveedor().">".$Proveedor->getIdProveedor()." ".$Proveedor->getTipoProveedor()."</option>";
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