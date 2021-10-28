<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$funcion = new Subcategoria();

	if(isset($_POST['desubcategorias'])){
		
		try {

			$proceso = $_POST['proceso'];
			$id = $_POST['id'];
			$desubcategorias = trim($_POST['desubcategorias']);
			$estado = trim($_POST['estado']);

			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Subcategoria($idcategoria,$desubcategorias,$estado);
			break;

			case 'Edicion':
				$funcion->Editar_Subcategoria($id,$idcategoria,$desubcategorias,$estado);
			break;

			default:
				$data = "Error";
 	   		 	echo json_encode($data);
			break;
		}
			
		} catch (Exception $e) {
			
			$data = "Error";
 	   		echo json_encode($data);
		}

	}
	
	

  	

?>
