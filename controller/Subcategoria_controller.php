<?php 

	class Subcategoria {

		public function Listar_Subcategorias(){

			$filas = SubcategoriaModel::Listar_Subcategorias();
			return $filas;
		
		}

		public function Insertar_Subcategoria($idcategoria,$desubcategoria){

			$cmd = SubcategoriaModel::Insertar_Subcategoria($idcategoria,$desubcategoria);
			
		}

		public function Editar_Subcategoria($codisubcategoria,$idcategoria,$desubcategoria,$estado){

			$cmd = SubcategoriaModel::Editar_Subcategoria($codisubcategoria,$idcategoria,$desubcategoria,$estado);
			
		}

	}


 ?>