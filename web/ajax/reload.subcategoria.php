<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$objSubcategoria =  new Subcategoria();

 ?>
	<table class="table datatable-basic table-xxs table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>Desubcategoria</th>
			<th>Estado</th>
			<th class="text-center">Opciones</th>
		</tr>
	</thead>

	<tbody>
	
	  <?php 
			$filas = $objSubcategoria->Listar_Subcategorias(); 
			if (is_array($filas) || is_object($filas))
			{
			foreach ($filas as $row => $column) 
			{
			?>
				<tr>
                	<td><?php print($column['codisubcategoria']); ?></td>
                	<td><?php print($column['idcategoria']); ?></td>
                	<td><?php print($column['desubcategorias']); ?></td>
                	<td><?php if($column['estado'] == '1')
                		echo '<span class="label label-success label-rounded"><span 
                		class="text-bold">VIGENTE</span></span>';
                		else 
                		echo '<span class="label label-default label-rounded">
                	<span 
                	    class="text-bold">DESCONTINUADA</span></span>'
	                ?></td>
                	<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a 
								href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
								onclick="openCategoria('editar',
			                     '<?php print($column["codisubcategoria"]); ?>',
			                     '<?php print($column["idcategoria"]); ?>',
			                     '<?php print($column["desubcategorias"]); ?>',
			                     '<?php print($column["estado"]); ?>')"> 
							   <i class="icon-pencil6">
						       </i> Editar</a></li>
								<li><a
								href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
								onclick="openCategoria('ver',
			                     '<?php print($column["codicategoria"]); ?>',
			                     '<?php print($column["idcategoria"]); ?>',
			                     '<?php print($column["desubcategorias"]); ?>',
			                     '<?php print($column["estado"]); ?>')"> 
								<i class=" icon-eye8">
								</i> Ver</a></li>
							</ul>
						</li>
					</ul>
				</td>
                </tr>
			<?php  
			}
		}
		?>
	
	</tbody>
</table>

<script type="text/javascript" src="web/custom-js/subcategoria.js"></script>
