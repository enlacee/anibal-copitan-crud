<?php

class Acc_Table_Crud_Backend {

	private $plugin_name;
	private $version;
	private $file;

	/**
	* construct
	*/
	public function __construct( $plugin_name, $version, $file) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->file = $file;

	}

	/*
	* Agregar menu
	*/
	public function add_menu()
	{
		add_menu_page(
			'Settings Anibal Copitan Crud',
			'Settings Anibal Copitan Crud',
			'manage_options', // capability *admin*
			$this->file,
			array($this, 'display_menu_content'),
			null,
			null
		);
	}

	/*
	* View
	*/
	static function display_menu_content()
	{
		global $wpdb;
		$classTable = Acc_Table_Crud::getInstance();
		$table_name = $classTable->getName();
		$adminPageURL = urlencode($_GET['page']);

		// DATA
		$results = $classTable->getAll(); 
		?>
		<div class="wrap">
		  <h2>Anibal Copitan Crud (beta)</h2>
		  <table class="wp-list-table widefat striped">
		    <thead>
		      <tr>
		        <th width="5%">User ID</th>
		        <th width="25%">Nombre</th>
		        <th width="25%">Apellido</th>
		        <th width="25%">Sexo</th>
		        <th width="20%">Acciones</th>
		      </tr>
		    </thead>
		    <tbody>
				<form action="" method="post" autocomplete="off">
				  <tr>
				    <td><input type="text" value="AUTO" disabled></td>
				    <td><input type="text" id="nombre" name="nombre"></td>
				    <td><input type="text" id="apellido" name="apellido"></td>
				    <td>
				    	<select id="sexo" name="sexo">
				    		<option value="1">Masculino</option>
				    		<option value="0">Fememino</option>
				    	</select>
				    </td>
				    <td><button id="newsubmit" name="newsubmit" type="submit">Agregar</button></td>
				  </tr>
				</form>

				<?php foreach($results as $item): ?>
				<tr>
				<td><?php echo $item->id; ?></td>
				<td><?php echo $item->nombre; ?></td>
				<td><?php echo $item->apellido; ?></td>
				<td><?php echo ($item->sexo == '1') ? 'Masculino' : 'Femenino'; ?></td>
				<td>
					<a href='admin.php?page=<?php echo $adminPageURL; ?>&upt=<?php echo $item->id; ?>'>
						Actualizar</a>
					<a href='admin.php?page=<?php echo $adminPageURL; ?>&del=<?php echo $item->id; ?> '>Eliminar</a></td>
				</tr>
				<?php endforeach; ?>
		    </tbody>
		  </table>
		</div>

		<?php

		/********************************************************
		 * Acciones to process
		 ********************************************************/
		 /**
		 * INSERT: Add new record
		 */
		if (isset($_POST['newsubmit'])) {
			$name = strip_tags($_POST['nombre']);
			$apellido = strip_tags($_POST['apellido']);
			$sexo = strip_tags($_POST['sexo']);

			if ( !empty($name) && !empty($apellido) && !empty($sexo)) {
				$rs = $classTable->insert(array(
					'nombre'	=> $name,
					'apellido'	=> $apellido,
					'sexo'		=> $sexo
				));
				echo "<p>Se registro correctamente!</p>";
			} else {
				echo "<p style='color:red'>Ocurrio un error, verifique los datos ingresados.</p>";
			}
			echo "<script>location.replace('admin.php?page=". $adminPageURL ."');</script>";
		}

		 /**
		 * UPDATE: record
		 */
		if (isset($_POST['uptsubmit'])) {
			$id = $_POST['id'];
			$name = strip_tags($_POST['nombre']);
			$apellido = strip_tags($_POST['apellido']);
			$sexo = strip_tags($_POST['sexo']);

			$rs = $classTable->update(array(
				'id'		=> $id,
				'nombre'	=> $name,
				'apellido'	=> $apellido,
				'sexo'		=> $sexo
			));
		  
			echo "<script>location.replace('admin.php?page=". $adminPageURL ."');</script>";
		}

		 /**
		 * DELETE: record
		 */
		if (isset($_GET['del'])) {
			$del_id = $_GET['del'];
			$rs = $classTable->delete($del_id);

			echo "<script>location.replace('admin.php?page=". $adminPageURL ."');</script>";
		}


		 /**
		 * VIEW UPDATE
		 */
		if (isset($_GET['upt'])) {
			$id = $_GET['upt'];
			$print = $wpdb->get_row("SELECT * FROM $table_name WHERE id='$id'");

			$selectMasculino = ($print->sexo == '1') ? 'selected ' : '';
			$selectFemenino = ($print->sexo == '0') ? 'selected ' : '';
			echo "
			<table class='wp-list-table widefat striped'>
			  <thead>
			    <tr>
			      <th width='5%'>User ID</th>
			      <th width='25%'>Nombre</th>
			      <th width='25%'>Apellido</th>
			      <th width='25%'>Sexo</th>
			      <th width='20%'>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    <form action='' method='post'>
			      <tr>
			        <td width='5%'>$print->id <input type='hidden' id='id' name='id' value='$print->id'></td>
			        <td width='25%'><input type='text' id='nombre' name='nombre' value='$print->nombre'></td>
			        <td width='25%'><input type='text' id='apellido' name='apellido' value='$print->apellido'></td>
			        <td width='25%'>
				    	<select id='sexo' name='sexo'>
				    		<option value='1' {$selectMasculino}>Masculino</option>
				    		<option value='0' {$selectFemenino}>Fememino</option>
				    	</select></td>
			        <td width='20%'><button id='uptsubmit' name='uptsubmit' type='submit'>Actualizar</button> <a href='admin.php?page=$adminPageURL'><button type='button'>Cancelar</button></a></td>
			      </tr>
			    </form>
			  </tbody>
			</table>";
		}

	}

}
