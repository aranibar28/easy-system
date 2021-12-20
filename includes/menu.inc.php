					<li class="active"><a href="./?View=Inicio"><i class="icon-home4"></i> <span>Inicio</span></a></li>

					<?php if ($tipo_usuario == '1') { ?>

						<!-- Ventas -->
						<li>
							<a href="#"><i class="icon-cart"></i> <span>Ventas</span></a>
							<ul>							
								<li><a href="./?View=POS">Realizar Ventas</a></li>
								<li><a href="./?View=Cotizacion">Generar Cotización</a></li>
								<li><a href="./?View=Cotizaciones">Consultar Cotización</a></li>
								<li><a href="./?View=Venta-Diaria">Consultar Ventas del Día</a></li>
								<li><a href="./?View=Ventas-Fecha">Consultar Ventas por Fecha</a></li>
								<li><a href="./?View=Ventas-Mes">Consultar Ventas por Mes</a></li>
								<li><a href="./?View=Creditos">Administrar Créditos</a></li>
							</ul>
						</li>
						<!-- /Ventas -->

						<!-- Compras -->
						<li>
							<a href="#"><i class="icon-truck"></i> <span>Compras</span></a>
							<ul>
								<li><a href="./?View=Compras">Realizar Compras</a></li>
								<li><a href="./?View=Compras-Fecha">Consultar Compras por Fecha</a></li>
								<li><a href="./?View=Compras-Mes">Consultar Compras por Mes</a></li>
								<li><a href="./?View=Historico-Precios">Historial de Precios</a></li>
								<li><a href="./?View=CreditosProveedor">Administrar Créditos</a></li>
								<li><a href="./?View=Proveedor">Proveedores</a></li>
							</ul>
						</li>
						<!-- /Compras -->

						<!-- Almacen -->
						<li>
							<a href="#"><i class="icon-box"></i> <span>Almacen</span></a>
							<ul>
								<li><a href="./?View=Categoria">Categoría</a></li>
								<li><a href="./?View=Marca">Material</a></li>
								<li><a href="./?View=Presentacion">Presentación</a></li>							
								<li><a href="./?View=Producto">Producto</a></li>
								<!-- <li><a href="./?View=Perecederos">Perecederos</a></li> -->
							</ul>
						</li>
						<!-- /Almacen -->

						<!-- Inventario -->
						<li>
							<a href="#"><i class="icon-grid6"></i> <span>Inventario</span></a>
							<ul>
								<li><a href="./?View=Abrir-Inventario">Abrir Nuevo Inventario</a></li>
								<li><a href="./?View=Kardex">Kardex</a></li>
							</ul>
						</li>
						<!-- /Inventario -->

						<!-- Caja -->
						<li>
							<a href="#"><i class="icon-cash3"></i> <span>Caja</span></a>
							<ul>
								<li><a href="./?View=Caja">Administrar Caja</a></li>
								<li><a href="./?View=Historico-Caja">Historial de Caja</a></li>
							</ul>
						</li>
						<!-- /Caja -->

						<!-- Ventas -->
						<li>
							<a href="#"><i class="icon-price-tags2"></i> <span>Apartados</span></a>
							<ul>
								<li><a href="./?View=POS-A">Apartar Productos</a></li>
								<li><a href="./?View=Apartados-Diarios">Consultar Apartados del Día</a></li>
								<li><a href="./?View=Apartados-Fecha">Consultar Apartados por Fecha</a></li>
								<li><a href="./?View=Apartados-Mes">Consultar Apartados por Mes</a></li>
							</ul>
						</li>
						<!-- /Ventas -->



						<!-- Taller  --->
						<li>
							<a href="#"><i class="icon-users"></i> <span>CRM</span></a>
							<ul>
								<li><a href="./?View=Clientes">Clientes</a></li>
								<li><a href="./?View=Tecnicos">Asesores</a></li>
								<li><a href="./?View=Taller">Orden de Reclamos</a></li>
								
							</ul>
						</li>
						<!-- Taller --->

						<!-- Documentos -->
						<li>
							<a href="#"><i class="icon-certificate"></i><span>Comprobantes</span></a>
							<ul>
								<li><a href="./?View=Tipo-Comprobante">Tipo de Comprobante</a></li>
								<li><a href="./?View=Tirajes">Tiraje de Comprobantes</a></li>
							</ul>
						</li>
						<!-- /Documentos -->

						<!-- Parámetros -->
						<li>
							<a href="#"><i class="icon-cog2"></i> <span>Parámetros</span></a>
							<ul>
								<li><a href="./?View=Usuario">Usuario</a></li>
								<li><a href="./?View=Empleados">Empleados</a></li>
								<li><a href="./?View=Monedas">Monedas</a></li>
								<li><a href="./?View=Parametros">Datos de la empresa</a></li>
							</ul>
						</li>
						<!-- /Parámetros -->

						<!-- /Acera de -->
						<li>
							<a href="./?View=Acerca-de"><i class="icon-info22"></i> <span> Acerca de </span></a>
						</li>
						<!--Acerca de  -->

					<?php } else { ?>

						<!-- Almacen -->
						<li>
							<a href="#"><i class="icon-box"></i> <span>Almacen</span></a>
							<ul>
								<li><a href="./?View=Producto">Producto</a></li>
							</ul>
						</li>
						<!-- /Almacen -->

						<!-- Cotizaciones -->
						<li>
							<a href="#"><i class="icon-file-spreadsheet"></i> <span>Cotizaciones</span></a>
							<ul>
								<li><a href="./?View=Cotizacion">Generar Cotizacion</a></li>
								<li><a href="./?View=Cotizaciones">Ver Cotizaciones</a></li>
							</ul>
						</li>
						<!-- /Cotizaciones -->

						<!-- Caja -->
						<li>
							<a href="#"><i class="icon-cash3"></i> <span>Caja</span></a>
							<ul>
								<li><a href="./?View=Caja">Administrar Caja</a></li>
							</ul>
						</li>
						<!-- /Caja -->

						<!-- Ventas -->
						<li>
							<a href="#"><i class="icon-cart"></i> <span>Ventas</span></a>
							<ul>
								<li><a href="./?View=Clientes">Clientes</a></li>
								<li><a href="./?View=POS">Punto de Venta</a></li>
								<li><a href="./?View=Venta-Diaria">Consultar Ventas del Dia</a></li>
								<li><a href="./?View=Ventas-Fecha">Consultar Ventas por Fecha</a></li>
								<li><a href="./?View=Ventas-Mes">Consultar Ventas por Mes</a></li>
							</ul>
						</li>
						<!-- /Ventas -->

						<!-- Creditos -->
						<li>
							<a href="#"><i class="icon-coins"></i> <span>Ventas al Credito</span></a>
							<ul>
								<li><a href="./?View=Creditos">Administrar Creditos</a></li>
							</ul>
						</li>
						<!-- /Creditos -->

						<!-- Inventario -->
						<li>
							<a href="#"><i class="icon-grid6"></i> <span>Inventario</span></a>
							<ul>
								<li><a href="./?View=Kardex">Kardex</a></li>
							</ul>
						</li>
						<!-- /Inventario -->

						<!-- /Acera de -->
						<li>
							<a href="./?View=Acerca-de"><i class="icon-info22"></i> <span> Acerca de </span></a>
						</li>
						<!--Acerca de  -->

					<?php } ?>