<?php

	class Conexion {

		public function Conectar(){


			$driver = 'mysql'; //mysql no cambiar
			$host = 'localhost'; //localhost
			$dbname = 'prueba'; //bdd
			$username ='root'; //usuario
			$passwd = ''; //contraseña




			$server=$driver.':host='.$host.';dbname='.$dbname;

			try {

				$conexion = new PDO($server,$username,$passwd);
				//$conexion = exec("SET CHARACTER SET utf8");
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			} catch (Exception $e) {

				$conexion = null;
            	echo '<span class="label label-danger label-block">ERROR AL CONECTARSE A LA BASE DE DATOS, PRESIONE F5</span>';
            	exit();
			}


			return $conexion;

		}

	}
