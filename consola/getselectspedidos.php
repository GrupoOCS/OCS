<?php
	include('funciones/DB.php');
	echo "	<table>
				<tr>
					<td class= 'col'>
						<span><label>Clientes</label></span>
					</td>
	        		<td class= 'col'>";
	        			getSelectClientes();
	echo			"</td>
				</tr>
	        	<tr>
	        		<td class= 'col'>
	        			<span><label>Productos</label></span><br><br>
	        		</td>
	        		<td class= 'col'>";
	        			getSelectMarcas();
	echo 		"	</td>
				</tr>
					<td class= 'col'>
	        			<span><label>Filtro</label></span><br><br>
	        		</td>
	        		<td class= 'col'>
	        			<select id='filtro'>
	        				<option value='1'>Todo</option>
	        				<option value='2'>Más vendidos</option>
	        				<option value='3'>Menos vendidos</option>
	        			</select><td class= 'col'>
	        		</td>
	        	</tr>       
	        </table><br>
	        <CENTER><button onclick='genrep()' class='aceptar'>Generar PDF</button> <button onclick='imprimir()' class='aceptar'>Imprimir PDF</button></CENTER>";
	echo	"
			<br><br><br>
			<span><label><b><h3>Inventario</h3></b></label></span><br>
			<table>
	        	<tr>
	        		<td class= 'col'>
	        			<span><label>Marcas</label></span>
	        		</td>
	        		<td class= 'col'>";
	        			getSelectMarcasIn();
	echo    "   	</td><td class= 'col'>
	        		</td>
				</tr>
			</table>
			<CENTER><button onclick='genrepInven()' class='aceptar'>Generar PDF</button> <button onclick='imprimirInven()' class='aceptar'>Imprimir PDF</button></center>";;

	
?>