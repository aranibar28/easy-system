<?php 

	require_once('Conexion.php');

	class SubcategoriaModel extends Conexion
	{
		public function Listar_Subcategorias()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_subcategoria();";
				$stmt = $dbconec->prepare($query);
				$stmt->execute();
				$count = $stmt->rowCount();

				if($count > 0)
				{
					return $stmt->fetchAll();
				}

				
				$dbconec = null;
			} catch (Exception $e) {
				
				echo '<span class="label label-danger label-block">ERROR AL CARGAR LOS DATOS, PRESIONE F5</span>';
			}
		}

		public function Insertar_Subcategoria($idcategoria,$descubcategorias,$estado)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_insert_subcategoria(:idcategoria,:descubcategorias,:estado)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idcategoria",$idcategoria);
				$stmt->bindParam(":desubcategorias",$desubcategorias);
				$stmt->bindParam(":estado",$estado);

				if($stmt->execute())
				{
					$count = $stmt->rowCount();
					if($count == 0){
						$data = "Duplicado";
 	   					echo json_encode($data);
					} else {
						$data = "Validado";
 	   					echo json_encode($data);
					}
				} else {

					$data = "Error";
 	   		 	 	echo json_encode($data);
				}
				$dbconec = null;
			} catch (Exception $e) {
				$data = "Error";
				echo json_encode($data);
				
			}

		}

		public function Editar_Subcategoria($codisubcategoria,$idcategoria,$descubcategorias,$estado)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
		$query = "CALL sp_update_subcategoria(:codisubcategoria,:idcategoria,:descubcategorias,:estado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":codisubcategoria",$codisubcategoria);
				$stmt->bindParam(":idcategoria",$idcategoria);
				$stmt->bindParam(":descubcategorias",$desubcategorias);
				$stmt->bindParam(":estado",$estado);


				if($stmt->execute())
				{

				  $data = "Validado";
   				  echo json_encode($data);
				
				} else {

					$data = "Error";
 	   		 	 	echo json_encode($data);
				}
				$dbconec = null;
			} catch (Exception $e) {
				$data = "Error";
				echo json_encode($data);
			
			}

		}

	}


 ?>