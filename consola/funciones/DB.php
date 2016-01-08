<?php
	function conectar()
	{ 
		$dsn='mysql:host=localhost;dbname=ocs';
		$username='root';
		$passsword='';
		try
		{
			$db=new PDO($dsn,$username, $passsword);
			return $db;	
		} 
		catch (PDOException $e) {
			//echo $e->getMessage();
    		return null;
		}		
	}
	
	function verificausuario($datos)
	{
		//session_start();
		$db=conectar();
		if($db!=null)
		{
			$prepared = array(
				'usuario' => $datos['usuario'],
				'contra' => $datos['contra']
				);
			$query = $db->prepare("SELECT nombre,usuario FROM administrador WHERE usuario=:usuario AND contrasena=:contra");
		    $query->execute($prepared);
			if( $row=($query->fetch(PDO::FETCH_NUM)) )
			{
				$_SESSION['nom_usu']=$row[0];
				$_SESSION['usu']=$row[1];
				return "true";
			}
			return "Usuario y/o contraseña incorrectos";
		}
		else
			return "ERROR:No se pudo conectar a la base de datos";
	}

	function getselectSubcategorias($select)
	{
		$db=conectar();
		if($db!=null)
		{
			$query = $db->prepare("SELECT * FROM subcategoria");
		    $query->execute();
		    $s= "<select id='idsubcategoria'>";
			while( $row=($query->fetch(PDO::FETCH_NUM)) )
			{
				if($select==$row[0])
					$s.= "<option value=".$row[0]." selected >".$row[1]."</option>";
				else
					$s.= "<option value=".$row[0].">".$row[1]."</option>";
			}
			$s.= "</select>";
			return $s;
		}
		else
			return "ERROR:No se pudo conectar a la base de datos";
	}

	function getSelectCategorias($select)
	{
		$db=conectar();
		if($db!=null)
		{
			$query = $db->prepare("SELECT * FROM categoria");
		    $query->execute();
		    $s= "<select id='idcategoria'>";
			while( $row=($query->fetch(PDO::FETCH_NUM)) )
			{
				if($select==$row[0])
					$s.= "<option value=".$row[0]." selected >".$row[1]."</option>";
				else
					$s.= "<option value=".$row[0].">".$row[1]."</option>";
			}
			$s.= "</select>";
			return $s;
		}
		else
			return "ERROR:No se pudo conectar a la base de datos";
	}

	function getSubcategorias()
	{
		$db=conectar();
		if($db!=null)
		{
			$query = $db->prepare("SELECT * FROM subcategoria");
		    $query->execute();
		    echo "<table>";
		    echo "<tr class='fondo'><td>Nombre</td><td colspan='3' >Acciones</td><tr>";
			while( $row=($query->fetch(PDO::FETCH_NUM)) )
			{
				echo "<tr>
						<td class='nombre'>".$row[1]."</td>
						<td class='acciones'><a onclick='versubcategoria(".$row[0].");'><img src='img/ver.png' class='icoacc'/></a></td>
						<td class='acciones'><a onclick='modsubcategoria(".$row[0].");'><img src='img/editar.png' class='icoacc'/></a></td>
						<td class='acciones'><a onclick='elisubcategoria(".$row[0].");'><img src='img/eliminar.png' class='icoacc'/></a></tr>";
			}
			echo "</table>";
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos";
	}

	function getSubcategoriaid($id)
	{
		$db=conectar();
		if($db!=null)
		{
			$query = $db->prepare("SELECT * FROM subcategoria WHERE id=:id");
		    $query->execute(array('id' => $id ));
		    return $query;
		}
		else
			return false;
	}

	function setSubcategoria($datos)
	{
		$db=conectar();
		if($db!=null)
		{
			$prepared = array(
				'nombre' => $datos['nombre'],
				'idcategoria' => $datos['idcategoria']
				);
			$query = $db->prepare("INSERT INTO subcategoria (nombre, idcategoria) VALUES (:nombre, :idcategoria)");
		    try {
		    	$query->execute($prepared);
		    	echo "Sus datos se han guardado exitosamente";
		    } 
		    catch ( PDOException $e) 
		    {
		    	echo "ERROR: No se puede insertar en la base de datos\nIntente mas tarde";
		    }	
		    	
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos";
	}

	function verSubcategoriaid($id)
	{
		$db=conectar();
		$query=getSubcategoriaid($id);
		if($query!=false)
		{
			if($query)
			{
				echo "<table>";
				if( $row=($query->fetch(PDO::FETCH_NUM)) )
				{
					echo 	"<tr>
								<td width='45%'><span class='r'>Nombre:</span></td><td width='70%'><span class='l'>".$row[1]."</span></td>
							</tr>
							<tr>
								<td width='45%'><span class='r'>Categoria:</span></td><td width='70%'>";
					$query = $db->prepare("SELECT * FROM categoria WHERE id=:id");
			    	$query->execute(array('id' => $row[2] ));
			    	if( $row2=($query->fetch(PDO::FETCH_NUM)) )
			    		echo "<span class='l'>".$row2[1]."</span>";
					echo 	"</td></tr>";
				}
				echo "</table>";
				echo "<center><input type='submit' value='Aceptar' onclick='subcategorias();' class='aceptar'/></center>";
			}
			else
				echo "ERROR:No se puede consultar la base de datos. Intentlo mas tarde<BR><center><input type='submit' value='Aceptar' onclick='subcategorias();' class='aceptar'/></center>";
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos<BR><center><input type='submit' value='Aceptar' onclick='subcategorias();' class='aceptar'/></center>";
	}

	function getcountSubcategoria($id)
	{
		$db=conectar();
		if($db!=null)
		{
			$query = $db->prepare("SELECT count(id) FROM producto WHERE id_subcategoria=:id");
		    $query->execute(array('id' => $id ));
		    if($query)
		    	if( $row=($query->fetch(PDO::FETCH_NUM)) )
		    		return $row[0];
		    	else 
		    		return 0;
		}
		else
			return false;
	}

	function eliSubcategoria($id)
	{
		$db=conectar();
		$query=getSubcategoriaid($id);
		$elementos=getcountSubcategoria($id);
		if($query!=false)
		{
			if($query)
			{
				echo "<table>";
				if( $row=($query->fetch(PDO::FETCH_NUM)) )
				{
					echo 	"<tr>
								<td width='45%'><span class='r'>Nombre:</span></td><td width='70%'><span class='l'>".$row[1]."</span></td>
							</tr>
							<tr>
								<td width='45%'><span class='r'>Categoria:</span></td><td width='70%'>";
					$query = $db->prepare("SELECT * FROM categoria WHERE id=:id");
			    	$query->execute(array('id' => $row[2] ));
			    	if( $row2=($query->fetch(PDO::FETCH_NUM)) )
			    		echo "<span class='l'>".$row2[1]."</span>";
					echo 	"</td></tr>";
				}
				echo "</table>";
				if($elementos>0)
					echo "<center><p class='texterror'> Nota:No se puede eliminar la categoria debido a que tiene productos</p></center><center>".
						 "<input type='submit' value='Mostar producto(s)' onclick='getProductosSubcategoria(".$row[0].");' class='mostrar'/> <input type='button' value='Cancelar' onclick='subcategorias();' class='cancelar'/></center>";
				else
					echo "<center><input type='submit' value='Aceptar' onclick='delsubcategoria(".$row[0].");' class='aceptar'/> <input type='button' value='Cancelar' onclick='subcategorias();' class='cancelar'/></center>";
			}
			else
				echo "ERROR:No se puede consultar la base de datos. Intentlo mas tarde<BR><center><input type='submit' value='Aceptar' onclick='subcategorias();' class='aceptar'/></center>";
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos<BR><center><input type='submit' value='Aceptar' onclick='subcategorias();' class='aceptar'/></center>";
	}

	function delsubcategoria($id)
	{
		$db=conectar();
		if($db!=null)
		{
			$query = $db->prepare("DELETE FROM subcategoria WHERE id=:id");
			try {
				$query->execute(array('id' => $id ));
			    echo "Se ha Eliminado exitosamente";
			} 
			catch (Exception $e) {
				echo "ERROR:No se elimino excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos<BR>";

		echo "<center><input type='submit' value='Aceptar' onclick='subcategorias();' class='aceptar'/></center>";
	}
	
	function modSubcategoria($id)
	{
		$db=conectar();
		$query=getSubcategoriaid($id);
		if($query!=false)
		{
			if($query)
			{
				
				if( $row=($query->fetch(PDO::FETCH_NUM)) )
				{
					echo "<form onsubmit='return updsubcategoria(".$row[0].")'><table>";
					echo 	"<tr>
								<td width='30%'><span class='r'>Nombre:</span></td><td width='70%'><input class='entrada-texto' id='nombre' type='text' value='".$row[1]."' autofocus required /></td>
							</tr>
							<tr>
								<td width='30%'><span class='r'>Categoria:</span></td><td width='70%'>".getSelectCategorias($row[2])."</td></tr>";
					echo "</table>";
					echo "<center><input type='submit' value='Aceptar' class='aceptar'/> <input type='button' value='Cancelar' onclick='subcategorias();' class='cancelar'/></center>";

				}
			}
			else
				echo "ERROR:No se puede consultar la base de datos. Intentlo mas tarde<BR><center><input type='submit' value='Aceptar' onclick='subcategorias();' class='aceptar'/></center>";
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos<BR><center><input type='submit' value='Aceptar' onclick='subcategorias();' class='aceptar'/></center>";
	}

	function updsubcategoria($datos)
	{
		$db=conectar();
		if($db!=null)
		{
			$prepared = array(
				'nombre' => $datos['nombre'],
				'idcategoria' => $datos['idcategoria'],
				'id' => $datos['id']
				);

			$query = $db->prepare("UPDATE subcategoria SET nombre=:nombre, idcategoria=:idcategoria WHERE id=:id");
			try {
				$query->execute($prepared);
			    echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos<BR>";

		echo "<center><input type='submit' value='Aceptar' onclick='subcategorias();' class='aceptar'/></center>";
	}

	function getProductoid($id)
	{
		$db=conectar();
		if($db!=null)
		{
			$query = $db->prepare("SELECT * FROM producto WHERE id=:id");
		    $query->execute(array('id' => $id ));
		    return $query;
		}
		else
			return false;
	}

	function getProductosSubcategoria($id)
	{
		$db=conectar();
		if($db!=null)
		{
			$db=conectar();
			if($db!=null)
			{
				$query = $db->prepare("SELECT * FROM producto WHERE id_subcategaria=:id");
			    $query->execute(array('id' => $id ));
			    echo "<table>";
			    echo "<tr class='fondo'><td>Nombre</td><td colspan='3' >Acciones</td><tr>";
				while( $row=($query->fetch(PDO::FETCH_NUM)) )
				{
					echo "<tr>
							<td class='nombre'>".$row[1]."</td>
							<td class='acciones'><a onclick='verproductos(".$row[0].");'><img src='img/ver.png' class='icoacc'/></a></td>
							<td class='acciones'><a onclick='modproductos(".$row[0].");'><img src='img/editar.png' class='icoacc'/></a></td>
							<td class='acciones'><a onclick='eliproductos(".$row[0].");'><img src='img/eliminar.png' class='icoacc'/></a></tr>";
				}
				echo "</table>";
			}
			else
				echo "ERROR:No se pudo conectar a la base de datos";
		}
	}

	function getProductos()
	{
		$db=conectar();
		if($db!=null)
		{
			$query = $db->prepare("SELECT * FROM producto");
		    $query->execute();
		    echo "<table>";
		    echo "<tr class='fondo'><td>Nombre</td><td colspan='3' >Acciones</td><tr>";
			while( $row=($query->fetch(PDO::FETCH_NUM)) )
			{
				echo "<tr>
						<td class='nombre'>".$row[1]."</td>
						<td class='acciones'><a onclick='verproductos(".$row[0].");'><img src='img/ver.png' class='icoacc'/></a></td>
						<td class='acciones'><a onclick='modproductos(".$row[0].");'><img src='img/editar.png' class='icoacc'/></a></td>
						<td class='acciones'><a onclick='eliproductos(".$row[0].");'><img src='img/eliminar.png' class='icoacc'/></a></tr>";
			}
			echo "</table>";
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos";
	}

	function setProducto($datos)
	{
		$db=conectar();
		if($db!=null)
		{
			$prepared = array(
				'nombre' => $datos['nombre'],
				'marca' => $datos['marca'],
				'precio' => $datos['precio'],
				'descripcion' => $datos['descripcion'],
				'idsubcategoria' => $datos['idsubcategoria'],
				);
			$query = $db->prepare("INSERT INTO producto (nombre, marca, precio, descripcion, id_subcategoria) VALUES (:nombre, :marca,:precio, :descripcion,:idsubcategoria)");
		    try {
		    	$query->execute($prepared);
		    	echo "Sus datos se han guardado exitosamente";
		    } 
		    catch ( PDOException $e) 
		    {
		    	echo "ERROR: No se puede insertar en la base de datos\nIntente mas tarde";
		    }	
		    	
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos";
	}

	function verProductoid($id)
	{
		$db=conectar();
		$query=getProductoid($id);
		if($query!=false)
		{
			if($query)
			{
				echo "<table>";
				if( $row=($query->fetch(PDO::FETCH_NUM)) )
				{
					echo 	"<tr>
								<td width='45%'><span class='r'>Nombre:</span></td><td width='70%'><span class='l'>".$row[1]."</span></td>
							</tr>
							<tr>
								<td width='45%'><span class='r'>Marca:</span></td><td width='70%'><span class='l'>".$row[2]."</span></td>
							</tr>
							<tr>
								<td width='45%'><span class='r'>Precio:</span></td><td width='70%'><span class='l'>".$row[3]."</span></td>
							</tr>
							<tr>
								<td width='45%'><span class='r'>Descripcion:</span></td><td width='70%'><span class='l'>".$row[4]."</span></td>
							</tr>
							<tr>
								<td width='45%'><span class='r'>Subcategoria:</span></td><td width='70%'>";
					$query = $db->prepare("SELECT * FROM subcategoria WHERE id=:id");
			    	$query->execute(array('id' => $row[5] ));
			    	if( $row2=($query->fetch(PDO::FETCH_NUM)) )
			    		echo "<span class='l'>".$row2[1]."</span>";
					echo 	"</td></tr>";
				}
				echo "</table>";
				echo "<center><input type='submit' value='Aceptar' onclick='productos();' class='aceptar'/></center>";
			}
			else
				echo "ERROR:No se puede consultar la base de datos. Intentlo mas tarde<BR><center><input type='submit' value='Aceptar' onclick='productos();' class='aceptar'/></center>";
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos<BR><center><input type='submit' value='Aceptar' onclick='productos();' class='aceptar'/></center>";
	}

	function modProducto($id)
	{
		$db=conectar();
		$query=getProductoid($id);
		if($query!=false)
		{
			if($query)
			{	
				if( $row=($query->fetch(PDO::FETCH_NUM)) )
				{
					echo "<form onsubmit='return updproductos(".$row[0].")'>
							<table>
								<tr>
									<td width='30%'><span class='r'>Nombre:</span></td><td width='70%'><input class='entrada-texto' id='nombre' type='text' value='".$row[1]."' autofocus required /></td>
								</tr>
								<tr>
									<td width='30%'><span class='r'>Marca:</span></td><td width='70%'><input class='entrada-texto' id='marca' type='text' value='".$row[2]."' autofocus required /></td>
								</tr>
								<tr>
									<td width='30%'><span class='r'>Precio:</span></td><td width='70%'><input class='entrada-texto' id='precio' type='text' value='".$row[3]."' autofocus required /></td>
								</tr>
								<tr>
									<td width='30%'><span class='r'>Descripcion:</span></td><td width='70%'><textarea rows='5' id='descripcion' autofocus required >".$row[4]."</textarea></td>
								</tr>
								<tr>
								<td width='30%'><span class='r'>Subcategoria:</span></td><td width='70%'>".getselectSubcategorias($row[5])."</td></tr>
							</table>
							<center><input type='submit' value='Aceptar' class='aceptar'/> <input type='button' value='Cancelar' onclick='productos();' class='cancelar'/></center>";

				}
			}
			else
				echo "ERROR:No se puede consultar la base de datos. Intentlo mas tarde<BR><center><input type='submit' value='Aceptar' onclick='productos();' class='aceptar'/></center>";
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos<BR><center><input type='submit' value='Aceptar' onclick='productos();' class='aceptar'/></center>";
	}

	function updProducto($datos)
	{
		$db=conectar();
		if($db!=null)
		{
			$prepared = array(
				'nombre' => $datos['nombre'],
				'marca' => $datos['marca'],
				'precio' => $datos['precio'],
				'descripcion' => $datos['descripcion'],
				'idsubcategoria' => $datos['idsubcategoria'],
				'id' => $datos['id'],
			);
			$query = $db->prepare("UPDATE producto SET nombre=:nombre, marca=:marca, precio=:precio, descripcion=:descripcion, id_subcategoria=:idsubcategoria WHERE id=:id");
			try {
				$query->execute($prepared);
			    echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos<BR>";

		echo "<center><input type='submit' value='Aceptar' onclick='productos();' class='aceptar'/></center>";
	}

	function eliProductos($id)
	{
		$db=conectar();
		$query=getProductoid($id);
		if($query!=false)
		{
			if($query)
			{
				echo "<table>";
				if( $row=($query->fetch(PDO::FETCH_NUM)) )
				{
					echo 	"<tr>
								<td width='45%'><span class='r'>Nombre:</span></td><td width='70%'><span class='l'>".$row[1]."</span></td>
							</tr>
							<tr>
								<td width='45%'><span class='r'>Marca:</span></td><td width='70%'><span class='l'>".$row[2]."</span></td>
							</tr>
							<tr>
								<td width='45%'><span class='r'>Precio:</span></td><td width='70%'><span class='l'>".$row[3]."</span></td>
							</tr>
							<tr>
								<td width='45%'><span class='r'>Descripcion:</span></td><td width='70%'><span class='l'>".$row[4]."</span></td>
							</tr>
							<tr>
								<td width='45%'><span class='r'>Subcategoria:</span></td><td width='70%'>";
					$query = $db->prepare("SELECT * FROM subcategoria WHERE id=:id");
			    	$query->execute(array('id' => $row[5] ));
			    	if( $row2=($query->fetch(PDO::FETCH_NUM)) )
			    		echo "<span class='l'>".$row2[1]."</span>";
					echo 	"</td></tr>";
				}
				echo "</table>";
				echo "<center><input type='submit' value='Aceptar' onclick='delproductos(".$row[0].");' class='aceptar'/> <input type='button' value='Cancelar' onclick='productos();' class='cancelar'/></center>";
			}
			else
				echo "ERROR:No se puede consultar la base de datos. Intentlo mas tarde<BR><center><input type='submit' value='Aceptar' onclick='productos();' class='aceptar'/></center>";
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos<BR><center><input type='submit' value='Aceptar' onclick='productos();' class='aceptar'/></center>";
	}

	function delProductos($id)
	{
		$db=conectar();
		if($db!=null)
		{
			$query = $db->prepare("DELETE FROM producto WHERE id=:id");
			try {
				$query->execute(array('id' => $id ));
			    echo "Se ha Eliminado exitosamente";
			} 
			catch (Exception $e) {
				echo "ERROR:No se elimino excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
		}
		else
			echo "ERROR:No se pudo conectar a la base de datos<BR>";

		echo "<center><input type='submit' value='Aceptar' onclick='productos();' class='aceptar'/></center>";
	}

?>