<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    # Funcion para leer el archivo txt y guardar los datos en la base #
	public function leer_archivo_txtAction()
	{
		$role= \Auth::user()->role;
		if($role == "ADMIN"){
			$group= \Auth::user()->group;
			$campus = $this->obtener_nombre_campus($group);
			$interfaces = array("wan", "lan", "opt1", "opt2","opt3");
	    	$interfaces_archivo = fopen("interfaces.txt", "w");
	    	foreach ($campus as $equipo_grupos){
				foreach ($equipo_grupos as $equipo){
					$xml = simplexml_load_file("clients/$group/$equipo/info.xml");
					foreach ($interfaces as $interfaces_equipo){
						$tipo_interfas = $xml->xpath("/interfaces/$interfaces_equipo/if");
		        		$nombre = $xml->xpath("/interfaces/$interfaces_equipo/descr");
		        		$ip = $xml->xpath("/interfaces/$interfaces_equipo/ipaddr");
		        		foreach ($tipo_interfas as $interfas){
							fwrite($interfaces_archivo, $interfas."|");
						}
						foreach ($nombre as $nombre_interfas){
							fwrite($interfaces_archivo, $nombre_interfas . "|".$interfaces_equipo."|");
						}
						foreach ($ip as $ip_equipo) {
							$ip_nueva = preg_replace('/\d{1,3}$/', '', $ip_equipo);
							if($ip_nueva == "dhcp"){
								fwrite($interfaces_archivo, "192.168.0." . "|$group|".$equipo."|\n");
							}
							else{
								$resultado_ip = $ip_nueva . "|$group|$equipo|\n";
								fwrite($interfaces_archivo, $resultado_ip);
							}
						}
					}
				}
			}
			fclose($interfaces_archivo);
		}
		# Query para borrar la tabla grupos de la base de datos #
		$delete_groups = DB::delete("DELETE FROM groups";);
		# Query para que la secuencia del contador regrese a 1 #
		//$query_alter_grupos = "ALTER SEQUENCE grupos_id_seq RESTART WITH 1";
		//$statement = "ALTER SEQUENCE grupos_id_seq RESTART WITH 1";
        //DB::unprepared($statement);
		# Query para borrar la tabla grupos de la base de datos #
		$delete_interfaces = DB::delete("DELETE FROM interfaces";);
		# Query para que la secuencia del contador regrese a 1 #
		//$query_alter_interfaces = "ALTER SEQUENCE interfaces_id_seq RESTART WITH 1";
		# Variable para leer el archivo informacion.txt #
		$filas=file('informacion.txt'); 
		foreach($filas as $value){
			list($ip, $grupo, $plantel) = explode("|", $value);
			'ip: '.$ip.'<br/>';
			'grupo: '.$grupo.'<br/>';
			'plantel: '.$plantel.'<br/><br/>';
			DB::insert('INSERT INTO groups(ip, group, campus, created_at, updated_at) VALUES (?, ?, ?, ?, ?)',[$ip, $grupo, $plantel, NOW(), NOW()]);
		}
		$archivo_interfaces=file('interfaces.txt'); 
		foreach($archivo_interfaces as $archivo_interfas){
			list($interfaz, $tipo, $nombre, $ip, $grupo, $plantel) = explode("|", $archivo_interfas);
			'interfaz: '.$interfaz.'<br/>';
			'tipo: '.$tipo.'<br/>'; 
			'nombre: '.$nombre.'<br/>'; 
			'ip: '.$ip.'<br/>';
			'grupo: '.$grupo.'<br/>';
			'plantel: '.$plantel.'<br/><br/>';
			DB::insert('INSERT INTO interfaces(interfas, name, type, ip, group, campus, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)',[$interfaz, $tipo, 
				$nombre, $ip, $grupo, $plantel, NOW(), NOW()]);
		}
		return $this->redirectToRoute("grupos");
	}

	# Area de consultas #
	# Funcion utilizada en leer_archivo_txt #
	private function obtener_nombre_campus($group)
	{
		$obtener_nombre_campus= DB::select("SELECT campus FROM groups WHERE group = ?", [$group]);
		return $obtener_nombre_campus;
	}
	# Funcion utilizada en grupos #
	private function recuperar_grupo_grupos()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT DISTINCT g.nombre FROM AppBundle:grupos g ORDER BY g.nombre ASC');
		$grupos = $query->getResult();
		return $grupos;
	}
	# Funcion utilizada en ver_ip #
	private function obtener_ip_plantel_grupos($grupo)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT g.id, g.ip, g.descripcion FROM AppBundle:grupos g
			WHERE g.nombre = :grupo ORDER BY g.descripcion ASC')->setParameter('grupo', $grupo);
		$grupos = $query->getResult();
		return $grupos;
	}
}
